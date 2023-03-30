# image php
FROM php:8.1.5-apache

WORKDIR /var/www/html
COPY . .

# Pour résoudre le problème de permission
RUN chown -R www-data:www-data /var/www/html

# Pour résoudre le problème de permission sur le dossier public
RUN chown -R www-data:www-data /var/www/html/public

# Copier le contenu du dossier de travail src dans le dossier de travail du conteneur
COPY src .

RUN a2enmod ssl && a2enmod rewrite

RUN mkdir -p /etc/apache2/ssl
COPY ./dockerphp/ssl/*.pem /etc/apache2/ssl/
COPY ./dockerphp/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libxml2-dev \
    nodejs \
    npm \
    wget \
    nano \
    apt-transport-https \
    lsb-release \
    # configure les extensions PHP nécessaires
    && docker-php-ext-configure intl \
    && docker-php-ext-configure zip \
    && docker-php-ext-configure gd --with-jpeg \ 
    && docker-php-ext-configure soap --enable-soap \ 
    # installe les extensions PHP nécessaires
    && docker-php-ext-install -j$(nproc) \
    intl \
    pdo_mysql \
    opcache \
    zip \
    gd \
    soap \
    # supprime les fichiers temporaires du système
    && rm -rf /var/lib/apt/lists/*

RUN pecl install xdebug && docker-php-ext-enable xdebug

# Donner les droits d'exécution au script d'installation install_composer.sh
RUN chmod +x install_composer.sh

# Exécuter le script install_composer.sh
RUN sh ./install_composer.sh

# Installation des dépendances avec composer
RUN composer install

EXPOSE 80
EXPOSE 443