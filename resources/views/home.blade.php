@extends('layout')

<!-- Bagian ini mengisi judul tab peramban untuk halaman beranda. -->
@section('title', 'Beranda - Sayang Anak')

@section('content')
    <!-- Bagian ini menyapa anak dengan kalimat singkat dan menjelaskan pilihan yang tersedia. -->
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="p-4 p-md-5 bg-white rounded-4 shadow-sm">
                    <p class="text-success fw-bold mb-2">
                        <i class="bi bi-stars me-2" aria-hidden="true"></i>Halo, teman hebat!
                    </p>
                    <h1 class="display-5 mb-3">Mau belajar kegiatan apa hari ini?</h1>
                    <p class="lead text-secondary mb-0">
                        Pilih satu kegiatan. Kita belajar satu langkah setiap kali.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian ini menampilkan kartu besar dari controller dengan satu tombol mulai yang mudah ditekan. -->
    <section class="container pb-4" aria-labelledby="judulAktivitas">
        <div class="mb-4">
            <h2 id="judulAktivitas" class="h2 mb-1">Pilih aktivitas</h2>
            <p class="text-secondary mb-0">Tekan tombol hijau untuk mulai belajar.</p>
        </div>

        <div class="row g-4">
            @foreach ($daftarAktivitas as $aktivitas)
                <div class="col-12 col-md-6 col-xl-3">
                    <article
                        class="card kartu-aktivitas h-100 shadow-sm"
                        style="background-color: {{ $aktivitas['warna_kartu'] }}; border-color: {{ $aktivitas['warna_kartu'] }};"
                    >
                        <div class="card-body d-flex flex-column p-4">
                            <span
                                class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-3"
                                style="width: 76px; height: 76px;"
                            >
                                <i class="{{ $aktivitas['ikon_bootstrap'] }} fs-1 text-success" aria-hidden="true"></i>
                            </span>
                            <h3 class="h4">{{ $aktivitas['judul'] }}</h3>
                            <p class="mb-4">{{ $aktivitas['deskripsi_singkat'] }}</p>
                            <a
                                class="btn tombol-besar tombol-hijau w-100 mt-auto"
                                href="{{ route('latihan', ['slug' => $aktivitas['slug']]) }}"
                            >
                                <i class="bi bi-play-fill" aria-hidden="true"></i>
                                Mulai Belajar
                            </a>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Bagian ini menjelaskan bahwa aplikasi adalah pendamping belajar bersama orang dewasa. -->
    <aside class="container py-4">
        <div class="alert alert-info border-0 rounded-4 mb-0" role="note">
            <i class="bi bi-people-fill me-2" aria-hidden="true"></i>
            Aplikasi ini adalah media pendamping guru dan orang tua saat anak belajar.
        </div>
    </aside>
@endsection
