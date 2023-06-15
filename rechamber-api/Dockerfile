# Use the PHP 8.2.7 Apache base image
FROM php:8.2.7-apache

# Install any dependencies your application requires
RUN apt-get update && apt-get install -y \
    libpq-dev php8.2-mysql/stable php8.2-common/stable php-mysql/stable \
    && docker-php-ext-install pdo pdo_mysql mysqli && a2enmod rewrite

# Set the working directory in the container
WORKDIR /var/www/html/rechamber/rechamber-api

# Copy the application files to the container
COPY . /var/www/html/rechamber/rechamber-api

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN cd /var/www/html/rechamber/rechamber-api && curl https://getcomposer.org/installer -o composer.phar && php composer.phar && mv composer.phar composer && ./composer install

# && ./composer install

# Expose the container's port (if needed)
EXPOSE 80

ENTRYPOINT ["./entrypoint.sh"]
# Define the command to run when the container starts
CMD ["apache2-foreground"]