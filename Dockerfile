# Gunakan image PHP 8.2 dengan Apache
FROM php:8.2-apache

# Install ekstensi PHP yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set working directory ke folder Laravel kamu
WORKDIR /var/www/html

# Copy semua file project ke dalam container
COPY . /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Ubah permission folder storage & cache biar bisa ditulis
RUN chmod -R 777 storage bootstrap/cache

# Buka port 80 (buat web server)
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]
