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

        // Upload File Desain Utama dari Laptop ATAU Link Drive
        $fileDesain = $request->input('file_desain');
        if ($request->hasFile('file_upload')) {
            try {
                $fileDesain = $this->validateAndSaveSingleUploadedFile($request->file('file_upload'), $kodePesanan, 'utama');
            } catch (\Exception $e) {
                return back()->withInput()->with('error', $e->getMessage());
            }
        }

        // Upload & Asosiasikan File Desain untuk Masing-Masing Item (Multi-Item Design Support)
        if (!empty($items)) {
            foreach ($items as $idx => &$it) {
                $fileKey = "item_file_{$idx}";
                $linkKey = "item_link_{$idx}";

                if ($request->hasFile($fileKey)) {
                    try {
                        $itPath = $this->validateAndSaveSingleUploadedFile($request->file($fileKey), $kodePesanan, "item_" . ($idx + 1));
                        $it['file_desain'] = $itPath;
                    } catch (\Exception $e) {
                        return back()->withInput()->with('error', "Item " . ($idx + 1) . " ({$it['nama_produk']}): " . $e->getMessage());
                    }
                } elseif ($request->filled($linkKey)) {
                    $it['file_desain'] = $request->input($linkKey);
                } elseif (!empty($it['file_desain'])) {
                    // Retain link/path from cart builder
                    $it['file_desain'] = $it['file_desain'];
                } elseif (!empty($fileDesain)) {
                    // Fallback to master file if available
                    $it['file_desain'] = $fileDesain;
                } else {
                    $it['file_desain'] = null;
                }
            }
            unset($it);

            // Jika fileDesain utama kosong, gunakan file desain item pertama sebagai representasi
            if (empty($fileDesain) && !empty($items[0]['file_desain'])) {
                $fileDesain = $items[0]['file_desain'];
            }
        }

        // Validasi Wajib Desain Cetak (Master File atau File per Item)
        $hasAnyItemDesign = false;
        if (!empty($items)) {
            foreach ($items as $it) {
                if (!empty($it['file_desain'])) {
                    $hasAnyItemDesign = true;
                    break;
                }
            }
        }

        if (empty($fileDesain) && !$hasAnyItemDesign) {
            return back()->withInput()->with('error', 'Pesanan wajib menyertakan file desain cetak! Silakan upload file dari laptop atau cantumkan tautan Google Drive.');
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
                'telepon' => '-',
                'email' => null,
                'alamat' => '-',
                'status' => 'Aktif',
                'total_pesanan' => 1,
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
                $filePath = $this->validateAndSaveSingleUploadedFile($request->file('file_upload'), $pesanan->kode_pesanan, 'update');
                $updateData['file_desain'] = $filePath;
            } catch (\Exception $e) {
                return back()->withInput()->with('error', $e->getMessage());
            }
        } elseif ($request->filled('file_desain')) {
            $updateData['file_desain'] = $request->input('file_desain');
        }

        // Update detail_items per-item designs if submitted
        $detailItems = $pesanan->detail_items;
        if (is_array($detailItems) && count($detailItems) > 0) {
            $hasItemUpdate = false;
            foreach ($detailItems as $idx => &$it) {
                $fileKey = "item_file_{$idx}";
                $linkKey = "item_link_{$idx}";

                if ($request->hasFile($fileKey)) {
                    try {
                        $itPath = $this->validateAndSaveSingleUploadedFile($request->file($fileKey), $pesanan->kode_pesanan, "item_" . ($idx + 1));
                        $it['file_desain'] = $itPath;
                        $hasItemUpdate = true;
                    } catch (\Exception $e) {
                        return back()->withInput()->with('error', "Item " . ($idx + 1) . " ({$it['nama_produk']}): " . $e->getMessage());
                    }
                } elseif ($request->filled($linkKey)) {
                    $it['file_desain'] = $request->input($linkKey);
                    $hasItemUpdate = true;
                }
            }
            unset($it);

            if ($hasItemUpdate) {
                $updateData['detail_items'] = $detailItems;
            }
        }

        $pesanan->update($updateData);

        return redirect()->route('pesanan')->with('success', "Status alur produksi pesanan {$pesanan->kode_pesanan} berhasil diperbarui!");
    }

    /**
     * Validasi Ketat Anti-Spoofing & Penyimpanan File Desain Percetakan
     */
    private function validateAndSaveSingleUploadedFile($file, $kodePesanan, $suffix = '')
    {
        if (!$file || !$file->isValid()) {
            throw new \Exception("File desain gagal diunggah atau rusak.");
        }

        // Batas maksimal ukuran file: 50 MB
        $maxBytes = 50 * 1024 * 1024;
        if ($file->getSize() > $maxBytes) {
            throw new \Exception("Ukuran file terlalu besar (" . round($file->getSize() / 1024 / 1024, 1) . " MB). Maksimal 50 MB.");
        }

        $origName = $file->getClientOriginalName();
        $ext = strtolower($file->getClientOriginalExtension());
        $filePath = $file->getRealPath();

        $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'pdf', 'tif', 'tiff', 'svg', 'ai', 'psd', 'cdr', 'zip'];
        if (!in_array($ext, $allowedExts)) {
            throw new \Exception("Format '.{$ext}' tidak didukung.");
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
                throw new \Exception("File '{$origName}' bukan gambar {$ext} yang valid.");
            }

            // getimagesize memverifikasi struktur biner header gambar yang sebenarnya
            $imgInfo = @getimagesize($filePath);
            if ($imgInfo === false || empty($imgInfo[0]) || empty($imgInfo[1])) {
                throw new \Exception("File '{$origName}' bukan gambar yang valid.");
            }

            // Verifikasi MIME internal dari parser gambar
            $validMimes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!in_array($mime, $validMimes) && !in_array($imgInfo['mime'], $validMimes)) {
                throw new \Exception("File '{$origName}' bukan gambar yang valid.");
            }
        }

        // 3. DETEKSI VEKTOR SVG (XML-based Vector)
        elseif ($ext === 'svg') {
            $content = file_get_contents($filePath);

            if (!preg_match('/<svg[\s\S]*?>/i', $content)) {
                throw new \Exception("File '{$origName}' bukan file SVG yang valid.");
            }

            // Validasi kelayakan sintaks XML
            libxml_use_internal_errors(true);
            $xml = simplexml_load_string($content);
            $errors = libxml_get_errors();
            libxml_clear_errors();

            if ($xml === false || strtolower($xml->getName()) !== 'svg') {
                throw new \Exception("File '{$origName}' bukan format SVG yang valid.");
            }

            // Sanitasi keamanan SVG
            if (stripos($content, '<script') !== false || stripos($content, 'javascript:') !== false) {
                throw new \Exception("File SVG '{$origName}' tidak diizinkan.");
            }
        }

        // 4. DETEKSI DOKUMEN PDF
        elseif ($ext === 'pdf') {
            if (!str_starts_with($headerBytes, '%PDF-')) {
                throw new \Exception("File '{$origName}' bukan dokumen PDF yang valid.");
            }
        }

        // 5. DETEKSI FORMAT DESAIN KHUSUS (TIFF, PSD, ZIP, AI, CDR)
        elseif (in_array($ext, ['tif', 'tiff'])) {
            $isTiff = str_starts_with($headerBytes, "II*\x00") || str_starts_with($headerBytes, "MM\x00*");
            if (!$isTiff) {
                throw new \Exception("File '{$origName}' bukan file TIFF yang valid.");
            }
        }
        elseif ($ext === 'psd') {
            if (!str_starts_with($headerBytes, '8BPS')) {
                throw new \Exception("File '{$origName}' bukan file PSD yang valid.");
            }
        }
        elseif ($ext === 'zip') {
            if (!str_starts_with($headerBytes, "PK\x03\x04")) {
                throw new \Exception("File '{$origName}' bukan file ZIP yang valid.");
            }
        }
        elseif ($ext === 'ai') {
            if (!str_starts_with($headerBytes, '%PDF-') && !str_starts_with($headerBytes, '%!PS')) {
                throw new \Exception("File '{$origName}' bukan file AI yang valid.");
            }
        }
        elseif ($ext === 'cdr') {
            if (!str_starts_with($headerBytes, 'RIFF') && !str_starts_with($headerBytes, "PK\x03\x04")) {
                throw new \Exception("File '{$origName}' bukan file CDR yang valid.");
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
