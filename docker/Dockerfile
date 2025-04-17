FROM php:8.3-alpine

RUN apk update && apk add \
    libzip-dev \
    git \
    zip \
    unzip \
    zsh \
    openssh-client \
    build-base \
    linux-headers \
    supervisor \
    curl-dev \
    libxml2-dev \
    rabbitmq-c-dev \
    autoconf \
    && rm -rf /var/cache/apk/* /tmp/*

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    curl \
    zip

RUN pecl install  amqp && docker-php-ext-enable amqp

RUN wget -q -O /usr/local/bin/composer https://getcomposer.org/download/2.7.7/composer.phar && chmod +x /usr/local/bin/composer

RUN composer self-update --stable

WORKDIR /var/www

COPY . .

RUN composer app:review:prepare && composer clear-cache

RUN chown -R www-data:www-data var/cache var/log public && \
    chmod +w var/cache var/log

COPY ../docker/supervisor/supervisor.conf /etc/supervisord.conf

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
