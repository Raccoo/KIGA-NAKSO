#!/bin/sh
id
# Vagrant�N������update
sudo apt update

# Vagrant�N�����ɏ��X�C���X�g�[��
sudo apt-get install -y apache2
sudo apt-get install -y mysql-server

# Vagrant�N�����ɏ��X�N��
sudo systemctl start apache2
sudo systemctl enabled apache2

# ��Ɨp�f�B���N�g�����쐬
