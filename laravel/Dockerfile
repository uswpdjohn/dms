FROM php:8.3

RUN apt-get update -y && \
    apt-get install -y openssl zip unzip git libzip-dev libxml2-dev libpng-dev default-mysql-client && \
    docker-php-ext-install zip xml gd mysqli pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN docker-php-ext-install pdo mbstring

WORKDIR /app

COPY . /app

RUN composer install

COPY .env.example .env

RUN php artisan key:generate

# RUN php artisan migrate

CMD php artisan serve --host=0.0.0.0 --port=8081

EXPOSE 8081