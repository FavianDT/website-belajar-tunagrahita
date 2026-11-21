# Sayang Anak

Sayang Anak adalah media pembelajaran asistif untuk membantu anak berlatih kegiatan bina diri melalui langkah sederhana, ilustrasi, dan suara bawaan Chrome.

## Menjalankan aplikasi

Pastikan dependensi PHP sudah tersedia, lalu siapkan konfigurasi lokal:

```powershell
Copy-Item .env.example .env
php artisan key:generate
php artisan serve
```

Jika berkas `.env` sudah tersedia, jangan menyalinnya lagi. Aplikasi tidak memerlukan database atau build aset npm untuk alur aktivitas.

## Dokumentasi

Baca [Panduan Proyek Sayang Anak](PANDUAN_SAYANG_ANAK.md) untuk memahami struktur, fitur, cara mengubah konten, pengujian, dan deployment.
