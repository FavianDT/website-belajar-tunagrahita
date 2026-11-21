<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

// Controller ini menyimpan daftar latihan dan mengatur alur menuju halaman yang tepat.
// Daftar yang sama dipakai untuk beranda dan halaman latihan, jadi semua data cukup ditulis sekali.
class AktivitasController extends Controller
{
    // Bagian ini berisi semua aktivitas dalam array biasa agar mudah dibaca dan diubah.
    // Saat halaman dibuka, controller mencari aktivitas dari daftar ini berdasarkan slug-nya.
    public array $daftarAktivitas = [
        // Data mencuci tangan ditampilkan sebagai kartu dan berisi enam langkah berurutan.
        [
            'slug' => 'mencuci-tangan',
            'judul' => 'Mencuci Tangan',
            'deskripsi_singkat' => 'Belajar membersihkan tangan sebelum dan sesudah beraktivitas.',
            'ikon_bootstrap' => 'bi bi-droplet',
            'warna_kartu' => '#E8F5E9',
            'langkah' => [
                [
                    'urutan' => 1,
                    'judul_langkah' => 'Buka keran',
                    'instruksi_suara' => 'Buka keran air perlahan.',
                    'ilustrasi' => 'ilustrasi-tangan-keran',
                ],
                [
                    'urutan' => 2,
                    'judul_langkah' => 'Basahi tangan',
                    'instruksi_suara' => 'Basahi kedua tangan dengan air.',
                    'ilustrasi' => 'ilustrasi-tangan-basah',
                ],
                [
                    'urutan' => 3,
                    'judul_langkah' => 'Ambil sabun',
                    'instruksi_suara' => 'Ambil sabun secukupnya.',
                    'ilustrasi' => 'ilustrasi-tangan-sabun',
                ],
                [
                    'urutan' => 4,
                    'judul_langkah' => 'Gosok tangan',
                    'instruksi_suara' => 'Gosok kedua tangan sampai berbusa.',
                    'ilustrasi' => 'ilustrasi-tangan-gosok',
                ],
                [
                    'urutan' => 5,
                    'judul_langkah' => 'Bilas tangan',
                    'instruksi_suara' => 'Bilas tangan sampai bersih.',
                    'ilustrasi' => 'ilustrasi-tangan-bilas',
                ],
                [
                    'urutan' => 6,
                    'judul_langkah' => 'Keringkan tangan',
                    'instruksi_suara' => 'Keringkan tangan dengan handuk.',
                    'ilustrasi' => 'ilustrasi-tangan-kering',
                ],
            ],
        ],
        // Data menyikat gigi memakai susunan yang sama agar beranda dan halaman latihan mudah menampilkannya.
        [
            'slug' => 'menyikat-gigi',
            'judul' => 'Menyikat Gigi',
            'deskripsi_singkat' => 'Belajar merawat gigi dengan sikat dan pasta gigi.',
            'ikon_bootstrap' => 'bi bi-emoji-smile',
            'warna_kartu' => '#E3F2FD',
            'langkah' => [
                [
                    'urutan' => 1,
                    'judul_langkah' => 'Siapkan sikat gigi',
                    'instruksi_suara' => 'Ambil sikat gigi yang bersih.',
                    'ilustrasi' => 'ilustrasi-gigi-siapkan',
                ],
                [
                    'urutan' => 2,
                    'judul_langkah' => 'Beri pasta gigi',
                    'instruksi_suara' => 'Beri pasta gigi sedikit saja.',
                    'ilustrasi' => 'ilustrasi-gigi-pasta',
                ],
                [
                    'urutan' => 3,
                    'judul_langkah' => 'Sikat gigi depan',
                    'instruksi_suara' => 'Sikat gigi depan perlahan.',
                    'ilustrasi' => 'ilustrasi-gigi-depan',
                ],
                [
                    'urutan' => 4,
                    'judul_langkah' => 'Sikat gigi belakang',
                    'instruksi_suara' => 'Sikat gigi belakang dengan pelan.',
                    'ilustrasi' => 'ilustrasi-gigi-belakang',
                ],
                [
                    'urutan' => 5,
                    'judul_langkah' => 'Berkumur',
                    'instruksi_suara' => 'Berkumur dengan air bersih.',
                    'ilustrasi' => 'ilustrasi-gigi-berkumur',
                ],
                [
                    'urutan' => 6,
                    'judul_langkah' => 'Bersihkan sikat',
                    'instruksi_suara' => 'Bilas sikat gigi setelah digunakan.',
                    'ilustrasi' => 'ilustrasi-gigi-bersihkan',
                ],
            ],
        ],
        // Data memakai sepatu berisi petunjuk dari menyiapkan sepatu sampai perekat tertutup.
        [
            'slug' => 'memakai-sepatu',
            'judul' => 'Memakai Sepatu',
            'deskripsi_singkat' => 'Belajar memakai sepatu dengan langkah yang teratur.',
            'ikon_bootstrap' => 'bi bi-universal-access',
            'warna_kartu' => '#FFF3E0',
            'langkah' => [
                [
                    'urutan' => 1,
                    'judul_langkah' => 'Ambil sepatu',
                    'instruksi_suara' => 'Ambil sepasang sepatu.',
                    'ilustrasi' => 'ilustrasi-sepatu-ambil',
                ],
                [
                    'urutan' => 2,
                    'judul_langkah' => 'Kenali sepatu kanan dan kiri',
                    'instruksi_suara' => 'Periksa sepatu kanan dan kiri.',
                    'ilustrasi' => 'ilustrasi-sepatu-kanan-kiri',
                ],
                [
                    'urutan' => 3,
                    'judul_langkah' => 'Buka perekat sepatu',
                    'instruksi_suara' => 'Buka perekat sepatu.',
                    'ilustrasi' => 'ilustrasi-sepatu-buka-perekat',
                ],
                [
                    'urutan' => 4,
                    'judul_langkah' => 'Masukkan kaki',
                    'instruksi_suara' => 'Masukkan kaki ke dalam sepatu.',
                    'ilustrasi' => 'ilustrasi-sepatu-masukkan-kaki',
                ],
                [
                    'urutan' => 5,
                    'judul_langkah' => 'Rapikan posisi kaki',
                    'instruksi_suara' => 'Pastikan kaki terasa nyaman.',
                    'ilustrasi' => 'ilustrasi-sepatu-rapikan',
                ],
                [
                    'urutan' => 6,
                    'judul_langkah' => 'Tutup perekat sepatu',
                    'instruksi_suara' => 'Tutup perekat sepatu sampai kuat.',
                    'ilustrasi' => 'ilustrasi-sepatu-tutup-perekat',
                ],
            ],
        ],
        // Data merapikan mainan berisi petunjuk untuk mengumpulkan dan menyimpan mainan.
        [
            'slug' => 'merapikan-mainan',
            'judul' => 'Merapikan Mainan',
            'deskripsi_singkat' => 'Belajar mengembalikan mainan ke tempatnya.',
            'ikon_bootstrap' => 'bi bi-box2-heart',
            'warna_kartu' => '#FCE4EC',
            'langkah' => [
                [
                    'urutan' => 1,
                    'judul_langkah' => 'Siapkan kotak mainan',
                    'instruksi_suara' => 'Letakkan kotak mainan di dekatmu.',
                    'ilustrasi' => 'ilustrasi-mainan-siapkan-kotak',
                ],
                [
                    'urutan' => 2,
                    'judul_langkah' => 'Ambil satu mainan',
                    'instruksi_suara' => 'Ambil satu mainan dari lantai.',
                    'ilustrasi' => 'ilustrasi-mainan-ambil',
                ],
                [
                    'urutan' => 3,
                    'judul_langkah' => 'Masukkan mainan ke kotak',
                    'instruksi_suara' => 'Masukkan mainan ke dalam kotak.',
                    'ilustrasi' => 'ilustrasi-mainan-masukkan',
                ],
                [
                    'urutan' => 4,
                    'judul_langkah' => 'Ulangi dengan mainan lain',
                    'instruksi_suara' => 'Lakukan lagi sampai semua mainan masuk.',
                    'ilustrasi' => 'ilustrasi-mainan-ulangi',
                ],
                [
                    'urutan' => 5,
                    'judul_langkah' => 'Tutup kotak mainan',
                    'instruksi_suara' => 'Tutup kotak mainan dengan rapi.',
                    'ilustrasi' => 'ilustrasi-mainan-tutup',
                ],
                [
                    'urutan' => 6,
                    'judul_langkah' => 'Simpan kotak',
                    'instruksi_suara' => 'Simpan kotak di tempatnya.',
                    'ilustrasi' => 'ilustrasi-mainan-simpan',
                ],
            ],
        ],
    ];

    // Fungsi ini menampilkan beranda dan mengirim semua aktivitas ke halaman home.
    // Halaman home lalu menampilkan satu kartu untuk setiap aktivitas di dalam daftar.
    public function index(): View
    {
        return view('home', [
            'daftarAktivitas' => $this->daftarAktivitas,
        ]);
    }

    // Fungsi ini mencari satu aktivitas berdasarkan slug yang ada di alamat halaman.
    // Jika ketemu, langkah-langkahnya dikirim ke halaman latihan; jika tidak, tampilkan 404.
    public function show(string $slug): View
    {
        foreach ($this->daftarAktivitas as $aktivitas) {
            if ($aktivitas['slug'] === $slug) {
                return view('latihan', [
                    'aktivitas' => $aktivitas,
                ]);
            }
        }

        abort(404);
    }
}
