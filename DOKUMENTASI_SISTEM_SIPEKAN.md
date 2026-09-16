# DOKUMEN MASTER PRESENTASI & BEDAH SISTEM TERPADU
# SIPEKAN (Sistem Informasi Manajemen Percetakan & Kasir Layanan)

---

## DAFTAR ISI
1. [BAGIAN 1: NASKAH PEMBUKAAN PRESENTASI (OPENING SCRIPT)](#bagian-1-naskah-pembukaan-presentasi-opening-script)
2. [BAGIAN 2: LATAR BELAKANG, PROBLEM SOLVER, & TUJUAN SISTEM](#bagian-2-latar-belakang-problem-solver--tujuan-sistem)
3. [BAGIAN 3: SPESIFIKASI TEKNIS & LINGKUNGAN PENGEMBANGAN (TECH STACK)](#bagian-3-spesifikasi-teknis--lingkungan-pengembangan-tech-stack)
4. [BAGIAN 4: ARSITEKTUR BASIS DATA & RELASI ANTAR TABEL (DATABASE SCHEMA)](#bagian-4-arsitektur-basis-data--relasi-antar-tabel-database-schema)
5. [BAGIAN 5: BEDAH KOMPONEN & ARSITEKTUR LAYOUT GLOBAL](#bagian-5-bedah-komponen--arsitektur-layout-global)
6. [BAGIAN 6: BEDAH DETAIL 9 MODUL, SETIAP HALAMAN, & SELURUH FUNGSI KECILNYA](#bagian-6-bedah-detail-9-modul-setiap-halaman--seluruh-fungsi-kecilnya)
   - [Modul 1: Autentikasi & Keamanan Gerbang Masuk (`login.blade.php`)](#1-modul-autentikasi--keamanan-gerbang-masuk-loginbladephp)
   - [Modul 2: Otentikasi Dua Faktor Google Authenticator (`two-factor.blade.php`)](#2-modul-otentikasi-dua-faktor--2fa-two-factorbladephp)
   - [Modul 3: Dasbor Analitik & Business Intelligence (`dashboard.blade.php`)](#3-modul-dasbor-analitik--business-intelligence-dashboardbladephp)
   - [Modul 4: Manajemen Direktori Pelanggan (`pelanggan.blade.php`)](#4-modul-manajemen-direktori-pelanggan-pelangganbladephp)
   - [Modul 5: Katalog Produk & Kontrol Inventaris Stok (`produk.blade.php`)](#5-modul-katalog-produk--kontrol-inventaris-stok-produkbladephp)
   - [Modul 6: Inti Pemesanan Percetakan & Multi-Item Cart (`pesanan.blade.php`)](#6-modul-inti-pemesanan-percetakan--multi-item-cart-pesananbladephp)
   - [Modul 7: Kasir POS, Pembayaran Bertahap (DP), & Struk Kasir (`pembayaran.blade.php`)](#7-modul-kasir-pos-pembayaran-bertahap-dp--struk-kasir-pembayaranbladephp)
   - [Modul 8: Laporan Finansial, Piutang, & Ekspor Cetak (`laporan.blade.php`)](#8-modul-laporan-finansial-piutang--ekspor-cetak-laporanbladephp)
   - [Modul 9: Pengaturan Sistem & Manajemen Hak Akses (`pengaturan.blade.php`)](#9-modul-pengaturan-sistem--manajemen-hak-akses-pengaturanbladephp)
7. [BAGIAN 7: DIAGRAM ALUR BISNIS END-TO-END (WORKFLOW LENGKAP)](#bagian-7-diagram-alur-bisnis-end-to-end-workflow-lengkap)
8. [BAGIAN 8: NASKAH PENUTUP PRESENTASI & SIMULASI TANYA-JAWAB PENGUJI (Q&A PREP)](#bagian-8-naskah-penutup-presentasi--simulasi-tanya-jawab-penguji-qa-prep)

---

# BAGIAN 1: NASKAH PEMBUKAAN PRESENTASI (OPENING SCRIPT)

> **Petunjuk Pembawaan:** Berbicaralah dengan nada mantap, tenang, tatap mata audiens/dosen penguji, dan tunjukkan rasa percaya diri.

*"Selamat pagi/siang kepada Bapak/Ibu dosen penguji, pembimbing, serta rekan-rekan sekalian.*

*Terima kasih atas kesempatan yang diberikan kepada saya hari ini. Perkenalkan, nama saya **[Nama Anda]**. Pada kesempatan yang sangat berharga ini, saya akan mempresentasikan hasil rancang bangun proyek aplikasi web yang telah saya kembangkan selama 2 bulan terakhir, yaitu:*

### **SIPEKAN: Sistem Informasi Manajemen Percetakan & Kasir Layanan**

*Aplikasi ini dirancang khusus untuk memecahkan persoalan riil dan krusial yang kerap dihadapi oleh industri percetakan digital maupun offset, mulai dari kekacauan koordinasi nota, kesalahan cetak bahan, file desain yang tercecer, hingga selisih perhitungan kasir antara uang muka (DP) dan sisa tagihan.*

*SIPEKAN hadir sebagai solusi digital berbasis web terintegrasi yang menyatukan alur manajemen pelanggan, persediaan stok bahan otomatis, keranjang pesanan cetak kustom multi-item, integrasi file desain dan instruksi finishing, sistem kasir POS berfitur kembalian dan cetak struk thermal, dashboard analitik pertumbuhan omset bulanan, hingga proteksi keamanan data tingkat tinggi dengan enkripsi dan Google Authenticator 2-Factor Authentication.*

*Izinkan saya menjabarkan secara rinci seluruh aspek teknis sistem ini, mulai dari problem solving, arsitektur database, desain antarmuka, hingga logika fungsi-fungsi kecil di balik kode programnya."*

---

# BAGIAN 2: LATAR BELAKANG, PROBLEM SOLVER, & TUJUAN SISTEM

### 1. Masalah Nyata di Industri Percetakan Konvensional (*The Pain Points*)
Sebelum sistem **SIPEKAN** dibangun, operasional harian percetakan konvensional mengalami 5 titik kegagalan (*bottlenecks*):
1. **Mis-Komunikasi Fatal Kasir vs Bagian Produksi:**
   - Kasir mencatat order pada nota fisik manual kertas: *"Spanduk 3x1 m, mata ayam pojok"*. Nota kertas kerap terselip, basah, robek, atau tulisannya tidak terbaca oleh operator mesin.
   - Operator mesin salah memilih jenis bahan (misal tertukar antara Flexi Frontlite 280g dan Flexi Korea 440g) atau lupa menambahkan instruksi finishing penting (seperti laminasi doff atau potong pas gambar). Akibatnya: **Bahan terbuang percuma (*waste material*), biaya operasional membengkak, dan konsumen komplain.**
2. **File Desain Konsumen Tercecer Tanpa Jejak:**
   - Konsumen mengirimkan file desain melalui beragam saluran tidak terpusat (WhatsApp pribadi kasir A, email percetakan, flashdisk fisik, link Google Drive). Saat giliran cetak tiba, operator mesin menghabiskan waktu lama hanya untuk mencari mana file desain final (*final artwork*) yang benar-benar siap naik mesin.
3. **Kekacauan Penanganan Uang Muka (DP) & Selisih Kasir Fisik:**
   - Dalam industri percetakan, hampir 80% transaksi bernominal menengah ke atas menggunakan skema **DP (Uang Muka)**, dan sisanya dilunasi saat pengambilan barang.
   - Kasir manual sering lupa menagih sisa tagihan saat penyerahan barang, salah menghitung kembalian uang fisik, atau tidak memiliki rekonsiliasi antara uang tunai di laci kasir dengan nota yang keluar.
4. **Stok Bahan Baku Habis Tiba-Tiba (*Stockout Risk*):**
   - Kasir menerima pesanan cetak ratusan meter, namun tidak mengetahui bahwa gulungan bahan spanduk atau tinta di gudang telah habis, karena tidak adanya sinkronisasi antara penerimaan pesanan dengan kartu stok inventaris.
5. **Ketiadaan Visibilitas Keuangan Real-Time:**
   - Pemilik percetakan baru mengetahui kondisi keuangan di akhir bulan setelah merekap nota secara manual. Manajemen buta terhadap jumlah piutang yang belum tertagih di tangan pelanggan dan tidak mengetahui produk apa yang sesungguhnya paling diminati pasar.

### 2. Solusi & Tujuan Utama Dibuatnya SIPEKAN (*The Solution*)
SIPEKAN dirancang dan dibangun untuk mencapai tujuan-tujuan strategis berikut:
- **Digitalisasi Alur Produksi Terpadu:** Menjamin setiap pesanan memiliki rekaman data digital berisi ukuran presisi, jenis bahan, catatan finishing wajib, serta file desain/link Google Drive yang dapat diakses langsung oleh operator mesin.
- **Otomatisasi Stok Bahan:** Memastikan stok produk terpotong secara otomatis (*auto-decrement*) begitu pesanan masuk ke sistem.
- **Pusat Kasir Kasir Cerdas & Anti-Fraud:** Menyediakan kalkulator DP otomatis, kalkulator uang tunai diterima dan kembalian, dukungan pembayaran modern QRIS dan Transfer Bank, serta mengunci transaksi berstatus LUNAS agar tidak dapat dimanipulasi (*tamper-proof*).
- **Visibilitas Finansial & Bisnis:** Menyajikan dasbor eksekutif dengan grafik tren pendapatan bulanan vs target bisnis serta laporan keuangan komprehensif lengkap dengan nilai piutang berjalan.
- **Keamanan Akses Multi-Level (RBAC + 2FA):** Memisahkan hak wewenang antara Administrator dan Operator Kasir, serta memperkuat akun Administrator dengan otentikasi lapis dua (Google Authenticator TOTP) dan Cloudflare Turnstile anti-bot.

---

# BAGIAN 3: SPESIFIKASI TEKNIS & LINGKUNGAN PENGEMBANGAN (TECH STACK)

| Komponen | Spesifikasi & Versi | Peran & Alasan Pemilihan |
| :--- | :--- | :--- |
| **Framework Backend** | **Laravel 10.x** (`^10.10`) | Framework PHP terkemuka dengan arsitektur **MVC (Model-View-Controller)**, routing terstruktur, Eloquent ORM yang ekspresif, dan sistem keamanan CSRF/XSS bawaan yang kokoh. |
| **Bahasa Pemrograman** | **PHP ^8.1 / PHP 8.2** | Menggunakan fitur-fitur modern PHP 8 seperti *named arguments*, *constructor promotion*, *strict typing*, dan algoritma hashing password mutakhir. |
| **Basis Data (DBMS)** | **MySQL / MariaDB** | Berjalan di atas paket server lokal **XAMPP** (Port default `3306`), nama database: `laravel`. Koneksi database dikonfigurasi fleksibel melalui file `.env`. |
| **Frontend Templating** | **Laravel Blade Engine** | Memungkinkan perancangan tata letak modular dengan sintaks `@extends`, `@section`, `@include`, serta direktif kondisional `@if` dan `@forelse`. |
| **Desain & Gaya Tampilan** | **Bespoke Pure Vanilla CSS** | **Bukan template instan atau Tailwind bawaan**. Desain dibuat mandiri (*handcrafted*) dengan konsep modern **Glassmorphism, Card Neumorphic**, dan palet warna korporat yang harmonis menggunakan tipografi **Plus Jakarta Sans** (Google Fonts). |
| **Ikonografi** | **FontAwesome 6.5.1 Free** | Koleksi ikon vektor scalable untuk meningkatkan estetika visual navigasi, tombol tindakan, dan indikator status. |
| **Visualisasi Data** | **Chart.js v4** | Library visualisasi Javascript untuk merender grafik batang/garis target penjualan serta grafik donat proporsi produk terlaris. |
| **Keamanan Gerbang 1** | **Cloudflare Turnstile CAPTCHA** | Proteksi keamanan anti-bot non-intrusif pada form login tanpa membebani user dengan teka-teki gambar yang menyulitkan. |
| **Keamanan Gerbang 2** | **Google Authenticator (2FA)** | Otentikasi dua arah berbasis standar industri **RFC 6238 TOTP (Time-Based One-Time Password)** dengan siklus kunci 30 detik untuk akun Admin. |
| **Sistem Hak Akses** | **Role-Based Access Control (RBAC)** | Pemisahan tegas antara wewenang **Administrator** (kontrol penuh sistem) dan **Kasir** (operasional input pesanan & pembayaran dengan pembatasan hak hapus data). |

---

# BAGIAN 4: ARSITEKTUR BASIS DATA & RELASI ANTAR TABEL (DATABASE SCHEMA)

Aplikasi ditopang oleh 5 tabel inti pada MySQL yang saling terhubung:

```
    ┌──────────────┐                  ┌────────────────┐
    │    users     │                  │   pelanggans   │
    └──────┬───────┘                  └───────┬────────┘
           │                                  │
           │ (Autentikasi & Role)             │ (nama_pelanggan)
           ▼                                  ▼
    ┌──────────────┐                  ┌────────────────┐          ┌──────────────┐
    │  Auth Guard  │ ───────────────► │    pesanans    │ ◄─────── │   produks    │
    └──────────────┘                  └───────┬────────┘          └──────────────┘
                                              │                    (Potong Stok)
                                              │ (kode_pesanan)
                                              ▼
                                      ┌────────────────┐
                                      │  pembayarans   │
                                      └────────────────┘
```

### 1. Tabel `users` (`database/migrations/2014_10_12_000000_create_users_table.php`)
- **Kolom:** `id`, `name`, `email`, `email_verified_at`, `password` (terenkripsi Hash Bcrypt), `remember_token`, `timestamps`.
- **Fungsi Teknis:** Menyimpan identitas pengguna sistem. Akun utama: Administrator (`admin` / `wusakun@gmail.com`) dan Kasir (`Kasir` / `kasir@gmail.com`).

### 2. Tabel `pelanggans` (`database/migrations/2026_08_26_015422_create_pelanggans_table.php`)
- **Kolom:** `id`, `kode_pelanggan` (format unik: `CUST-001`), `nama`, `email`, `no_hp`, `alamat`, `total_pesanan` (default `0`), `tanggal_daftar`, `status` (default: `Aktif`), `timestamps`.
- **Fungsi Teknis:** Menyimpan basis data konsumen. Kolom `total_pesanan` secara otomatis tersinkronisasi dan bertambah saat pesanan baru tercatat atas nama konsumen tersebut.

### 3. Tabel `produks` (`database/migrations/2026_08_26_015422_create_produks_table.php`)
- **Kolom:** `id`, `kode_produk` (format unik: `PRD-001`), `nama_produk`, `kategori`, `harga`, `stok` (default `0`), `deskripsi`, `status` (default: `Tersedia`), `timestamps`.
- **Fungsi Teknis:** Katalog item dan persediaan bahan mentah cetak. Stok akan berkurang otomatis (*decrement*) setiap kali pesanan baru dibuat.

### 4. Tabel `pesanans` (`database/migrations/2026_08_26_015422_create_pesanans_table.php` & `2026_09_12_000001_add_printing_fields_to_pesanans_table.php`)
- **Kolom Inti:** `id`, `kode_pesanan` (format unik: `ORD-2026-001`), `nama_pelanggan`, `nama_produk`, `jumlah_ukuran`, `total_harga`, `status` (default: `Antrean Cetak`), `tanggal_pesan`.
- **Kolom Spesialisasi Percetakan:**
  - `detail_items` (Tipe `JSON/LONGTEXT`): Menyimpan rincian multi-item jika satu faktur memuat beberapa jenis produk sekaligus (ukuran kustom, kuantitas, subtotal, dan file masing-masing item).
  - `catatan_finishing` (Tipe `TEXT`): Menyimpan instruksi pasca-cetak (misal: "Mata ayam tiap sudut", "Laminasi Doff 2 sisi").
  - `file_desain` (Tipe `VARCHAR`): Menyimpan lokasi file yang diunggah secara lokal atau tautan URL Google Drive.
  - `status_pembayaran` (Tipe `VARCHAR`): Nilai: *Belum Lunas*, *DP*, atau *Lunas*.
  - `sisa_bayar` (Tipe `BIGINT`): Menyimpan nominal piutang yang belum dilunasi oleh pelanggan.

### 5. Tabel `pembayarans` (`database/migrations/2026_08_26_015423_create_pembayarans_table.php` & `2026_09_12_000001_add_printing_fields_to_pesanans_table.php`)
- **Kolom:** `id`, `kode_pembayaran` (format unik: `PAY-2026-001`), `kode_pesanan`, `tanggal`, `metode` (Tunai, QRIS, Transfer BCA/Mandiri), `jumlah`, `status` (*Lunas* atau *DP (Uang Muka)*), `uang_diterima`, `kembalian`, `timestamps`.
- **Fungsi Teknis:** Menghubungkan kas fisik kasir dengan invoice pesanan. Menampung uang pembayaran, menghitung uang kembalian kasir, dan secara otomatis memutakhirkan kolom `sisa_bayar` serta `status_pembayaran` pada tabel `pesanans`.

---

# BAGIAN 5: BEDAH KOMPONEN & ARSITEKTUR LAYOUT GLOBAL

---

## Layout 1: Topbar Header (`resources/views/layouts/topbar.blade.php`)
Bilah navigasi atas yang selalu hadir secara seragam di seluruh halaman sistem:
1. **Tombol Hamburger Mobile (`#mobileMenuBtn`):** Berfungsi mengontrol buka-tutup sidebar saat sistem diakses dari perangkat mobile atau tablet.
2. **Pencarian Global Instan (`#globalSearchInput`):**
   - Dilengkapi *keyboard shortcut* `/` (garis miring). Pengguna cukup menekan tombol `/` pada keyboard dari halaman mana pun, maka kursor otomatis melompat dan fokus ke kotak pencarian.
   - Tombol silang pembersih (`#clearSearchBtn`) untuk mereset kata kunci secara instan.
3. **Widget Jam Digital Jakarta (WIB Real-Time):**
   - Menampilkan jam, menit, dan detik secara *real-time* yang disinkronkan dengan zona waktu Waktu Indonesia Barat (`Asia/Jakarta`).
4. **Pusat Notifikasi Interaktif (`#notifBellBtn` & `#notifDropdown`):**
   - Mengambil data pesanan dan pembayaran terbaru dari database.
   - Lencana merah (*badge*) menghitung jumlah pesanan yang baru masuk dan pembayaran belum lunas.
   - Tombol **"Tandai dibaca"** (`#markAllReadBtn`) yang secara asinkron menyembunyikan badge merah tanpa reload halaman.
5. **Tombol Pusat Bantuan & FAQ (`#helpModalBtn`):** Membuka jendela panduan ringkas alur kerja kasir dan percetakan.
6. **Menu Profil Pengguna (`#userProfileBtn` & `#userProfileDropdown`):**
   - Menampilkan foto profil, nama pengguna aktif, dan alamat email.
   - Tautan cepat ke modal profil dan tombol logout aman.

---

## Layout 2: Sidebar Navigasi (`resources/views/layouts/sidebar.blade.php`)
Bilah navigasi di sisi kiri layar:
1. **Brand Identity:**
   - Menampilkan logo resmi SIPEKAN yang dilengkapi parameter anti-cache browser: `?v={{ filemtime(...) }}`.
   - Badge Hak Akses Dinamis: Menampilkan label **"Konsol Admin"** (jika login sebagai Admin) atau **"Konsol Kasir"** (jika login sebagai Kasir).
2. **6 Menu Operasional Utama:**
   - `Dasbor`: Ringkasan analitik dan grafik performa bisnis.
   - `Pelanggan`: Direktori database pelanggan percetakan.
   - `Produk`: Katalog harga dan kontrol stok bahan cetak.
   - `Pesanan`: Modul penerimaan order cetak kustom, upload desain, dan status produksi.
   - `Pembayaran`: Modul kasir POS, pelunasan sisa tagihan, dan cetak struk nota.
   - `Laporan`: Modul pembukuan keuangan, kontrol piutang, dan ekspor cetak.
3. **Indikator Menu Aktif Otomatis:** Menggunakan logika Blade `request()->routeIs('nama_route') ? 'active' : ''` sehingga menu yang sedang dibuka otomatis menyala biru dengan teks tebal.
4. **Penyaringan Menu Hak Akses (RBAC Guard):**
   - Menu **"Pengaturan"** dibungkus dalam blok `@if(!($isKasir ?? false))`. Operator Kasir sama sekali tidak dapat melihat menu pengaturan ini.
5. **Form Logout Terproteksi CSRF:** Tombol keluar mengeksekusi JavaScript `submit()` pada form tersembunyi ber-metode POST yang dilindungi `@csrf`.

---

## Layout 3: Modal Global & Asset Engine (`resources/views/layouts/navbar_assets.blade.php`)
File utilitas pusat yang menyuntikkan seluruh modal global, CSS universal, dan JavaScript terpadu:
1. **Pencegah Flash of Unstyled Content (FOUC):** Mengunci status awal seluruh modal (*display: none !important*) agar modal tidak muncul berkedip saat pertama kali halaman dimuat.
2. **Normalisasi Input Numerik:** Menghilangkan panah atas-bawah (*spin button*) bawaan browser pada seluruh tag `<input type="number">` agar antarmuka kasir terlihat rapi dan presisi.
3. **Custom Slim Scrollbar:** Mengganti scrollbar tebal default Windows dengan scrollbar tipis bernuansa abu-abu slate modern.
4. **Mesin Pencarian Autocomplete Universal:**
   - Mengumpulkan data pelanggan, produk, pesanan, dan menu ke memori JavaScript.
   - Menampilkan dropdown hasil pencarian cerdas saat pengguna mengetik di kolom pencarian topbar.
5. **Modal "Profil Saya" & "Pusat Bantuan":** Pop-up seragam yang dapat dipanggil dari halaman mana pun untuk melihat data akun atau panduan operasional sistem.

---

# BAGIAN 6: BEDAH DETAIL 9 MODUL, SETIAP HALAMAN, & SELURUH FUNGSI KECILNYA

---

## 1. Modul Autentikasi & Keamanan Gerbang Masuk (`login.blade.php`)
- **Controller:** `app/Http/Controllers/AuthController.php`
- **Route:** `GET /login`, `POST /login`

### Layout & Tampilan Antarmuka:
- **Kartu Login Dua Sisi (*Split Login Card*):**
  - **Sisi Kiri:** Logo resmi SIPEKAN, teks judul & subjudul (*"Sistem Informasi Manajemen Percetakan"*), kotak pesan error/sukses (*session alert*), input username/email, input kata sandi dengan ikon intip sandi, centang *"Ingat Saya"*, tautan *"Lupa Kata Sandi"*, widget Cloudflare Turnstile, dan tombol masuk (*Submit*).
  - **Sisi Kanan:** Ilustrasi grafis operasional percetakan modern dengan latar gradien halus dan teks deskripsi nilai tambah sistem.

### Fitur-Fitur Kecil & Logika Kode di Baliknya:
1. **Toggle Show/Hide Password:** Ikon mata interaktif yang mengubah atribut input antara `type="password"` dan `type="text"`.
2. **Proteksi Cloudflare Turnstile CAPTCHA:**
   - Memvalidasi bahwa pengguna bukan bot/skrip otomatis.
   - Di backend (`AuthController@login`), token divalidasi ke API Cloudflare Siteverify sebelum memeriksa data ke database.
3. **Pemisahan Jalur Login Berdasarkan Peran (Role Routing):**
   - Jika yang login adalah **Admin** (`admin` / `wusakun@gmail.com`), sistem menyimpan sesi `2fa_pending = true` dan mengalihkan (*redirect*) ke tahap otentikasi lapis kedua (Google Authenticator).
   - Jika yang login adalah **Kasir** (`Kasir` / `kasir@gmail.com`), sistem memotong alur 2FA dan langsung membukakan dasbor kasir demi kecepatan layanan transaksi.
4. **Modal Interaktif Lupa Sandi (*Self-Service Password Reset*):**
   - Pengguna mengklik *"Lupa kata sandi?"* ➔ Muncul modal pop-up dengan efek *backdrop-blur*.
   - Pengguna memasukkan alamat email ➔ Sistem memvalidasi dan mengirimkan kode verifikasi 6-digit.
   - Setelah kode cocok, form kata sandi baru dibuka dan kata sandi baru langsung dienkripsi ulang menggunakan **Bcrypt**.

---

## 2. Modul Otentikasi Dua Faktor / 2FA (`two-factor.blade.php`)
- **Controller:** `app/Http/Controllers/AuthController.php`
- **Route:** `GET /login/2fa`, `POST /login/2fa`

### Layout & Tampilan Antarmuka:
- Desain kartu keamanan terpusat (*centered card*) dengan ikon perisai gembok (*shield lock*).
- Menampilkan nama dan email pengguna yang sedang melakukan verifikasi.
- Form input kode PIN yang terpisah ke dalam **6 kotak angka individual**.
- Indikator lingkaran animasi waktu mundur (*countdown timer*) siklus 30 detik TOTP.
- Indikator sisa batas percobaan verifikasi (*maksimal 3 kali*).

### Fitur-Fitur Kecil & Logika Kode di Baliknya:
1. **Auto-Tab & Auto-Paste 6 Kotak PIN:**
   - Setiap kali pengguna mengetik 1 angka, kursor otomatis melompat ke kotak berikutnya.
   - Jika menekan tombol *Backspace*, kursor otomatis mundur ke kotak sebelumnya.
   - Mendukung penempelan (*Ctrl+V*): Jika pengguna menyalin kode 6-digit dari aplikasi Google Authenticator di smartphone, JavaScript otomatis memecah setiap angka ke dalam 6 kotak secara instan.
2. **Kalkulator Siklus Waktu 30 Detik Real-Time:**
   - Lingkaran progress SVG yang menghitung mundur sisa masa berlaku kode TOTP saat ini: `30 - (time() % 30)`.
3. **Toleransi Drift Waktu (*Time Window Drift Tolerance*):**
   - Di backend (`AuthController@verify2FA`), sistem memvalidasi kode di jendela waktu saat ini (`$currentWindow`), satu siklus sebelumnya (`$currentWindow - 1`), dan satu siklus setelahnya (`$currentWindow + 1`). Hal ini menjamin pengguna tetap dapat login meskipun jam pada smartphone mereka berselisih beberapa detik dengan jam server.
4. **Proteksi Anti Brute-Force:**
   - Percobaan dibatasi **maksimal 3 kali**. Jika 3 kali salah berturut-turut, sesi 2FA langsung dihancurkan dan dialihkan kembali ke login awal demi keamanan.
5. **Modal Bantuan Kunci Rahasia:** Tombol *"Tidak bisa scan QR?"* yang menampilkan Kunci Rahasia Base32 dalam format blok 4-karakter agar dapat diketik manual di aplikasi Google Authenticator.

---

## 3. Modul Dasbor Analitik & Business Intelligence (`dashboard.blade.php`)
- **Controller:** `app/Http/Controllers/DashboardController.php`
- **Route:** `GET /dashboard`

### Layout & Tampilan Antarmuka:
- **Header Salam Pembuka:** Menyapa nama pengguna yang sedang aktif disertai tampilan kalender hari ini.
- **4 Kartu Metrik Ringkasan Utama (KPI Cards):**
  1. *Total Pesanan:* Akumulasi seluruh nota transaksi di sistem.
  2. *Total Pendapatan:* Total kas masuk dari pembayaran lunas.
  3. *Total Pelanggan:* Jumlah database pelanggan terdaftar.
  4. *Total Produk:* Jumlah varian produk/bahan yang tersedia di gudang.
- **Bagian Grafik Analitik Visual:**
  - *Grafik Kiri (Bar/Line Chart):* Perbandingan Pendapatan Riil Bulanan terhadap Target Finansial Bisnis.
  - *Grafik Kanan (Doughnut Chart):* Proporsi 5 Kategori Produk Terlaris berdasarkan volume pesanan.
- **Bagian Tabel Aktivitas Terkini:**
  - Tabel 5 Pesanan Cetak Terbaru (Kode, Pelanggan, Produk, Total Biaya, Status).
  - Tabel 5 Riwayat Kas Pembayaran Terbaru (No. Bayar, Pesanan, Metode, Jumlah, Status).

### Fitur-Fitur Kecil & Logika Kode di Baliknya:
1. **Kalkulasi Pertumbuhan Bulan-ke-Bulan (Month-over-Month Growth):**
   - Pada `DashboardController`, sistem membandingkan volume transaksi bulan ini dengan bulan sebelumnya secara matematis:
     $$\text{Growth (\%)} = \frac{\text{Bulan Ini} - \text{Bulan Lalu}}{\text{Bulan Lalu}} \times 100\%$$
   - Ditampilkan dalam badge persentase hijau dengan panah naik jika positif, atau merah jika menurun.
2. **Koreksi Kalender Dinamis:**
   - Sumbu grafik X otomatis hanya menampilkan bulan-bulan yang telah berjalan di tahun ini (`$m <= $thisMonth`), sehingga grafik tidak menampilkan bulan kosong di masa depan.
3. **Fallback Perhitungan Pendapatan:**
   - Jika data pembayaran kasir bernilai 0, sistem secara cerdas menghitung estimasi nilai omset dari akumulasi `total_harga` di tabel pesanan.

---

## 4. Modul Manajemen Direktori Pelanggan (`pelanggan.blade.php`)
- **Controller:** `app/Http/Controllers/PelangganController.php`
- **Route:** `GET /pelanggan`, `POST /pelanggan`, `PUT /pelanggan/{id}`, `DELETE /pelanggan/{id}`

### Layout & Tampilan Antarmuka:
- **Toolbar Atas:** Kolom pencarian pelanggan, dropdown filter kota/wilayah, dan tombol **"+ Tambah Pelanggan"**.
- **Tabel Direktori Pelanggan:** Kode Pelanggan, Nama Lengkap, Kontak (Email & No. HP WhatsApp), Alamat/Kota Domisili, Total Pesanan yang Pernah Dibuat, Tanggal Bergabung, Status (Aktif/Nonaktif), dan Tombol Tindakan (Detail, Edit, Hapus).
- **Modal Tambah/Edit Pelanggan:** Formulir pop-up dengan validasi nama, format email, nomor telepon, dan alamat.
- **Modal Detail Riwayat Pelanggan:** Pop-up tinjau informasi profil dan riwayat order pelanggan.

### Fitur-Fitur Kecil & Logika Kode di Baliknya:
1. **Auto-Generate Kode Pelanggan:** Menghasilkan kode urut unik berformat `CUST-001`, `CUST-002`, dst., yang dihitung dari ID maksimum pada database.
2. **Sinkronisasi Otomatis Total Pesanan:**
   - Di dalam method `index()`, sistem menghitung riwayat transaksi aktual: `Pesanan::where('nama_pelanggan', $pelanggan->nama)->count()`. Jika ada pesanan baru, kolom `total_pesanan` langsung diperbarui otomatis.
3. **Filter Kota Ekstraktif:**
   - Sistem membedah teks alamat pelanggan pada database, mengambil nama kota setelah tanda koma, menggabungkannya dengan 20 daftar kota besar di Indonesia, dan menyajikannya sebagai dropdown filter cepat.
4. **Penghapusan Aman:** Dilengkapi modal konfirmasi JavaScript sebelum data pelanggan dihapus dari database.

---

## 5. Modul Katalog Produk & Kontrol Inventaris Stok (`produk.blade.php`)
- **Controller:** `app/Http/Controllers/ProdukController.php`
- **Route:** `GET /produk`, `POST /produk`, `PUT /produk/{id}`, `DELETE /produk/{id}`

### Layout & Tampilan Antarmuka:
- **Toolbar Atas:** Pencarian nama produk, filter kategori (Banner/Spanduk, Brosur, Stiker, Kartu Nama, Merchandise), dan tombol **"+ Tambah Produk"**.
- **Tabel Katalog Produk:** Kode Produk, Nama Produk, Kategori, Harga Dasar Satuan, Jumlah Stok Fisik di Gudang, Deskripsi Spesifikasi Bahan, Status Ketersediaan, dan Kolom Tindakan.
- **Modal Tambah/Edit Produk:** Formulir pengisian nama, kategori, harga satuan, jumlah stok, deskripsi, dan status ketersediaan.

### Fitur-Fitur Kecil & Logika Kode di Baliknya:
1. **Auto-Generate Kode Produk:** Menghasilkan format kode `PRD-` dengan penomoran urut otomatis 3 digit angka.
2. **Proteksi Wewenang Role (RBAC):**
   - Di dalam `ProdukController`, fungsi `store()`, `update()`, dan `destroy()` memverifikasi identitas pengguna. Jika akun Kasir mencoba menambah, mengedit harga, atau menghapus produk, sistem mengembalikan status HTTP `403 Forbidden`. **Kasir hanya diperbolehkan melihat katalog (*view-only*)**.
3. **Indikator Visual Stok Kritis:**
   - Jika stok `> 10`, lencana berstatus hijau *"Tersedia"*.
   - Jika stok `<= 10` dan `> 0`, lencana berstatus oranye *"Stok Menipis"*.
   - Jika stok `== 0`, lencana berstatus merah *"Habis"*.

---

## 6. Modul Inti Pemesanan Percetakan & Multi-Item Cart (`pesanan.blade.php`)
- **Controller:** `app/Http/Controllers/PesananController.php`
- **Route:** `GET /pesanan`, `POST /pesanan`, `PUT /pesanan/{id}`, `DELETE /pesanan/{id}`

### Layout & Tampilan Antarmuka:
- **Toolbar Filter Kompleks:**
  - Pencarian instan (kode pesanan, nama pemesan, nama produk).
  - Filter status produksi (*Semua, Antrean Cetak, Sedang Dicetak, Finishing, Selesai*).
  - Filter status pembayaran (*Semua, Belum Lunas, DP, Lunas*).
  - Tombol **"+ Buat Pesanan Baru"**.
- **Tabel Antrean Pesanan Percetakan:**
  - Kolom: No. Nota Pesanan (`ORD-2026-001`), Nama Pelanggan, Produk & Rincian Item, Total Biaya, Status Produksi Cetak, Status Bayar (Lunas/DP/Belum Lunas), dan Menu Dropdown Aksi Cepat.
- **Modal Pembuatan Pesanan Multi-Item (*Cart Builder*):**
  - Memungkinkan pelanggan memesan lebih dari 1 jenis produk dalam 1 nomor nota transaksi.
  - Form per item: Pemilihan jenis produk, input ukuran kustom (panjang x lebar atau ukuran standar A3/A4/A5), jumlah *quantity*, pilihan satuan (*Pcs, Lembar, Meter, Rim, Box*), subtotal harga otomatis.
  - **Formulir File Desain:** Pilihan antara upload langsung file dari laptop/komputer atau menyematkan tautan Google Drive / Cloud storage.
  - **Catatan Finishing Produksi:** Pilihan instruksi pasca-cetak (Laminasi Glossy, Laminasi Doff, Mata Ayam/Keling, Lem Panas, Jilid Spiral, Lipat, Pon Bentuk Khusus).
  - **Kalkulator Kasir Terintegrasi Saat Pemesanan:**
    - Pilihan tipe pembayaran langsung: **Belum Bayar**, **Bayar DP**, atau **Bayar Lunas**.
    - Jika memilih DP, tersedia tombol cepat (*chip button*): DP 25%, DP 50%, atau DP 75%.
    - Jika memilih Tunai, terdapat input *Uang Diterima* dan kalkulator *Kembalian* langsung.
- **Popover Multi-Item:** Jika 1 pesanan berisi banyak jenis produk, pada kolom tabel muncul tombol lencana interaktif yang jika diklik akan membuka jendela pop-up terapung (*floating popover*) merinci setiap item dan desainnya secara rapi.
- **Modal Cetak Dokumen:**
  - **Cetak Faktur Pesanan:** Nota resmi rincian biaya untuk diberikan kepada pemesan.
  - **Cetak SPK (Surat Perintah Kerja):** Lembar instruksi kerja untuk bagian operator mesin dan bagian finishing tanpa menampilkan nominal uang, berfokus murni pada bahan, ukuran, dan file cetak.

### Fitur-Fitur Kecil & Logika Kode di Baliknya:
1. **Otomatisasi Pendaftaran Pelanggan Baru:**
   - Jika kasir mengetik nama pelanggan yang belum terdaftar, pada `PesananController@store`, sistem secara otomatis membuatkan data baru di tabel `pelanggans` dengan kode urut baru.
2. **Pemotongan Stok Inventaris Seketika (*Stock Auto-Decrement*):**
   - Begitu pesanan disimpan, sistem mengeksekusi `Produk::where(...)->decrement('stok', $qty)` sehingga kuantitas bahan di gudang langsung berkurang.
3. **Pencatatan Otomatis ke Kasir Pembayaran:**
   - Jika saat memesan konsumen langsung membayar DP atau Lunas, controller otomatis meng-insert data transaksi baru ke tabel `pembayarans` tanpa kasir perlu mengetik ulang di modul kasir.
4. **Pembaruan Status Produksi 4-Fase:**
   - Operator mesin dapat memperbarui status bertahap: dari *Antrean Cetak* ➔ *Sedang Dicetak* ➔ *Finishing* ➔ *Siap Diambil / Selesai* melalui menu dropdown aksi cepat.

---

## 7. Modul Kasir POS, Pembayaran Bertahap (DP), & Struk Kasir (`pembayaran.blade.php`)
- **Controller:** `app/Http/Controllers/PembayaranController.php`
- **Route:** `GET /pembayaran`, `POST /pembayaran`, `PUT /pembayaran/{id}`, `DELETE /pembayaran/{id}`

### Layout & Tampilan Antarmuka:
- **Struktur Layar Terbagi Dua (*Split-Screen POS*):**
  - **Sisi Kiri (Panel Kasir POS Input):**
    - Dropdown nomor pesanan yang belum lunas (menampilkan kode nota, nama pemesan, dan nominal sisa tagihan).
    - Pilihan metode transaksi: **Tunai**, **QRIS**, dan **Transfer Bank (BCA / Mandiri)**.
    - Tombol tipe pelunasan: **Bayar Lunas Penuh** vs **Bayar DP / Sebagian**.
    - Kotak kalkulator tunai: input uang fisik diterima, tombol jalan pintas *"Uang Pas"*, dan kotak kalkulasi uang kembalian berwarna hijau.
  - **Sisi Kanan (Panel Riwayat Kas Transaksi):**
    - Tab penyaring status: *Semua*, *Belum Lunas*, dan *Lunas*.
    - Tabel mutasi kas: No. Pembayaran (`PAY-2026-001`), Pesanan Terkait, Tanggal, Metode, Jumlah Uang Masuk, Status, dan Tombol Cetak Struk.
- **Modal Cetak Struk Kasir Thermal (*Thermal Receipt Modal*):**
  - Menampilkan nota struk kasir berdesain struk kasir digital printing (lengkap dengan nama percetakan, nomor transaksi, rincian pembayaran, uang diterima, uang kembalian, dan stempel status LUNAS).

### Fitur-Fitur Kecil & Logika Kode di Baliknya:
1. **Pencegahan Pembayaran Melebihi Tagihan (*Overpayment Guard*):**
   - Di backend `PembayaranController@store`, jika kasir menginput nominal lebih besar dari sisa hutang nota, sistem menolaknya demi mencegah kekacauan pembukuan.
2. **Penyaringan Otomatis Nota Lunas:**
   - Dropdown pesanan di form kasir secara otomatis **hanya menampilkan pesanan yang masih memiliki sisa tagihan**. Pesanan yang sudah lunas disaring dan dihilangkan dari opsi dropdown.
3. **Pencegahan Uang Tunai Kurang (*Cash Shortage Warning*):**
   - Jika metode pembayaran adalah Tunai dan nilai *Uang Fisik Diterima* lebih kecil dari *Nominal yang Disetorkan*, muncul peringatan merah interaktif dan form ditolak.
4. **Validasi Kronologi Tanggal:**
   - Tanggal pembayaran divalidasi tidak boleh mendahului tanggal pesanan dibuat (`$tanggal < $pesanan->tanggal_pesan`).
5. **Penguncian Permanen Transaksi Lunas (*Data Locking Anti-Fraud*):**
   - Setiap pembayaran yang sudah berstatus LUNAS dikunci secara permanen. Tombol hapus/edit dimatikan untuk mencegah staf kasir menghapus bukti uang masuk.
6. **Proteksi Wewenang Hapus Kasir:**
   - Jika akun Kasir mencoba menghapus transaksi pembayaran apa pun, controller langsung menolaknya: *"Akses ditolak! Akun Kasir tidak memiliki wewenang menghapus catatan transaksi"*.

---

## 8. Modul Laporan Finansial, Piutang, & Ekspor Cetak (`laporan.blade.php`)
- **Controller:** `app/Http/Controllers/LaporanController.php`
- **Route:** `GET /laporan`

### Layout & Tampilan Antarmuka:
- **Toolbar Filter Rentang Tanggal:**
  - Tombol jalan pintas periode: **Hari Ini**, **Bulan Ini**, **Kuartal Ini**, **Tahun Berjalan**.
  - Input kalender tanggal mulai (*Start Date*) dan tanggal akhir (*End Date*).
- **3 Kartu Ringkasan Finansial:**
  1. *Total Omset Periode Terpilih:* Akumulasi omset kotor dari seluruh nota pesanan di periode tersebut.
  2. *Total Piutang Belum Tertagih:* Jumlah uang yang masih tertahan di konsumen (pesanan yang statusnya belum lunas atau baru DP).
  3. *Rata-Rata Nilai Transaksi (AOV - Average Order Value):* Menghitung rata-rata nilai belanja konsumen per transaksi.
- **Tabel Buku Besar Laporan:** Menampilkan nomor nota, tanggal, nama pemesan, rincian produk yang dicetak, total nilai pesanan, status pembayaran, dan sisa piutang.
- **Format Cetak Laporan Formal (*Print-Friendly Version*):**
  - Tampilan yang secara otomatis disesuaikan untuk printer kertas A4: menyertakan kop surat resmi SIPEKAN, tanggal periode pembukuan, tabel kalkulasi, dan kolom tanda tangan Penanggung Jawab Keuangan.

### Fitur-Fitur Kecil & Logika Kode di Baliknya:
1. **Penguncian Batas Tanggal Hari Ini (*Strict Date Bound*):**
   - Pada `LaporanController`, tanggal akhir dibatasi maksimal adalah tanggal hari ini (`$now->toDateString()`). Sistem secara otomatis menolak dan memotong input tanggal masa depan agar data laporan selalu valid.
2. **Kalkulasi Piutang Realistis:**
   - Sistem menghitung sisa hutang per pesanan (`sisa_bayar`). Jika suatu pesanan berstatus DP, hanya sisa hutangnya yang dimasukkan ke dalam metrik piutang, bukan total harga secara keseluruhan.

---

## 9. Modul Pengaturan Sistem & Manajemen Hak Akses (`pengaturan.blade.php`)
- **Controller:** `app/Http/Controllers/PengaturanController.php`
- **Route:** `GET /pengaturan`

### Layout & Tampilan Antarmuka:
- **Tabel Pengguna & Hak Akses:** Menampilkan nama pengguna, email, peran hak akses (*Administrator* vs *Kasir*), dan tanggal pendaftaran.
- **Profil Perusahaan:** Form informasi instansi percetakan (Nama Usaha: SIPEKAN Digital Printing, alamat kantor, nomor kontak, footer nota).
- **Konfigurasi Keamanan:** Informasi status Google Authenticator dan perlindungan data.

### Fitur-Fitur Kecil & Logika Kode di Baliknya:
1. **Proteksi Redirection Kasir:**
   - Di dalam `PengaturanController`, jika user yang sedang login terdeteksi sebagai akun Kasir, sistem langsung melempar kembali ke `/dashboard` tanpa menampilkan halaman pengaturan.

---

# BAGIAN 7: DIAGRAM ALUR BISNIS END-TO-END (WORKFLOW LENGKAP)

```
[ KONSUMEN DATANG KE TOKO / PERCETAKAN ]
                   │
                   ▼
┌─────────────────────────────────────────────────────────────┐
│ 1. KASIR MEMBUAT PESANAN (Modul Pesanan)                     │
│    - Pilih / Ketik Nama Pelanggan                           │
│    - Tambah Item: Pilih Produk, Ukuran, Satuan, & Qty       │
│    - Unggah File Desain Cetak / Tautan Google Drive         │
│    - Tentukan Instruksi Finishing Produksi                  │
│    - Tentukan Opsi Bayar: Belum Bayar / DP / Lunas          │
└──────────────────────────────┬──────────────────────────────┘
                               │
            ┌──────────────────┴──────────────────┐
            │   OTOMATISASI SISTEM DI BACKEND     │
            │   - Potong Stok Produk (decrement)  │
            │   - Daftarkan Konsumen Baru         │
            │   - Buat No. Nota: ORD-2026-001     │
            └──────────────────┬──────────────────┘
                               │
            ┌──────────────────┴──────────────────┐
            ▼                                     ▼
┌──────────────────────────────┐      ┌──────────────────────────────┐
│ 2A. JIKA BAYAR DP / LUNAS    │      │ 2B. JIKA BELUM BAYAR         │
│     - Sistem catat ke kasir  │      │     - Status: "Belum Lunas"  │
│     - Hitung Uang Kembalian  │      │     - Sisa Piutang: 100%     │
│     - Status: "DP" / "Lunas" │      └──────────────┬───────────────┘
└──────────────┬───────────────┘                     │
               │                                     │
               └──────────────────┬──────────────────┘
                                  │
                                  ▼
┌─────────────────────────────────────────────────────────────┐
│ 3. OPERATOR WORKSHOP PRODUKSI                               │
│    - Operator buka Pesanan & Unduh File Desain              │
│    - Cetak Lembar SPK (Surat Perintah Kerja)                │
│    - Perbarui Status Bertahap:                              │
│      [Antrean Cetak] ➔ [Sedang Cetak] ➔ [Finishing] ➔ [Selesai]│
└──────────────────────────────┬──────────────────────────────┘
                               │
                               ▼
┌─────────────────────────────────────────────────────────────┐
│ 4. PENGAMBILAN BARANG & PELUNASAN KASIR (Modul Pembayaran)  │
│    - Pelanggan datang mengambil hasil cetakan               │
│    - Kasir buka menu Pembayaran ➔ Pilih Nomor Pesanan       │
│    - Sistem otomatis mengunci nominal sisa tagihan          │
│    - Kasir input uang fisik ➔ Sistem hitung Kembalian       │
│    - Status pesanan otomatis beralih menjadi "LUNAS"        │
│    - Cetak Struk Nota Kasir Thermal                         │
│    - Transaksi LUNAS langsung terkunci permanen             │
└──────────────────────────────┬──────────────────────────────┘
                               │
                               ▼
┌─────────────────────────────────────────────────────────────┐
│ 5. MONITORING & PEMBUKUAN PEMILIK USAHA                     │
│    - Pemilik cek Dashboard (Pertumbuhan Omset & Tren Produk)│
│    - Buka Modul Laporan: Filter Periode & Pantau Piutang    │
│    - Ekspor Cetak Laporan Keuangan Formal untuk Arsip       │
└─────────────────────────────────────────────────────────────┘
```

---

# BAGIAN 8: NASKAH PENUTUP PRESENTASI & SIMULASI TANYA-JAWAB PENGUJI (Q&A PREP)

### Naskah Penutup Presentasi:
> *"Demikian pemaparan menyeluruh mengenai rancang bangun dan implementasi sistem **SIPEKAN (Sistem Informasi Manajemen Percetakan & Kasir Layanan)**.*
>
> *Sebagai penutup, sistem ini berhasil membuktikan bahwa proses bisnis percetakan yang sebelumnya rumit, rentan salah cetak, dan rawan selisih uang kas dapat ditransformasikan menjadi alur kerja digital yang rapi, otomatis, aman, dan dapat dipertanggungjawabkan secara finansial.*
>
> *Aplikasi ini telah diuji secara menyeluruh dan beroperasi dengan lancar pada arsitektur web modern Laravel 10 dan MySQL.*
>
> *Terima kasih yang sebesar-besarnya atas perhatian dan waktu Bapak/Ibu dosen penguji serta rekan-rekan sekalian. Saya dengan senang hati menyambut pertanyaan, masukan, maupun saran pada sesi diskusi dan tanya-jawab. Waktu dan tempat saya persilakan."*

---

### Prediksi Pertanyaan Dosen Penguji & Panduan Jawaban Tepat:

#### 1. Pertanyaan: *"Mengapa autentikasi dibuat kustom menggunakan session, bukan menggunakan Laravel Breeze, Jetstream, atau Filament?"*
- **Jawaban Anda:**
  > *"Sistem autentikasi sengaja kami rancang secara custom controller agar kami memiliki kendali penuh atas alur bisnis unik percetakan ini. Misalnya, pemisahan perilaku antara Admin yang wajib melalui verifikasi Google Authenticator 2FA 6-digit TOTP dan Cloudflare Turnstile, sedangkan Kasir diberikan akses instan langsung ke dashboard operasional tanpa 2FA demi kecepatan pelayanan di toko fisik. Paket scaffolding bawaan seperti Breeze atau Jetstream memiliki struktur kaku yang lebih sulit dikustomisasi untuk alur percabangan sesi peran ganda ini."*

#### 2. Pertanyaan: *"Bagaimana cara kerja Google Authenticator 2FA di sistem ini jika server berada di jaringan lokal atau internet mati?"*
- **Jawaban Anda:**
  > *"Google Authenticator menggunakan algoritma standar internasional **RFC 6238 TOTP (Time-Based One-Time Password)**. Algoritma ini murni perhitungan kriptografi matematika hash HMAC-SHA1 antara jam sistem server dan jam smartphone pengguna menggunakan shared-secret key Base32. Oleh karena itu, otentikasi 2FA tetap berfungsi 100% akurat tanpa membutuhkan koneksi internet sama sekali, asalkan waktu (jam) pada server dan smartphone berada pada detik yang sama."*

#### 3. Pertanyaan: *"Bagaimana sistem menangani pesanan multi-item jika satu faktur memiliki banyak produk dengan file desain yang berbeda-beda?"*
- **Jawaban Anda:**
  > *"Sistem memanfaatkan kolom `detail_items` bertipe data JSON/Longtext pada tabel `pesanans`. Setiap baris item di dalam keranjang memiliki struktur datanya sendiri yang mencakup nama produk, ukuran kustom, kuantitas, satuan, subtotal harga, hingga path file desain atau link Google Drive masing-masing item. Saat data ditampilkan di tabel pesanan, JavaScript Popover membaca array JSON tersebut dan menyajikannya secara interaktif per item tanpa merusak struktur baris tabel utama."*

#### 4. Pertanyaan: *"Mengapa transaksi pembayaran yang sudah LUNAS dikunci dan tidak boleh dihapus atau diedit?"*
- **Jawaban Anda:**
  > *"Hal tersebut merupakan penerapan prinsip kepatuhan akuntansi (*internal control & audit trail*). Transaksi yang sudah berstatus Lunas dan struknya telah diterima oleh konsumen tidak boleh diubah atau dihapus secara sepihak untuk mencegah tindak kecurangan kas (*fraud*) oleh karyawan kasir. Jika terdapat pembatalan nota atau kekeliruan cetak fisik, tindakan hanya dapat diotorisasi oleh Administrator melalui mekanisme khusus."*

#### 5. Pertanyaan: *"Bagaimana sistem menjamin bahwa kasir tidak salah menghitung kembalian uang fisik saat konsumen membayar tunai?"*
- **Jawaban Anda:**
  > *"Sistem menyertakan kalkulator kasir tunai interaktif di frontend dan backend. Kasir wajib menginput nominal uang fisik yang diterima konsumen. Jika nominal tersebut kurang dari tagihan, sistem langsung menampilkan peringatan merah dan menolak penyimpanan. Jika uang fisik lebih besar, sistem secara otomatis menghitung selisihnya sebagai `kembalian`, menyimpannya ke database, dan mencetaknya secara transparan pada struk thermal kasir."*

---
*Dokumen ini dibuat otomatis sebagai panduan presentasi, dokumentasi teknis, dan buku pedoman sistem SIPEKAN.*
