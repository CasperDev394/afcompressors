# ---------- Composer stage ----------
FROM composer:2 AS composer_builder

WORKDIR /app

COPY . .
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

RUN composer dump-autoload --optimize


# ---------- Node stage ----------
FROM node:20-alpine AS node_builder

WORKDIR /app

COPY package.json yarn.lock ./
RUN yarn install --frozen-lockfile

COPY . .
RUN yarn build


# ---------- Final stage ----------
FROM php:8.5-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache \
    nginx \
    supervisor \
    bash \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
    postgresql-dev \
    curl \
    git \
    nano \
    unzip \
    linux-headers \
    $PHPIZE_DEPS \
    && docker-php-ext-install \
        pdo_pgsql \
        pgsql \
        bcmath \
        intl \
        mbstring \
        zip

# код приложения
COPY --from=composer_builder /app /var/www/html
COPY --from=node_builder /app/public/build /var/www/html/public/build

# nginx config
COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf

# supervisor configs
COPY docker/supervisor/supervisord.conf /etc/supervisord.conf
COPY docker/supervisor/php-fpm.conf /etc/supervisor.d/php-fpm.conf
COPY docker/supervisor/nginx.conf /etc/supervisor.d/nginx.conf
COPY docker/supervisor/queue.conf /etc/supervisor.d/queue.conf
COPY docker/supervisor/scheduler.conf /etc/supervisor.d/scheduler.conf

COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN mkdir -p \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    /run/nginx \
    && chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
