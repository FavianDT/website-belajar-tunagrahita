# Blok ini memakai PHP CLI resmi sebagai dasar untuk menjalankan Laravel.
FROM php:8.5-cli

# Blok ini memasang alat sistem dan pustaka yang dibutuhkan untuk mengunduh paket serta membuat ekstensi PHP.
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        curl \
        git \
        libcurl4-openssl-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        unzip \
        zip \
    && docker-php-ext-install curl mbstring xml zip \
    && rm -rf /var/lib/apt/lists/*

# Blok ini mengambil Composer dari image resminya agar tidak perlu memasangnya secara manual.
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Blok ini memilih folder kerja aplikasi di dalam container.
WORKDIR /var/www/html

# Blok ini menyalin seluruh berkas proyek ke dalam container.
COPY . .

# Blok ini memasang paket produksi Laravel tanpa paket khusus pengembangan.
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Blok ini menyiapkan folder runtime lalu memberi izin tulis kepada pengguna web.
RUN mkdir -p \
        storage/framework/cache/data \
        storage/framework/cache/locks \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwX storage bootstrap/cache

# Blok ini menjalankan aplikasi sebagai pengguna biasa agar container tidak perlu berjalan sebagai root.
USER www-data

# Blok ini mengatur penyimpanan file dan antrean langsung agar aplikasi tidak perlu database.
ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    SESSION_DRIVER=file \
    CACHE_STORE=file \
    QUEUE_CONNECTION=sync

# Blok ini memastikan kunci rahasia tersedia sebelum menjalankan Laravel pada port dari Render.
CMD ["sh", "-c", "if [ -z \"$APP_KEY\" ]; then echo 'APP_KEY wajib diatur sebagai environment variable rahasia.' >&2; exit 1; fi; php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"]
