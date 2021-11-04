#!/bin/bash

cd /laradock/

docker-compose up -d nginx mysql phpmyadmin redis workspace
docker-compose exec workspace bash
