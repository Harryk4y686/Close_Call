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
# 1. Login
Terdapat kolom input email or phone untuk memasukkan email dan terdapat kolom input password untuk memasukkan password. Kemudian terdapat tombol login untuk konfirmasi menggunakan akun tersebut dan juga tombol Sign up bagi yang belum memiliki akun yang akan mengarahkan user ke halaman registrasi

# 2. Register
Terdapat kolom input first name untuk memasukkan nama depan  
Terdapat kolom input last name untuk memasukkan nama akhir  
Terdapat kolom input email or phone untuk memasukkan email  
Terdapat kolom input country untuk memasukkan negara  
Terdapat kolom input password untuk memasukkan password untuk akun tersebut serta  
Terdapat kolom input password verify untuk memasukkan konfirmasi password  
Terdapat tombol Register untuk konfirmasi setelah itu user akan diarahkan untuk memasukkan kode yang telah diberikan melalui email (Verify your Email)  
Terdapat tombol Login jika telah memiliki akun Setelah menekan tombol Verify your Email, user akan diarahkan ke halaman landing page yang telah diverifikasi mempunyai akun

*Disini tambahkan disclaimer*  
**DISCLAIMER!**  
Proses email verifikasi menggunakan MailTrap.

# 4. Landing Page / Home Page (after login)
Terdapat Job Categories, Browse Jobs, Reviews, CloseCall AI, Join us (untuk yang belum login), dan berbagai pilihan di bagian footer  
Pada bagian Browse Jobs, masing-masing pilihan dapat diklik untuk melihat informasi lebih detail, namun halaman khusus untuk melihat detail informasinya masih dalam proses pembuatan  
Kemudian terdapat fitur CloseCall AI, dengan CloseCall AI, kita mendapatkan asisten karier cerdas yang membantu membuat resume profesional dan mempersiapkan lamaran kerja lebih mudah dari sebelumnya untuk mendapatkan pekerjaan impian (fitur ini masih belum dapat digunakan untuk sementara)

*Tambahan*  
Semua button dalam landing page ini tidak akan berfungsi dan akan menavigasi ke halaman register jika Anda belum login/register.

# 5. Jobs Page
Halaman tersebut memiliki fungsi sebagai pusat pencarian pekerjaan. Dalam halaman tersebut, terdapat berbagai fitur, yaitu:
- Progress bar terkait seberapa lengkap data pengguna.  
- Job categories yang jika ditekan dapat menunjukkan seluruh kategori pekerjaan.  
- Job recommendations dimana website akan merekomendasikan pekerjaan terbaik buat pengguna. Rekomendasi tersebut memprioritaskan lokasi, dimana akan mencari tempat lowongan pekerjaan terdekat.  
- Search bar dimana pengguna dapat mencari lowongan pekerjaan sesuai dengan apa yang diinginkannya. Search bar tersebut juga dapat mencari terkait kategori, hashtags, perusahaan, dst.

# 6. Events Page
Halaman ini berguna sebagai tempat pengumpulan komunitas serta cara lain untuk mencari pekerjaan. Lewat events ini, pengguna dapat melihat berbagai acara yang dibuat oleh tempat lowongan pekerjaan tertentu, ataupun dapat mencari seminar-seminar sesuai dengan minat pengguna.  
Dalam events page ini, Anda dapat membuat events baru, yang terdiri dari input: *(INPUTNYA)*  
Anda juga dapat seleksi event tersebut, dan mengikutinya sehingga mendapatkan update terbaru. Di bagian bawah, terdapat sebuah kalender yang menunjukkan semua events.

# 7. AI Page
CloseCall AI digunakan sebagai pembantu dan panduan pengguna dalam menavigasi dunia CloseCall. AI ini dapat membantu dalam berbagai hal, seperti review CV/Portfolio (Upload file), memberikan tips untuk mencari tempat kerja terbagus, dst. Dalam halaman ini, dapat terlihat riwayat pesan-pesan yang telah dikirim, serta juga UI bagian chat dengan AI tersebut. Dalam input chat, pengguna dapat menanyakan AI terkait apapun itu, dan akan dijawabnya.

