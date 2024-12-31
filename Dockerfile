# Gunakan image PHP dengan FPM untuk menjalankan aplikasi Laravel
FROM php:8.2-fpm-alpine

# Install dependensi yang dibutuhkan oleh Laravel
RUN apk add --no-cache --update \
    bash \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    git \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql \
    && rm -rf /var/cache/apk/*

# Set working directory di dalam container
WORKDIR /var/www/html

# Salin file composer.json dan install dependensi PHP
COPY composer.json /var/www/html/
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Salin file package.json dan install dependensi NPM
COPY package.json /var/www/html/
COPY package-lock.json /var/www/html/
RUN npm install

# Salin seluruh kode aplikasi Laravel ke dalam container
COPY . /var/www/html

# Build assets frontend menggunakan NPM (menggunakan Tailwind, Flowbite, dan Chart.js)
RUN npm run prod

# Set permissions agar Laravel dapat menulis ke storage dan cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 untuk aplikasi
EXPOSE 80

# Jalankan PHP-FPM
CMD ["php-fpm"]
