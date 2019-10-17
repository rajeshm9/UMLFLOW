FROM php:7.2-apache
RUN mkdir -p /usr/share/man/man1
RUN apt-get update && apt-get install -y default-jre-headless
COPY src/ /var/www/html/
