# Use official PHP with Apache
FROM php:8.2-apache

# Enable mod_rewrite (for clean URLs if needed)
RUN a2enmod rewrite

# Copy your app
COPY . /var/www/html/

# Set ownership and permissions
RUN chown -R www-data:www-data /var/www/html

# Enable error reporting (optional)
RUN echo "display_errors=On\nerror_reporting=E_ALL" > /usr/local/etc/php/conf.d/errors.ini

# Expose port 80 explicitly (for clarity; not strictly required for Railway)
EXPOSE 80
