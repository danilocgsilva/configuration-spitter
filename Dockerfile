FROM debian:bookworm-slim

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install vim zip wget curl -y
RUN apt-get install php php-curl php-xml php-xdebug -y
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
WORKDIR /app
RUN mkdir /output
COPY xdebug.ini /etc/php/8.2/mods-available

COPY ./app /app
RUN composer install -d /app
