#!/bin/bash

echo "-----Installing VirtualBox and Vagrant-----"

#Update
sudo apt-get update

#Installing git
sudo apt-get install git -y

#Installing VirtualBox
sudo apt install virtualbox -y

#Installing Vagrant
sudo apt install vagrant -y

#Configuring Vagrant
#Downloading to Downloads vagrant deb file
path=/home/$(whoami)/Downloads
wget -c https://releases.hashicorp.com/vagrant/2.0.3/vagrant_2.0.3_x86_64.deb \
-P $path

#Installing Vagrant_2.0.3_x86_64
sudo dpkg -i $path/vagrant_2.0.3_x86_64.deb

#Installing vagrant-hostmanager
vagrant plugin install vagrant-hostmanager

#Cloning Git repostory into Desktop
path=/home/$(whoami)/Desktop
git clone https://github.com/kouosl/portal.git $path/portal

#Changing Key
keyPath=$1
key=$(cat $keyPath)
path=/home/$(whoami)/Desktop/portal/vagrant/config/vagrant-local.example.yml
sed -i -r "s/<your-personal-github-token>/$key/g" $path
mv $path /home/$(whoami)/Desktop/portal/vagrant/config/vagrant-local.yml

#Vagrant up
cd /home/$(whoami)/Desktop/portal
vagrant up

#Vagrant ssh
vagrant ssh