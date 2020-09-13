FROM php:7.4.0-fpm

ARG UID
EXPOSE $UID

RUN adduser -u ${UID} --disabled-password --gecos "" appuser
RUN mkdir /home/appuser/.ssh
RUN chown -R appuser:appuser /home/appuser/
RUN echo "StrictHostKeyChecking no" >> /home/appuser/.ssh/config
RUN echo "export COLUMNS=300" >> /home/appuser/.bashrc
RUN echo "alias sf=/appdata/www/bin/console" >> /home/appuser/.bashrc

COPY ./php.ini /usr/local/etc/php/php.ini
COPY ./scripts/change-sf-permissions.sh /usr/bin/sf-permissions

RUN apt-get update \
    && apt-get install -y git acl openssl openssh-client wget zip vim librabbitmq-dev libssh-dev \
    && apt-get install -y libpng-dev zlib1g-dev libzip-dev libxml2-dev libicu-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip gd soap \
    && pecl install xdebug \
    && docker-php-ext-enable --ini-name 05-opcache.ini opcache xdebug

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

# node para laravel mix
# https://github.com/nodesource/distributions
# esto parece que no sirve de mucho en el contenedor pq no refresca el js y por otro lado da error al montar el contenedor
# lo voy a comentar
RUN apt-get update \
    && apt-get -y install sudo \
    && apt-get install curl
    # && curl -sL https://deb.nodesource.com/setup_14.x | sudo -E bash - \
    # && sudo apt-get install -y nodejs \
    # && yes | apt-get install npm

# opcional
# RUN apt-get install ghostscript

# RUN wget https://cs.symfony.com/download/php-cs-fixer-v2.phar -O php-cs-fixer
# RUN chmod a+x php-cs-fixer
# RUN mv php-cs-fixer /usr/local/bin/php-cs-fixer

RUN mkdir -p /appdata/www

USER appuser
RUN composer global require "hirak/prestissimo:^0.3" --prefer-dist --no-progress --no-suggest --optimize-autoloader --classmap-authoritative \
	&& composer clear-cache

WORKDIR /appdata/www
