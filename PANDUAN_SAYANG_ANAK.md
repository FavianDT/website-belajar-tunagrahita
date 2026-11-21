# Panduan Proyek Sayang Anak

Dokumen ini menjelaskan tujuan aplikasi, alur halaman, susunan berkas, cara kerja fitur, serta panduan mengubah konten dan menambah kemampuan baru. Penjelasan dibuat agar mudah digunakan saat belajar atau presentasi.

## 1. Gambaran umum

**Sayang Anak** adalah media pembelajaran asistif untuk membantu anak berlatih kegiatan bina diri secara bertahap. Aplikasi memecah kegiatan menjadi langkah sederhana, lalu menampilkan ilustrasi, instruksi, suara, dan tombol navigasi.

Aplikasi ini adalah **media pendamping**, bukan pengganti arahan guru, orang tua, atau pendamping. Tidak ada akun pengguna dan tidak ada catatan perkembangan yang disimpan.

Empat kegiatan yang tersedia:

1. Mencuci Tangan
2. Menyikat Gigi
3. Memakai Sepatu
4. Merapikan Mainan

Setiap kegiatan saat ini mempunyai enam langkah.

## 2. Cara kerja website

Alur sederhananya seperti ini:

```text
Pengunjung membuka /
        |
        v
routes/web.php memanggil AktivitasController.index()
        |
        v
Controller mengirim daftar aktivitas ke home.blade.php
        |
        v
Pengunjung menekan "Mulai Belajar"
        |
        v
Browser membuka /latihan/{slug}
        |
        v
AktivitasController.show() mencari aktivitas berdasarkan slug
        |
        +-- ditemukan   -> tampilkan latihan.blade.php
        |
        +-- tidak ditemukan -> tampilkan halaman 404
```

Urutan belajar, bintang, navigasi, suara, dan evaluasi dikelola di browser. Data kegiatan berasal dari array PHP di controller, bukan dari database.

## 3. Susunan berkas utama

```text
sayang-anak/
├── app/
│   └── Http/
│       └── Controllers/
│           └── AktivitasController.php
├── bootstrap/
│   └── app.php
├── config/
│   ├── cache.php
│   ├── database.php
│   └── session.php
├── database/
│   └── migrations/
├── public/
│   └── index.php
├── resources/
│   └── views/
│       ├── home.blade.php
│       ├── latihan.blade.php
│       └── layout.blade.php
├── routes/
│   └── web.php
├── tests/
│   └── Feature/
│       └── AktivitasTest.php
├── .dockerignore
├── Dockerfile
├── composer.json
├── composer.lock
└── PANDUAN_SAYANG_ANAK.md
```

### Fungsi berkas

| Berkas/folder | Fungsi |
| --- | --- |
| `routes/web.php` | Menghubungkan alamat website ke fungsi controller. |
| `app/Http/Controllers/AktivitasController.php` | Menyimpan array aktivitas dan memilih data untuk halaman. |
| `resources/views/layout.blade.php` | Kerangka bersama: font, warna, tombol, navbar, footer, dan pustaka Bootstrap. |
| `resources/views/home.blade.php` | Beranda yang menampilkan kartu aktivitas. |
| `resources/views/latihan.blade.php` | Halaman satu langkah latihan, ilustrasi SVG, suara, navigasi, dan evaluasi. |
| `tests/Feature/AktivitasTest.php` | Memeriksa beranda, halaman latihan, dan respons 404. |
| `database/migrations/` dan `app/Models/User.php` | Bagian bawaan Laravel; belum dipakai untuk alur aktivitas saat ini. |
| Bootstrap, Bootstrap Icons, dan Nunito | Dimuat langsung dari CDN di `layout.blade.php`; proyek tidak memerlukan build aset npm. |
| `Dockerfile` | Menyiapkan image aplikasi untuk dijalankan di Render. |
| `.dockerignore` | Mengeluarkan berkas lokal dan berkas yang tidak dibutuhkan dari konteks build Docker. |
| `composer.json` dan `composer.lock` | Daftar serta versi paket PHP/Laravel yang digunakan. |
| `bootstrap/app.php` dan `config/` | Pengaturan awal Laravel dan konfigurasi layanan seperti session, cache, serta database. |

## 4. Rute dan controller

