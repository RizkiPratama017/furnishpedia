# Gunakan base image PHP dengan FPM untuk Laravel
FROM php:8.2-fpm

# Install dependensi sistem yang dibutuhkan Laravel
RUN apk add --no-cache --update \
    bash \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    git \
    curl \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql \
    && rm -rf /var/cache/apk/*

# Set working directory di dalam container
WORKDIR /var/www/html

# Salin file composer.json dan composer.lock ke container
COPY composer.json composer.lock ./

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependensi PHP
RUN composer install --no-dev --optimize-autoloader

# Salin file package.json dan package-lock.json untuk NPM
COPY package.json package-lock.json ./

# Install dependensi frontend
RUN npm install

# Salin seluruh proyek Laravel ke container
COPY . .

# Build aset frontend menggunakan npm
RUN npm run build

# Set permissions agar Laravel dapat menulis ke storage dan cache
RUN chmod -R 775 storage bootstrap/cache

# Jalankan perintah Laravel sebelum memulai server
RUN php artisan migrate --force && \
    php artisan db:seed --force

# Expose port 8080
EXPOSE 8080

# Jalankan server Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
