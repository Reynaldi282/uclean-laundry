<img src="https://banners.beyondco.de/Laundry%20App.png?theme=light&packageManager=&packageName=&pattern=architect&style=style_1&description=Aplikasi+Management+Laundry&md=1&showWatermark=1&fontSize=100px&images=truck" />
<p>Halo, ini adalah aplikasi Laundry yang dibangun dengan cinta (love). Aplikasi ini sudah bisa multi toko loh, alias kamu bisa membuat cabang laundry.<br>

## Requirements

* PHP 8.0 (Framework Laravel 9)
* Database (eg: MySQL)
* Web Server (eg: Apache, Nginx, IIS)

## Framework

Laundry dibangun menggunakan [Laravel](http://laravel.com), the best existing PHP framework, as the foundation framework.

## Installation

* Install [Composer](https://getcomposer.org/download) and [Npm](https://nodejs.org/en/download)
* Install dependencies: `composer install ; npm install ; npm run dev`
* Run `cp .env.example .env` for create .env file
* Run `php artisan migrate --seed` for migration database
* Run `php artisan storage:link` for create folder storage
* Run `php artisan create:admin` for create user Administrator
* Run `php artisan queue:listen` for run queue

Note : Aplikasi ini akan terus saya update.<br>
Kalau ada pertanyaan bisa kontak aku di email ini <b>reynaldi@omahku-id.com</b>
</p>


## Fitur Release
   #### Administrator
   * Dashboard Administrator
   * Tambah User Karyawan
   * Lihat data transaksi
   * Data Finance
   * Data Harga
   * Atur target laundry
   * Ubah thema (untuk saat ini hanya ada Dark & White)
   * Data Bank
   * Setting Notifikasi Email, Telegram dan WhatsAapp
   * Dokumentasi

   #### Karyawan
   * Dashboard Karyawan
   * Data order masuk
   * Data customer
   * Tambah customer
   * Tambah transaksi Laundry
   * Laporan
   * Ubah thema (untuk saat ini hanya ada Dark & White)

   #### Customer
   * Dashboard Customer
   * Ubah thema (untuk saat ini hanya ada Dark & White)
   * Notification List

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).