Rute yang aktif:

| Alamat | Nama rute | Fungsi |
| --- | --- | --- |
| `/` | `home` | Memanggil `AktivitasController.index()` dan menampilkan beranda. |
| `/latihan/{slug}` | `latihan` | Memanggil `AktivitasController.show($slug)` dan menampilkan latihan. |

Di `AktivitasController.php`:

- `$daftarAktivitas` adalah daftar isi aplikasi dalam array PHP.
- `index()` mengirim seluruh daftar ke tampilan `home`.
- `show($slug)` mencari satu aktivitas berdasarkan `slug`.
- Jika slug tidak cocok, `abort(404)` menampilkan halaman tidak ditemukan.

Contoh alamat latihan:

```text
/latihan/mencuci-tangan
/latihan/menyikat-gigi
/latihan/memakai-sepatu
/latihan/merapikan-mainan
```

## 5. Bentuk data aktivitas

Setiap aktivitas memiliki informasi berikut:

```php
[
    'slug' => 'mencuci-tangan',
    'judul' => 'Mencuci Tangan',
    'deskripsi_singkat' => 'Belajar membersihkan tangan.',
    'ikon_bootstrap' => 'bi bi-droplet',
    'warna_kartu' => '#E8F5E9',
    'langkah' => [
        [
            'urutan' => 1,
            'judul_langkah' => 'Buka keran',
            'instruksi_suara' => 'Buka keran air perlahan.',
            'ilustrasi' => 'ilustrasi-tangan-keran',
        ],
    ],
]
```

Arti beberapa isian:

- `slug`: nama pendek yang menjadi bagian alamat latihan.
- `judul`: nama kegiatan yang terlihat di halaman.
- `ikon_bootstrap`: nama ikon di kartu beranda.
- `warna_kartu`: warna latar kartu kegiatan.
- `urutan`: nomor langkah.
- `judul_langkah`: judul besar untuk satu langkah.
- `instruksi_suara`: kalimat yang tampil dan dibacakan.
- `ilustrasi`: ID simbol SVG yang dipakai untuk langkah tersebut.

## 6. Cara kerja halaman

### Kerangka dan beranda

`layout.blade.php` dipakai oleh kedua halaman. File ini memuat Google Font Nunito, Bootstrap 5.3, Bootstrap Icons, gaya warna dan tombol, navbar, serta footer.

Warna tombol dibuat konsisten:

- Hijau: mulai dan lanjut.
- Biru: suara.
- Oranye: kembali, pengaturan pendamping, dan ulangi.

Tombol utama memiliki tinggi minimal 60 px. Tampilan juga menyediakan tanda fokus keyboard dan mengurangi animasi jika perangkat meminta pengurangan gerakan.

`home.blade.php` mengulang `$daftarAktivitas` dari controller, kemudian membuat satu kartu dan tombol **Mulai Belajar** untuk setiap kegiatan.

### Halaman latihan

`latihan.blade.php` menampilkan satu langkah dalam satu waktu. Bagian pentingnya:

1. **Pengaturan pendamping** berada di panel lipat yang tertutup saat halaman dibuka. Di dalamnya ada sakelar suara otomatis dan pilihan Panduan Penuh atau Mode Mandiri.
2. **Area belajar** menampilkan nomor langkah, bintang untuk langkah yang selesai, ilustrasi, instruksi, dan tombol **Dengarkan Suara**.
3. **Navigasi** menyediakan tombol Sebelumnya dan Selanjutnya. Tombol terakhir menyelesaikan latihan.
4. **Apresiasi dan evaluasi** muncul setelah langkah terakhir. Pilihan evaluasi hanya menghasilkan ringkasan di layar; tidak dikirim atau disimpan.

Data langkah dikirim dari Blade ke JavaScript memakai `Js::from(...)`. Variabel `langkahSekarang` hanya menyimpan posisi langkah selama halaman terbuka.

Jika anak berpindah langkah, mematikan suara otomatis, atau menyelesaikan latihan saat suara belum siap, aplikasi membersihkan timer suara agar instruksi lama tidak diputar belakangan.

### Ilustrasi SVG

Simbol-simbol SVG buatan sendiri berada di dalam bagian `<defs>` pada `latihan.blade.php`. Nilai `ilustrasi` dari controller menunjuk ke ID simbol, misalnya:

