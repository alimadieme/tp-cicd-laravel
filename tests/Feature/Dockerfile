FROM php:8.4-cli-alpine

# Installation des dépendances système requises pour les extensions PHP natives
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    libzip-dev \
    unzip \
    sqlite-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite gd zip

WORKDIR /var/www/html

# Importation du binaire Composer de façon propre (Multi-stage build)
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# Copie des fichiers de configuration de l'application
COPY . .

# Installation des paquets de production sans les outils de dev
RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN php artisan config:cache && php artisan route:cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
