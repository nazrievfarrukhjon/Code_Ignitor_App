# create network docker network create ci_network

up:
	docker-compose up -d
cp_env:
#   docker-compose run --rm php_ci cp ./.env.example ./.env
composer_update:
	docker-compose run --rm composer_ci composer update
composer_install:
	docker-compose run --rm composer_ci composer install
key_gen:
	docker-compose run --rm artisan_ci key:generate
migrate:
	docker-compose run --rm artisan_ci migrate
seed:
	docker-compose run --rm artisan_ci db:seed
queue:
	docker-compose run --rm artisan_ci queue:work
npm_install:
	docker-compose run --rm node npm install
npm_run_prod:
	docker-compose run --rm node npm run build
down:
	docker-compose down
optimize_clear:
	docker-compose run --rm artisan_ci optimize:clear

# Shortcut to Run Everything
all: up cp_env composer_install key_gen migrate seed npm_install
