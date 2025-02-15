FROM php:8.2-fpm

ENV TZ=Asia/Tokyo

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    nodejs \
    npm \
    supervisor

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN npm install -g yarn

WORKDIR /var/www/html
COPY . /var/www/html
RUN git config --global --add safe.directory /var/www/html

RUN yarn install
RUN ln -s /var/www/html/node_modules/.bin/vite /usr/local/bin/vite
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN apt-get update && apt-get install -y netcat-openbsd

EXPOSE 3000 5173
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-n"]
