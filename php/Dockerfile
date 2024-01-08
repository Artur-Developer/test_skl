FROM php:7.4-fpm

COPY ./php.ini /usr/local/etc/php/
COPY ./www.conf /usr/local/etc/php/

VOLUME /root/.composer

RUN apt-get update && apt-get upgrade -y \
    && apt-get install apt-utils -y \
    && apt-get install git zip vim libzip-dev libgmp-dev libxml2-dev libffi-dev libssl-dev libpng-dev libcurl4-openssl-dev libicu-dev libpq-dev wget jq curl -y \
    && docker-php-ext-install -j$(nproc) gd sockets zip curl intl gmp  pcntl bcmath ffi soap pdo pdo_mysql pdo_pgsql \
    && docker-php-source delete \
    && apt-get autoremove --purge -y && apt-get autoclean -y && apt-get clean -y \
    && usermod -u 1000 www-data

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000

