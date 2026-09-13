<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Models\Pelanggan;
use App\Models\Produk;

class PesananController extends Controller
{
    private function isKasir()
    {
        $sessionUser = session('user');
        $currentLoggedUser = null;
        if (session()->has('user_id')) {
            $currentLoggedUser = \App\Models\User::find(session('user_id'));
        }
        if (!$currentLoggedUser && $sessionUser) {
            $currentLoggedUser = \App\Models\User::where('name', $sessionUser)->orWhere('email', $sessionUser)->first();
        }
        $name = $currentLoggedUser ? $currentLoggedUser->name : $sessionUser;
        $email = $currentLoggedUser ? $currentLoggedUser->email : '';
        return (strtolower($name ?? '') === 'kasir' || str_contains(strtolower($email ?? ''), 'kasir'));
    }

    public function index()
    {
        $pesanans = Pesanan::orderBy('id', 'desc')->get();
        $pelanggans = Pelanggan::orderBy('nama', 'asc')->get();
        $produks = Produk::orderBy('nama_produk', 'asc')->get();
        return view('pesanan', compact('pesanans', 'pelanggans', 'produks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'status' => 'nullable|string',
        ]);

        $statusProduksi = 'Antrean Cetak'; // Selalu otomatis antrean cetak untuk pesanan baru
        $rawItems = $request->input('items_json');
        $items = [];

        if (!empty($rawItems)) {
            $decoded = json_decode($rawItems, true);
            if (is_array($decoded) && count($decoded) > 0) {
                $items = $decoded;
            }
        }

        $totalHarga = 0;
        $namaProdukUtama = '';
        $jumlahUkuranSummary = '';

        if (!empty($items)) {
            // Multi-Item Processing
            $itemCount = count($items);
            foreach ($items as $idx => $it) {
                $sub = floatval($it['subtotal'] ?? 0);
                $totalHarga += $sub;

                // Decrement stock for product
                $prod = Produk::where('nama_produk', $it['nama_produk'])->first();
                $q = intval($it['qty'] ?? 1);
                if ($prod && $prod->stok > 0) {
                    $prod->decrement('stok', min($q, $prod->stok));
                }
            }

            $namaProdukUtama = $items[0]['nama_produk'];
            if ($itemCount > 1) {
                $namaProdukUtama .= " (+ " . ($itemCount - 1) . " produk lainnya)";
                $jumlahUkuranSummary = "{$itemCount} Macam Item";
            } else {
                $firstQty = $items[0]['qty'] ?? 1;
                $firstUnit = $items[0]['satuan'] ?? 'pcs';
                $firstUkuran = $items[0]['ukuran'] ?? '';
                $jumlahUkuranSummary = trim("{$firstQty} {$firstUnit} " . ($firstUkuran ? "({$firstUkuran})" : ""));
            }
        } else {
            // Single Item Fallback
            $request->validate([
                'nama_produk' => 'required|string|max:255',
                'total_harga' => 'required|numeric|min:0',
            ]);

            $namaProdukUtama = $request->input('nama_produk');
            $totalHarga = floatval($request->input('total_harga'));

            $produk = Produk::where('nama_produk', $namaProdukUtama)->first();
            $requestedQty = intval($request->input('jumlah_val', 1));

            if ($produk) {
                if ($produk->stok <= 0) {
                    return back()->withInput()->with('error', "Stok untuk produk '{$produk->nama_produk}' sedang HABIS!");
                }
                if ($requestedQty > $produk->stok) {
                    return back()->withInput()->with('error', "Jumlah pesanan ({$requestedQty}) melebihi stok yang tersedia ({$produk->stok})!");
                }
                $produk->decrement('stok', min($requestedQty, $produk->stok));
            }

            $jumlahVal = $request->input('jumlah_val', $request->input('jumlah', '1'));
            $jumlahUnit = $request->input('jumlah_unit', 'Pcs');
            $ukuranVal = trim($request->input('ukuran_val', $request->input('ukuran', '')));
            $formattedUkuran = !empty($ukuranVal) ? " ({$ukuranVal})" : '';
            $jumlahUkuranSummary = "{$jumlahVal} {$jumlahUnit}{$formattedUkuran}";

            $items = [
                [
                    'nama_produk' => $namaProdukUtama,
                    'qty' => $jumlahVal,
                    'satuan' => $jumlahUnit,
                    'ukuran' => $ukuranVal,
                    'harga' => $totalHarga,
                    'subtotal' => $totalHarga,
                    'catatan' => $request->input('catatan_finishing', ''),
                ]
            ];
        }

        $lastId = Pesanan::max('id') + 1;
        $year = date('Y');
        $kodePesanan = "ORD-{$year}-" . str_pad($lastId, 3, '0', STR_PAD_LEFT);

        // Upload File Desain dari Laptop dengan Verifikasi Ketat Anti-Spoofing ATAU Link Drive
        $fileDesain = $request->input('file_desain');
        if ($request->hasFile('file_upload')) {
            try {
                $fileDesain = $this->validateAndStoreDesignFile($request, $kodePesanan);
            } catch (\Exception $e) {
                return back()->withInput()->with('error', $e->getMessage());
            }
        }

        // Payment Handling: Lunas, DP, or Belum Bayar (Default is belum_bayar, managed in Menu Pembayaran)
        $pembayaranTipe = $request->input('pembayaran_tipe', 'belum_bayar');
        $metodeBayar = $request->input('metode_pembayaran', 'Tunai');
        $statusPembayaran = 'Belum Lunas';
        $sisaBayar = $totalHarga;

        if ($pembayaranTipe === 'lunas') {
            $statusPembayaran = 'Lunas';
            $sisaBayar = 0;
        } elseif ($pembayaranTipe === 'dp') {
            $dpNominal = floatval($request->input('dp_nominal', $totalHarga * 0.5));
            $dpNominal = min($totalHarga, max(1, $dpNominal));
            $sisaBayar = max(0, $totalHarga - $dpNominal);
            $statusPembayaran = $sisaBayar == 0 ? 'Lunas' : 'DP';
        } else {
            $statusPembayaran = 'Belum Lunas';
            $sisaBayar = $totalHarga;
        }

        $pesanan = Pesanan::create([
            'kode_pesanan' => $kodePesanan,
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'nama_produk' => $namaProdukUtama,
            'jumlah_ukuran' => $jumlahUkuranSummary,
            'total_harga' => $totalHarga,
            'status' => 'Antrean Cetak',
            'tanggal_pesan' => now()->toDateString(),
            'detail_items' => $items,
            'catatan_finishing' => $request->input('catatan_finishing'),
            'file_desain' => $fileDesain,
            'status_pembayaran' => $statusPembayaran,
            'sisa_bayar' => $sisaBayar,
        ]);

        // Auto Create Pembayaran Record if Lunas or DP
        if ($pembayaranTipe === 'lunas' || $pembayaranTipe === 'dp') {
            $payLastId = Pembayaran::max('id') + 1;
            $payNominal = $pembayaranTipe === 'lunas' ? $totalHarga : floatval($request->input('dp_nominal', $totalHarga * 0.5));
            $uangDiterima = floatval($request->input('uang_diterima', $payNominal));
            $kembalian = max(0, $uangDiterima - $payNominal);

            Pembayaran::create([
                'kode_pembayaran' => "PAY-{$year}-" . str_pad($payLastId, 3, '0', STR_PAD_LEFT),
                'kode_pesanan' => $kodePesanan,
                'metode' => $metodeBayar,
                'jumlah' => $payNominal,
                'status' => $pembayaranTipe === 'lunas' ? 'Lunas' : 'DP (Uang Muka)',
                'tanggal' => now()->toDateString(),
                'uang_diterima' => $uangDiterima,
                'kembalian' => $kembalian,
            ]);
        }

        // Auto sync Pelanggan table
        $pelanggan = Pelanggan::where('nama', $validated['nama_pelanggan'])->first();
        if ($pelanggan) {
            $pelanggan->increment('total_pesanan');
        } else {
            $nextCusId = Pelanggan::max('id') + 1;
            Pelanggan::create([
                'kode_pelanggan' => 'CUST-' . str_pad($nextCusId, 3, '0', STR_PAD_LEFT),
                'nama' => $validated['nama_pelanggan'],
                'email' => strtolower(str_replace(' ', '', $validated['nama_pelanggan'])) . '@gmail.com',
                'no_hp' => '+62 812-' . rand(1000, 9999) . '-' . rand(1000, 9999),
                'alamat' => 'Jakarta, Indonesia',
                'total_pesanan' => 1,
                'tanggal_daftar' => now()->toDateString(),
                'status' => 'Aktif',
            ]);
        }

        return redirect()->route('pesanan')->with('success', "Pesanan baru {$kodePesanan} berhasil dibuat dengan status Antrean Cetak!");
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|string',
        ]);

        $updateData = ['status' => $validated['status']];

        if ($request->filled('catatan_finishing')) {
            $updateData['catatan_finishing'] = $request->input('catatan_finishing');
        }

        if ($request->hasFile('file_upload')) {
            try {
                $filePath = $this->validateAndStoreDesignFile($request, $pesanan->kode_pesanan);
                $updateData['file_desain'] = $filePath;
            } catch (\Exception $e) {
                return back()->withInput()->with('error', $e->getMessage());
            }
        } elseif ($request->filled('file_desain')) {
            $updateData['file_desain'] = $request->input('file_desain');
        }

        $pesanan->update($updateData);

        return redirect()->route('pesanan')->with('success', "Status alur produksi pesanan {$pesanan->kode_pesanan} berhasil diperbarui!");
    }

    /**
     * Validasi Ketat Anti-Spoofing & Penyimpanan File Desain Percetakan
     * Mencegah file teks biasa yang sengaja diubah ekstensinya menjadi .jpg, .svg, .pdf, dll.
     */
    private function validateAndStoreDesignFile(Request $request, $kodePesanan)
    {
        if (!$request->hasFile('file_upload')) {
            return $request->input('file_desain');
        }

        $file = $request->file('file_upload');

        if (!$file->isValid()) {
            throw new \Exception("File desain gagal diunggah atau rusak saat proses transfer.");
        }

        // Batas maksimal ukuran file: 50 MB
        $maxBytes = 50 * 1024 * 1024;
        if ($file->getSize() > $maxBytes) {
            throw new \Exception("Ukuran file terlalu besar (" . round($file->getSize() / 1024 / 1024, 1) . " MB). Maksimal 50 MB!");
        }

        $origName = $file->getClientOriginalName();
        $ext = strtolower($file->getClientOriginalExtension());
        $filePath = $file->getRealPath();

        $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'pdf', 'tif', 'tiff', 'svg', 'ai', 'psd', 'cdr', 'zip'];
        if (!in_array($ext, $allowedExts)) {
            throw new \Exception("Ekstensi file '.{$ext}' tidak diizinkan! Gunakan format percetakan: JPG, PNG, PDF, TIFF, SVG, AI, PSD, CDR, ZIP.");
        }

        // 1. Deteksi Magic MIME menggunakan finfo PHP
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $filePath);
        finfo_close($finfo);

        // Baca 512 byte pertama untuk inspeksi magic header binary
        $fp = fopen($filePath, 'rb');
        $headerBytes = fread($fp, 512);
        fclose($fp);

        // 2. DETEKSI GAMBAR BITMAP (JPG, JPEG, PNG, WEBP)
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            // Tolak jika terdeteksi text biasa atau script
            if (str_starts_with($mime, 'text/') || $mime === 'application/x-empty' || str_contains($mime, 'script')) {
                throw new \Exception("VALIDASI DITOLAK: File '{$origName}' terdeteksi sebagai teks biasa yang diubah ekstensinya menjadi .{$ext}! Harap unggah file gambar grafis asli.");
            }

            // getimagesize memverifikasi struktur biner header gambar yang sebenarnya
            $imgInfo = @getimagesize($filePath);
            if ($imgInfo === false || empty($imgInfo[0]) || empty($imgInfo[1])) {
                throw new \Exception("VALIDASI DITOLAK: File '{$origName}' bukan gambar yang valid! Header biner gambar tidak ditemukan atau rusak (file teks yang diganti ekstensi).");
            }

            // Verifikasi MIME internal dari parser gambar
            $validMimes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!in_array($mime, $validMimes) && !in_array($imgInfo['mime'], $validMimes)) {
                throw new \Exception("VALIDASI DITOLAK: Format biner file '{$origName}' tidak cocok dengan ekstensi gambar .{$ext}.");
            }
        }

        // 3. DETEKSI VEKTOR SVG (XML-based Vector)
        elseif ($ext === 'svg') {
            $content = file_get_contents($filePath);

            // File teks biasa tidak memiliki tag <svg
            if (!preg_match('/<svg[\s\S]*?>/i', $content)) {
                throw new \Exception("VALIDASI DITOLAK: File '{$origName}' terdeteksi sebagai file teks biasa tanpa elemen vektor grafik SVG!");
            }

            // Validasi kelayakan sintaks XML
            libxml_use_internal_errors(true);
            $xml = simplexml_load_string($content);
            $errors = libxml_get_errors();
            libxml_clear_errors();

            if ($xml === false || strtolower($xml->getName()) !== 'svg') {
                throw new \Exception("VALIDASI DITOLAK: File '{$origName}' bukan format SVG vector yang valid (struktur XML rusak atau palsu).");
            }

            // Sanitasi keamanan SVG
            if (stripos($content, '<script') !== false || stripos($content, 'javascript:') !== false) {
                throw new \Exception("VALIDASI DITOLAK: File SVG '{$origName}' ditolak karena mengandung script berbahaya!");
            }
        }

        // 4. DETEKSI DOKUMEN PDF
        elseif ($ext === 'pdf') {
            // PDF resmi wajib memiliki magic byte '%PDF-' di awal
            if (!str_starts_with($headerBytes, '%PDF-')) {
                throw new \Exception("VALIDASI DITOLAK: File '{$origName}' bukan dokumen PDF asli! Magic header '%PDF-' tidak ditemukan (tampaknya file teks yang di-rename).");
            }
        }

        // 5. DETEKSI FORMAT DESAIN KHUSUS (TIFF, PSD, ZIP, AI, CDR)
        elseif (in_array($ext, ['tif', 'tiff'])) {
            $isTiff = str_starts_with($headerBytes, "II*\x00") || str_starts_with($headerBytes, "MM\x00*");
            if (!$isTiff) {
                throw new \Exception("VALIDASI DITOLAK: File '{$origName}' bukan file format TIFF percetakan yang valid.");
            }
        }
        elseif ($ext === 'psd') {
            if (!str_starts_with($headerBytes, '8BPS')) {
                throw new \Exception("VALIDASI DITOLAK: File '{$origName}' bukan file format Adobe Photoshop (.psd) asli.");
            }
        }
        elseif ($ext === 'zip') {
            if (!str_starts_with($headerBytes, "PK\x03\x04")) {
                throw new \Exception("VALIDASI DITOLAK: File '{$origName}' bukan arsip berkas ZIP yang valid.");
            }
        }
        elseif ($ext === 'ai') {
            if (!str_starts_with($headerBytes, '%PDF-') && !str_starts_with($headerBytes, '%!PS')) {
                throw new \Exception("VALIDASI DITOLAK: File '{$origName}' bukan file Adobe Illustrator (.ai) asli.");
            }
        }
        elseif ($ext === 'cdr') {
            if (!str_starts_with($headerBytes, 'RIFF') && !str_starts_with($headerBytes, "PK\x03\x04")) {
                throw new \Exception("VALIDASI DITOLAK: File '{$origName}' bukan file CorelDraw (.cdr) asli.");
            }
        }

        // Simpan file ke direktori public/uploads/desain
        $targetDir = public_path('uploads/desain');
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $cleanCode = preg_replace('/[^a-zA-Z0-9_-]/', '_', $kodePesanan);
        $fileName = 'desain-' . $cleanCode . '-' . time() . '-' . \Illuminate\Support\Str::random(6) . '.' . $ext;
        $file->move($targetDir, $fileName);

        return '/uploads/desain/' . $fileName;
    }

    public function destroy($id)
    {
        if ($this->isKasir()) {
            return back()->with('error', 'Akses ditolak! Akun Kasir tidak diizinkan menghapus data pesanan. Hanya Administrator yang dapat menghapus transaksi.');
        }

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('pesanan')->with('success', "Pesanan {$pesanan->kode_pesanan} berhasil dihapus!");
    }
}
