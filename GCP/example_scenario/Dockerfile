FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite
RUN echo "display_errors = On" >> /usr/local/etc/php/php.ini

# Apache 설정 파일 수정
RUN echo '<Directory /var/www/html/>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

COPY ./html /var/www/html/
RUN chown -R www-data:www-data /var/www/html/
RUN echo 'DirectoryIndex index.php index.html' >> /etc/apache2/apache2.conf
