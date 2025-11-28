# Imagen base con PHP y Apache
FROM php:8.2-apache

# Habilitar extensiones necesarias
RUN docker-php-ext-install mysqli

# Instalar dependencias para MongoDB
RUN apt-get update && apt-get install -y \
    libssl-dev \
    pkg-config \
    libcurl4-openssl-dev \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# Copiar el código del proyecto al servidor web
COPY . /var/www/html/

# Permisos
RUN chown -R www-data:www-data /var/www/html

# Puerto usado por Render
ENV PORT=80
EXPOSE 80

CMD ["apache2-foreground"]
