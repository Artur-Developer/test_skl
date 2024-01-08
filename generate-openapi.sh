#!/bin/bash

docker-compose.exe -f ./docker-compose.yml exec -T php vendor/bin/openapi -l --output ./openapi.json --pattern "*.php" --exclude vendor --exclude tests --format json ./
