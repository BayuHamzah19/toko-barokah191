# Hasil Pengujian Alpha dan Black-Box Fungsionalitas

Laporan ini mendokumentasikan hasil pengujian internal (Alpha) menggunakan metode *Black-Box Testing* untuk memastikan setiap fitur pada sistem Toko191 berjalan sesuai dengan fungsinya.

## 1. Pengujian Alpha (Fungsionalitas Black-Box)

Pengujian ini dilakukan oleh pengembang untuk memverifikasi logika input dan output pada setiap modul utama.

### A. Modul Autentikasi & Profil
| No | Fitur | Skenario Pengujian | Hasil yang Diharapkan | Status |
| :-- | :--- | :--- | :--- | :---: |
| 1 | Register | Input data baru (Email/Username) | Akun tersimpan di MySQL & Firebase Auth | Berhasil |
| 2 | Login (Regular) | Masukkan email & password terdaftar | Masuk ke dashboard sesuai role (User/Admin) | Berhasil |
| 3 | Login Google | Klik tombol "Login with Google" | Autentikasi via Firebase & redirect otomatis | Berhasil |
| 4 | Logout | Klik tombol logout | Token dihapus & session berakhir | Berhasil |

### B. Modul Manajemen Produk (Admin)
| No | Fitur | Skenario Pengujian | Hasil yang Diharapkan | Status |
| :-- | :--- | :--- | :--- | :---: |
| 1 | Tambah Produk | Upload gambar dan detail produk | Data tersimpan di Firestore & gambar di Storage | Berhasil |
| 2 | Edit Produk | Mengubah harga atau stok | Perubahan langsung tercermin di halaman User | Berhasil |
| 3 | Hapus Produk | Menghapus data produk | Data terhapus secara permanen dari database | Berhasil |

### C. Modul Transaksi & Pembayaran (User)
| No | Fitur | Skenario Pengujian | Hasil yang Diharapkan | Status |
| :-- | :--- | :--- | :--- | :---: |
| 1 | Keranjang | Klik "Tambah ke Keranjang" | Item masuk ke list belanja & update jumlah | Berhasil |
| 2 | Checkout | Klik checkout & isi alamat | Generate Snap Token dari Midtrans | Berhasil |
| 3 | Pembayaran | Simulasi bayar via Virtual Account | Status pesanan otomatis berubah jadi "Sudah Bayar" | Berhasil |

### D. Modul Notifikasi & Real-time
| No | Fitur | Skenario Pengujian | Hasil yang Diharapkan | Status |
| :-- | :--- | :--- | :--- | :---: |
| 1 | Sinkronisasi | Update data di Firestore | Frontend terupdate otomatis tanpa refresh | Berhasil |
| 2 | Notifikasi Order | Pesanan baru masuk | Admin menerima pemberitahuan pesanan baru | Berhasil |

---

## 2. Hasil Pengujian Non-Fungsional

Selain fungsionalitas, pengujian juga dilakukan pada aspek teknis sistem:

| Aspek | Parameter Pengujian | Hasil |
| :--- | :--- | :--- |
| **Keamanan** | Akses halaman Admin tanpa login | Sistem otomatis me-redirect ke halaman Login (Middleware berjalan). |
| **Responsivitas** | Akses via Desktop, Tablet, & HP | Layout Tailwind CSS menyesuaikan ukuran layar dengan rapi. |
| **Integrasi API** | Koneksi ke Midtrans & Firebase | Respon API rata-rata < 200ms (Sangat Cepat). |

---

## 3. Kesimpulan Pengujian Alpha

Berdasarkan pengujian **Black-Box** yang telah dilakukan terhadap seluruh modul utama:
1.  **Fungsionalitas**: 100% fitur utama berjalan sesuai spesifikasi teknis.
2.  **Integritas Data**: Sinkronisasi antara Laravel (MySQL) dan Firebase (NoSQL) berjalan sinkron tanpa ada kehilangan data (*data loss*).
3.  **Kesiapan**: Sistem dinyatakan stabil dan lolos tahap Alpha Testing, sehingga siap dilanjutkan ke tahap Beta Testing (Pengguna Akhir).

---
*Tanggal Pengujian: 22 Januari 2026*
*Tim Penguji: Tim Developer Toko191*
