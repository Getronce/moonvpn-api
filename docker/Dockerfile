FROM php:8.3-alpine

RUN apk update && apk add --no-cache \
    git \
    zip \
    unzip \
    libpq-dev \
    supervisor \
    bash \
    curl \
    && docker-php-ext-install pdo pdo_pgsql pgsql


RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony


RUN wget -q -O /usr/local/bin/composer https://getcomposer.org/download/2.7.7/composer.phar && chmod +x /usr/local/bin/composer

RUN composer self-update --stable

WORKDIR /var/www

COPY . .

RUN composer app:review:prepare && composer clear-cache

RUN chown -R www-data:www-data var/cache var/log public && \
    chmod +w var/cache var/log

COPY ./docker/supervisor/supervisor.conf /etc/supervisord.conf

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
