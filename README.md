# AgentResponsableDZ

Third year web developpement project

# Important

The **25.11.2021**, it has been decided the project will not use vue.js, and only integrate a few pages

This has been decided with [Mr. Grunenwald](https://github.com/grunenwald) because we got many issues with docker, laravel and so on.

The pages that are still integrated are the main page, with all the flights, the login page and the user-management page.

# Installation

First we need to clone in recursive mode

```
git clone --recursive https://github.com/HE-Arc/AgentResponsableDZ.git
```

You can then open the repo and go inside the laradock folder.

Here we have all the docker containers and we need to tell docker how to build the containers. 

We need to

```
//Inside laradock
cp .env.example .env
```

and then change some configs:
```
COMPOSE_PROJECT_NAME=ardz
PHP_VERSION=7.4
...
MYSQL_DATABASE=ardz_db
MYSQL_USER=homestead
MYSQL_PASSWORD=secret
...
NGINX_HOST_HTTP_PORT=8000

```

You can choose diffrent configs but we use those

After that in a command line inside laradock
```
docker-compose up -d nginx mysql phpmyadmin redis workspace
```

You should now be inside a linux env

There is a bug with this install that mysql container does not start. If that is the case, go to and 
```
C:\User\[Username]\.laradock\data\mysql
```

delete mysql and then recreate a empty mysql folder. The container should restart without crashing

Once all containers start:
```
docker-compose exec workspace bash
composer update
composer install
php artisan migrate
npm install
export NODE_OPTIONS=--openssl-legacy-provider
```



After that, there should be the default page on localhost:8000 (if you choose 8000 as your port) and localhost:8081 has phpmyadmin.

run
```
npm run watch
```
When developping
