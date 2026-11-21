# Laporan Pemeriksaan Program Sayang Anak

**Tanggal pemeriksaan:** 21 November 2026  
**Ruang lingkup:** aplikasi Laravel, alur halaman, JavaScript latihan, tes, serta konfigurasi Docker untuk Render.

## Ringkasan

Alur utama aplikasi berfungsi: beranda menampilkan empat aktivitas, seluruh halaman latihan dapat dibuka, dan slug yang tidak dikenal menghasilkan 404. Suara latihan kini memakai kemampuan bawaan Chrome, memilih suara Indonesia/perempuan bila tersedia, dan tidak membutuhkan API key eksternal.

Integrasi ResponsiveVoice dan baris API key yang terkait sudah dihapus dari tampilan, konfigurasi contoh, dan `.env` lokal. Konfigurasi aplikasi tetap mendukung session/cache file tanpa layanan database.

## Perubahan sejak pemeriksaan sebelumnya

- Berkas sambutan Laravel dan aset CSS/JavaScript/Vite yang tidak digunakan halaman aktif sudah dihapus.
- Perintah setup tidak lagi menjalankan migration atau build npm; perintah pengembangan memakai `php artisan serve`.
- Pengaturan npm/Vite yang tidak terpakai dihapus dari berkas proyek.
- Timer suara sekarang dibersihkan saat langkah berganti, suara otomatis dimatikan, latihan selesai, atau latihan diulang. Pemutaran suara juga dicegah setelah sesi selesai.
- `.env.example` dan Dockerfile memakai session/cache file serta antrean `sync`.
- Dockerfile menghentikan container dengan pesan yang jelas jika `APP_KEY` kosong.
- Pembacaan latihan menggunakan Web Speech API bawaan Chrome dengan bahasa `id-ID`; tidak ada permintaan ke ResponsiveVoice.
- API key ResponsiveVoice yang tidak lagi dipakai dihapus dari `.env` lokal dan `.env.example`.
- Tes fitur kini mencakup halaman latihan untuk semua aktivitas.
- Panduan proyek diperbarui agar sesuai dengan perilaku dan konfigurasi terbaru.

## Cakupan dan metode

Yang ditinjau:

- Rute dan controller aktivitas.
- Tampilan beranda, layout, dan latihan, termasuk simbol SVG dan JavaScript.
- Tes fitur, konfigurasi proyek, dan berkas Docker.
- Halaman latihan melalui browser.

Yang tidak dilakukan:

- Tidak membaca berkas `.env` lokal karena mungkin berisi rahasia.
- Tidak membangun image Docker atau menguji deployment nyata di Render.
- Tidak melakukan audit keamanan penetrasi.
- Suara browser diuji dengan simulasi pada API speech, bukan penilaian kualitas audio oleh pendengar.

## Hasil pemeriksaan

| Pemeriksaan | Hasil |
| --- | --- |
| `php artisan test` | Lulus: 7 tes, 32 assertion. |
| `vendor\bin\pint --test app routes database tests` | Lulus; tidak ada perubahan format yang diminta. |
| Empat rute latihan dan rute 404 | Lulus melalui tes fitur. |
| Konfigurasi suara Chrome | Tes memastikan halaman memakai `SpeechSynthesisUtterance`, mengatur `id-ID`, dan tidak memuat ResponsiveVoice. |
| Interaksi suara di browser | Dengan API tiruan, suara `id-ID` terpilih, keenam langkah dibacakan, latihan selesai dan diulang dari awal; tidak ada SDK suara eksternal. Audio asli tidak diputar. |
| Build Docker | Tidak dijalankan karena Docker CLI tidak tersedia; Dockerfile ditinjau secara statis. |
| Pemeriksaan referensi aset lama | Tidak ditemukan pemakaian `@vite`, halaman `welcome`, atau entri environment Vite pada halaman aktif setelah pembersihan. |

## Temuan

### 1. [Diperbaiki] Suara tertunda tidak lagi diputar setelah latihan selesai

Suara kini memakai `speechSynthesis` bawaan Chrome. Timer yang menunggu daftar suara dibersihkan saat langkah berganti, suara otomatis dimatikan, latihan selesai, atau latihan diulang. Nomor pembacaan juga mencegah callback dari suara yang dibatalkan mengubah status pembacaan yang baru.

**Verifikasi:** tes fitur memastikan halaman menggunakan API speech Chrome. Simulasi browser memeriksa pemilihan suara `id-ID`, seluruh langkah, penyelesaian, dan pengulangan; audio nyata tidak diputar selama pemeriksaan.

### 2. [Dimitigasi] `APP_KEY` wajib disediakan di Render

