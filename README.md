# CMS Sederhana

CMS (Content Management System) Sederhana adalah sistem manajemen konten yang dibangun dengan PHP native. Sistem ini menyediakan fitur-fitur dasar untuk mengelola konten website dengan antarmuka yang intuitif dan responsif.

## Fitur Utama

### 1. Manajemen Konten
- Post Management (CRUD)
- Category Management
- Media Library
- User Management
- Comment System

### 2. Antarmuka Pengguna
- Dashboard yang informatif
- Sidebar navigasi yang responsif
- Header dengan fitur pencarian
- Media library dengan preview
- Rich text editor (TinyMCE)

### 3. Keamanan
- Sistem login/register
- Manajemen session
- Password hashing
- Role-based access control

### 4. Responsive Design
- Layout yang responsif untuk mobile
- Search box full width pada mobile
- Mobile-friendly navigation
- Optimized spacing untuk mobile view

### 5. Visual Effects
- Modern gradient backgrounds
- Smooth transitions dan animations
- Interactive hover effects
- Soft shadows

## Persyaratan Sistem

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Web server (Apache/Nginx)
- XAMPP/WAMP/MAMP (untuk development)

## Instalasi

1. Clone repository ini ke direktori web server Anda:
```bash
git clone https://github.com/your-username/CMS_Sederhana.git
cd CMS_Sederhana
```

2. Buat database baru di MySQL:
```sql
CREATE DATABASE cms_sederhana;
```

3. Import struktur database dari file `database/cms_sederhana.sql`

4. Konfigurasi koneksi database di `config/connection.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');  // Sesuaikan dengan username MySQL Anda
define('DB_PASS', '');      // Sesuaikan dengan password MySQL Anda
define('DB_NAME', 'cms_sederhana');
```

5. Akses CMS melalui browser:
```
http://localhost/CMS_Sederhana
```

## Struktur Direktori

```
CMS_Sederhana/
├── app/
│   ├── controllers/
│   ├── models/
│   ├── views/
│   └── includes/
├── config/
├── core/
├── database/
├── public/
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   └── images/
│   └── index.php
└── README.md
```

## Penggunaan

### Login Default
- Username: admin
- Password: admin123

> **PENTING**: Setelah login pertama kali, segera ubah password default untuk keamanan.

### Membuat Post Baru
1. Login ke dashboard
2. Klik menu "Posts"
3. Klik tombol "Add New Post"
4. Isi form post
5. Upload gambar jika diperlukan
6. Klik "Publish"

### Mengelola Media
1. Akses menu "Media"
2. Upload file menggunakan form upload
3. Lihat preview media
4. Hapus media yang tidak diperlukan

## Kontak dan Dukungan

### Tim Pengembang
- **Lead Developer**: [Nama Anda]
- **Email**: [email@anda.com]
- **GitHub**: [github.com/username-anda]

### Dukungan Teknis
Untuk bantuan teknis atau melaporkan bug:
1. Buat issue baru di repository GitHub
2. Berikan detail lengkap tentang masalah yang Anda hadapi
3. Sertakan screenshot jika diperlukan
4. Jelaskan langkah-langkah untuk mereproduksi masalah

### Kontribusi
Kami menyambut kontribusi dari komunitas! Untuk berkontribusi:
1. Fork repository ini
2. Buat branch baru untuk fitur Anda
3. Commit perubahan Anda
4. Push ke branch Anda
5. Buat Pull Request

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

## Catatan Penting

- Pastikan server web Anda (Apache/Nginx) memiliki izin write pada direktori `public/assets/images/` untuk upload media
- Backup database secara berkala
- Selalu perbarui password admin secara berkala
- Gunakan HTTPS untuk keamanan tambahan di production 