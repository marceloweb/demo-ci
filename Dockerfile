FROM trafex/alpine-nginx-php7:1.1.0

USER root

RUN apk add --update \
    php-mbstring \
    php-pdo_mysql

EXPOSE 8080