# 8. Profile
Di bagian profile, Anda dapat mengedit serta menambahkan --  
*(Bgian ini ak gtw, jdi stu org anokin); selain itu juga ngomongin terkait progress barnya*

# 9. Admin Page - User Database
Halaman User Database berfungsi sebagai pusat pengelolaan seluruh data pengguna dalam sistem. Pada halaman ini, admin dapat melihat daftar lengkap pengguna yang telah terdaftar beserta informasi penting mereka.  
Fitur–fitur yang tersedia:
• Tabel daftar pengguna yang menampilkan:  
o First Name  
o Last Name  
o Email  
o Phone Number  
o Date of Birth  
o Location  
o Postal Code  
o Resume, CV, dan Portfolio (dalam bentuk file yang dapat diunduh)  
o Date Added (tanggal pengguna ditambahkan)  
• Search bar untuk mencari pengguna berdasarkan nama, email, atau data lainnya.  
• Filter data, seperti:  
o Filter berdasarkan lokasi  
o Filter berdasarkan rentang tanggal (Start Date → End Date)  
• Aksi langsung pada setiap data pengguna, yaitu:  
o Edit → mengarahkan admin ke halaman Add & Edit Users untuk mengubah data pengguna.  
o Delete → menghapus akun pengguna dari database.  
• Tombol “Add Users” di bagian kanan atas, yang memungkinkan admin menambahkan pengguna baru secara manual.

# 10. Admin Page - Job Database
Halaman Job Database digunakan sebagai pusat pengelolaan seluruh data lowongan pekerjaan yang tersedia dalam sistem. Pada halaman ini, admin dapat memantau, menambahkan, mengubah, dan menghapus job postings secara mudah.  
Fitur–fitur yang tersedia:
• Tabel daftar pekerjaan yang menampilkan informasi penting, seperti:  
o Job Name  
o Category  
o Company  
o Location  
o Description  
o Tag 1–4 (label pendukung seperti remote, design, dll.)  
o Date Added (tanggal job ditambahkan)  
• Search bar untuk mencari lowongan berdasarkan nama pekerjaan, perusahaan, kategori, atau kata kunci lainnya.  
• Filter data, meliputi:  
o Filter berdasarkan lokasi  
o Filter berdasarkan rentang tanggal (Start Date → End Date)  
• Aksi pada setiap entri pekerjaan, yaitu:  
o Edit → mengarahkan admin ke halaman Add & Edit Jobs untuk memperbarui informasi pekerjaan.  
o Delete → menghapus lowongan pekerjaan dari database.  
• Tombol “Add Job” di bagian kanan atas untuk menambahkan job posting baru secara manual.

# 11. Admin Page - Event Database
Halaman Event Database berfungsi sebagai pusat pengelolaan seluruh data event yang dibuat dalam sistem. Pada halaman ini, admin dapat melihat daftar lengkap event beserta informasi penting mengenai acara tersebut, serta melakukan pengaturan seperti menambah, mengubah, dan menghapus acara.  
Fitur–fitur yang tersedia:
• Tabel daftar event yang menampilkan informasi berikut:  
• Event Name  
• Location  
• Attendees (jumlah peserta yang ditargetkan atau hadir)  
• About (deskripsi singkat event)  
• Starting Date  
• Date Added (tanggal event dimasukkan ke sistem)  
• Search bar  
Digunakan untuk mencari event berdasarkan nama acara, lokasi, atau kata kunci lainnya.  
• Filter data:  
• Filter berdasarkan lokasi  
• Filter berdasarkan rentang tanggal (Start Date → End Date)  
• Aksi pada setiap entri event:  
• Edit → Mengarahkan admin ke halaman Add & Edit Events untuk memperbarui data event.  
• Delete → Menghapus event dari database secara permanen.  
• Tombol “Add Event”  
Terletak di bagian kanan atas halaman, digunakan untuk menambahkan event baru secara manual.

