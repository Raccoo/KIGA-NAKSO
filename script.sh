#!/bin/sh
id
# Vagrant�N������update
sudo apt update

# Vagrant�N�����ɏ��X�C���X�g�[��
sudo apt-get install -y apache2
sudo apt-get install -y mysql-server
sudo apt-get install -y php7.0 php7.0-mysql php7.0-dev php libapache2-mod-php

# Vagrant�N�����ɏ��X�N��
#sudo systemctl start apache2
#sudo systemctl enabled apache2
sudo systemctl restart apache2.service

# ��Ɨp�f�B���N�g�����쐬
cd /var/www/html/KIGA-NAKSO

sudo mkdir KIGA-NAKSO/menu
sudo mkdir KIGA-NAKSO/food
sudo mkdir KIGA-NAKSO/user

sudo touch KIGA-NAKSO/menu/index.php
sudo touch KIGA-NAKSO/food/index.php
sudo touch KIGA-NAKSO/user/index.php
sudo touch KIGA-NAKSO/header.php
sudo touch KIGA-NASO/footer.php
