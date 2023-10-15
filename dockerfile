FROM php:8.2-fpm

WORKDIR /var/www/html/php-todo

RUN apt-get update

RUN set -eux; \
    apt-get upgrade -y; \
    apt-get install -y\
        libzip-dev \
        zip \
        unzip \
        supervisor \
        git \
        zlib1g-dev \
        curl \
        libmemcached-dev \
        libz-dev \
        libpq-dev \
        libjpeg-dev \
        libpng-dev \
        libfreetype6-dev \
        libssl-dev \
        libwebp-dev \
        libxpm-dev \
        libmcrypt-dev \
        libonig-dev; \
        rm -rf /var/lib/apt/lists/*

RUN apt-get install autoconf


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install \
        gd pdo pdo_pgsql pdo_mysql zip sockets bcmath opcache\
    && docker-php-ext-enable \
        gd pdo pdo_pgsql pdo_mysql zip sockets bcmath opcache

RUN usermod -u 1000 www-data
RUN rm -rf /var/cache/apk/*
ADD . /var/www/php-todo
RUN chown -R www-data:www-data /var/www/php-todo
RUN chmod -R 777 /var/www/php-todo

USER www-data


EXPOSE 9000
CMD ["php-fpm"]