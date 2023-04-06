
#-----------------------------------------------------------
# Docker
#-----------------------------------------------------------

# Start docker containers
start:
	docker-compose start

# Stop docker containers
stop:
	docker-compose stop

# Recreate docker containers
up:
	docker-compose up -d

# Stop and remove containers and networks
down:
	docker-compose down

# Stop and remove containers, networks, volumes and images
clean:
	docker-compose down --rmi local -v

ultra-clean:
	rm -rf node_modules/
	rm -rf vendor/
	rm composer.lock
	docker-compose down --rmi local -v

# Restart all containers
restart: stop start

# Build and up docker containers
build:
	docker-compose build

# Build containers with no cache option
build-no-cache:
	docker-compose build --no-cache

# Build and up docker containers
rebuild: build up

env:
	[ -f .env ] && echo .env exists || cp .env.example .env

init: env up build install start

php-bash:
	docker exec -it --user=www-data cp-php bash

#-----------------------------------------------------------
# Linter
#-----------------------------------------------------------
pint:
	docker-compose run -u `id -u` --rm php ./vendor/bin/pint -v --test

# Fix code directly
pint-hard:
	docker-compose run -u `id -u` --rm php ./vendor/bin/pint -v

lint:
	docker-compose run -u `id -u` --rm php composer php-cs-fixer fix -- --dry-run --diff -v

stan:
	docker-compose run -u `id -u` --rm php ./vendor/bin/phpstan analyse --memory-limit=2G
stan-file:
	docker-compose run -u `id -u` --rm php ./vendor/bin/phpstan analyse -b --memory-limit=2G
stan-json:
	docker-compose run -u `id -u` --rm php ./vendor/bin/phpstan analyse --error-format=prettyJson --memory-limit=2G

test:
	docker-compose run -u `id -u` --rm php php artisan co:cle
	docker-compose run -u `id -u` --rm php php artisan test --parallel --processes=4 --stop-on-failure --log-junit ./tests/Reports/junit.xml

check: pint lint stan test


#-----------------------------------------------------------
# Installation
#-----------------------------------------------------------

# Laravel
install:
	docker-compose stop
	docker-compose run -u `id -u` --rm php composer i
	docker-compose run -u `id -u` --rm php php artisan key:generate
	docker-compose run -u `id -u` --rm php php artisan migrate:fresh --seed
	docker-compose run -u `id -u` --rm php php artisan storage:link
