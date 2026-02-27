FROM php:8.2-cli

# Install system dependencies (IMPORTANT: include libonig-dev)
RUN apt-get update && apt-get install -y \
    git unzip curl zip \
    libzip-dev \
    libonig-dev \
    gnupg

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring zip

# Install Node 22
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app