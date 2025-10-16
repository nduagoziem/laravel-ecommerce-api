# Dockerfile (recommended - Debian-based) for railway deployment
FROM php:8.4-fpm

# install system deps needed by extensions + git, unzip, build tools
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libxml2-dev \
    libonig-dev \
    build-essential \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) intl zip exif pdo pdo_mysql mbstring bcmath xml opcache \
    && pecl install redis || true \
    && docker-php-ext-enable redis || true \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Add composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# copy composer files and install (after extensions are available)
COPY composer.json composer.lock ./
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-scripts --no-interaction

# copy app
COPY . .

# runtime
CMD ["php-fpm"]
