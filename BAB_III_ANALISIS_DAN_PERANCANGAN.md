## BAB III
## ANALISIS DAN PERANCANGAN SISTEM

### 3.1 Analisis Sistem
Analisis sistem dilakukan untuk mengidentifikasikan masalah yang diangkat dalam penelitian yang terjadi di lapangan, serta memberikan gambaran bagaimana cara sistem mengolah data hingga memberikan informasi. Analisis sistem mencakup analisis masalah, analisis sistem yang berjalan, dan analisis sistem yang dibangun.

### 3.2 Analisis Masalah
Saat ini, proses penjualan di Toko Barokah 191 masih dilakukan secara konvensional atau offline, di mana transaksi hanya dapat dilayani oleh pelanggan yang datang langsung ke toko. Kondisi tersebut membuat toko berpotensi kehilangan banyak konsumen yang ingin melakukan pembelian di luar jam operasional. Selain itu, proses pencatatan transaksi serta perhitungan penjualan masih dilakukan secara manual, sehingga rentan terjadi kesalahan dan kurang efisien. Sistem inventarisasi barang juga belum tertata secara baik, yang mengakibatkan pengelolaan stok menjadi kurang optimal.

Di sisi lain, Toko Barokah 191 juga belum memiliki strategi promosi digital yang efektif, sehingga banyak peluang untuk menjangkau pelanggan baru dan meningkatkan penjualan yang belum dimanfaatkan. Dengan adanya pembangunan sistem yang baru, diharapkan Toko Barokah 191 dapat memperbaiki berbagai kelemahan sistem lama, meningkatkan efisiensi operasional, serta membuka peluang yang lebih luas dalam mengembangkan usaha.

### 3.3 Analisis Sistem yang Sedang Berjalan
Analisis sistem yang sedang berjalan merupakan proses untuk mengidentifikasi alur kerja yang sedang digunakan oleh pihak terkait pada saat ini. Tujuannya adalah untuk menyajikan gambaran secara mendetail sistem yang saat ini sedang digunakan.

#### Gambar 3.1: Alur yang Sedang Berjalan

Berdasarkan alur tersebut, berikut adalah perincian proses bisnis konvensional di Toko Barokah 191:
1. Pembeli datang ke lokasi fisik Toko Barokah 191 di Kopo.
2. Pembeli menanyakan ketersediaan barang yang ingin dibeli kepada penjual.
3. Penjual secara manual memeriksa ketersediaan stok barang.
4. Jika tersedia, penjual menunjukkan produk (fisik) kepada pembeli.
5. Pembeli mengecek kesesuaian barang (kualitas, ukuran, warna).
6. Jika sesuai, pembeli meminta penjual untuk memproses transaksi.
7. Penjual menghitung total biaya secara manual dan menuliskan nota pembayaran.
8. Pembeli melakukan pembayaran tunai.
9. Penjual menerima pembayaran dan menyerahkan barang kepada pembeli.

### 3.4 Analisis Sistem yang Dibangun
Sistem yang dikembangkan akan memiliki dua jenis hak akses pengguna utama dengan pembagian tugas sebagai berikut:

1. **Admin (Penjual)**: Berperan sebagai pengelola utama sistem dengan kontrol penuh pada manajemen produk, kategori, monitoring transaksi, serta laporan pendapatan.
2. **User (Pembeli)**: Mengakses platform untuk melihat katalog, mengelola keranjang belanja, mendeteksi lokasi otomatis, dan melakukan pembayaran digital.

