## websitePhsing 🎣

Selamat datang di repositori **Sistem Reservasi Tempat Pemancingan**! Ini adalah aplikasi web yang memungkinkan pengguna untuk melakukan reservasi tempat pemancingan, melihat informasi kolam pemancingan, jenis ikan, serta mengelola pembayaran. Aplikasi ini dirancang agar responsif dan mudah digunakan oleh pengguna maupun administrator.

## 📅 Timeline:
**24-25 Mei (2 hari):**
- Design
- Repo GIT klo bisa
- bagi tugas

**26-28 Mei (3 hari):**
- grind tugas(belajar & eksplor)
 
**29-30 Mei (2 hari):**
- 30% jadi 
- buat laporan progres

**31-5 Juni (6 hari):**
- gas buat

### 🚀 Fitur

- **Reservasi Online**: Pengguna dapat membuat reservasi tempat pemancingan dengan mudah.
- **Manajemen Kolam Pemancingan**: Admin dapat menambah, mengubah, dan menghapus informasi kolam pemancingan.
- **Manajemen Ikan**: Admin dapat menambah, mengubah, dan menghapus informasi jenis ikan.
- **Pembayaran**: Kelola dan proses pembayaran untuk setiap reservasi.
- **Dashboard Admin**: Ringkasan data penting seperti total reservasi, pembayaran, dan aktivitas pengguna.

### 📂 Struktur Folder

```
/
├── includes/
│   ├── config.php        # Koneksi database
│   ├── header.php        # Header untuk halaman
│   └── footer.php        # Footer untuk halaman
├── admin.php             # Dashboard admin
├── manage_reservations.php # Manajemen reservasi
├── manage_pools.php      # Manajemen kolam pemancingan
├── manage_fish.php       # Manajemen ikan
├── add_pool.php          # Tambah kolam pemancingan
├── edit_pool.php         # Edit kolam pemancingan
├── delete_pool.php       # Hapus kolam pemancingan
├── add_fish.php          # Tambah ikan
├── edit_fish.php         # Edit ikan
├── delete_fish.php       # Hapus ikan
├── login.php             # Halaman login admin
└── README.md             # Dokumen ini
```

### 📂 sql query

```
CREATE DATABASE fishing_db;

USE fishing_db;

CREATE TABLE admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nama_admin VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE pelanggan (
    id_pelanggan INT AUTO_INCREMENT PRIMARY KEY,
    nama_pelanggan VARCHAR(100) NOT NULL,
    alamat_pelanggan TEXT NOT NULL,
    no_telp VARCHAR(20),
    alamat_email VARCHAR(100)
);

CREATE TABLE kolam_pemancingan (
    id_kolam INT AUTO_INCREMENT PRIMARY KEY,
    nama_kolam VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    kapasitas INT,
    harga_perjam DECIMAL(10, 2)
);

CREATE TABLE ikan (
    id_ikan INT AUTO_INCREMENT PRIMARY KEY,
    nama_ikan VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    harga_per_kg DECIMAL(10, 2)
);

CREATE TABLE reservasi (
    id_reservasi INT AUTO_INCREMENT PRIMARY KEY,
    id_pelanggan INT,
    id_kolam INT,
    tgl_pemakaian DATE,
    waktu_mulai TIME,
    waktu_selesai TIME,
    status_reservasi VARCHAR(50),
    FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan),
    FOREIGN KEY (id_kolam) REFERENCES kolam_pemancingan(id_kolam)
);

CREATE TABLE hasilMancing (
    id_hasilMancing INT AUTO_INCREMENT PRIMARY KEY,
    id_reservasi INT,
    id_ikan INT,
    jumlah_ikan INT,
    berat_total DECIMAL(10, 2),
    FOREIGN KEY (id_reservasi) REFERENCES reservasi(id_reservasi),
    FOREIGN KEY (id_ikan) REFERENCES ikan(id_ikan)
);

CREATE TABLE pembayaran (
    id_pembayaran INT AUTO_INCREMENT PRIMARY KEY,
    id_reservasi INT,
    id_admin INT,
    id_pelanggan INT,
    id_hasilMancing INT,
    tgl_pembayaran DATE,
    jml_pembayaran DECIMAL(10, 2),
    mtd_pembayaran VARCHAR(50),
    FOREIGN KEY (id_reservasi) REFERENCES reservasi(id_reservasi),
    FOREIGN KEY (id_admin) REFERENCES admin(id_admin),
    FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan),
    FOREIGN KEY (id_hasilMancing) REFERENCES hasilMancing(id_hasilMancing)
);

```

### 🛠️ Instalasi

Ikuti langkah-langkah berikut untuk menginstal aplikasi ini secara manual tanpa menggunakan AMPPS atau XAMPP:

1. **Pasang Software yang Dibutuhkan**:
   - **Apache**: Web server
   - **MySQL**: Database
   - **PHP**: Bahasa pemrograman server-side

2. **Konfigurasi Web Server**:
   - Pastikan Apache dan MySQL berjalan di sistem Anda.
   - Tempatkan semua file aplikasi di direktori root web server (misalnya, `C:\Apache24\htdocs` di Windows atau `/var/www/html` di Linux).

3. **Buat Database**:
   - Buka MySQL dan buat database baru:
     ```sql
     CREATE DATABASE pemancingan;
     ```
   - Impor struktur tabel menggunakan file SQL yang telah disediakan:
     ```sql
     USE pemancingan;
     SOURCE path/to/database.sql;
     ```

4. **Konfigurasi Database**:
   - Buka `includes/config.php` dan sesuaikan pengaturan koneksi database dengan konfigurasi lokal Anda:
     ```php
     <?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "pemancingan";

     $conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
     ?>
     ```

5. **Jalankan Aplikasi**:
   - Buka browser dan akses aplikasi melalui URL lokal, misalnya: `http://localhost/`

### 📚 Dokumentasi API

- **Reservasi**:
  - GET `/reservations`: Mendapatkan daftar semua reservasi.
  - POST `/reservations`: Membuat reservasi baru.
  
- **Kolam Pemancingan**:
  - GET `/pools`: Mendapatkan daftar semua kolam pemancingan.
  - POST `/pools`: Menambahkan kolam pemancingan baru.
  
- **Ikan**:
  - GET `/fish`: Mendapatkan daftar semua jenis ikan.
  - POST `/fish`: Menambahkan jenis ikan baru.
  
- **Pembayaran**:
  - GET `/payments`: Mendapatkan daftar semua pembayaran.
  - POST `/payments`: Menambahkan pembayaran baru.

### 🎉 Kontribusi

Kami menyambut kontribusi dari komunitas! Jika Anda ingin berkontribusi, silakan lakukan langkah-langkah berikut:

1. Fork repositori ini.
2. Buat branch fitur baru (`git checkout -b fitur-baru`).
3. Commit perubahan Anda (`git commit -am 'Menambahkan fitur baru'`).
4. Push ke branch (`git push origin fitur-baru`).
5. Buat Pull Request.

---

Selamat memancing dan menikmati pengalaman menggunakan Sistem Reservasi Tempat Pemancingan! 🎣🐟

**Dibuat dengan ❤️ oleh Tim Pemancingan**
