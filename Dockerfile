FROM php:7.4-apache

# Instala la extensión pdo_mysql
RUN docker-php-ext-install pdo_mysql

# Habilita el módulo mod_rewrite de Apache
RUN a2enmod rewrite

# Copia el contenido de tu proyecto al directorio de Apache
COPY . /var/www/html/

# Cambia el propietario de los archivos a www-data
RUN chown -R www-data:www-data /var/www/html/
