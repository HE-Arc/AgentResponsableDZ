#!/bin/bash

cd laradock/

docker-compose up -d nginx mysql phpmyadmin redis workspace
winpty docker-compose exec workspace bash
