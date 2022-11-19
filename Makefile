up:
	docker compose up -d
	@make yarn-dev
build:
	docker compose build --no-cache --force-rm
stop:
	docker compose stop
down:
	docker compose down --remove-orphans
down-v:
	docker compose down --remove-orphans --volumes
destroy:
	docker compose down --rmi all --volumes --remove-orphans
ps:
	docker compose ps
logs:
	docker compose logs
logs-watch:
	docker compose logs --follow
log-web:
	docker compose logs web
log-web-watch:
	docker compose logs  --follow web
log-app:
	docker compose logs app
log-app-watch:
	docker compose logs --follow app
log-db:
	docker compose logs db
log-db-watch:
	docker compose logs --follow db
log-front:
	docker compose logs front
log-front-watch:
	docker compose logs --follow front
init:
	docker compose up -d --build
	@make copy-environment-files
	@make composer-install
	@make php-cs-fixer-install
	@make larastan-install
	@make yarn-install
	@make generate-app-key
	@make yarn-dev
copy-environment-files:
	docker compose exec app cp .env.example .env
	docker compose exec app cp .env.testing.example .env.testing
	docker compose exec front cp .env.example .env
composer-install:
	docker compose exec app composer install
php-cs-fixer-install:
	docker compose exec app bash -c "cd tools/php-cs-fixer && composer install"
larastan-install:
	docker compose exec app bash -c "cd tools/larastan && composer install"
yarn-install:
	docker compose exec front yarn install
migrate-local-db:
	docker compose exec app php artisan migrate --seed
migrate-test-db:
	docker compose exec app php artisan migrate --env=testing
refresh-local-db:
	docker compose exec app php artisan migrate:fresh --seed
refresh-test-db:
	docker compose exec app php artisan migrate:fresh --env=testing --seed
test:
	docker compose exec app php artisan test
test-feature:
	docker compose exec app php artisan test --testsuite=Feature
test-unit:
	docker compose exec app php artisan test --testsuite=Unit
php-cs-fixer:
	docker compose exec app ./tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --config=./tools/php-cs-fixer/.php-cs-fixer.dist.php -v --diff
dry-run-php-cs-fixer:
	docker compose exec app ./tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --config=./tools/php-cs-fixer/.php-cs-fixer.dist.php -v --diff --dry-run
larastan:
	docker compose exec app ./tools/larastan/vendor/bin/phpstan analyse -c ./tools/larastan/phpstan.neon --memory-limit=-1
lint:
	docker compose exec front yarn lint
lint-fix:
	docker compose exec front yarn lintfix
test-front:
	docker compose exec front yarn test
yarn-dev:
	docker compose exec -d front yarn run dev
generate-app-key:
	@make generate-local-app-key
	@make generate-test-app-key
generate-local-app-key:
	docker compose exec app php artisan key:generate
generate-test-app-key:
	docker compose exec app php artisan key:generate --env=testing
setup-xdebug:
	docker compose cp infra/docker/app/xdebug.ini app:/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
	docker compose restart
