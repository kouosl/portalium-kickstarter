FROM ubuntu:latest
MAINTAINER KOUOSL "info@kouosl.org"
ENV DEBIAN_FRONTEND noninteractive
# Install
RUN apt-get update && apt-get install -y \
    mariadb-server \
    mariadb-client \
    apache2 \
    php7.0 \
    libapache2-mod-php7.0 \
    php7.0-mysql \
    php7.0-curl \
    php7.0-gd \
    php7.0-intl \
    php-pear \
    php-imagick \
    php7.0-imap \
    php7.0-mcrypt \
    php-memcache  \
    php7.0-pspell \
    php7.0-recode \
    php7.0-sqlite3 \
    php7.0-tidy \
    php7.0-xmlrpc \
    php7.0-xsl \
    php7.0-mbstring \
    php-gettext \
    git \
    composer \
    nano \
    unzip

RUN apt-get -y install phpmyadmin --no-install-recommends
RUN apt-get clean
RUN a2enmod php7.0
RUN a2enmod rewrite
RUN rm -rf /var/www/*
RUN mkdir -p /var/www/portal
ADD docker/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf
RUN service apache2 restart

RUN echo "mysqld_safe &" > /tmp/config \
    && echo "mysqladmin --silent --wait=30 ping || exit 1" >> /tmp/config \
    && echo "mysql -u root -e 'USE mysql; UPDATE user SET plugin=\"\" WHERE User=\"root\"; FLUSH PRIVILEGES;'" >> /tmp/config \
    && bash /tmp/config \
    && rm -f /tmp/config

RUN ln -s /etc/phpmyadmin/apache.conf /etc/apache2/conf-enabled/phpmyadmin.conf
RUN sed -i '/AllowNoPassword/s/^    \/\///g' /etc/phpmyadmin/config.inc.php

RUN echo 'service apache2 start' >> /root/.bashrc
RUN echo 'service mysql start' >> /root/.bashrc

EXPOSE 80

# Create Container
# docker run -it -p 8080:80 -v $(pwd):/var/www/portal --name server kouosl/portal:server
# localhost:8080
# localhost:8080/phpmyadmin
