
start:
	docker-compose up -d

build:
	docker-compose build

stop:
	docker-compose down

composer-install:
	docker-compose run --rm php composer install

composer-require:
	docker-compose run --rm php composer require $(package)

composer-update:
	docker-compose run --rm php composer update

exec:
	docker-compose exec php bash

