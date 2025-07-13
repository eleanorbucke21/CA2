# Use PHP with Apache
FROM php:8.2-apache

# Enable Apache rewrite module (optional but common)
RUN a2enmod rewrite

# Copy the entire project to the server's web root
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html/php

# Apache serves /var/www/html/index.php by default,
# so we make php/index.php act as the entry point

# Expose HTTP port
EXPOSE 80
