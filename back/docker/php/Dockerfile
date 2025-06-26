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

# Install composer and dependencies of the project
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY composer.json .

RUN composer install

WORKDIR /app

# Copy the rest of the code
COPY . .

EXPOSE 8000

# Start PHP built-in server at container start
CMD ["composer", "run", "start"]