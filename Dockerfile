FROM debian:bookworm-slim

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install vim zip wget curl -y
RUN apt-get install php php-xml -y

CMD echo hello hello world!