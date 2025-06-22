FROM php:8.3-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    zip \
    libssl-dev \
    pkg-config \
    && rm -rf /var/lib/apt/lists/*

# Install MongoDB extension (required)
RUN pecl install mongodb && docker-php-ext-enable mongodb

WORKDIR /app

# Copy composer files and install dependencies
COPY composer.json composer.lock ./

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');" \
    && composer install --no-dev --optimize-autoloader

# Copy the rest of the code
COPY . .

EXPOSE 8000

# Start PHP built-in server at container start
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public/"]