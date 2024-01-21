# Use an official PHP runtime with Apache as a parent image
FROM php:7.2-apache

# Install mysqli and mysql-client
RUN docker-php-ext-install mysqli && apt-get update && apt-get install -y mysql-client

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Make port 80 available to the world outside this container
EXPOSE 80

# Import the database
RUN mysql -h localhost -u root estore < /var/www/html/estore.sql

# By default, simply start apache in the foreground
CMD ["apache2-foreground"]