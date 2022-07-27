# syntax = docker/dockerfile:1.2

FROM node:lts AS builder

# Set working directory
WORKDIR /app

#
COPY frontend/package.json frontend/yarn.lock ./

# Same as npm install
RUN yarn

COPY frontend ./

RUN yarn build

FROM php:7.4.3-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www/html

COPY .env .
COPY backend .
COPY --from=builder /app/build .

