FROM php:8.2-fpm-alpine

ARG COMPOSER_ALLOW_SUPERUSER=1

# System dependencies and PHP extensions required for Laravel + Postgres
RUN apk add --no-cache \
    bash \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    icu-dev \
    postgresql-dev \
    $PHPIZE_DEPS \
    && docker-php-ext-install pdo pdo_pgsql pgsql intl xml opcache \
    && pecl install redis || true \
    && docker-php-ext-enable redis || true \
    && apk add --no-cache --virtual .composer-deps curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apk del .composer-deps

WORKDIR /var/www/html

# Copy composer files first to leverage Docker cache when installing deps
COPY composer.json composer.lock* ./

RUN if [ -f composer.json ]; then composer install --no-dev --no-scripts --no-autoloader --prefer-dist; fi

# Copy the rest of the app
COPY . ./

# Run composer dump-autoload if composer.json was provided
RUN if [ -f composer.json ]; then composer dump-autoload --optimize; fi

# Create storage and bootstrap cache directories with proper permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true

EXPOSE 9000

CMD ["php-fpm"]
