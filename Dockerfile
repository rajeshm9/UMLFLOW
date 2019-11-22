FROM php:7.2-apache
RUN mkdir -p /usr/share/man/man1
RUN apt-get update && apt-get install -y default-jre-headless
COPY src/ /var/www/html/
ENTRYPOINT []
CMD sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf && docker-php-entrypoint apache2-foreground
