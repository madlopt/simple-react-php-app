FROM php:8.2-alpine

COPY . /var/www/react-php

WORKDIR /var/www/react-php

RUN chmod -R 755 /var/www/react-php
RUN mkdir -p /var/www/react-php/vendor \
    && chmod -R 777 /var/www/react-php/vendor

RUN php composer.phar install --no-scripts --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader


