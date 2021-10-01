up:
	@docker-compose up -d webserver

up-install: up install-back

stop:
	@docker-compose stop

down:
	@docker-compose down

first-install: up install-back

install-thn-backend-test: PROJECT := thn-backend-test
install-thn-backend-test:
	@docker-compose exec -u application webserver bash -c  "cd /var/www/$(PROJECT);rm -f .env.local.php"
	@docker-compose exec -u application webserver bash -c  "cd /var/www/$(PROJECT);rm -f .env"
	@docker-compose exec -u application webserver bash -c  "cd /var/www/$(PROJECT);composer install --no-interaction --no-scripts"
	@docker-compose exec -u application webserver bash -c  "cd /var/www/$(PROJECT);composer dump-env dev"
	@docker-compose exec -u application webserver bash -c  "cd /var/www/$(PROJECT);php bin/console d:d:d --force"
	@docker-compose exec -u application webserver bash -c  "cd /var/www/$(PROJECT);php bin/console d:d:c"
	@docker-compose exec -u application webserver bash -c  "cd /var/www/$(PROJECT);php bin/console d:s:u -f"
	@docker-compose exec -u application webserver bash -c  "cd /var/www/$(PROJECT);php bin/console d:f:l -n"

install-back: up install-thn-backend-test

status:
	@docker-compose ps -a

into-container:
	@docker-compose exec -u application webserver bash