```text
ilustrasi-tangan-keran
```

Saat langkah berganti, JavaScript mengubah rujukan SVG agar gambar sesuai dengan langkah baru. Ilustrasi tidak memerlukan file gambar atau layanan placeholder dari luar.

Jika mengubah atau menambah ID ilustrasi, pastikan nama di array controller **sama persis** dengan `id` pada elemen `<symbol>` di Blade.

## 7. Suara bawaan Chrome

Suara latihan memakai Web Speech API yang tersedia di Chrome, bukan layanan TTS eksternal. Aplikasi meminta suara Bahasa Indonesia (`id-ID`), memilih suara Bahasa Indonesia/perempuan jika tersedia, lalu mencoba suara Bahasa Melayu, Jawa, atau Sunda sebelum memakai pilihan suara bawaan Chrome.

Daftar suara berasal dari Chrome dan sistem operasi, sehingga pilihan serta kualitas lafalnya berbeda di setiap perangkat. Jika Chrome tidak menyediakan suara Indonesia, teks tetap diberi bahasa `id-ID`, tetapi suara terpilih mungkin mengucapkannya dengan aksen berbeda. Jika daftar suara belum siap, aplikasi menunggu sebentar lalu mencoba suara bawaan Chrome. Tidak diperlukan API key, dan aplikasi tidak mengirim instruksi ke ResponsiveVoice.

Logika suara berada di JavaScript pada `resources/views/latihan.blade.php`, terutama fungsi `pilihSuaraTerdekat()`, `mulaiPembacaanSuara()`, `putarSuara()`, dan `hentikanPembacaanSuara()`.

## 8. Data, database, dan penyimpanan

Fitur kegiatan saat ini:

- Tidak membaca atau menulis data aktivitas ke database.
- Tidak menggunakan `localStorage`.
- Tidak menyimpan pilihan evaluasi setelah halaman ditutup atau dimuat ulang.
- Menggunakan array di controller untuk judul, deskripsi, langkah, dan ilustrasi.

Laravel tetap memiliki konfigurasi dan migrasi bawaan. `.env.example` dan Dockerfile menggunakan `SESSION_DRIVER=file`, `CACHE_STORE=file`, dan `QUEUE_CONNECTION=sync`, sehingga alur aktivitas tidak memerlukan database. Laravel tetap menyertakan koneksi SQLite dan migration bawaan, tetapi fitur kegiatan, suara, dan evaluasi tidak menggunakannya.

Penyimpanan file di container Render dapat bersifat sementara. Karena itu, sesi file dapat hilang saat container dimulai ulang. Hal tersebut tidak menghilangkan daftar aktivitas karena datanya berasal dari kode.

## 9. Menjalankan dan menguji secara lokal

