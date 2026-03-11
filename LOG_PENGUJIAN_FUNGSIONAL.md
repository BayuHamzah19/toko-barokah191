# Log Pengujian Fungsional (Black-Box Testing) - Toko191

Laporan ini mendetailkan setiap kasus uji sistem sesuai dengan skenario input data (Data Benar & Data Salah).

---

### 1. Hasil Pengujian Melakukan Register
**Tabel 4.15 Hasil Pengujian Melakukan Register**

| Kasus dan Hasil Uji (Data Benar) | | | |
| :--- | :--- | :--- | :--- |
| **Data Masukan** | **Hasil Diharapkan** | **Hasil Pengamatan** | **Kesimpulan** |
| Nama: Budi Santoso<br>Username: budi191<br>Email: budi@example.com<br>Kata Sandi: password123<br>Konfirmasi: password123 | Sistem berhasil menyimpan akun dan mengarahkan pengguna ke halaman login atau dashboard. | Berhasil masuk ke dalam sistem, data tersimpan di database MySQL & Firebase Auth. | **Diterima** |
| | | | |
| **Kasus dan Hasil Uji (Data Salah)** | | | |
| **Data Masukan** | **Hasil Diharapkan** | **Hasil Pengamatan** | **Kesimpulan** |
| Nama: Budi Santoso<br>Email: budi@example.com<br>Kata Sandi: gilang12<br>Konfirmasi: salah12 | Sistem menampilkan pesan error "The password confirmation does not match". | Muncul notifikasi kemerahan yang menyatakan konfirmasi kata sandi tidak sesuai. | **Diterima** |

---

### 2. Hasil Pengujian Melakukan Login
**Tabel 4.16 Hasil Pengujian Melakukan Login**

| Kasus dan Hasil Uji (Data Benar) | | | |
| :--- | :--- | :--- | :--- |
| **Data Masukan** | **Hasil Diharapkan** | **Hasil Pengamatan** | **Kesimpulan** |
| Email: budi@example.com<br>Kata Sandi: password123 | Dapat masuk ke dalam sistem dan mengarahkan ke halaman dashboard sesuai role. | Pengguna berhasil dialihkan ke halaman utama/dashboard pembeli. | **Diterima** |
| | | | |
| **Kasus dan Hasil Uji (Data Salah)** | | | |
| **Data Masukan** | **Hasil Diharapkan** | **Hasil Pengamatan** | **Kesimpulan** |
| Email: budi@example.com<br>Kata Sandi: salahsandi | Sistem menampilkan pesan error "These credentials do not match our records". | Gagal masuk dan muncul pesan peringatan bahwa kredensial salah. | **Diterima** |

---

### 3. Hasil Pengujian Tambah Produk (Admin)
**Tabel 4.17 Hasil Pengujian Tambah Produk**

| Kasus dan Hasil Uji (Data Benar) | | | |
| :--- | :--- | :--- | :--- |
| **Data Masukan** | **Hasil Diharapkan** | **Hasil Pengamatan** | **Kesimpulan** |
| Nama Produk: Beras 5KG<br>Harga: 65000<br>Stok: 50<br>Gambar: beras.jpg | Produk baru muncul di daftar katalog admin dan halaman pembeli. | Data produk tersimpan di Firestore dan gambar terupload ke Storage. | **Diterima** |
| | | | |
| **Kasus dan Hasil Uji (Data Salah)** | | | |
| **Data Masukan** | **Hasil Diharapkan** | **Hasil Pengamatan** | **Kesimpulan** |
| Nama Produk: -<br>Harga: "Gratis"<br>Stok: -10 | Sistem menolak input dan memberikan pesan validasi pada field yang kosong/salah. | Muncul pesan error "Nama produk wajib diisi" dan "Harga harus berupa angka". | **Diterima** |

---

### 4. Hasil Pengujian Proses Checkout & Midtrans
**Tabel 4.18 Hasil Pengujian Checkout**

| Kasus dan Hasil Uji (Data Benar) | | | |
| :--- | :--- | :--- | :--- |
| **Data Masukan** | **Hasil Diharapkan** | **Hasil Pengamatan** | **Kesimpulan** |
| Pilih Produk -> Keranjang -> Klik Checkout -> Klik Bayar | Muncul Pop-up Midtrans (Snap) dengan berbagai pilihan metode pembayaran. | Berhasil menampilan modal pembayaran Midtrans dengan nomor Virtual Account. | **Diterima** |
| | | | |
| **Kasus dan Hasil Uji (Data Salah)** | | | |
| **Data Masukan** | **Hasil Diharapkan** | **Hasil Pengamatan** | **Kesimpulan** |
| Klik Checkout tanpa mengisi alamat pengiriman | Sistem meminta pengguna melengkapi data profil/alamat terlebih dahulu. | Tombol bayar tidak aktif/muncul peringatan untuk mengisi alamat. | **Diterima** |

---
*Laporan ini dibuat untuk memenuhi standard dokumentasi pengujian fungsional sistem.*
