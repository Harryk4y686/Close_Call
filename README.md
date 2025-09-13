<p align="center"><a href="https://laravel.com" target="_blank"><img src="public/image/logo.png" width="200" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Close Call

Close Call adalah website untuk mencari berbagai lowongan pekerjaan

Fungsi nya adalah:
- Menyediakan satu platform terpusat untuk semua informasi lowongan kerja
- Mempermudah pencari kerja menemukan pekerjaan sesuai minat, lokasi, dan kualifikasi
- Mempercepat proses pencocokan antara perusahaan dan kandidat
- Menyediakan komunikasi langsung antara pencari kerja dan perusahaan

Aplikasi yang akan dibangun merupakan platform pencarian kerja yang mempertemukan pencari kerja dan pemberi kerja secara lebih cepat, dekat, dan efektif. Bagi pencari kerja, aplikasi ini menyediakan fitur rekomendasi lowongan berbasis AI, panduan pembuatan kalender, serta informasi mengenai keterampilan yang dibutuhkan sesuai lokasi lowongan kerja yang dekat. Sementara itu, bagi pemberi kerja, aplikasi ini menawarkan proses rekrutmen yang lebih efisien untuk UMKM rendah dengan melalui fitur pencocokan berbasis AI serta menyediakan tempat untuk melakukan komunikasi lebih lanjut , sehingga aplikasi ini dapat menjadi solusi menyeluruh untuk mengatasi tantangan dalam mencegah pengganguran kerja dan startup atau UMKM yang rendah

## Fitur Utama
- Pencarian lowongan kerja sesuai lokasi
- Fitur untuk melihat berbagai event
- AI spesifik ke pencarian lowongan kerja/membantu rekomendasikan orang ke tempat loker

## Teknologi yang digunakan dalam pengembangan dan pembuatan aplikasi Close Call meliputi:
- Figma sebagai platform utama desain UI/UX.
- MySQL untuk basis data aplikasi CloseCall.
- GitHub sebagai tempat repositori kode.
- Laravel sebagai framework backend.
- Tailwind CSS sebagai framework frontend.
- Git untuk kolaborasi pengembangan.

## Penjelasan lebih lengkap tentang fitur:
### Halaman Login
Terdapat kolom input email or phone untuk memasukkan email dan terdapat kolom input password untuk memasukkan password.
Kemudian terdapat tombol login untuk konfirmasi menggunakan akun tersebut dan juga tombol Sign up bagi yang belum memiliki akun yang akan mengarahkan user ke halaman registrasi

### Halaman Register
- Terdapat kolom input first name untuk memasukkan nama depan
- Terdapat kolom input last name untuk memasukkan namma akhir
- Terdapat kolom input email or phone untuk memasukkan email
- Terdapat kolom input country untuk memasukkan negara
- Terdapat kolom input password untuk memasukkan password untuk akun tersebut serta
- Terdapat kolom input password verify untuk memasukkan konfirmasi password
- Terdapat tombol Register untuk konfirmasi setelah itu user akan diarahkan untuk memasukkan kode yang telah diberikan melalui email (Verify your Email)
- Terdapat tombol Login jika telah memiliki akun
Setelah menekan tombol Verify your Email, user akan diarahkan ke halaman landing page yang telah diverifikasi mempunyai akun

### Landing Page
- Terdapat Job Categories, Browse Jobs, Reviews, CloseCall AI, Join us (untuk yang belum login), dan berbagai pilihan di bagian footer
- Pada bagian Browse Jobs, masing-masing pilihan dapat diklik untuk melihat informasi lebih detail, namun halaman khusus untuk melihat detail informasinya masih dalam proses pembuatan
- Kemudian terdapat fitur CloseCall AI, dengan CloseCall AI, kita mendapatkan asisten karier cerdas yang membantu membuat resume profesional dan mempersiapkan lamaran kerja lebih mudah dari sebelumnya untuk mendapatkan pekerjaan impian (fitur ini masih belum dapat digunakan untuk sementara)
### IMPORTANT!
Sementara waktu, landing page yang digunakan adalah landing page yang belum login oleh user

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
