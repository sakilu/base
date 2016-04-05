#!/bin/sh
 
project="$1"
cp -r ./* ../;cd ..;rm -rf base
cd application;
composer update
cd ..;git init;git add .;git commit -m "first commit";git remote add origin https://sakilu@bitbucket.org/sakilu/$project.git;git push -u origin master
git clone https://github.com/sakilu/crud.git