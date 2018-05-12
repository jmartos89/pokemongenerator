FROM ubuntu:17.10

RUN apt-get update && apt-get -y upgrade
RUN apt-get install -y vim curl git unzip

RUN \
    apt-get update && \
    apt-get install -y software-properties-common python-software-properties && \
    LC_ALL=C.UTF-8 add-apt-repository -y -u ppa:ondrej/php

RUN apt-get install -y php7.1 php7.1-fpm php7.1-mysql php7.1-xml php7.1-curl php-memcached php-geoip nodejs php7.1-mcrypt

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

ADD symfony.ini /etc/php/7.1/fpm/conf.d/
ADD symfony.ini /etc/php/7.1/cli/conf.d/

ADD symfony.ini /etc/php7.1/php-fpm.d/
ADD symfony.ini /etc/php7.1/cli/conf.d/

ADD symfony.pool.conf /etc/php/7.1/fpm/pool.d/
RUN rm /etc/php/7.1/fpm/pool.d/www.conf

RUN mkdir /run/php

EXPOSE 9000

CMD ["php-fpm7.1", "-F"]