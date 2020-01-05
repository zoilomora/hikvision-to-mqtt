FROM php:7.4-cli-alpine3.11

RUN apk add --no-cache \
        libzip-dev \
        openssl-dev \
        mosquitto-dev && \
    docker-php-ext-install -j$(nproc) \
        zip && \
    apk add --no-cache --virtual .phpize_deps $PHPIZE_DEPS && \
    pecl install mosquitto-0.4.0 && \
    docker-php-ext-enable \
        mosquitto && \
    rm -rf /usr/share/php7 && \
    rm -rf /tmp/pear && \
    apk del .phpize_deps && \
    mkdir /var/app && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
ENV PATH /var/app/bin:/var/app/vendor/bin:$PATH
WORKDIR /var/app
