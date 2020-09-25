FROM webdevops/php-apache:7.2

# Update image
RUN apt-get update && apt-get install -y

# Install Xdebug
RUN curl -fsSL 'https://xdebug.org/files/xdebug-2.7.2.tgz' -o xdebug.tar.gz \
    && mkdir -p xdebug \
    && tar -xf xdebug.tar.gz -C xdebug --strip-components=1 \
    && rm xdebug.tar.gz \
    && ( \
    cd xdebug \
    && phpize \
    && ./configure --enable-xdebug \
    && make -j$(nproc) \
    && make install \
    ) \
    && rm -r xdebug \
    && docker-php-ext-enable xdebug

# Copy php.ini into image
COPY php.ini.sample /opt/docker/etc/php/php.ini

ENV php.error_reporting="E_ALL & ~E_NOTICE"

COPY ./ /app