**Bukti:** [.env.example](./.env.example) sengaja tidak berisi nilai kunci, dan [Dockerfile](./Dockerfile) tidak menanam rahasia ke image. Perintah awal Docker sekarang menghentikan container dengan pesan yang jelas jika `APP_KEY` kosong.

Pemisahan ini menjaga rahasia agar tidak masuk ke repository atau image. Namun, kunci tidak dapat dibuat atau dipasang pada service Render dari perubahan kode ini.

**Tindakan sebelum deploy:** buat atau gunakan kunci Laravel yang valid dan tambahkan sebagai environment variable rahasia `APP_KEY` di Render. Jangan commit nilai kunci. Build dan deployment Render belum dijalankan.

### 3. [Diperbaiki] Nilai contoh session dan cache tidak lagi memakai database

**Bukti:** [.env.example](./.env.example) dan [Dockerfile](./Dockerfile) sekarang memakai `SESSION_DRIVER=file`, `CACHE_STORE=file`, dan `QUEUE_CONNECTION=sync`.

Dengan konfigurasi contoh yang baru, fitur aktivitas tidak memerlukan database untuk session, cache, atau antrean. Koneksi SQLite dan migration bawaan Laravel masih tersedia, tetapi tidak dipakai oleh aktivitas aplikasi.

### 4. [Batasan perangkat] Pilihan dan lafal suara Chrome berbeda-beda

**Bukti:** [latihan.blade.php](./resources/views/latihan.blade.php) memilih suara yang tersedia di Chrome dengan prioritas Indonesia, Melayu, Jawa, lalu Sunda, mengutamakan suara perempuan, dan mengatur `ucapan.lang` ke `id-ID`.

**Dampak:** suara yang terpasang bergantung pada Chrome dan sistem operasi. Jika tidak ada suara Indonesia, suara bawaan atau suara bahasa terdekat mungkin memiliki aksen berbeda. Ini tidak memerlukan API key atau koneksi ke layanan TTS eksternal.

### 5. [Diperbaiki sebagian] Cakupan tes halaman aktivitas ditambah

**Bukti:** [AktivitasTest.php](./tests/Feature/AktivitasTest.php) kini menguji beranda, konten latihan, pemakaian API speech Chrome, semua empat slug aktivitas, dan 404. Suite berisi tujuh tes dengan 32 assertion.

Interaksi JavaScript tidak dijalankan oleh PHPUnit. Tes memeriksa kontrak tampilan, tetapi pilihan suara dan kualitas pelafalan perlu dicoba langsung pada Chrome/perangkat yang akan digunakan.

**Batasan tersisa:** tes browser otomatis belum ditambahkan karena proyek tidak memasang framework browser test. Navigasi, Mode Mandiri, evaluasi, dan suara nyata tetap perlu diuji manual sebelum perubahan UI besar.

### 6. [Batasan diterima] Tampilan bergantung pada CDN eksternal

Bootstrap, Bootstrap Icons, dan Google Font Nunito dimuat dari CDN. Jika CDN tidak dapat diakses, halaman masih memiliki teks dan HTML, tetapi gaya, ikon, atau font dapat berbeda. Suara Chrome tidak bergantung pada CDN tersebut.

Ini bukan perubahan yang dilakukan karena mempertahankan CDN adalah persyaratan proyek saat ini. Jika penggunaan offline menjadi kebutuhan, aset perlu dipindahkan ke Vite atau disajikan secara lokal.

## Bagian yang berjalan sesuai rancangan

- [web.php](./routes/web.php) menghubungkan `/` ke beranda dan `/latihan/{slug}` ke halaman latihan.
- [AktivitasController.php](./app/Http/Controllers/AktivitasController.php) menyimpan empat aktivitas beserta enam langkah masing-masing; slug tidak dikenal menghasilkan 404.
- Aktivitas dan evaluasi tidak disimpan ke database atau `localStorage`.
- Ilustrasi SVG dipilih berdasarkan ID yang disediakan controller.
- Tampilan memberi kontrol besar, status langkah berbentuk bintang, pengaturan pendamping yang dapat dilipat, dan dukungan pengurangan animasi.
- `.dockerignore` mengecualikan berkas lokal yang tidak dibutuhkan image. Dockerfile menjalankan aplikasi pada `$PORT` Render, memberi izin tulis pada direktori Laravel, dan memeriksa `APP_KEY` sebelum server mulai.

## Prioritas tindak lanjut

1. Tambahkan `APP_KEY` sebagai rahasia di Render sebelum deployment.
2. Uji suara pada Chrome dan sistem operasi yang akan digunakan anak.
3. Jalankan build Docker dan uji container pada port yang diberikan Render.
4. Pertimbangkan tes browser otomatis jika proyek memasang framework yang sesuai.

