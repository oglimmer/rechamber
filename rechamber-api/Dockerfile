# Use the PHP 8.2.7 Apache base image
FROM php:8.2.7-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the application files to the container
COPY . /var/www/html

# Install any dependencies your application requires
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql

# Expose the container's port (if needed)
EXPOSE 80

ENTRYPOINT ["./entrypoint.sh"]
# Define the command to run when the container starts
CMD ["apache2-foreground"]
