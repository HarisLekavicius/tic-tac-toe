FROM php:7.2-apache

ENV \
  	APP_DIR="/var/www/html"

RUN apt-get -y update --fix-missing
RUN apt-get upgrade -y

# Install useful tools
RUN apt-get -y install vim

# Install important libraries
RUN apt-get -y install --fix-missing apt-utils build-essential curl git unzip

# Intall composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# PHP libraries
RUN apt-get -y install libsqlite3-dev libsqlite3-0 mysql-client libcurl3 libcurl3-dev libssl-dev zlib1g-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev

# PHP config
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/

# PHP Extensions
RUN docker-php-ext-install mysqli \
	&& docker-php-ext-install pdo_mysql \
	&& docker-php-ext-install opcache \
	&& docker-php-ext-install zip \
	&& docker-php-ext-install -j$(nproc) gd

# Enable apache modules
RUN a2enmod rewrite headers

# change working dir
WORKDIR $APP_DIR
