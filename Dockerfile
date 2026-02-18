# Usa PHP 8.2 come base
FROM php:8.2-apache

# Aggiorna i pacchetti e installa le dipendenze
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    openssh-server \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql zip \
    && a2enmod rewrite

RUN rm /etc/apt/preferences.d/no-debian-php

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Imposta la directory di lavoro
WORKDIR /var/www/html
USER www-data

# Set up Apache configuration
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Esponi la porta per Apache
EXPOSE 80

# Avvia Apache
CMD ["apache2-foreground"]
