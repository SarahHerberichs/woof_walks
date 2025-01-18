# Utilise une image PHP officielle avec Apache
FROM php:8.1-apache

# Installe les dépendances nécessaires (comme Composer, extensions PHP)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

# Active les modules Apache
RUN a2enmod rewrite

# Copie le code source dans l'image Docker
COPY . /var/www/symfony

# Définit le répertoire de travail
WORKDIR /var/www/symfony

# Expose le port 8000 pour accéder à Symfony
EXPOSE 8000
