# Admission Test Fuzzy

Proyek ini adalah implementasi untuk tes penerimaan dengan fitur fuzzy logic. Berikut adalah langkah-langkah untuk menyiapkan dan menjalankan proyek ini di lingkungan lokal Anda.

## Prasyarat

![Laravel](https://img.shields.io/badge/Laravel-v12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white) ![Filament](https://img.shields.io/badge/Filament-FDAE4B?style=for-the-badge&logo=filament&logoColor=white) ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

Proyek ini mengimplementasikan sistem tes penerimaan dengan fuzzy logic menggunakan:

- **Laravel** - Framework PHP
- **Filament** - Admin Panel
- **MySQL** - Database System

## Instalasi

1.  **Clone Repository:**

    Buka terminal Anda dan jalankan perintah berikut untuk mengkloning repositori dari GitHub:

    ```bash
    git clone https://github.com/glenoka/admission-test-fuzzy.git
    cd admission-test-fuzzy
    ```

2.  **Instalasi Dependencies Composer:**

    Setelah masuk ke direktori proyek, instal semua dependensi yang diperlukan menggunakan Composer:

    ```bash
    composer install
    ```

## Konfigurasi

1.  **Konfigurasi Environment (.env):**

    -   Salin file `.env.example` menjadi `.env`:

        ```bash
        cp .env.example .env
        ```

    -   Buka file `.env` dengan editor teks dan konfigurasi detail database Anda:

        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=nama_database_anda
        DB_USERNAME=nama_pengguna_database
        DB_PASSWORD=password_database_anda
        ```

    -   Generate App Key:

        Jalankan perintah berikut untuk menghasilkan APP\_KEY:

        ```bash
        php artisan key:generate
        ```
    - Sesuikan ```APP_URL``` dengan url
      ``` APP_URL=http://admission-test-fuzzy.test/```
      atau
      ``` APP_URL=http://127.0.0.1:8000/```

## Instalasi dan Konfigurasi Filament

1.  **Instalasi Filament:**

    Jalankan perintah berikut untuk menginstal Filament:

    ```bash
    composer require filament/filament:"^3.0-stable"
    ```

2.  **Instalasi Panel Filament:**

    Untuk menginstal panel Filament, jalankan:

    ```bash
    php artisan filament:install --panel
    ```

3.  **Instalasi Filament Shield:**

    Instal Filament Shield untuk manajemen otorisasi:

    ```bash
    composer require filament/shield:"^3.0-stable"
    ```

4.  **Migrasi dan Seeding Database:**

    Jalankan migrasi untuk membuat tabel database dan lakukan seeding untuk data awal:

    ```bash
    php artisan migrate --seed
    ```

5.  **Generate Semua Fitur Shield:**

    Generate semua resources dan policies yang diperlukan oleh Shield:

    ```bash
    php artisan shield:generate --all
    ```

6.  **Konfigurasi Super-Admin:**

    Setelah instalasi Shield, Anda perlu mengatur pengguna sebagai super-admin. Ini biasanya dilakukan melalui database atau menyesuaikan seeder. Contoh, Anda bisa menemukan user id di table users. kemudian jalankan perintah berikut di Tinker:

    ```bash
    php artisan shield::super-admin
    ```

   

## Menjalankan Proyek

1.  **Jalankan Server Pengembangan:**

    Untuk menjalankan proyek, gunakan server pengembangan yang disediakan oleh Laravel:

    ```bash
    php artisan serve
    ```

    Buka browser Anda dan kunjungi `http://localhost:8000` untuk mengakses aplikasi Anda. Untuk mengakses panel Filament, biasanya dapat diakses melalui `http://localhost:8000/admin`.

## Dokumentasi Tambahan

Untuk informasi lebih lanjut tentang penggunaan dan konfigurasi Filament serta Filament Shield, kunjungi dokumentasi resmi:

-   [Filament](https://filamentphp.com/docs)
-   [Filament Shield](https://filamentphp.com/docs/shield)

## Lisensi

Proyek ini dilisensikan di bawah lisensi [MIT](LICENSE).