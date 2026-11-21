@extends('layout')

<!-- Bagian ini mengisi judul tab peramban dengan nama aktivitas yang sedang dipelajari. -->
@section('title', $aktivitas['judul'] . ' - Sayang Anak')

@section('content')
    <!-- Bagian ini memberi tahu anak kegiatan apa yang sedang dipelajari dengan kalimat sederhana. -->
    <section class="container pt-4 pb-2">
        <p class="text-success fw-bold mb-1">
            <i class="{{ $aktivitas['ikon_bootstrap'] }} me-2" aria-hidden="true"></i>
            Latihan Bina Diri
        </p>
        <h1 class="display-6 mb-2">{{ $aktivitas['judul'] }}</h1>
        <p class="text-secondary mb-0">{{ $aktivitas['deskripsi_singkat'] }}</p>
    </section>

    <!-- ==================== BAGIAN 1: PENGATURAN PENDAMPING ==================== -->
    <!-- Bagian ini menyimpan pengaturan di balik tombol lipat agar layar anak tetap sederhana. -->
    <section id="panelPengaturan" class="container py-3" aria-label="Pengaturan pendamping">
        <button
            class="btn tombol-besar tombol-oranye"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#isiPengaturan"
            aria-expanded="false"
            aria-controls="isiPengaturan"
        >
            <i class="bi bi-sliders" aria-hidden="true"></i>
            Pengaturan Pendamping
            <i class="bi bi-chevron-down" aria-hidden="true"></i>
        </button>

        <div id="isiPengaturan" class="collapse mt-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h4 mb-4">Atur cara belajar</h2>
                    <div class="row g-4 align-items-end">
                        <div class="col-12 col-md-6">
                            <div class="form-check form-switch">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    role="switch"
                                    id="suaraOtomatis"
                                    checked
                                >
                                <label class="form-check-label fw-bold" for="suaraOtomatis">
                                    Suara Otomatis (<span id="statusSuara">Aktif</span>)
                                </label>
                            </div>
                            <p class="small text-secondary mt-2 mb-0">
                                Suara membacakan langkah saat kita berpindah.
                            </p>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold" for="tingkatBantuan">
                                Tingkat Bantuan
                            </label>
                            <select class="form-select form-select-lg" id="tingkatBantuan">
                                <option value="penuh">Panduan Penuh</option>
                                <option value="mandiri">Mode Mandiri</option>
                            </select>
                            <p class="small text-secondary mt-2 mb-0">
                                Mode Mandiri menyembunyikan teks sampai tombol petunjuk ditekan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== BAGIAN 2: AREA BELAJAR UTAMA ==================== -->
    <!-- Bagian ini menampilkan gambar SVG buatan sendiri, satu petunjuk, dan kemajuan berbentuk bintang. -->
    <section id="areaBelajar" class="container py-3" aria-labelledby="judulAreaBelajar">
        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="card-body p-4 p-md-5 text-center">
                <h2 id="judulAreaBelajar" class="visually-hidden">Langkah latihan</h2>

                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 mb-3">
                    <p id="nomorLangkah" class="h5 fw-bold mb-0" aria-live="polite">
                        Langkah 1 dari {{ count($aktivitas['langkah']) }}
                    </p>
                    <div class="d-flex align-items-center gap-2" role="group" aria-label="Bintang untuk langkah selesai">
                        <div id="bintangLangkah" class="d-flex gap-1">
                            @foreach ($aktivitas['langkah'] as $langkah)
                                <i
                                    class="bi bi-star bintang-langkah"
                                    data-nomor-langkah="{{ $langkah['urutan'] }}"
                                    aria-hidden="true"
                                ></i>
                            @endforeach
                        </div>
                        <span id="statusBintang" class="small fw-bold" aria-live="polite">
                            Belum ada langkah selesai.
                        </span>
                    </div>
                </div>

                <!-- Gambar SVG di dalam daftar simbol ini dipilih sesuai langkah oleh controller. -->
                <svg
                    class="ilustrasi-langkah"
                    viewBox="0 0 640 420"
                    role="img"
                    aria-labelledby="judulIlustrasi"
                >
                    <title id="judulIlustrasi">{{ $aktivitas['langkah'][0]['judul_langkah'] }}</title>
                    <defs>
                        <!-- Ilustrasi mencuci tangan menunjukkan air, sabun, tangan, dan handuk. -->
                        <symbol id="ilustrasi-tangan-keran" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#e6f5ff"/>
                            <circle cx="535" cy="82" r="36" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#7ab6d9" stroke-width="12" stroke-linecap="round"/>
                            <path d="M240 245H455L430 340H265Z" fill="#8bd3f4" stroke="#256b91" stroke-width="10" stroke-linejoin="round"/>
                            <path d="M292 214V105H360Q390 105 390 135V160H352" fill="none" stroke="#53677e" stroke-width="24" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M352 160H400" stroke="#53677e" stroke-width="20" stroke-linecap="round"/>
                            <path d="M365 184C350 207 350 217 365 225C380 217 380 207 365 184Z" fill="#229ed1"/>
                            <path d="M400 190C388 208 388 217 400 224C412 217 412 208 400 190Z" fill="#229ed1"/>
                        </symbol>
                        <symbol id="ilustrasi-tangan-basah" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#e6f5ff"/>
                            <circle cx="535" cy="82" r="36" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#7ab6d9" stroke-width="12" stroke-linecap="round"/>
                            <path d="M265 105C240 145 240 165 265 178C290 165 290 145 265 105Z" fill="#229ed1"/>
                            <path d="M365 115C340 155 340 175 365 188C390 175 390 155 365 115Z" fill="#229ed1"/>
                            <path d="M195 270L205 225Q210 207 226 216L238 247L250 195Q255 177 271 186L279 242L294 194Q301 176 316 186L319 247L338 211Q349 194 362 207L348 286Q337 326 296 329L224 314Q193 304 195 270Z" fill="#ffc28f" stroke="#914f43" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M368 270L376 225Q381 207 397 216L409 247L421 195Q426 177 442 186L450 242L465 194Q472 176 487 186L490 247L509 211Q520 194 533 207L519 286Q508 326 467 329L395 314Q364 304 368 270Z" fill="#ffc28f" stroke="#914f43" stroke-width="9" stroke-linejoin="round"/>
                        </symbol>
                        <symbol id="ilustrasi-tangan-sabun" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#fff3df"/>
                            <circle cx="535" cy="82" r="36" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#d7a35a" stroke-width="12" stroke-linecap="round"/>
                            <rect x="150" y="205" width="130" height="125" rx="24" fill="#ffca55" stroke="#9e6400" stroke-width="9"/>
                            <path d="M180 205V175H243V205M212 175V145H274" fill="none" stroke="#53677e" stroke-width="14" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M370 275L380 225Q385 208 401 217L412 250L426 204Q431 187 447 196L453 252L470 208Q477 191 491 201L491 258L512 226Q524 211 535 225L519 293Q507 328 470 328H408Q373 318 370 275Z" fill="#ffc28f" stroke="#914f43" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M215 260H215" stroke="#ffffff" stroke-width="20" stroke-linecap="round"/>
                            <circle cx="333" cy="130" r="14" fill="#ffffff"/>
                            <circle cx="372" cy="153" r="9" fill="#ffffff"/>
                        </symbol>
                        <symbol id="ilustrasi-tangan-gosok" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#fff0eb"/>
                            <circle cx="535" cy="82" r="36" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#e5a89a" stroke-width="12" stroke-linecap="round"/>
                            <path d="M195 278L205 228Q210 210 226 219L238 250L250 198Q255 180 271 189L279 245L294 197Q301 179 316 189L319 250L338 214Q349 197 362 210L348 289Q337 329 296 332L224 317Q193 307 195 278Z" fill="#ffc28f" stroke="#914f43" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M368 278L376 228Q381 210 397 219L409 250L421 198Q426 180 442 189L450 245L465 197Q472 179 487 189L490 250L509 214Q520 197 533 210L519 289Q508 329 467 332L395 317Q364 307 368 278Z" fill="#ffc28f" stroke="#914f43" stroke-width="9" stroke-linejoin="round"/>
                            <circle cx="250" cy="145" r="17" fill="#ffffff"/>
                            <circle cx="325" cy="125" r="13" fill="#ffffff"/>
                            <circle cx="390" cy="150" r="20" fill="#ffffff"/>
                            <path d="M293 90L305 108M353 82L350 105" stroke="#229ed1" stroke-width="10" stroke-linecap="round"/>
                        </symbol>
                        <symbol id="ilustrasi-tangan-bilas" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#e6f5ff"/>
                            <circle cx="535" cy="82" r="36" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#7ab6d9" stroke-width="12" stroke-linecap="round"/>
                            <path d="M280 210V105H348Q378 105 378 135V160H340" fill="none" stroke="#53677e" stroke-width="22" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M340 160H392" stroke="#53677e" stroke-width="18" stroke-linecap="round"/>
                            <path d="M365 185L355 225M390 185L380 232M415 185L405 225" stroke="#229ed1" stroke-width="10" stroke-linecap="round"/>
                            <path d="M208 280L218 230Q223 212 239 221L251 252L263 200Q268 182 284 191L292 247L307 199Q314 181 329 191L332 252L351 216Q362 199 375 212L361 291Q350 331 309 334L237 319Q206 309 208 280Z" fill="#ffc28f" stroke="#914f43" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M414 285C401 305 401 314 414 322C427 314 427 305 414 285Z" fill="#229ed1"/>
                        </symbol>
                        <symbol id="ilustrasi-tangan-kering" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#f3edff"/>
                            <circle cx="535" cy="82" r="36" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#b09bdb" stroke-width="12" stroke-linecap="round"/>
                            <path d="M170 125L230 100L285 252L225 278Z" fill="#8ed8ca" stroke="#397b75" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M250 150L310 125L365 275L305 300Z" fill="#6bc8b6" stroke="#397b75" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M365 280L375 230Q380 212 396 221L408 252L420 200Q425 182 441 191L449 247L464 199Q471 181 486 191L489 252L508 216Q519 199 532 212L518 291Q507 331 466 334L394 319Q363 309 365 280Z" fill="#ffc28f" stroke="#914f43" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M205 78L215 58M280 95L295 78M350 115L370 105" stroke="#a65b00" stroke-width="9" stroke-linecap="round"/>
                        </symbol>

                        <!-- Ilustrasi menyikat gigi menunjukkan sikat, pasta, gigi, dan berkumur. -->
                        <symbol id="ilustrasi-gigi-siapkan" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#e9f4ff"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#82b6dc" stroke-width="12" stroke-linecap="round"/>
                            <rect x="150" y="220" width="120" height="110" rx="24" fill="#7bd3ca" stroke="#347d7c" stroke-width="9"/>
                            <path d="M170 220V195H250V220" fill="none" stroke="#347d7c" stroke-width="9"/>
                            <path d="M340 300L455 125" stroke="#f08c45" stroke-width="28" stroke-linecap="round"/>
                            <path d="M444 135L482 78" stroke="#52677b" stroke-width="30" stroke-linecap="round"/>
                            <path d="M455 120L467 130M468 101L480 110M478 84L490 92" stroke="#ffffff" stroke-width="8" stroke-linecap="round"/>
                            <circle cx="210" cy="270" r="18" fill="#ffffff"/>
                        </symbol>
                        <symbol id="ilustrasi-gigi-pasta" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#e9f4ff"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#82b6dc" stroke-width="12" stroke-linecap="round"/>
                            <path d="M170 260L220 130L320 165L275 295Z" fill="#ff8fa3" stroke="#a6425c" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M190 210L310 255" stroke="#ffffff" stroke-width="10"/>
                            <path d="M300 180L375 220" stroke="#52677b" stroke-width="22" stroke-linecap="round"/>
                            <path d="M370 218L410 148" stroke="#f08c45" stroke-width="26" stroke-linecap="round"/>
                            <path d="M400 160L412 166M410 143L422 150" stroke="#ffffff" stroke-width="7" stroke-linecap="round"/>
                            <circle cx="200" cy="125" r="10" fill="#ff8fa3"/>
                        </symbol>
                        <symbol id="ilustrasi-gigi-depan" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#fff4e3"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <circle cx="290" cy="215" r="135" fill="#ffd1a8"/>
                            <path d="M205 190Q290 125 375 190V250Q290 310 205 250Z" fill="#9d4254"/>
                            <path d="M230 192H350V230Q290 258 230 230Z" fill="#ffffff" stroke="#d8e2ec" stroke-width="8"/>
                            <path d="M380 280L470 160" stroke="#f08c45" stroke-width="25" stroke-linecap="round"/>
                            <path d="M458 170L490 125" stroke="#52677b" stroke-width="28" stroke-linecap="round"/>
                            <path d="M465 157L477 166M476 141L488 150" stroke="#ffffff" stroke-width="7" stroke-linecap="round"/>
                            <path d="M130 340H510" stroke="#d7aa82" stroke-width="12" stroke-linecap="round"/>
                        </symbol>
                        <symbol id="ilustrasi-gigi-belakang" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#fff0eb"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M200 320Q145 270 170 180Q200 100 300 120Q370 130 400 190L355 250L320 325Z" fill="#ffd1a8" stroke="#a66b5b" stroke-width="9"/>
                            <path d="M270 218Q320 180 365 215L350 245Q315 265 280 248Z" fill="#9d4254"/>
                            <path d="M286 215L300 240L315 210L330 240L345 215" fill="#ffffff" stroke="#d8e2ec" stroke-width="6"/>
                            <path d="M360 280L460 170" stroke="#f08c45" stroke-width="25" stroke-linecap="round"/>
                            <path d="M447 180L482 140" stroke="#52677b" stroke-width="28" stroke-linecap="round"/>
                            <path d="M455 169L467 178M467 153L479 162" stroke="#ffffff" stroke-width="7" stroke-linecap="round"/>
                            <path d="M130 340H510" stroke="#d7aa82" stroke-width="12" stroke-linecap="round"/>
                        </symbol>
                        <symbol id="ilustrasi-gigi-berkumur" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#e9f8ff"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <circle cx="285" cy="190" r="120" fill="#ffd1a8"/>
                            <path d="M235 225Q285 260 335 225" fill="none" stroke="#9d4254" stroke-width="14" stroke-linecap="round"/>
                            <path d="M425 190H500L488 330H437Z" fill="#72cee9" stroke="#397b9d" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M435 220H495" stroke="#ffffff" stroke-width="8"/>
                            <path d="M150 340H520" stroke="#82b6dc" stroke-width="12" stroke-linecap="round"/>
                            <path d="M160 180L180 190M390 160L410 150" stroke="#229ed1" stroke-width="10" stroke-linecap="round"/>
                        </symbol>
                        <symbol id="ilustrasi-gigi-bersihkan" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#e9f8ff"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#82b6dc" stroke-width="12" stroke-linecap="round"/>
                            <path d="M275 195V105H340Q370 105 370 135V155H335" fill="none" stroke="#52677b" stroke-width="22" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M335 155H390" stroke="#52677b" stroke-width="18" stroke-linecap="round"/>
                            <path d="M365 180L355 220M390 180L380 226M415 180L405 218" stroke="#229ed1" stroke-width="10" stroke-linecap="round"/>
                            <path d="M280 300L395 205" stroke="#f08c45" stroke-width="25" stroke-linecap="round"/>
                            <path d="M388 212L425 178" stroke="#52677b" stroke-width="28" stroke-linecap="round"/>
                            <path d="M395 203L407 211M409 190L421 198" stroke="#ffffff" stroke-width="7" stroke-linecap="round"/>
                        </symbol>

                        <!-- Ilustrasi memakai sepatu menunjukkan urutan mengambil, membuka, dan memakai sepatu. -->
                        <symbol id="ilustrasi-sepatu-ambil" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#fff3df"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#d7a35a" stroke-width="12" stroke-linecap="round"/>
                            <path d="M140 275Q185 275 220 225L250 250Q275 280 325 285Q350 288 350 320H145Z" fill="#4a8fe7" stroke="#285694" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M330 285Q375 285 410 235L440 258Q465 290 515 295Q540 298 540 330H335Z" fill="#ff8b67" stroke="#a94d39" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M190 278L230 258M375 288L418 267" stroke="#ffffff" stroke-width="8" stroke-linecap="round"/>
                        </symbol>
                        <symbol id="ilustrasi-sepatu-kanan-kiri" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#e9f4ff"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#82b6dc" stroke-width="12" stroke-linecap="round"/>
                            <path d="M125 275Q170 275 205 225L235 250Q260 280 310 285Q335 288 335 320H130Z" fill="#4a8fe7" stroke="#285694" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M325 285Q370 285 405 235L435 258Q460 290 510 295Q535 298 535 330H330Z" fill="#ff8b67" stroke="#a94d39" stroke-width="9" stroke-linejoin="round"/>
                            <circle cx="220" cy="185" r="35" fill="#ffffff" stroke="#285694" stroke-width="7"/>
                            <circle cx="420" cy="185" r="35" fill="#ffffff" stroke="#a94d39" stroke-width="7"/>
                            <text x="220" y="197" text-anchor="middle" font-size="14" font-weight="800" fill="#243247">KIRI</text>
                            <text x="420" y="197" text-anchor="middle" font-size="14" font-weight="800" fill="#243247">KANAN</text>
                        </symbol>
                        <symbol id="ilustrasi-sepatu-buka-perekat" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#e7f7eb"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M100 340H540" stroke="#83ba8c" stroke-width="12" stroke-linecap="round"/>
                            <path d="M170 275Q215 275 250 225L280 250Q305 280 355 285Q380 288 380 320H175Z" fill="#4a8fe7" stroke="#285694" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M285 250L380 220L400 245L300 280Z" fill="#ffcf5c" stroke="#a16b00" stroke-width="7" stroke-linejoin="round"/>
                            <path d="M385 220L445 185" stroke="#a16b00" stroke-width="8" stroke-dasharray="12 12" stroke-linecap="round"/>
                            <path d="M430 170L475 205" stroke="#f08c45" stroke-width="9" stroke-linecap="round"/>
                            <path d="M475 170L430 205" stroke="#f08c45" stroke-width="9" stroke-linecap="round"/>
                        </symbol>
                        <symbol id="ilustrasi-sepatu-masukkan-kaki" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#fff0eb"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#dba49a" stroke-width="12" stroke-linecap="round"/>
                            <path d="M170 295Q210 295 245 260L275 280Q300 305 350 310Q375 313 375 340H175Z" fill="#4a8fe7" stroke="#285694" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M235 110Q260 115 270 145L285 218L345 260Q370 278 350 295L260 285Q230 280 215 250L205 170Q205 130 235 110Z" fill="#ffc28f" stroke="#914f43" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M280 250L350 270" stroke="#ffcf5c" stroke-width="13" stroke-linecap="round"/>
                            <path d="M245 190L265 205M255 220L280 232" stroke="#ffffff" stroke-width="8" stroke-linecap="round"/>
                        </symbol>
                        <symbol id="ilustrasi-sepatu-rapikan" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#e9f8ff"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#82b6dc" stroke-width="12" stroke-linecap="round"/>
                            <path d="M150 275Q195 275 230 225L260 250Q285 280 335 285Q360 288 360 320H155Z" fill="#4a8fe7" stroke="#285694" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M190 265L215 245M225 278L250 258M260 286L285 266" stroke="#ffffff" stroke-width="8" stroke-linecap="round"/>
                            <path d="M430 125L440 150L465 160L440 170L430 195L420 170L395 160L420 150Z" fill="#ffbf3f"/>
                            <path d="M490 215L497 230L512 237L497 244L490 259L483 244L468 237L483 230Z" fill="#ffbf3f"/>
                        </symbol>
                        <symbol id="ilustrasi-sepatu-tutup-perekat" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#f3edff"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M100 340H540" stroke="#b09bdb" stroke-width="12" stroke-linecap="round"/>
                            <path d="M170 275Q215 275 250 225L280 250Q305 280 355 285Q380 288 380 320H175Z" fill="#4a8fe7" stroke="#285694" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M270 255L355 270L345 295L260 280Z" fill="#ffcf5c" stroke="#a16b00" stroke-width="7" stroke-linejoin="round"/>
                            <path d="M450 185L475 210L525 155" fill="none" stroke="#176b45" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"/>
                        </symbol>

                        <!-- Ilustrasi merapikan mainan menunjukkan mainan yang dipindah ke dalam kotak. -->
                        <symbol id="ilustrasi-mainan-siapkan-kotak" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#fff0f2"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#d99aa7" stroke-width="12" stroke-linecap="round"/>
                            <path d="M185 210H455V330H185Z" fill="#ffcf5c" stroke="#9b6500" stroke-width="10" stroke-linejoin="round"/>
                            <path d="M165 195L245 145L320 195L395 145L475 195" fill="#ffe19a" stroke="#9b6500" stroke-width="10" stroke-linejoin="round"/>
                            <rect x="245" y="242" width="55" height="55" rx="8" fill="#5a9df0"/>
                            <circle cx="365" cy="260" r="28" fill="#ff7f69"/>
                            <path d="M335 80L350 115H390L358 137L370 175L335 151L300 175L312 137L280 115H320Z" fill="#75c5aa"/>
                        </symbol>
                        <symbol id="ilustrasi-mainan-ambil" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#e9f4ff"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#82b6dc" stroke-width="12" stroke-linecap="round"/>
                            <rect x="280" y="268" width="75" height="75" rx="10" fill="#5a9df0" stroke="#285694" stroke-width="8"/>
                            <path d="M185 100Q210 120 225 160L260 200L290 230Q310 250 290 270Q270 286 250 265L210 230L175 200Q145 170 150 135Z" fill="#ffc28f" stroke="#914f43" stroke-width="9" stroke-linejoin="round"/>
                            <path d="M300 170L315 205M350 175L365 210M400 185L415 220" stroke="#ffbf3f" stroke-width="10" stroke-linecap="round"/>
                        </symbol>
                        <symbol id="ilustrasi-mainan-masukkan" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#e7f7eb"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#83ba8c" stroke-width="12" stroke-linecap="round"/>
                            <path d="M175 230H465V335H175Z" fill="#ffcf5c" stroke="#9b6500" stroke-width="10" stroke-linejoin="round"/>
                            <path d="M155 215L240 165L320 215L400 165L485 215" fill="#ffe19a" stroke="#9b6500" stroke-width="10" stroke-linejoin="round"/>
                            <rect x="270" y="105" width="70" height="70" rx="10" fill="#5a9df0" stroke="#285694" stroke-width="8"/>
                            <path d="M305 175V215" stroke="#176b45" stroke-width="12" stroke-linecap="round"/>
                            <path d="M285 195L305 218L325 195" fill="none" stroke="#176b45" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                        </symbol>
                        <symbol id="ilustrasi-mainan-ulangi" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#fff3df"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#d7a35a" stroke-width="12" stroke-linecap="round"/>
                            <path d="M165 230H475V335H165Z" fill="#ffcf5c" stroke="#9b6500" stroke-width="10" stroke-linejoin="round"/>
                            <path d="M145 215L235 165L320 215L405 165L495 215" fill="#ffe19a" stroke="#9b6500" stroke-width="10" stroke-linejoin="round"/>
                            <rect x="215" y="220" width="55" height="55" rx="8" fill="#5a9df0"/>
                            <circle cx="340" cy="250" r="27" fill="#ff7f69"/>
                            <path d="M390 250L430 250M415 232L435 250L415 268" fill="none" stroke="#176b45" stroke-width="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="430" y="110" width="45" height="45" rx="8" fill="#75c5aa"/>
                        </symbol>
                        <symbol id="ilustrasi-mainan-tutup" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#e9f8ff"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M80 340H560" stroke="#82b6dc" stroke-width="12" stroke-linecap="round"/>
                            <path d="M185 225H455V330H185Z" fill="#ffcf5c" stroke="#9b6500" stroke-width="10" stroke-linejoin="round"/>
                            <path d="M175 215L235 165L315 205L395 165L465 215L430 245L370 215L310 250L245 215L205 245Z" fill="#ffe19a" stroke="#9b6500" stroke-width="10" stroke-linejoin="round"/>
                            <path d="M485 130L515 160L485 190" fill="none" stroke="#176b45" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                        </symbol>
                        <symbol id="ilustrasi-mainan-simpan" viewBox="0 0 640 420">
                            <rect width="640" height="420" rx="36" fill="#f3edff"/>
                            <circle cx="530" cy="78" r="35" fill="#ffd166"/>
                            <path d="M100 130H540" stroke="#8c6bba" stroke-width="16" stroke-linecap="round"/>
                            <path d="M160 130V335M480 130V335" stroke="#8c6bba" stroke-width="14" stroke-linecap="round"/>
                            <path d="M205 235H435V325H205Z" fill="#ffcf5c" stroke="#9b6500" stroke-width="10" stroke-linejoin="round"/>
                            <path d="M190 225L245 185L320 215L395 185L450 225L425 248L370 225L315 250L255 225L215 248Z" fill="#ffe19a" stroke="#9b6500" stroke-width="10" stroke-linejoin="round"/>
                            <path d="M220 95L232 120M320 80V115M420 95L408 120" stroke="#176b45" stroke-width="10" stroke-linecap="round"/>
                        </symbol>
                    </defs>
                    <use id="gambarLangkah" width="640" height="420" href="#{{ $aktivitas['langkah'][0]['ilustrasi'] }}"></use>
                </svg>

                <h2 id="judulLangkah" class="display-6 mb-3" tabindex="-1">
                    {{ $aktivitas['langkah'][0]['judul_langkah'] }}
                </h2>
                <p id="teksInstruksi" class="fs-3 fw-bold mb-3" aria-live="polite">
                    {{ $aktivitas['langkah'][0]['instruksi_suara'] }}
                </p>
                <button
                    id="tombolLihatPetunjuk"
                    class="btn tombol-besar tombol-hijau mb-3 d-none"
                    type="button"
                >
                    <i class="bi bi-eye" aria-hidden="true"></i>
                    Lihat Petunjuk
                </button>
                <div>
                    <button id="tombolDengarkan" class="btn tombol-besar tombol-biru tombol-suara" type="button">
                        <i class="bi bi-volume-up-fill" aria-hidden="true"></i>
                        Dengarkan Suara
                    </button>
                </div>
                <p id="pesanSuara" class="small text-secondary mt-3 mb-0" aria-live="polite"></p>
            </div>
        </div>
    </section>

    <!-- ==================== BAGIAN 3: TOMBOL NAVIGASI ==================== -->
    <!-- Bagian ini memberi ruang tekan besar dan warna berbeda untuk mundur atau melanjutkan. -->
    <nav id="navigasiLangkah" class="container py-3 pb-5" aria-label="Navigasi langkah">
        <div class="navigasi-langkah d-flex justify-content-between gap-3">
            <button id="tombolSebelumnya" class="btn tombol-besar tombol-oranye px-4" type="button">
                <i class="bi bi-arrow-left" aria-hidden="true"></i>
                Sebelumnya
            </button>
            <button id="tombolSelanjutnya" class="btn tombol-besar tombol-hijau px-4" type="button">
                Selanjutnya
                <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </button>
        </div>
    </nav>

    <!-- ==================== BAGIAN 4: LAYAR APRESIASI DAN EVALUASI ==================== -->
    <!-- Bagian ini merayakan keberhasilan dan menampilkan catatan sesi tanpa menyimpannya. -->
    <section id="layarApresiasi" class="container pb-5 d-none" aria-labelledby="judulApresiasi">
        <div class="card border-0 shadow-sm text-center">
            <div class="card-body p-4 p-md-5">
                <i class="bi bi-star-fill display-1 text-warning" aria-hidden="true"></i>
                <h2 id="judulApresiasi" class="display-6 mt-3" tabindex="-1">Hebat! Kamu Berhasil!</h2>
                <p class="lead text-secondary">
                    Kamu sudah menyelesaikan latihan {{ $aktivitas['judul'] }}.
                </p>

                <div class="text-start mx-auto my-4" style="max-width: 680px;">
                    <fieldset>
                        <legend class="h4">Catatan untuk pendamping</legend>
                        <p class="text-secondary">
                            Pilih cara anak menyelesaikan latihan. Catatan ini hanya tampil di layar.
                        </p>
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <label class="card h-100 p-3">
                                    <span>
                                        <input class="form-check-input me-2" type="radio" name="hasilEvaluasi" value="Mandiri">
                                        Mandiri
                                    </span>
                                </label>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="card h-100 p-3">
                                    <span>
                                        <input class="form-check-input me-2" type="radio" name="hasilEvaluasi" value="Dengan Petunjuk">
                                        Dengan Petunjuk
                                    </span>
                                </label>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="card h-100 p-3">
                                    <span>
                                        <input class="form-check-input me-2" type="radio" name="hasilEvaluasi" value="Dengan Bantuan Langsung">
                                        Dengan Bantuan Langsung
                                    </span>
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <p id="ringkasanEvaluasi" class="alert alert-success mt-3 mb-0" aria-live="polite">
                        Pilih hasil latihan untuk melihat ringkasan sesi.
                    </p>
                </div>

                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                    <button id="tombolUlangi" class="btn tombol-besar tombol-oranye px-4" type="button">
                        <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                        Ulangi Latihan
                    </button>
                    <a class="btn tombol-besar tombol-hijau px-4" href="{{ route('home') }}">
                        <i class="bi bi-grid" aria-hidden="true"></i>
                        Pilih Aktivitas Lain
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- Bagian ini mengatur tampilan langkah, suara, bintang, navigasi, dan ringkasan sesi. -->
    <script>
        // Daftar langkah disiapkan controller agar gambar dan petunjuk selalu mengikuti aktivitas yang dipilih.
        const daftarLangkah = {{ Illuminate\Support\Js::from($aktivitas['langkah']) }};

        // Variabel ini mencatat pilihan pendamping dan langkah aktif selama halaman masih terbuka.
        let langkahSekarang = 0;
        let suaraOtomatisAktif = true;
        let tingkatBantuan = 'penuh';
        let permintaanSuaraMenunggu = false;
        let timerSuaraMenunggu = null;
        let nomorSuaraAktif = 0;
        let latihanSelesai = false;
        let keteranganBahasaSuara = '';

        // Fungsi ini mengganti ilustrasi, petunjuk, nomor langkah, dan bintang yang sudah didapat.
        function tampilkanLangkah() {
            const langkah = daftarLangkah[langkahSekarang];
            const nomorLangkah = langkahSekarang + 1;
            const gambarLangkah = document.getElementById('gambarLangkah');
            const teksInstruksi = document.getElementById('teksInstruksi');
            const tombolLihatPetunjuk = document.getElementById('tombolLihatPetunjuk');
            const daftarBintang = document.querySelectorAll('.bintang-langkah');
            let jumlahBintangSelesai = 0;

            document.getElementById('nomorLangkah').textContent =
                'Langkah ' + nomorLangkah + ' dari ' + daftarLangkah.length;
            document.getElementById('judulLangkah').textContent = langkah.judul_langkah;
            document.getElementById('judulIlustrasi').textContent = langkah.judul_langkah;
            gambarLangkah.setAttribute('href', '#' + langkah.ilustrasi);
            teksInstruksi.textContent = langkah.instruksi_suara;

            for (let nomorBintang = 0; nomorBintang < daftarBintang.length; nomorBintang++) {
                const langkahBintang = Number(daftarBintang[nomorBintang].dataset.nomorLangkah);
                const bintangSelesai = langkahBintang <= langkahSekarang;

                daftarBintang[nomorBintang].classList.toggle('bi-star-fill', bintangSelesai);
                daftarBintang[nomorBintang].classList.toggle('bi-star', !bintangSelesai);
                daftarBintang[nomorBintang].classList.toggle('selesai', bintangSelesai);

                if (bintangSelesai) {
                    jumlahBintangSelesai = jumlahBintangSelesai + 1;
                }
            }

            if (jumlahBintangSelesai === 0) {
                document.getElementById('statusBintang').textContent = 'Belum ada langkah selesai.';
            } else {
                document.getElementById('statusBintang').textContent =
                    jumlahBintangSelesai + ' dari ' + daftarLangkah.length + ' bintang terkumpul.';
            }

            teksInstruksi.classList.toggle('d-none', tingkatBantuan === 'mandiri');
            tombolLihatPetunjuk.classList.toggle('d-none', tingkatBantuan === 'penuh');
            document.getElementById('tombolSebelumnya').disabled = langkahSekarang === 0;

            if (langkahSekarang === daftarLangkah.length - 1) {
                document.getElementById('tombolSelanjutnya').innerHTML =
                    'Selesaikan Latihan <i class="bi bi-check-lg" aria-hidden="true"></i>';
            } else {
                document.getElementById('tombolSelanjutnya').innerHTML =
                    'Selanjutnya <i class="bi bi-arrow-right" aria-hidden="true"></i>';
            }
        }

        // Fungsi ini menyalakan animasi lembut ketika suara mulai dibacakan.
        function mulaiAnimasiSuara() {
            if (latihanSelesai) {
                return;
            }

            document.getElementById('tombolDengarkan').classList.add('suara-berjalan');
            document.getElementById('pesanSuara').textContent =
                'Chrome sedang membacakan petunjuk. ' + keteranganBahasaSuara;
        }

        // Fungsi ini mematikan animasi ketika pembacaan suara sudah selesai.
        function hentikanAnimasiSuara() {
            if (latihanSelesai) {
                return;
            }

            document.getElementById('tombolDengarkan').classList.remove('suara-berjalan');
            document.getElementById('pesanSuara').textContent = 'Suara selesai dibacakan.';
        }

        // Fungsi ini mematikan animasi dan memberi tahu pendamping jika pembacaan suara gagal.
        function tampilkanSuaraGagal(error) {
            if (latihanSelesai) {
                return;
            }

            document.getElementById('tombolDengarkan').classList.remove('suara-berjalan');
            document.getElementById('pesanSuara').textContent =
                'Suara Chrome belum dapat diputar. Pendamping dapat membacakan petunjuk.';

            if (error) {
                console.error('Suara Chrome gagal membacakan petunjuk:', error);
            }
        }

        // Fungsi ini menghapus timer agar suara lama tidak diputar setelah langkah berubah.
        function batalkanSuaraMenunggu() {
            permintaanSuaraMenunggu = false;

            if (timerSuaraMenunggu !== null) {
                window.clearTimeout(timerSuaraMenunggu);
                timerSuaraMenunggu = null;
            }
        }

        // Fungsi ini menghentikan timer dan suara Chrome saat langkah berganti atau latihan selesai.
        function hentikanPembacaanSuara() {
            batalkanSuaraMenunggu();
            nomorSuaraAktif = nomorSuaraAktif + 1;

            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();
            }

            document.getElementById('tombolDengarkan').classList.remove('suara-berjalan');
        }

        // Fungsi ini memilih suara Chrome yang paling dekat dan mengutamakan suara perempuan.
        function pilihSuaraTerdekat(daftarSuara) {
            const urutanBahasa = ['id', 'ms', 'jv', 'su'];
            const tandaNamaPerempuan =
                /female|woman|perempuan|wanita|gadis|damayanti|ayu|siti|zira|aria|jenny|samantha|id-id-x-idf|Indonesia|Indonesian|Google Bahasa Indonesia/i;
            let suaraBahasaTerdekat = null;

            for (let nomorBahasa = 0; nomorBahasa < urutanBahasa.length; nomorBahasa++) {
                for (let nomorSuara = 0; nomorSuara < daftarSuara.length; nomorSuara++) {
                    const suara = daftarSuara[nomorSuara];
                    const bahasaSuara = suara.lang.toLowerCase();

                    if (bahasaSuara.startsWith(urutanBahasa[nomorBahasa])) {
                        if (suaraBahasaTerdekat === null) {
                            suaraBahasaTerdekat = suara;
                        }

                        if (tandaNamaPerempuan.test(suara.name)) {
                            return suara;
                        }
                    }
                }
            }

            if (suaraBahasaTerdekat !== null) {
                return suaraBahasaTerdekat;
            }

            for (let nomorSuara = 0; nomorSuara < daftarSuara.length; nomorSuara++) {
                if (tandaNamaPerempuan.test(daftarSuara[nomorSuara].name)) {
                    return daftarSuara[nomorSuara];
                }
            }

            for (let nomorSuara = 0; nomorSuara < daftarSuara.length; nomorSuara++) {
                if (daftarSuara[nomorSuara].default) {
                    return daftarSuara[nomorSuara];
                }
            }

            return daftarSuara.length > 0 ? daftarSuara[0] : null;
        }

        // Fungsi ini membacakan instruksi dengan suara Chrome dan mencegah callback lama mengubah status baru.
        function mulaiPembacaanSuara(suaraTerpilih) {
            if (latihanSelesai) {
                return;
            }

            const nomorPembacaan = nomorSuaraAktif + 1;
            nomorSuaraAktif = nomorPembacaan;
            const ucapan = new SpeechSynthesisUtterance(
                daftarLangkah[langkahSekarang].instruksi_suara
            );

            ucapan.lang = 'id-ID';

            if (suaraTerpilih === null) {
                keteranganBahasaSuara = 'Memakai suara bawaan Chrome dengan bahasa Indonesia.';
            } else {
                ucapan.voice = suaraTerpilih;
                keteranganBahasaSuara = 'Memakai suara Chrome: ' + suaraTerpilih.name + '.';
            }

            ucapan.rate = 0.95;
            ucapan.pitch = 1.05;
            ucapan.onstart = function () {
                if (nomorPembacaan === nomorSuaraAktif) {
                    mulaiAnimasiSuara();
                }
            };
            ucapan.onend = function () {
                if (nomorPembacaan === nomorSuaraAktif) {
                    hentikanAnimasiSuara();
                }
            };
            ucapan.onerror = function (error) {
                if (nomorPembacaan === nomorSuaraAktif) {
                    tampilkanSuaraGagal(error);
                }
            };

            window.speechSynthesis.cancel();
            window.speechSynthesis.speak(ucapan);
        }

        // Fungsi ini memakai suara bawaan Chrome jika daftar suara belum tersedia setelah menunggu.
        function laporkanSuaraBelumTersedia() {
            timerSuaraMenunggu = null;

            if (!permintaanSuaraMenunggu || latihanSelesai) {
                return;
            }

            permintaanSuaraMenunggu = false;
            document.getElementById('pesanSuara').textContent =
                'Daftar suara Chrome belum tersedia. Mencoba suara bawaan dengan bahasa Indonesia.';
            mulaiPembacaanSuara(null);
        }

        // Fungsi ini mencoba lagi membaca saat Chrome selesai memuat daftar suaranya.
        function periksaSuaraTersedia() {
            if (!permintaanSuaraMenunggu || latihanSelesai) {
                return;
            }

            if (window.speechSynthesis.getVoices().length > 0) {
                batalkanSuaraMenunggu();
                putarSuara();
            }
        }

        // Fungsi ini membacakan instruksi memakai suara bawaan Chrome, tanpa layanan luar.
        function putarSuara() {
            if (latihanSelesai) {
                return;
            }

            if (!('speechSynthesis' in window) || !('SpeechSynthesisUtterance' in window)) {
                document.getElementById('pesanSuara').textContent =
                    'Fitur suara bawaan Chrome tidak tersedia. Pendamping dapat membacakan petunjuk.';
                return;
            }

            const daftarSuara = window.speechSynthesis.getVoices();

            if (daftarSuara.length === 0) {
                if (!permintaanSuaraMenunggu) {
                    permintaanSuaraMenunggu = true;
                    document.getElementById('pesanSuara').textContent =
                        'Chrome sedang menyiapkan daftar suara.';
                    timerSuaraMenunggu = window.setTimeout(laporkanSuaraBelumTersedia, 2000);
                }

                return;
            }

            batalkanSuaraMenunggu();
            mulaiPembacaanSuara(pilihSuaraTerdekat(daftarSuara));
        }

        // Fungsi ini maju satu langkah atau membuka layar apresiasi setelah langkah terakhir.
        function langkahBerikutnya() {
            hentikanPembacaanSuara();

            if (langkahSekarang === daftarLangkah.length - 1) {
                latihanSelesai = true;
                document.getElementById('panelPengaturan').classList.add('d-none');
                document.getElementById('areaBelajar').classList.add('d-none');
                document.getElementById('navigasiLangkah').classList.add('d-none');
                document.getElementById('layarApresiasi').classList.remove('d-none');

                document.getElementById('judulApresiasi').focus();
                return;
            }

            langkahSekarang = langkahSekarang + 1;
            tampilkanLangkah();

            if (suaraOtomatisAktif) {
                putarSuara();
            }
        }

        // Fungsi ini membawa anak kembali satu langkah untuk melihat atau mendengar petunjuk sebelumnya.
        function langkahSebelumnya() {
            if (langkahSekarang > 0) {
                hentikanPembacaanSuara();
                langkahSekarang = langkahSekarang - 1;
                tampilkanLangkah();

                if (suaraOtomatisAktif) {
                    putarSuara();
                }
            }
        }

        // Fungsi ini mengulang latihan dari awal dan menghapus pilihan evaluasi sementara.
        function ulangiLatihan() {
            hentikanPembacaanSuara();
            latihanSelesai = false;
            langkahSekarang = 0;
            document.getElementById('panelPengaturan').classList.remove('d-none');
            document.getElementById('areaBelajar').classList.remove('d-none');
            document.getElementById('navigasiLangkah').classList.remove('d-none');
            document.getElementById('layarApresiasi').classList.add('d-none');
            document.getElementById('ringkasanEvaluasi').textContent =
                'Pilih hasil latihan untuk melihat ringkasan sesi.';
            const pilihanEvaluasi = document.querySelectorAll('input[name="hasilEvaluasi"]');

            for (let nomorPilihan = 0; nomorPilihan < pilihanEvaluasi.length; nomorPilihan++) {
                pilihanEvaluasi[nomorPilihan].checked = false;
            }

            tampilkanLangkah();
            document.getElementById('judulLangkah').focus();

            if (suaraOtomatisAktif) {
                putarSuara();
            }
        }

        // Fungsi ini menampilkan ringkasan hasil di layar tanpa menyimpannya ke database.
        function tampilkanRingkasanEvaluasi(hasilEvaluasi) {
            document.getElementById('ringkasanEvaluasi').textContent =
                'Ringkasan sesi: latihan ' + @json($aktivitas['judul']) +
                ' diselesaikan ' + hasilEvaluasi + '. Catatan ini hanya tampil di layar.';
        }

        // Fungsi ini menampilkan teks petunjuk saat tombol Lihat Petunjuk ditekan.
        function tampilkanPetunjuk() {
            document.getElementById('teksInstruksi').classList.remove('d-none');
            document.getElementById('tombolLihatPetunjuk').classList.add('d-none');
        }

        // Fungsi ini mengubah status suara lalu memutar atau menghentikan pembacaan otomatis.
        function ubahSuaraOtomatis(peristiwa) {
            suaraOtomatisAktif = peristiwa.target.checked;
            document.getElementById('statusSuara').textContent = suaraOtomatisAktif ? 'Aktif' : 'Mati';

            if (suaraOtomatisAktif) {
                putarSuara();
            } else {
                hentikanPembacaanSuara();
                document.getElementById('pesanSuara').textContent = 'Suara otomatis dimatikan.';
            }
        }

        // Fungsi ini menerapkan tingkat bantuan dan memperbarui apakah teks petunjuk terlihat.
        function ubahTingkatBantuan(peristiwa) {
            tingkatBantuan = peristiwa.target.value;
            tampilkanLangkah();
        }

        // Fungsi ini menampilkan ringkasan ketika pendamping memilih hasil evaluasi sesi.
        function pilihHasilEvaluasi(peristiwa) {
            tampilkanRingkasanEvaluasi(peristiwa.target.value);
        }

        // Bagian ini menghubungkan setiap tombol dan pilihan dengan fungsi yang sesuai.
        document.getElementById('tombolSelanjutnya').addEventListener('click', langkahBerikutnya);
        document.getElementById('tombolSebelumnya').addEventListener('click', langkahSebelumnya);
        document.getElementById('tombolDengarkan').addEventListener('click', putarSuara);
        document.getElementById('tombolUlangi').addEventListener('click', ulangiLatihan);
        document.getElementById('tombolLihatPetunjuk').addEventListener('click', tampilkanPetunjuk);
        document.getElementById('suaraOtomatis').addEventListener('change', ubahSuaraOtomatis);
        document.getElementById('tingkatBantuan').addEventListener('change', ubahTingkatBantuan);

        const pilihanEvaluasi = document.querySelectorAll('input[name="hasilEvaluasi"]');

        for (let nomorPilihan = 0; nomorPilihan < pilihanEvaluasi.length; nomorPilihan++) {
            pilihanEvaluasi[nomorPilihan].addEventListener('change', pilihHasilEvaluasi);
        }

        // Bagian ini menyiapkan suara Chrome, bintang, dan petunjuk saat halaman dibuka.
        tampilkanLangkah();

        if ('speechSynthesis' in window) {
            window.speechSynthesis.onvoiceschanged = periksaSuaraTersedia;
        }

        if (suaraOtomatisAktif) {
            putarSuara();
        }
    </script>
@endpush
