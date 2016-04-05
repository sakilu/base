#!/bin/sh
 
project="$1"
cp -r ./* ../;cd ..;rm -rf base
cd application;
composer update
cd ..;git clone https://github.com/sakilu/crud.git
sudo /home/ubuntu/docker/virtualhost.sh create
sudo /home/ubuntu/docker/virtualhost.sh delete
sudo /home/ubuntu/docker/virtualhost.sh create