# 12. Admin Page - Company Database
Halaman Company Database berfungsi sebagai pusat pengelolaan seluruh data perusahaan yang terdaftar dalam sistem. Pada halaman ini, admin dapat memonitor, menambahkan, mengubah, dan menghapus data perusahaan secara efisien. Data ini menjadi acuan utama dalam pengelolaan lowongan pekerjaan serta relasi perusahaan di dalam platform.  
Fitur–fitur yang tersedia:
• Tabel daftar perusahaan yang menampilkan informasi penting berikut:  
• Company Name  
• Industry (jenis industri perusahaan)  
• About (deskripsi singkat perusahaan)  
• Company Size (jumlah karyawan, misalnya 50–100)  
• CloseCall Employees (jumlah karyawan yang terdaftar atau terkait di sistem)  
• HQ (alamat kantor pusat)  
• Location Berupa negara  
• Date Added (tanggal perusahaan diinput ke sistem)  
• Search bar  
Digunakan untuk mencari perusahaan berdasarkan nama, industri, lokasi, atau kata kunci lainnya.  
• Filter data:  
• Filter berdasarkan lokasi  
• Filter berdasarkan rentang tanggal (Start Date → End Date) untuk menampilkan perusahaan berdasarkan tanggal penambahannya.  
• Aksi pada setiap entri perusahaan:  
• Edit → Mengarahkan admin ke halaman Add & Edit Companies untuk memperbarui informasi perusahaan.  
• Delete → Menghapus data perusahaan dari database secara permanen.  
• Tombol “Add Company”  
Terletak di bagian kanan atas halaman, berfungsi untuk menambahkan perusahaan baru secara manual ke dalam sistem.

# 13. Admin Page - Add & Edit Users
Halaman Add & Edit Users merupakan halaman yang digunakan admin untuk menambahkan data pengguna baru atau mengubah data pengguna yang sudah terdaftar di dalam sistem. Pada halaman ini, admin dapat mengelola seluruh informasi personal dan profesional pengguna secara detail.  
Fitur-fitur yang tersedia:  
________________________________________  
• Personal Information  
Admin dapat mengisi atau mengubah seluruh informasi dasar pengguna, meliputi:  
• First Name – Nama depan pengguna  
• Last Name – Nama belakang pengguna  
• Email – Email pengguna yang digunakan untuk login atau komunikasi  
• Mobile Number – Nomor telepon aktif pengguna  
• Date of Birth – Tanggal lahir pengguna  
• Gender – Pilihan jenis kelamin (dropdown)  
• Location – Lokasi berupa negara  
• Postal Code – Kode pos sesuai lokasi  
Di bagian atas form, terdapat dua tombol tambahan:  
• Add Profile – untuk mengunggah atau mengganti foto profil pengguna  
• Add Banner – untuk mengunggah atau mengganti banner profil pengguna  
________________________________________  
• Professional Information  
(Admin dapat menambahkan atau mengedit seluruh data ini sesuai kebutuhan.)  
________________________________________  
• Resume / CV / Portfolio Upload  
Terdapat opsi untuk mengunggah:  
• Resume  
• CV  
• Portfolio  
File ini akan tersimpan di database dan muncul di halaman User Database sebagai file yang dapat diunduh.  
________________________________________  
• Save / Update Button  
Setelah admin selesai mengisi atau mengubah data, terdapat tombol:  
• Save → Untuk menyimpan data  
• Add → Untuk mennambah data

# 14. Admin Page - Add & Edit Jobs
Halaman Add & Edit Jobs adalah tempat bagi admin untuk menambahkan lowongan pekerjaan baru atau mengubah data lowongan yang sudah ada. Pada halaman ini, admin dapat mengisi seluruh detail terkait job posting secara lengkap dan terstruktur.  
________________________________________  
Fitur–fitur yang tersedia  
• Job Information  
Admin dapat mengisi atau mengedit informasi utama mengenai lowongan pekerjaan, yaitu:  
• Name  
Nama pekerjaan/job title, misalnya UI/UX Designer, Software Engineer, dsb.  
• Category  
Kategori pekerjaan, misalnya Tech, Engineering, Design, dll.  
• Company  
Nama perusahaan yang membuka lowongan.  
• Location  
Lokasi berupa negara.  
• Description  
Deskripsi pekerjaan yang bisa berisi penjelasan mengenai peran, tanggung jawab, syarat pelamar, dan detail penting lainnya.  
• Tags  
Berupa label tambahan untuk mempermudah pencarian, seperti “remote”, “full-time”, “design”, atau tag apapun dalam format list.  
________________________________________  
• Profile & Banner Upload  
Di bagian atas halaman, terdapat dua tombol:  
• Add Profile → Mengunggah gambar profil perusahaan atau ikon job  
• Add Banner → Mengunggah banner atau gambar header untuk tampilan job  
(Keduanya opsional dan digunakan untuk mempercantik tampilan job di halaman utama.)  
________________________________________  
• Add / Update Button  
Di bagian bawah halaman, tersedia tombol aksi utama:  
• Save → Untuk menyimpan data  
• Add → Untuk mennambah data