#### 3.4.1 Proses Pemesanan pada Sistem
Alur proses pemesanan pada sistem e-commerce baru:
1. Pembeli mengakses website dan login menggunakan akun Google (Firebase Auth).
2. Pembeli menelusuri katalog produk UMKM dan melihat detail spesifikasi.
3. Pembeli memasukkan produk pilihan ke dalam keranjang belanja.
4. Pada proses checkout, sistem mengambil koordinat geolokasi pelanggan secara otomatis.
5. **Validasi Haversine**: Sistem menghitung jarak antara lokasi pelanggan dan pusat toko (Kopo).
6. Jika jarak **<= 8 KM**, tombol pembayaran diaktifkan. Jika tidak, muncul peringatan jangkauan.
7. Pelanggan melakukan pembayaran melalui **Midtrans Snap API** (VA, E-Wallet, QRIS).
8. Midtrans mengirimkan notifikasi sukses ke server, dan status pesanan berubah otomatis.
9. Admin mengonfirmasi dan memproses pengiriman produk.

#### Gambar 3.2: Alur Pemesanan Pada Sistem

#### 3.4.2 Alur Proses Login Admin
Admin mengakses URL khusus login, sistem memvalidasi kredensial, dan mengarahkan ke Dashboard yang menyajikan ringkasan statistik pendapatan harian.
#### Gambar 3.3: Alur Proses Login Admin

#### 3.4.3 Alur Proses Manajemen Produk
Admin memiliki otoritas untuk mengelola inventaris melalui menu Manajemen Produk.
#### Gambar 3.4: Alur Proses Manajemen Produk

#### 3.4.4 - 3.4.6 Alur CRUD (Tambah, Ubah, Hapus) Produk
Setiap proses CRUD melibatkan validasi data di sisi server sebelum disimpan ke database MySQL.
#### Gambar 3.5, 3.6, 3.7: Alur Proses Tambah, Ubah, dan Hapus Produk

#### 3.4.7 Alur Proses Mengelola Pesanan
Admin memantau pesanan masuk, memverifikasi status pembayaran dari Midtrans, memasukkan nomor resi, dan memperbarui status menjadi "Dikirim".
#### Gambar 3.8: Alur Proses Pesanan

#### 3.4.8 Alur Proses Pendapatan
Menyajikan visualisasi data keuangan berdasarkan rentang waktu harian, mingguan, atau bulanan.
#### Gambar 3.9: Alur Proses Pendapatan

### 3.5 Analisis Arsitektur Sistem
Sistem ini mengadopsi arsitektur **Modern Monolith** yang efisien dengan pembagian alur sebagai berikut:

#### 3.5.1 Alur Pelanggan
1. Pengguna mengakses frontend (Bootstrap & Blade).
2. Autentikasi dikelola oleh Firebase SDK untuk login Google sekali klik.
3. Data token divalidasi silang antara Frontend, Backend, dan Firebase Auth.
4. Data profil dan transaksi disimpan secara sinkron di MySQL Utama.

#### 3.5.2 Alur Pembayaran (Midtrans)
1. Server mengirimkan payload transaksi ke API Midtrans.
2. Pelanggan menerima Snap Token untuk memunculkan jendela pembayaran.
3. Notifikasi status pembayaran (*webhook*) dikirim oleh Midtrans ke server Toko191 secara asinkron.

#### 3.5.3 Alur Admin
Admin mengoperasikan panel kontrol yang terhubung langsung ke backend untuk manipulasi data inventaris dan monitoring laporan secara real-time.
#### Gambar 3.10: Analisis Arsitektur Sistem

### 3.6 Analisis Teknologi yang Digunakan
Sistem ini dibangun dengan tumpukan teknologi berikut:
- **Backend**: Laravel 12 untuk logika bisnis dan keamanan server.
- **Frontend**: Bootstrap 5.3 + Bootstrap Icons untuk UI yang responsif.
- **Payment**: Midtrans Snap API sebagai gerbang pembayaran otomatis.
- **Autentikasi**: Firebase Auth (Google Login).
- **Data Real-time**: Firebase Firestore sebagai pendamping MySQL.
- **Algoritma**: Haversine Formula untuk pembatasan layanan radius 8 KM.

#### 3.6.1 Analisis Penggunaan Midtrans
Integrasi Midtrans memungkinkan otomatisasi verifikasi pembayaran. Saat pelanggan menekan "Bayar", server meminta *Snap Token* dari Midtrans dan menampilkannya di sisi klien. Konfirmasi pembayaran ditangani oleh sistem *Webhook* sehingga admin tidak perlu mengecek mutasi bank secara manual.

