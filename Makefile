DOCKER_COMPOSE=cd .build/docker/ && docker-compose

help:
	@echo
	@echo
	@echo \# this help
	@echo help
	@echo
	@echo \# build php container and install required packages
	@echo install
	@echo
	@echo \# start container
	@echo up
	@echo
	@echo \# launch tests
	@echo test
	@echo
	@echo \# enter into container
	@echo bash
	@echo
	@echo \# stop container
	@echo down
	@echo
	@echo

install:
	$(DOCKER_COMPOSE) up -d --build
	$(DOCKER_COMPOSE) exec php-fpm composer install

up:
	$(DOCKER_COMPOSE) up -d

test:
	$(DOCKER_COMPOSE) exec php-fpm ./vendor/bin/phpunit tests --verbose --color always

bash:
	$(DOCKER_COMPOSE) exec php-fpm bash

down:
	$(DOCKER_COMPOSE) down

.PHONY: install up bash down help