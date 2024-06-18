FROM php:8.1-apache
RUN apt-get update \
    && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) bcmath gd pdo pdo_mysql mysqli \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

RUN npm install -g pnpm

WORKDIR /var/www/html

COPY . .

RUN composer install
RUN pnpm install

RUN chmod -R 775 /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/vendor

EXPOSE 8000
EXPOSE 3000

RUN composer dump-autoload && php artisan key:generate

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
