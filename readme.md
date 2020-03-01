Util Tools

# docker

docker run -p 8014:80 -p 3314:3306 --name utiltools -d -v /local/project/path/utiltools:/var/www/html/app brunopaglialunga/laraedit

docker exec -i -t <CONTAINER-ID> /bin/bash

cd /var/www/html/app
cp .env.example .env

# npm
npm run wacth
npm run production

# fabric
fab deploy:git_user=[bitbucket-user]

# Reference links

## Laravel 5.5 Docupentation
   https://laravel.com/docs/5.5

## Vue JS 2 - The Complete Guide (incl. Vue Router & Vuex)
   https://www.udemy.com/vuejs-2-the-complete-guide/

## Laravel 5.5 Docupentation
   https://adminlte.io/

## Docker
   https://www.docker.com/get-started