Jika file `.env` belum ada dan dependensi PHP sudah tersedia, alur awal umumnya:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
```

Jika `.env` sudah ada, jangan menyalinnya lagi karena dapat menimpa pengaturan lokal. Nilai contoh sudah memakai session/cache file dan antrean langsung agar aplikasi dapat dijalankan tanpa database untuk fitur aktivitas.
Setup aplikasi tidak menjalankan migration atau build npm karena aktivitas tidak memakai database dan halaman memuat aset dari CDN.

Jalankan website dan tes:

```powershell
php artisan serve
php artisan test
```

Tes fitur yang relevan berada di `tests/Feature/AktivitasTest.php`. Tes tersebut memastikan semua aktivitas tampil, keempat halaman latihan dapat dibuka, konten latihan tersedia, dan slug yang salah menghasilkan 404. Interaksi JavaScript dan Web Speech API perlu diperiksa di browser karena suite PHPUnit tidak menjalankan JavaScript.

## 10. Deploy ke Render

Proyek menggunakan `Dockerfile` di root. Secara ringkas, Dockerfile:

- Memakai image resmi `php:8.5-cli`.
- Memasang Composer dan ekstensi PHP yang dibutuhkan.
- Menjalankan `composer install --no-dev --optimize-autoloader`.
- Mengatur izin tulis `storage` dan `bootstrap/cache`.
- Menjalankan Laravel pada `$PORT` yang diberikan Render, dengan port `10000` sebagai cadangan.
- Mematikan debug dan memakai session/cache file.
- Menghentikan container dengan pesan yang jelas jika `APP_KEY` belum diberikan.

Langkah umum di Render:

1. Buat **Web Service** dari repository proyek.
2. Pilih deployment dengan Dockerfile.
3. Tambahkan `APP_KEY` sebagai environment variable rahasia di Render sebelum service dijalankan. Dockerfile akan menolak menjalankan aplikasi jika nilainya kosong. Jangan menaruh kunci rahasia ke Git atau Dockerfile.
4. Periksa log deployment dan buka URL service setelah build berhasil.

Bootstrap, Bootstrap Icons, dan Google Font dimuat dari CDN. Suara menggunakan kemampuan Chrome yang terpasang pada perangkat.

## 11. Panduan mengubah isi atau fitur

### Mengubah judul, instruksi, atau aktivitas

1. Buka `app/Http/Controllers/AktivitasController.php`.
2. Cari aktivitas di `$daftarAktivitas`.
3. Ubah `judul`, `deskripsi_singkat`, `warna_kartu`, atau teks langkah.
4. Pastikan setiap aktivitas memiliki `slug` yang unik dan setiap nomor `urutan` tetap berurutan.

Beranda dan halaman latihan mengambil data dari daftar ini. Untuk mengubah kata-kata yang dibacakan, ubah `instruksi_suara`.

### Menambah atau mengganti ilustrasi

1. Tentukan ID ilustrasi pada nilai `ilustrasi` di controller.
2. Buat atau ubah simbol dengan ID yang sama di bagian `<defs>` dalam `resources/views/latihan.blade.php`.
3. Jangan menggunakan ID yang sama untuk dua gambar berbeda.
4. Pastikan gambar tetap jelas, sederhana, berwarna kontras, dan tidak mengandalkan teks kecil.

### Mengubah tampilan umum

- Font, palet warna, ukuran tombol, fokus keyboard, dan footer: `resources/views/layout.blade.php`.
- Sapaan, kartu aktivitas, dan catatan pendamping: `resources/views/home.blade.php`.
- Susunan langkah, panel pengaturan, bintang, evaluasi, dan interaksi suara: `resources/views/latihan.blade.php`.

### Mengubah alur halaman

- Untuk mengganti alamat atau nama rute, ubah `routes/web.php`.
- Untuk mengubah pemilihan halaman berdasarkan slug, ubah `index()` atau `show()` di `AktivitasController.php`.
- Jika mengganti nama rute `home` atau `latihan`, perbarui juga pemanggilan `route(...)` di tampilan.

### Menambah fitur baru

1. Tentukan dulu apakah fitur hanya mengubah tampilan, mengubah data kegiatan, atau memerlukan penyimpanan.
2. Untuk perubahan tampilan, pertahankan layout bersama dan gunakan tombol/label yang mudah dipahami.
3. Untuk perubahan langkah, perbarui array controller dan ilustrasi yang cocok.
4. Untuk interaksi baru, gunakan nama fungsi JavaScript yang menjelaskan tugasnya dan pertahankan komentar penjelas.
5. Tambahkan atau sesuaikan tes fitur di `tests/Feature/AktivitasTest.php`.
6. Jalankan `php artisan test` sebelum perubahan digabung atau dipresentasikan.

Jika kelak evaluasi harus tersimpan setelah halaman ditutup, array dan JavaScript saja tidak cukup. Tambahkan rancangan database, migration, model, validasi, serta aturan privasi data terlebih dahulu.

## 12. Catatan aksesibilitas untuk perubahan berikutnya

- Jangan menyampaikan status hanya melalui warna; sertakan tulisan seperti nomor langkah atau ringkasan bintang.
- Pertahankan teks yang besar, kalimat instruksi singkat, dan tombol dengan area tekan luas.
- Pastikan elemen interaktif bisa dipakai dengan keyboard dan memiliki label.
- Jangan menghapus indikator fokus atau dukungan `prefers-reduced-motion`.
- Ilustrasi harus membantu memahami langkah, bukan sekadar hiasan yang membingungkan.
- Minta guru, orang tua, atau pendamping meninjau perubahan instruksi sebelum dipakai bersama anak.
