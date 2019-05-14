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
cd /var/www/html/KIGA-NAKSO

sudo mkdir KIGA-NAKSO/menu
sudo mkdir KIGA-NAKSO/food
sudo mkdir KIGA-NAKSO/user

sudo touch KIGA-NAKSO/menu/index.php
sudo touch KIGA-NAKSO/food/index.php
sudo touch KIGA-NAKSO/user/index.php
sudo touch KIGA-NAKSO/header.php
sudo touch KIGA-NASO/footer.php
