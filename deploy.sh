#!/bin/sh
 
project="$1"
cp -r ./* ../;cd ..;rm -rf base
cd application;
composer update
cd ..;git clone https://github.com/sakilu/crud.git