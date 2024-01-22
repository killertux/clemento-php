FROM  php:8.3-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app
