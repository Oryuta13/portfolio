FROM node:16-slim as node-builder

COPY . ./app
RUN cd /app && npm ci && npm run prod


FROM php:8.1.5-apache

# 必要なパッケージのインストールと設定
RUN apt-get update && apt-get install -y \
  zip \
  unzip \
  git \
  postgresql-client \
  libpq-dev \
  libmemcached-dev \
  zlib1g-dev \
  && pecl install memcached \
  && docker-php-ext-enable memcached \
  && docker-php-ext-install -j "$(nproc)" opcache \
  && docker-php-ext-install -j "$(nproc)" pdo_pgsql pgsql \
  && docker-php-ext-enable opcache

# mod_rewrite を有効にする
RUN a2enmod rewrite

# Apacheのポートとドキュメントルートの設定を変更
RUN sed -i 's/80/8080/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf \
  && sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf

# PHPの設定ファイルを本番用に変更
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Composerを最新バージョンでコピー
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# エントリポイントスクリプトをコピー
COPY entrypoint.sh /entrypoint.sh
# スクリプトを実行可能にする
RUN chmod +x /entrypoint.sh

# アプリケーションのセットアップ
WORKDIR /var/www/html
COPY . ./
COPY --from=node-builder /app/public ./public
RUN composer install
RUN chown -Rf www-data:www-data ./

ENTRYPOINT ["/entrypoint.sh"]