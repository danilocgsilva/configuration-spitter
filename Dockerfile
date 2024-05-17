FROM debian:bookworm-slim

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install vim zip wget curl -y
RUN apt-get install php php-xml -y
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

CMD while : ; do sleep 1000; done