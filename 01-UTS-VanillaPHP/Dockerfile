FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy project files to the container
COPY . /var/www/html/

# Set permissions for upload directories
RUN chown -R www-data:www-data /var/www/html/uploads_artikel /var/www/html/uploads_penulis

# Increase PHP upload limits
RUN echo "upload_max_filesize=20M" >> /usr/local/etc/php/conf.d/docker-php-ext-custom.ini && \
    echo "post_max_size=20M" >> /usr/local/etc/php/conf.d/docker-php-ext-custom.ini
