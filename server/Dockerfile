FROM php:8.3-apache

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    libicu-dev libpq-dev libmcrypt-dev zlib1g-dev libzip-dev git zip unzip curl sudo \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-install intl pcntl pdo_mysql pdo_pgsql pgsql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

WORKDIR /var/www/html

# Usuwamy RUN composer install && npm install z Dockerfile
# Kopiujemy całą aplikację
COPY . .

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

RUN a2enmod rewrite

RUN mkdir -p /var/www/logs

COPY testApp.conf /etc/apache2/sites-available/

RUN a2ensite testApp.conf && a2dissite 000-default.conf


EXPOSE 80
EXPOSE 3000

# Kopiujemy entrypoint i nadajemy prawa do wykonania
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Uruchamiamy entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
