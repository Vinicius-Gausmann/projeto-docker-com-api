FROM php:8.2-apache

# Instala extensão MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Ativa mod_rewrite (bom pra API REST)
RUN a2enmod rewrite

# Define diretório padrão
WORKDIR /var/www/html