FROM ubuntu:16.04

MAINTAINER jmartos <jmartos89@gmail.com>

# Update Repository, upgrade packages, install basic utils
RUN apt-get update -y && apt-get upgrade -y && apt-get install -y apt-utils vim curl unzip git

# Set mysql password
RUN echo mysql-server mysql-server/root_password password root | debconf-set-selections
RUN echo mysql-server mysql-server/root_password_again password root | debconf-set-selections

# Install and Configure Database
RUN apt-get install -y mysql-server mysql-client

# Set permissions
RUN usermod -d /var/lib/mysql/ mysql
RUN mkdir /var/run/mysqld
RUN chown mysql /var/run/mysqld

# Configure MySQL
ADD config/mysqld.cnf /etc/mysql/mysql.conf.d/
COPY config/my.cnf /root/.my.cnf

# Expose
EXPOSE 3306

# Run
CMD ["mysqld"]
