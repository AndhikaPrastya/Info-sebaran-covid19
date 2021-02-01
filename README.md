## Sistem Informasi Monitoring Sebaran COVID-19

### PANDUAN SINGKAT INSTALASI PROGRAM

*Web browser sudah terinstal
*XAMPP dengan PHP v5.5 atau yang terbaru

1. Mengaktifkan Xampp
2. Import Database MySql
   a. Buka Browser, masuk ke localhost/phpmyadmin
   b. Kemudian klik Database
   c. Pada Create Database (info-covid19)
   d. Kemudian klik Create
   e. klik Import
   f. klik tombol Choose File atau Browser
   g. Pilih file database Anda berupa .sql (database/info-covid19.sql)
   h. Kemudian klik Open dan selesai.
3. Pindahkan PHP ke htdocs dan atur koneksi ke database
4. Menjalankan Program 
   a. Buka browser
   b. Ketikkan localhost/info-covid19
   c. Program sudah bisa dijalankan
5. Menu Program
   a. Client Page
	-Halaman ini menampilkan hasil monitoring data covid-19 berupa grafik dan juga angka
   b. Admin Page
	-Halaman ini menampilkan hasil monitoring dan juga halaman pengolahan data dan rekap data
