## BAB V
## KESIMPULAN DAN SARAN

### 5.1 Kesimpulan
Berdasarkan hasil perancangan, implementasi, serta pengujian yang telah dilakukan terhadap aplikasi E-Commerce Toko191 berbasis web menggunakan Laravel, React, Firebase, dan Midtrans, maka dapat ditarik beberapa kesimpulan sebagai berikut:

1.  Aplikasi E-Commerce Toko191 telah berhasil dibangun dengan memanfaatkan arsitektur modern yang menggabungkan backend Laravel 12 dan frontend React 18 melalui Inertia.js, sehingga menghasilkan aplikasi web yang responsif dan memiliki pengalaman pengguna (user experience) yang baik.
2.  Integrasi dengan layanan pihak ketiga yaitu Firebase (Auth & Firestore) dan Payment Gateway Midtrans telah berjalan dengan sukses, dibuktikan dengan kemampuan sistem dalam menangani autentikasi login Google, sinkronisasi data produk real-time, serta proses transaksi pembayaran yang otomatis tanpa verifikasi manual.
3.  Hasil pengujian *Blackbox* menunjukkan bahwa seluruh fungsi inti sistem—mulai dari manajemen produk, keranjang belanja, hingga proses checkout—berfungsi 100% sesuai dengan spesifikasi kebutuhan fungsional yang telah direncanakan.
4.  Hasil pengujian beta melalui kuesioner menunjukkan tingkat kepuasan yang tinggi dari sisi pelanggan dengan rata-rata persentase di atas 90% untuk aspek kemudahan transaksi, keamanan pembayaran, dan aksesibilitas informasi stok produk yang real-time.
5.  Dari sisi operasional, aplikasi ini terbukti mempermudah pengelola (admin) Toko191 dalam melakukan pencatatan stok dan manajemen pesanan menjadi lebih terstruktur, transparan, dan mengurangi risiko kesalahan manusia (human error) dibandingkan metode pencatatan konvensional.

### 5.2 Saran
Meskipun sistem telah berfungsi dengan baik, peneliti menyadari masih terdapat ruang untuk pengembangan lebih lanjut. Oleh karena itu, terdapat beberapa saran yang dapat diajukan untuk pengembangan aplikasi Toko191 di masa depan:

1.  **Integrasi Logistik dan Ongkos Kirim**: Menambahkan integrasi API ekspedisi (seperti RajaOngkir atau sejenisnya) agar perhitungan biaya pengiriman dapat dilakukan secara otomatis dan akurat sesuai dengan berat produk dan lokasi pelanggan.
2.  **Pengembangan Aplikasi Mobile Native**: Mempertimbangkan pengembangan aplikasi versi mobile (Android/iOS) menggunakan teknologi seperti React Native atau Flutter agar pelanggan mendapatkan aksesibilitas yang lebih tinggi melalui perangkat seluler.
3.  **Sistem Analisis Penjualan**: Menambahkan fitur dashboard analitik yang lebih mendalam, mencakup visualisasi grafik penjualan bulanan, produk terlaris, dan segmentasi pelanggan untuk membantu pengelola dalam pengambilan keputusan bisnis.
4.  **Optimasi Keamanan**: Melakukan audit keamanan secara berkala serta penambahan fitur *Two-Factor Authentication* (2FA) untuk meningkatkan keamanan akun, terutama pada sisi admin.
5.  **Pemasaran Terintegrasi**: Menambahkan fitur promosi otomatis seperti sistem kupon/diskon berkala dan notifikasi email/push notification untuk menjaga loyalitas pelanggan (Customer Retention).
