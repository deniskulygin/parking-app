.PHONY: build up install down restart migrate bash run-worker logs run-php-unit phpcs phpcbf ci-checks test-all stan

SERVICE_NAME=my-app

build:
	docker-compose build

up:
	docker-compose up -d

install: up
	docker-compose exec $(SERVICE_NAME) composer install -o

migrate:
	docker-compose exec $(SERVICE_NAME) php artisan migrate

seed:
	docker-compose exec $(SERVICE_NAME) php artisan db:seed

down:
	docker-compose down

bash:
	docker-compose exec -ti $(SERVICE_NAME) bash

restart: down up

# Composer script wrappers
ci-checks:
	docker-compose exec $(SERVICE_NAME) composer ci:checks

test-all:
	docker-compose exec $(SERVICE_NAME) composer test:all

stan:
	docker-compose exec $(SERVICE_NAME) composer test:stan

sniff:
	docker-compose exec $(SERVICE_NAME) composer sniff

sniff-fix:
	docker-compose exec $(SERVICE_NAME) composer sniff:fix

sniff-baseline:
	docker-compose exec $(SERVICE_NAME) composer sniff:baseline
