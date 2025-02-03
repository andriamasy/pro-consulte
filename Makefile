projet=test-technique-test-technique-php-1

SUPPORTED_COMMANDS := bin/console composer yarn
SUPPORTS_MAKE_ARGS := $(findstring $(firstword $(MAKECMDGOALS)), $(SUPPORTED_COMMANDS))
ifneq "$(SUPPORTS_MAKE_ARGS)" ""
  COMMAND_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
  COMMAND_ARGS := $(subst :,\:,$(COMMAND_ARGS))
  $(eval $(COMMAND_ARGS):;@:)
endif

help:             ##Afficher l'aide sur le fichier
	@cat Makefile | grep "##." | sed '2d;s/##//;s/://'
start:            ##Démarrer l'instance Docker
	@docker compose -f ./docker-compose.yml up -d --force-recreate
build-docker:     ##Build l'instance Docker
	@docker compose -f ./docker-compose.yml build
stop:             ##Arreter l'instance Docker
	@docker compose -f ./docker-compose.yml down
exec:             ##Bash sur l'instance docker php
	@docker exec -it --user www-data "$(projet)" bash

.PHONY: bin/console
console:          ##Console Laravel
	@docker exec -it --user www-data "$(projet)" bash -c "php bin/console $(COMMAND_ARGS)"

clear:
	rm -rf var/cache/*

phpcs:            ##fix pagination du code
	@docker exec -it --user www-data "$(projet)" bash -c "./vendor/bin/php-cs-fixer -v fix --diff"

phpstan:          ##Analyse le code
	@docker exec -it --user www-data "$(projet)" bash -c "php -d memory_limit=4G ./vendor/bin/phpstan analyse src"

phpunit:          ##Analyse le code
	@docker exec -it --user www-data "$(projet)" bash -c "php bin/phpunit"

