# Laporan Implementasi Teknologi - Project Toko191

Laporan ini merinci teknologi yang diimplementasikan dalam pengembangan sistem E-Commerce Toko191.

## 1. Arsitektur Sistem
Project ini menggunakan arsitektur **Modern Monolith** yang menggabungkan kekuatan backend Laravel dengan reaktivitas frontend React melalui bridge **Inertia.js**.

- **Backend**: Laravel 12 (PHP 8.2)
- **Frontend**: React 18 + Tailwind CSS 3.2
- **Bridge**: Inertia.js 2.0
- **Database**: MySQL (untuk data relasional) & Firebase Firestore (untuk data real-time)

---

## 2. Implementasi Backend (Laravel)
Laravel digunakan sebagai engine utama untuk menangani routing, logika bisnis, database ORM (Eloquent), dan middleware keamanan.

### Fitur Utama Backend:
- **Routing & Middleware**: Pemisahan akses antara `is_admin` dan `is_user`.
- **Eloquent ORM**: Pemodelan data untuk `Product`, `Order`, `Cart`, dan `User`.
- **Service Layer**: Implementasi `FirebaseService` untuk interaksi dengan Google Cloud API.
- **REST Integration**: Penggunaan `FirestoreRest` untuk komunikasi dengan database NoSQL Firestore.

---

## 3. Implementasi Frontend (React & Tailwind CSS)
Frontend dibangun menggunakan React untuk memberikan pengalaman pengguna yang responsif.

- **Vite**: Sebagai build tool untuk kompilasi asset (JS/CSS) yang super cepat.
- **Tailwind CSS**: Digunakan untuk styling berbasis utility yang konsisten dan responsif.
- **Inertia.js**: Memungkinkan pengembangan aplikasi *Single Page Application* (SPA) menggunakan routing Laravel tanpa perlu membangun API terpisah.
- **Components**: UI yang reusable seperti Sidebar, Navbar, dan Product Cards.

---

## 4. Integrasi Layanan Pihak Ketiga (Third-Party)

### A. Midtrans Payment Gateway
Digunakan untuk menangani transaksi pembayaran secara otomatis dan aman.
- **SDK**: `midtrans/midtrans-php`
- **Tipe Transaksi**: Snap (Modal Checkout)
- **Status**: Sandbox Mode (Development)
- **Fitur**: Pembuatan `snap_token` untuk pembayaran menggunakan Kartu Kredit, GoPay, ShopeePay, dan Virtual Account.

### B. Firebase & Firestore
Digunakan untuk autentikasi dan penyimpanan data cloud.
- **Firebase Auth**: Implementasi login via Google.
- **Firestore**: Digunakan untuk sinkronisasi data produk atau order secara real-time.
- **SDK**: `kreait/laravel-firebase` & `google/auth`.

---

## 5. Keamanan & Migrasi
- **Laravel Sanctum**: Digunakan untuk autentikasi API berbasis token.
- **Middleware**: Memastikan proteksi halaman admin dari akses user biasa.
- **Database Migrations**: Penstrukturan schema database secara terkontrol.

---

## 6. Kebutuhan Sistem (System Requirements)
Untuk menjalankan implementasi ini, dibutuhkan lingkungan berikut:
- **Server**: Laragon / XAMPP (untuk Apache/Nginx & MySQL)
- **PHP**: Versi 8.2 atau lebih tinggi.
- **Node.js**: Untuk menjalankan Vite dan mengelola library React.
- **Composer**: Untuk mengelola dependency PHP.
- **Firebase Service Account**: Berupa file `serviceAccountKey.json` untuk akses API.

---

## Kesimpulan
Teknologi yang ada pada project Toko191 merupakan perpaduan antara framework PHP paling populer (Laravel) dengan library JS paling populer (React). Integrasi dengan Midtrans dan Firebase memberikan fitur kelas enterprise dalam skala yang dapat disesuaikan.