#### 3.6.2 Analisis Penggunaan Firebase
Firebase Auth menyederhanakan proses registrasi melalui Google Account. Firebase Firestore digunakan untuk menyimpan koordinat lokasi sementara pelanggan demi kecepatan perhitungan jarak tanpa membebani tabel transaksi utama.

#### 3.6.3 Analisis Penggunaan Deteksi Jarak (Haversine)
Karena keterbatasan operasional pengiriman UMKM, sistem mewajibkan validasi jarak. Algoritma Haversine menghitung kelengkungan bumi antara koordinat toko dan pelanggan. Jika hasil > 8 KM, transaksi diblokir untuk menjaga kualitas layanan pengantaran lokal.

### 3.7 Analisis Kebutuhan Non-Fungsional
1. **Software**: Web Browser (Chrome/Edge), Server PHP 8.2+, MySQL 8.
2. **Hardware**: RAM minimal 4GB (Server/Desktop) dan koneksi internet stabil.

### 3.8 Analisis Kebutuhan Pengguna
Sistem membagi pengguna menjadi **Pembeli** (mampu menggunakan smartphone & e-wallet) dan **Penjual** (mampu mengelola dashboard admin dan stok).

### 3.9 Analisis Kebutuhan Fungsional
Analisis kebutuhan fungsional berfokus pada identifikasi fungsi dan tugas yang harus dijalankan oleh sistem. Berikut adalah rincian deskripsi kebutuhan fungsional (SKPL-F):

Tabel 3. 5 Deskripsi Kebutuhan Fungsional

| Nomor | Deskripsi Kebutuhan Fungsional |
| :--- | :--- |
| SKPL-F-01 | Sistem memfasilitasi fitur pendaftaran akun dan login bagi Pengunjung agar dapat menjadi Pembeli. |
| SKPL-F-02 | Sistem menampilkan daftar seluruh kategori produk kepada Penjual. |
| SKPL-F-03 | Sistem menyediakan halaman bagi Penjual untuk menambah kategori produk baru. |
| SKPL-F-04 | Sistem memfasilitasi pengubahan informasi kategori produk oleh Penjual. |
| SKPL-F-05 | Sistem memfasilitasi penghapusan kategori produk oleh Penjual. |
| SKPL-F-06 | Sistem menyediakan halaman bagi Penjual untuk menambahkan produk baru beserta kategorinya. |
| SKPL-F-07 | Sistem memfasilitasi pengelolaan gambar produk oleh Penjual (tambah, ganti, hapus). |
| SKPL-F-08 | Sistem menampilkan daftar seluruh produk yang tersedia kepada Penjual. |
| SKPL-F-09 | Sistem memfasilitasi pengubahan informasi produk oleh Penjual (nama, harga, deskripsi). |
| SKPL-F-10 | Sistem memfasilitasi penghapusan produk oleh Penjual. |
| SKPL-F-11 | Sistem menampilkan detail informasi produk kepada Pembeli (gambar, harga, deskripsi). |
| SKPL-F-12 | Sistem memfasilitasi penambahan produk ke keranjang oleh Pembeli. |
| SKPL-F-13 | Sistem menampilkan daftar item yang telah dimasukkan ke dalam keranjang. |
| SKPL-F-14 | Sistem memfasilitasi penghapusan produk dari keranjang oleh Pembeli. |
| SKPL-F-15 | Sistem memfasilitasi proses pembayaran pesanan melalui integrasi Midtrans. |
| SKPL-F-16 | Sistem memfasilitasi pengunduhan invoice pesanan oleh Pembeli setelah pembayaran. |
| SKPL-F-17 | Sistem menampilkan laporan penjualan kepada Penjual berdasarkan rentang waktu. |

### 3.10 Pemodelan UML
Pemodelan UML digunakan untuk memetakan arsitektur fungsional dan logis sistem.

