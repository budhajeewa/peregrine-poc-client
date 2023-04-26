FROM php:8.2.5-fpm-alpine3.17
ARG UID
RUN apk --update add shadow
RUN usermod -u $UID www-data && groupmod -g $UID www-data
RUN apk --update add sudo
RUN echo "www-data ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers
RUN apk --update add composer
RUN apk add --update php-tokenizer
RUN apk add --update php-session
RUN apk add --update php-dom
RUN apk add --update php-fileinfo
RUN apk add --update php-xml
RUN apk add --update php-xmlwriter
RUN apk add --update npm
RUN apk add --update make
RUN apk add --update busybox-extras
RUN apk add --update php-openssl
RUN apk add --update nano