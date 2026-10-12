# OneCoreVisa — Laravel 12 Web Portal

Website resmi untuk bisnis pengurusan visa, KITAS, serta pendirian usaha & bantuan hukum di Indonesia: **OneCoreVisa (One Step Solution)**.
Website ini telah dikonversi secara penuh ke **Laravel 12** menggunakan template aset yang berada di folder `/refs`.

---

## 🎨 Palette Warna Resmi

- **Deep Navy:** `#0B2942` (Warna utama otoritas, header, topbar, footer, badge judul)
- **Ocean Blue:** `#176B9C` (Warna brand utama, tombol aksi primer, ikon highlight, kartu aktif)
- **Light Blue:** `#6EA8C8` (Aksen dinamis, badge kode, border interaktif, tag status)

---

## 🏗️ Struktur Landing Page

### 1. ONECORE VISA (One step solution)
- **Hero Section:** Slider background dari template `/refs`, headline kuat *"ONECORE VISA (One Step Solution)"*.
- **Pilar Bisnis:** *Visa & KITAS Specialists* + *Businesses Setup & Legal Assist*.
- **OneCore Verified Pass:** Kartu simulasi izin digital resmi berstatus 100% legal compliant.
- **Trust Metrics Bar:** 5.200+ Visa & KITAS, 380+ PT PMA, 99.4% Approval, 48+ Negara Klien.
- **Akreditasi:** Kepatuhan Ditjen Imigrasi, BKPM OSS-RBA, Kemenkumham RI, & PERADI.

### 2. Check which your preference (search kolom)
- **Search Kolom Real-Time:** Filter instan berbasis teks untuk menemukan visa, KITAS, PT PMA, atau izin spesifik.
- **Tombol Pencarian Cepat:** Chip untuk *Investor KITAS*, *PT PMA Setup*, *Remote Worker (E33G)*, *Tourist B211A*, *Spouse KITAS*, *Virtual Office*, *NIB & OSS*.
- **Filter Tab Kategori:**
  - *All Options*
  - *Visas & Visits* (e-VOA, B211A)
  - *KITAS & Long-Term* (Investor E28A/B, Kerja E23, Nomad E33G, Pensiun E33F, Keluarga E31A)
  - *Business Setup & PMA* (PT PMA 100% Asing, Virtual Office Bali/Jakarta)
  - *Legal & Corporate Assist* (OSS RBA & NIB, Pajak & Rekening Bank, Kontrak Bisnis)
- **30-Second Match Wizard:** Rekomendasi otomatis berdasarkan 2 pertanyaan mudah (Tujuan & Durasi).
- **Katalog Kartu Layanan:** Menyajikan waktu pengerjaan (SLA), masa berlaku, dokumen persyaratan (collapsible), keunggulan, serta tombol *"Select & Inquire"*.

### 3. About us
- **Filosofi Solusi Satu Pintu:** Menyatukan birokrasi imigrasi dan korporasi di bawah satu firma hukum terakreditasi.
- **4 Pilar Layanan:** Kepastian Hukum, Kecepatan & VIP Fast-Track, Dukungan Bisnis Penuh, Harga Pasti & Transparan.
- **Matriks Perbandingan:** Komparasi langsung calo tidak berizin vs keunggulan OneCoreVisa.
- **Kantor Fisik:** *Jakarta Corporate Hub* (TB Simatupang) & *Bali Expat Hub* (Sunset Road, Badung/Seminyak).

### 4. Our service
- **Tab 1: Layanan Visa & KITAS** (e-VOA, B211A, Working KITAS, Investor KITAS, Remote Worker Visa, Spouse KITAS, Retirement KITAS).
- **Tab 2: Pendirian Bisnis & Bantuan Hukum** (PT PMA 100% Kepemilikan Asing, Virtual Office, OSS-RBA & NIB, NPWP Badan & Pembukaan Rekening Bank Devisa, Kontrak Bisnis).

### 5. Our process
- **Tahap 01:** Konsultasi & Analisis Strategis Gratis (Dalam 2 Jam)
- **Tahap 02:** Verifikasi & Penyusunan Dokumen (Hari 1 - 2)
- **Tahap 03:** Pengajuan ke Portal Resmi Pemerintah (Hari 3 - 7)
- **Tahap 04:** Persetujuan, Biometrik VIP & Serah Terima (Sesuai SLA Garansi)
- **The OneCore Guarantee:** Dedicated Case Manager, kerahasiaan dokumen di bawah perjanjian NDA legal.

---

## 🛠️ Komponen & Fitur Laravel 12

- **Framework:** Laravel 12 (`laravel/framework: ^12.0`)
- **PHP:** PHP 8.4
- **Template Integration:** Asset CSS, JS, Fonts, dan Gambar dari folder `/refs` dipindahkan ke `public/assets/` dengan custom theme `public/assets/css/onecore-theme.css`.
- **Controller:** [`app/Http/Controllers/HomeController.php`](app/Http/Controllers/HomeController.php)
- **Views:**
  - Layout: [`resources/views/layouts/app.blade.php`](resources/views/layouts/app.blade.php)
  - Home: [`resources/views/home.blade.php`](resources/views/home.blade.php)
- **Routes:** [`routes/web.php`](routes/web.php)
- **Bilingual Switcher:** Mendukung Bahasa Inggris (`EN`) dan Bahasa Indonesia (`ID`) via session (`/lang/{locale}`).
- **Lead Capture & WhatsApp Integration:** Modal konsultasi langsung memformat pesan WhatsApp calon klien dengan data terstruktur.

---

## 🚀 Menjalankan Project

```bash
# Menjalankan server Laravel di port 8080 (atau port pilihan)
php artisan serve --port=8080

# Akses di browser:
# http://127.0.0.1:8080
```
