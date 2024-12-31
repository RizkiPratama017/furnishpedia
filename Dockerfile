# Gunakan image PHP dengan Nginx sebagai base image
FROM php:8.2-fpm-alpine

# Install dependensi tambahan
RUN apk add --no-cache --update \
    bash \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql \
    && rm -rf /var/cache/apk/*

# Set working directory di dalam container
WORKDIR /var/www/html

# Copy composer.json dan install dependencies
COPY composer.json /var/www/html/
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Copy seluruh kode aplikasi ke dalam container
COPY . /var/www/html

# Set file permission agar Laravel bisa menulis ke storage dan cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 untuk aplikasi
EXPOSE 80

# Command untuk menjalankan aplikasi Laravel
CMD ["php-fpm"]