#### 3.10.1 Use Case Diagram
Menggambarkan interaksi aktor (Pembeli, Penjual, Midtrans) dengan fitur sistem.

**Identifikasi Aktor**
Tabel 3. 7 Identifikasi Aktor

| No | Aktor | Deskripsi |
| :--- | :--- | :--- |
| 1 | Pengunjung | Mengakses sistem tanpa login, melihat produk, dan mendaftar akun. |
| 2 | Pembeli | Pengguna terdaftar yang dapat melakukan transaksi, checkout, dan bayar. |
| 3 | Penjual | Admin yang mengelola produk, kategori, pesanan, dan laporan. |
| 4 | Midtrans | Payment Gateway sebagai pihak ketiga proses transaksi online. |

**Identifikasi Use Case**
Tabel 3. 8 Identifikasi Use Case

| No | Use Case | Deskripsi |
| :--- | :--- | :--- |
| 1 | Melihat Home Page | Pengunjung melihat halaman utama sistem. |
| 2 | Registrasi/Login | Pendaftaran pelanggan baru atau masuk ke sistem. |
| 3 | Kelola Produk | Penjual menambah, mengubah, atau menghapus produk. |
| 4 | Kelola Kategori | Penjual mengelola klasifikasi produk UMKM. |
| 5 | Tambah ke Keranjang | Pembeli menampung produk sebelum checkout. |
| 6 | Checkout & Jarak | Validasi lokasi pelanggan (Haversine) dan pembuatan pesanan. |
| 7 | Pembayaran | Transaksi via Midtrans Snap. |
| 8 | Laporan | Penjual melihat rekapitulasi penjualan. |

#### 3.10.2 Activity Diagram
Menjelaskan seluruh alur kerja mulai dari Login, Checkout, hingga konfirmasi pembayaran oleh Admin.
#### Gambar 3.16 - 3.39: Kumpulan Activity Diagram

#### 3.11 Perancangan Basis Data
Perancangan basis data dilakukan menggunakan MySQL (Relational) dengan struktur tabel sebagai berikut:

**Tabel 3. 36: User (users)**
| Atribut | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| id | bigint | Primary Key |
| name | varchar(255) | Nama Lengkap |
| email | varchar(255) | Email (Google Login) |
| role | varchar(50) | admin / customer |

**Tabel 3. 38: Products (products)**
| Atribut | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| id | bigint | Primary Key |
| name | varchar(255) | Nama Produk |
| price | decimal(15,2) | Harga Satuan |
| stock | int | Jumlah Stok |
| category_id | bigint | Foreign Key ke Categories |

**Tabel 3. 41: Orders (orders)**
| Atribut | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| id | bigint | Primary Key |
| user_id | bigint | Foreign Key ke Users |
| total_price | decimal(15,2) | Total Transaksi |
| status | varchar(50) | pending / settlement / failure |

### 3.12 Perancangan Antarmuka (UI/UX)
Perancangan difokuskan pada pengalaman pengguna yang intuitif dengan struktur sebagai berikut:
1. **Landing Page**: Menampilkan banner promo dan grid produk.
2. **Product Detail**: Menyediakan tombol "Tambah Keranjang" dan deskripsi produk.
3. **Checkout Page**: Form input alamat dengan deteksi otomatis geolokasi.
4. **Admin Dashboard**: Statistik penjualan interaktif menggunakan chart.

### 3.13 Jaringan Semantik
Jaringan semantik menggambarkan keterhubungan konseptual antara objek dalam sistem Toko191.
- **Pembeli** *memiliki* **Keranjang**.
- **Keranjang** *berisi* **Produk**.
- **Produk** *memiliki* **Kategori**.
- **Pesanan** *divalidasi oleh* **Jarak Haversine**.
- **Pembayaran** *diproses oleh* **Midtrans**.

#### Gambar 3.81 & 3.82: Jaringan Semantik Pembeli & Penjual
