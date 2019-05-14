#!/bin/sh
id
# Vagrant起動時にupdate
sudo apt update

# Vagrant起動時に諸々インストール
sudo apt-get install -y apache2
sudo apt-get install -y mysql-server

# Vagrant起動時に諸々起動
sudo systemctl start apache2
sudo systemctl enabled apache2

# 作業用ディレクトリを作成
cd /var/www/html/php

sudo mkdir php/menu
sudo mkdir php/food
sudo mkdir php/user

sudo touch php/menu/index.php
sudo touch php/food/index.php
sudo touch php/user/index.php
sudo touch php/header.php
sudo touch php/footer.php
