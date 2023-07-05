
start:
	docker-compose up -d

build:
	docker-compose build

stop:
	docker-compose down

composer-install:
	docker-compose exec php composer install

composer-require:
	docker-compose exec php composer require $(package)

composer-update:
	docker-compose exec php composer update

exec:
	docker-compose exec php bash

test:
	docker-compose exec php vendor/bin/phpunit tests

php-cs:
	docker-compose exec php vendor/bin/php-cs-fixer fix src --verbose
