FROM php:8.2-fpm
# FROM php:8.2-fpm

WORKDIR /var/www/html/php-todo

RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mbstring

# Add user for laravel application
# RUN groupadd -g 1000 www-data
# RUN useradd -u 1000 -ms /bin/bash -g www-data www-data

# WORKDIR /var/www/html/php-todo
COPY . /var/www/html/php-todo
RUN composer install 
# COPY ./default.conf /etc/apache2/sites-available/000-default.conf

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html/php-todo
RUN chown -R www-data:www-data /var/www/html/php-todo

# Change current user to www
USER www-data
# EXPOSE 80
# EXPOSE 443

# CMD php artisan serve --host=0.0.0.0
EXPOSE 9000                 
CMD ["php-fpm"]