FROM php:8.4-fpm

# Instalar certificados SSL
RUN apt-get update \
    && apt-get install -y ca-certificates \
    && update-ca-certificates

# Otras extensiones que ya tengas
