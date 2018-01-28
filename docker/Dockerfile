FROM phusion/baseimage:latest
MAINTAINER Takanori Matsumoto <takanori.matsumoto@mulodo.com>

# General
# ---------------------------------------------------------------
RUN ln -fs /usr/share/zoneinfo/Asia/Tokyo /etc/localtime
RUN echo "alias ll='ls -la'" > /root/.bashrc
RUN apt-get update && \
  apt-get -y dist-upgrade && \
  apt-get install -y \
    net-tools \
    tcpdump \
    nginx \
    apache2 \
    wget \
    build-essential

# Git
# ---------------------------------------------------------------
RUN apt-get install -y git
RUN wget -P /etc/bash_completion.d/ https://raw.githubusercontent.com/git/git/master/contrib/completion/git-completion.bash
RUN wget -P /etc/bash_completion.d/ https://raw.githubusercontent.com/git/git/master/contrib/completion/git-prompt.sh
RUN echo 'source /etc/bash_completion.d/git-prompt.sh' >> /root/.bashrc && \
  echo 'source /etc/bash_completion.d/git-completion.bash' >> /root/.bashrc && \
  echo 'GIT_PS1_SHOWDIRTYSTATE=true' >> /root/.bashrc && \
  echo "export PS1='\u@\h:\W\[\\033[31m\]\$(__git_ps1 [%s])\[\\033[00m\]\\$ '" >> /root/.bashrc

# Network utilities
# ---------------------------------------------------------------
RUN apt-get install -y iputils-ping net-tools
RUN apt-get install -y iproute2 traceroute
RUN apt-get install -y httperf

# PHP
# ---------------------------------------------------------------
ENV PHP_VERSION 7.1
RUN add-apt-repository -y ppa:ondrej/php
# install php
RUN apt-get update -y && apt-get install -y \
  php${PHP_VERSION} \
  php${PHP_VERSION}-mbstring \
  php${PHP_VERSION}-xml \
  php${PHP_VERSION}-zip \
  build-essential \
  php${PHP_VERSION}-pgsql \
  php${PHP_VERSION}-mysql \
  libapache2-mod-php${PHP_VERSION}

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN echo 'PATH=$PATH:~/.composer/vendor/bin' >> /root/.bashrc

# ex. https://getcomposer.org/doc/faqs/how-to-install-untrusted-packages-safely.md
RUN composer global require "laravel/installer"
COPY laravel-schedule /etc/cron.d/laravel-schedule
RUN chmod 0644 /etc/cron.d/laravel-schedule

# DB
# ---------------------------------------------------------------
RUN apt-get install -y postgresql
RUN apt-get install -y redis-tools

# Node
# ---------------------------------------------------------------
# RUN curl -sL https://deb.nodesource.com/setup_6.x | bash -
# RUN apt-get install -y nodejs
ENV NODE_VERSION 6.11.3
RUN curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.4/install.sh | bash
RUN . $HOME/.bashrc && nvm install $NODE_VERSION && nvm alias default $NODE_VERSION && npm i -g npm
