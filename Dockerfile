FROM php:7.2-fpm
WORKDIR "/application"

# Install git, unzip
RUN apt-get update \
    && apt-get -y install git unzip vim

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install php-intl
RUN apt-get update \
    && apt-get install -y libicu-dev \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && docker-php-ext-install intl

# Install zip (phpUnit requirement)
RUN apt-get update && \
    apt-get install -y \
    zlib1g-dev \
    && docker-php-ext-install zip

# Install mysql
RUN docker-php-ext-install mysqli

RUN apt-get update && apt-get install -y mysql-client && rm -rf /var/lib/apt

# Install gd mbstring pdo
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libpq-dev \
 	&& rm -rf /var/lib/apt/lists/* \
 	&& docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr \
	&& docker-php-ext-install gd mbstring pdo pdo_mysql pdo_pgsql

# Install xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Fix permission problems
RUN usermod -u 1000 www-data
