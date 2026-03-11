### 4.2.1.3 Hasil Pengujian Beta

Setelah dilakukan proses pengujian secara langsung di **Toko191** kepada pengelola dan pelanggan, berikut adalah hasil temuan dan analisis data yang didapatkan:

#### 1. Hasil Wawancara Pengelola (Admin/Pemilik)
Berdasarkan wawancara yang dilakukan kepada pemilik **Toko191**, diperoleh hasil sebagai berikut:

- **Pertanyaan A (Manajemen Stok):** Pemilik menyatakan bahwa sistem sangat membantu dalam mengontrol stok produk secara otomatis. Risiko kesalahan pencatatan manual yang sebelumnya sering terjadi dapat diminimalisir hingga 90%.
- **Pertanyaan B (Integrasi Pembayaran & Real-time):** Integrasi Midtrans memudahkan verifikasi pembayaran tanpa harus mengecek mutasi rekening secara manual. Sinkronisasi real-time memberikan kenyamanan karena data pesanan langsung muncul saat pelanggan melakukan checkout.
- **Pertanyaan C (Efisiensi Order):** Fitur pelacakan status pengiriman dan riwayat transaksi membantu dalam memberikan layanan after-sales yang lebih baik kepada pelanggan.

**Kesimpulan Admin:** Sistem dinilai sangat layak (Sangat Baik) untuk digunakan dalam operasional harian Toko191.

---

#### 2. Hasil Kuesioner Pelanggan (User)
Pengujian dilakukan kepada **10 orang responden** yang mencoba langsung aplikasi Toko191 untuk melakukan simulasi transaksi. Berikut adalah rekapitulasi skor yang diberikan (Skala 1-5):

| No | Pertanyaan Kuesioner | Skor Rata-rata | Persentase | Keterangan |
| :-- | :--- | :---: | :---: | :--- |
| 1 | Kemudahan antarmuka (UI/UX) | 4.6 | 92% | Sangat Baik |
| 2 | Kelancaran proses pencarian & keranjang | 4.8 | 96% | Sangat Baik |
| 3 | Keamanan & kemudahan Midtrans | 4.7 | 94% | Sangat Baik |
| 4 | Kejelasan informasi & status pesanan | 4.5 | 90% | Sangat Baik |
| 5 | Pengalaman belanja secara keseluruhan | 4.8 | 96% | Sangat Baik |

**Analisis Hasil Kuesioner:**
Berdasarkan data di atas, rata-rata skor kepuasan pelanggan mencapai **93.6%**. Hal ini menunjukkan bahwa aplikasi Toko191 telah memenuhi ekspektasi pengguna dalam hal fungsionalitas dan kemudahan penggunaan.

---

#### 3. Rekapitulasi Feedback & Perbaikan (Bug Tracking)
Selama masa pengujian beta, terdapat beberapa masukan kecil dari pengguna:

| No | Temuan/Masukan | Status | Tindakan |
| :-- | :--- | :---: | :--- |
| 1 | Waktu loading gambar produk agak lama di koneksi rendah. | Selesai | Optimasi ukuran gambar menggunakan format WebP. |
| 2 | Penambahan fitur filter harga di halaman produk. | Selesai | Fitur filter harga telah diimplementasikan. |
| 3 | Konfirmasi email setelah pembayaran berhasil. | Selesai | Integrasi pengiriman notifikasi via email/WA. |

---

#### 4. Kesimpulan Akhir Pengujian Beta
Secara keseluruhan, pengujian beta menunjukkan bahwa aplikasi **Toko191** berfungsi dengan stabil dan diterima dengan sangat baik oleh pengguna. Sistem telah siap untuk diimplementasikan ke tahap *Production* atau digunakan secara resmi untuk melayani transaksi nyata.
