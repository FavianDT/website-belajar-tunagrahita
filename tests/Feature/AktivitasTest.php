<?php

namespace Tests\Feature;

use Tests\TestCase;

class AktivitasTest extends TestCase
{
    // Tes ini memastikan beranda menampilkan keempat pilihan aktivitas dari controller.
    public function test_beranda_menampilkan_semua_aktivitas(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Mencuci Tangan')
            ->assertSee('Menyikat Gigi')
            ->assertSee('Memakai Sepatu')
            ->assertSee('Merapikan Mainan')
            ->assertSee('Mulai Belajar')
            ->assertSee('media pendamping guru dan orang tua');
    }

    // Tes ini memastikan alamat latihan menampilkan judul dan urutan langkah aktivitas yang dipilih.
    public function test_halaman_latihan_menampilkan_langkah_aktivitas(): void
    {
        $response = $this->get('/latihan/mencuci-tangan');

        $response->assertOk()
            ->assertSee('Mencuci Tangan')
            ->assertSee('Buka keran')
            ->assertSee('Keringkan tangan')
            ->assertSee('Suara Otomatis')
            ->assertSee('Mode Mandiri')
            ->assertSee('Lihat Petunjuk')
            ->assertSee('Dengarkan Suara')
            ->assertSee('Hebat! Kamu Berhasil!')
            ->assertSee('Dengan Bantuan Langsung');
    }

    // Tes ini memastikan instruksi memakai suara bawaan Chrome, bukan API layanan luar.
    public function test_halaman_latihan_menggunakan_suara_bawaan_chrome(): void
    {
        $response = $this->get('/latihan/mencuci-tangan');

        $response->assertOk()
            ->assertSee('SpeechSynthesisUtterance', false)
            ->assertSee("ucapan.lang = 'id-ID'", false)
            ->assertSee('window.speechSynthesis.speak(ucapan)', false)
            ->assertSee("const urutanBahasa = ['id', 'ms', 'jv', 'su']", false)
            ->assertDontSee('responsivevoice', false);
    }

    // Tes ini memastikan tiga aktivitas lainnya juga bisa dibuka dari alamat latihannya.
    public function test_halaman_latihan_aktivitas_lainnya_dapat_dibuka(): void
    {
        $daftarAktivitasLainnya = [
            'menyikat-gigi' => 'Menyikat Gigi',
            'memakai-sepatu' => 'Memakai Sepatu',
            'merapikan-mainan' => 'Merapikan Mainan',
        ];

        foreach ($daftarAktivitasLainnya as $slug => $judulAktivitas) {
            $response = $this->get('/latihan/'.$slug);

            $response->assertOk()
                ->assertSeeText($judulAktivitas);
        }
    }

    // Tes ini memastikan slug yang tidak ada menghasilkan halaman 404, bukan halaman latihan yang salah.
    public function test_slug_aktivitas_yang_tidak_ditemukan_menghasilkan_404(): void
    {
        $response = $this->get('/latihan/aktivitas-tidak-ada');

        $response->assertNotFound();
    }
}
