FROM php:8.4-apache

RUN docker-php-ext-install pdo_mysql
COPY index.php /var/www/html/index.php
COPY start.sh /usr/local/bin/lab09-start.sh

EXPOSE 8080
CMD ["sh", "/usr/local/bin/lab09-start.sh"]