# 15. Admin Page - Add & Edit Events
Halaman Add & Edit Events digunakan admin untuk menambahkan event baru atau mengedit event yang sudah ada pada sistem. Event-event ini nantinya akan muncul di halaman Events Page dan dapat diikuti oleh pengguna.  
________________________________________  
Fitur–fitur yang tersedia  
• Event Information  
Admin dapat mengisi atau memperbarui seluruh detail event melalui form berikut:  
• Event Name  
Nama acara yang akan ditampilkan kepada pengguna.  
• Starting Date  
Tanggal dimulainya event (format tanggal sesuai sistem).  
• Location  
Negara tempat diselenggarakannya event.  
• Event Time 
Waktu Event tersebut dimulai.  
• About  
Deskripsi singkat mengenai acara, seperti tujuan, penjelasan, atau informasi detail terkait event.  
________________________________________  
• Banner Upload  
Di bagian kanan atas terdapat tombol:  
• Add Banner  
Digunakan untuk mengunggah atau mengganti gambar banner untuk event tersebut. Banner ini dapat mempercantik tampilan event saat ditampilkan kepada pengguna.  
________________________________________  
• Add / Update Button  
Di bagian paling bawah halaman terdapat tombol aksi utama:  
• Save → Untuk menyimpan data  
• Add → Untuk mennambah data

# 16. Admin Page - Add & Edit Companies
Halaman Add & Edit Companies digunakan admin untuk menambahkan perusahaan baru atau mengubah data perusahaan yang sudah ada. Semua informasi perusahaan dapat diedit melalui form yang lengkap dan terstruktur.  
Fitur yang tersedia:  
Company Information  
Admin dapat mengisi atau memperbarui data berikut:  
• Company Name – Nama perusahaan.  
• Industry – Jenis industri perusahaan.  
• HQ – Alamat kantor pusat.  
• Location – Negara perusahaan berada.  
• Company Size – Jumlah karyawan (contoh: 10–100).  
• CloseCall Employees – Jumlah karyawan perusahaan yang terdaftar dalam sistem.  
• About – Deskripsi singkat mengenai perusahaan.  
Di bagian atas form tersedia:  
• Add Profile → Mengunggah atau mengganti foto profil perusahaan.  
• Add Banner → Mengunggah banner perusahaan untuk tampilan yang lebih menarik.  
Add / Update Button  
Terdapat tombol aksi utama di bagian bawah:  
• Save → Untuk menyimpan data  
• Add → Untuk mennambah data

# 17. Admin Page - Dashboard
Pada dashboard, seorang admin pertama melihat sambutan dari CloseCall, serta tanggal hari ini. Di bawahnya, terdapat opsi log out. Selain itu, terdapat beberapa ringkasan dari masing-masing databases, yaitu total users, total jobs, total events, dan total companies. Terdapat juga quick actions, di mana admin dapat langsung mengakses database masing-masing yang ada. Di bagian sidebar, admin dapat menjangkau semua database yang ada dalam CloseCall.

## 👥 Contributors
### Fidelyn Adeo Gratia - UI/UX Designer
### Grant Savero - BackEnd Developer
### Surya Gemilang Pratama - FrontEnd Developer

## Struktur
- public/image > Aset-aset foto
- resources/views > Blade, Tailwind, CSS, JavaScript
- routes > Routing
- README.md > Dokumentasi Aplikasi
