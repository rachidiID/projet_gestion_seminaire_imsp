# Choisissez une version de PHP, Alpine est plus léger
FROM php:8.4-fpm-alpine

# Arguments pour l'utilisateur et le groupe (pour éviter les problèmes de permission)
ARG UID
ARG GID

# Définir le répertoire de travail
WORKDIR /var/www

# Installation des dépendances système de base et des premières extensions PHP
RUN apk update && apk add --no-cache \
    bash \
    build-base \
    curl \
    wget \
    git \
    zip \
    unzip \
    nodejs \
    npm \ 
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libxml2-dev \
    icu-dev \
    oniguruma-dev \
    libexif-dev \
    # Configuration pour GD (si on l'ajoute plus tard)
    # && docker-php-ext-configure gd --with-freetype --with-jpeg \
    # Installation des extensions essentielles (PDO pour la base de données)
    && docker-php-ext-install pdo pdo_mysql \
    # Nettoyage initial (sera fait à la fin quand toutes les extensions seront installées)
    # && apk del build-base
    && echo "Extensions pdo et pdo_mysql installées"

# --- SECTION POUR AJOUTER D'AUTRES EXTENSIONS PAS À PAS ---
# Exemple pour ajouter mbstring (nous le ferons étape par étape)
RUN docker-php-ext-install mbstring && echo "Extension mbstring installée"
RUN docker-php-ext-install bcmath && echo "Extension bcmath installée" 
RUN docker-php-ext-install zip && echo "Extension zip installée"
RUN docker-php-ext-install intl && echo "Extension intl installée"
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install gd && echo "Extension gd installée"
RUN docker-php-ext-install exif && echo "Extension exif installée"
RUN docker-php-ext-install pcntl && echo "Extension pcntl installée" 
RUN docker-php-ext-install xml && echo "Extension xml installée"
RUN docker-php-ext-enable opcache && echo "Extension OPcache activée"
# --- FIN DE LA SECTION D'AJOUT ---

# À la toute fin, quand toutes les extensions sont installées, on nettoie les paquets de build
RUN apk del build-base && echo "Dépendances de build nettoyées"

# Installation de Composer (gestionnaire de dépendances pour PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Création d'un utilisateur et d'un groupe non-root pour exécuter l'application
RUN addgroup -g ${GID:-1000} laravel_group && \
    adduser -u ${UID:-1000} -G laravel_group -s /bin/sh -D laravel_user

# Exposer le port 9000 et démarrer php-fpm
EXPOSE 9000
CMD ["php-fpm"]