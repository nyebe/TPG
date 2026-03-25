FROM php:8.2-fpm-alpine

ARG COMPOSER_ALLOW_SUPERUSER=1

# Install system deps + nginx + supervisor + envsubst
RUN apk add --no-cache \
    bash \
    nginx \
    supervisor \
    gettext \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    icu-dev \
    postgresql-dev \
    curl \
    $PHPIZE_DEPS \
    && docker-php-ext-install pdo pdo_pgsql pgsql intl xml opcache \
    && pecl install redis || true \
    && docker-php-ext-enable redis || true \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Composer caching
COPY composer.json composer.lock* ./
RUN if [ -f composer.json ]; then composer install --no-dev --no-scripts --no-autoloader --prefer-dist; fi

# Copy app
COPY . .

RUN if [ -f composer.json ]; then composer dump-autoload --optimize; fi

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true

# Nginx config
COPY nginx.conf /etc/nginx/http.d/default.conf

# Supervisor config
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Remove default nginx fallback config
RUN rm -f /etc/nginx/http.d/default.conf.default || true

EXPOSE 8080

CMD ["/usr/bin/supervisord", "-n"]