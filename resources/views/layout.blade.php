<!doctype html>
<html lang="id">
<head>
    <!-- Bagian ini menyiapkan halaman dan memuat Bootstrap, ikon, serta Google Font Nunito. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sayang Anak')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Bagian ini mengatur warna, tulisan, tombol besar, fokus keyboard, dan animasi yang lembut. -->
    <style>
        :root {
            --warna-teks: #243247;
            --warna-latar: #f3f8fc;
            --warna-biru: #15598a;
            --warna-biru-gelap: #10466d;
            --warna-hijau: #176b45;
            --warna-hijau-gelap: #105336;
            --warna-oranye: #a44708;
            --warna-oranye-gelap: #7d3505;
            --warna-fokus: #6237a5;
        }

        body {
            background-color: var(--warna-latar);
            color: var(--warna-teks);
            font-family: 'Nunito', 'Trebuchet MS', sans-serif;
            font-size: 1.125rem;
            line-height: 1.6;
        }

        h1,
        h2,
        h3,
        .navbar-brand {
            font-weight: 800;
        }

        .card {
            border-radius: 1.5rem;
        }

        .text-secondary {
            color: #4b5563 !important;
        }

        .navbar-brand.text-success {
            color: var(--warna-hijau) !important;
        }

        .tombol-besar {
            display: inline-flex;
            min-height: 60px;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            border-width: 2px;
            border-radius: 1rem;
            padding: 0.8rem 1.35rem;
            font-size: 1.125rem;
            font-weight: 800;
        }

        .tombol-hijau {
            background-color: var(--warna-hijau);
            border-color: var(--warna-hijau);
            color: #ffffff;
        }

        .tombol-hijau:hover {
            background-color: var(--warna-hijau-gelap);
            border-color: var(--warna-hijau-gelap);
            color: #ffffff;
        }

        .tombol-biru {
            background-color: var(--warna-biru);
            border-color: var(--warna-biru);
            color: #ffffff;
        }

        .tombol-biru:hover {
            background-color: var(--warna-biru-gelap);
            border-color: var(--warna-biru-gelap);
            color: #ffffff;
        }

        .tombol-oranye {
            background-color: var(--warna-oranye);
            border-color: var(--warna-oranye);
            color: #ffffff;
        }

        .tombol-oranye:hover {
            background-color: var(--warna-oranye-gelap);
            border-color: var(--warna-oranye-gelap);
            color: #ffffff;
        }

        .tombol-besar:focus-visible,
        a:focus-visible,
        input:focus-visible,
        select:focus-visible {
            outline: 4px solid var(--warna-fokus);
            outline-offset: 3px;
            box-shadow: none;
        }

        .kartu-aktivitas {
            border: 3px solid transparent;
            transition: transform 160ms ease, box-shadow 160ms ease;
        }

        .kartu-aktivitas:hover {
            transform: translateY(-4px);
            box-shadow: 0 1rem 2rem rgba(36, 50, 71, 0.12) !important;
        }

        .bintang-langkah {
            color: #667085;
            font-size: 2rem;
        }

        .bintang-langkah.selesai {
            color: #a65b00;
        }

        .ilustrasi-langkah {
            display: block;
            width: min(100%, 620px);
            height: auto;
            margin: 0 auto 1.5rem;
        }

        .tombol-suara.suara-berjalan {
            animation: denyut-suara 1.2s ease-in-out infinite;
        }

        @keyframes denyut-suara {
            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(21, 89, 138, 0.25);
                transform: scale(1);
            }

            50% {
                box-shadow: 0 0 0 12px rgba(21, 89, 138, 0);
                transform: scale(1.03);
            }
        }

        @media (max-width: 575.98px) {
            .navigasi-langkah {
                display: grid !important;
                grid-template-columns: 1fr;
            }

            .navigasi-langkah .tombol-besar {
                width: 100%;
            }

            .navbar .tombol-besar {
                min-height: 48px;
                padding: 0.45rem 0.7rem;
                font-size: 0.95rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <!-- ==================== HEADER ==================== -->
    <!-- Bagian ini menampilkan nama aplikasi dan tombol jelas untuk kembali ke beranda. -->
    <header>
        <nav class="navbar navbar-expand bg-white border-bottom">
            <div class="container py-2">
                <a class="navbar-brand text-success fs-3" href="{{ route('home') }}">
                    <i class="bi bi-heart-fill me-2" aria-hidden="true"></i>Sayang Anak
                </a>
                <a class="btn tombol-besar tombol-oranye" href="{{ route('home') }}">
                    <i class="bi bi-house-door" aria-hidden="true"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </nav>
    </header>

    <!-- ==================== KONTEN UTAMA ==================== -->
    <!-- Bagian ini menampilkan isi halaman yang dimasukkan oleh beranda atau halaman latihan. -->
    <main>
        @yield('content')
    </main>

    <!-- ==================== FOOTER ==================== -->
    <!-- Bagian ini menutup halaman dengan keterangan singkat tentang aplikasi. -->
    <footer class="container py-4 text-center text-secondary">
        <p class="mb-0">Belajar bina diri sedikit demi sedikit, dengan gembira.</p>
    </footer>

    <!-- Bagian ini mengaktifkan tombol lipat Bootstrap dan memuat script khusus halaman. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
