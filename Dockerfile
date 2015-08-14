FROM php:5.6-apache
MAINTAINER noahgao "ziheng1719@163.com"
RUN docker-php-ext-install pdo_mysql
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html
EXPOSE 80