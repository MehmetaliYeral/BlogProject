# Use the official PHP 8.2 image as base
FROM php:8.2-fpm

# Update package lists and install necessary tools
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libxml2-dev \
    libldap2-dev \
    libgd-dev \
    zlib1g-dev \
    libicu-dev \
    libfreetype6-dev \
    libpng-dev \
    libjpeg-dev \
    libjpeg62-turbo-dev

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        intl \
        gd \
        ldap \
        soap \
        zip \
        mysqli \
        bcmath \
        ctype \
        fileinfo \
        pdo \
        pdo_mysql

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt install nodejs npm

# Clean up unnecessary packages and files
RUN apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Set the working directory
WORKDIR /var/www/html

# Expose port 9000 to communicate with Nginx/Apache
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
