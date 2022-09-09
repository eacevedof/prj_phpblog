#!/bin/bash
# en mac devuelve Darwin (código de la terminal de mac), ubuntu en linux y para windows hay 2
OS := $(shell uname)
# docker backend, que coincide con el nombre en docker-compose.yml container_name
DOCKER_BE = lv-eduardoaf-be

ifeq ($(OS),Darwin)
	# id de usuario que se va a usar en el entorno
	UID=$(shell id -u)
else ifeq ($(OS),Linux)
	UID=$(shell id -u)
else
	UID=1000 # windows hay q asignarle manualmente
endif

# U_ID será un argumento para el resto de archivos

help: ## Show this help message
	@echo "usage: make [target]"
	@echo
	@echo "targets:"
	@egrep "^(.+)\:\ ##\ (.+)" ${MAKEFILE_LIST} | column -t -c 2 -s ":#"
	@echo ${UID}

run: ## Start the containers
ifeq ($(OS),Darwin)
	# docker volume create --name=lv-eduardoaf-be-sync
	# levantará: la bd, el backend y el servicio web
	# servicios en cascada
	# docker-sync ayuda en al optimizacion del funcionamiento en mac
	# U_ID=${UID} docker-sync start
	U_ID=${UID} docker-compose -f docker-compose.macos.yml up -d
else
	U_ID=${UID} docker-compose -f docker-compose.linux.yml up -d
endif

start: ## Start the containers
ifeq ($(OS),Darwin)
	U_ID=${UID} docker-compose -f docker-compose.macos.yml up -d
else
	U_ID=${UID} docker-compose -f docker-compose.linux.yml up -d
endif

stop: ## Stop the containers
ifeq ($(OS),Darwin)
	# U_ID=${UID} docker-sync stop
	U_ID=${UID} docker-compose -f docker-compose.macos.yml stop
else
	U_ID=${UID} docker-compose -f docker-compose.linux.yml stop
endif

docker-sync-restart: ## Rebuild docker-sync stack and prepare environment
	# U_ID=${UID} docker-sync-stack clean
	# start containers
	$(MAKE) run
	# permissions y composer install
	$(MAKE) prepare

restart: ## Restart the containers
	$(MAKE) stop && $(MAKE) run

build: ## Rebuilds all the containers
ifeq ($(OS),Darwin)
	U_ID=${UID} docker-compose -f docker-compose.macos.yml build --compress --parallel
else
	U_ID=${UID} docker-compose -f docker-compose.linux.yml build
endif

prepare: ## Runs backend commands
	$(MAKE) be-sf-permissions
	$(MAKE) composer-install
	# $(MAKE) migrations

# Backend commands
be-sf-permissions: ## Configure the Symfony permissions
	U_ID=${UID} docker exec -it -uroot ${DOCKER_BE} sh /usr/bin/sf-permissions

composer-install: ## Installs composer dependencies
	U_ID=${UID} docker exec --user ${UID} -it ${DOCKER_BE} composer install --no-scripts --no-interaction --optimize-autoloader

migrations: ## Runs the migrations
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} bin/console doctrine:migrations:migrate -n

be-logs: ## Tails the Symfony dev log
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} tail -f var/log/dev.log
# End backend commands

ssh-be: ## ssh's into the be container
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} bash

ssh-db: ## ssh's into mysql
	docker exec -it --user root cont-mariadb-univ bash

cp-db: ## copy into database container
	docker cp ./db/prod.sql cont-mariadb-univ:/tmp

# code-style: ## Runs php-cs to fix code styling following Symfony rules
	#U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} php-cs-fixer fix src --rules=@Symfony

deploy-test: ## deploy codeonly in test
	py.sh deploy.codeonly eduardoaf-test

deploy-prod: ## deploy codeonly in prod
	py.sh deploy.codeonly eduardoaf-prod

rem-logs: ## remove logs
	rm -fr ./logs/*
	rm -f ./storage/*.log

compile: ## npm run dev
	npm run dev

dumpdb: ## dumpdb
	py.sh dump eduardoaf

down: ## remove containers
	U_ID=${UID} docker-compose -f docker-compose.macos.yml down --remove-orphans

rebuild: ## rebuild containers
	U_ID=${UID} docker-compose -f docker-compose.macos.yml down
	U_ID=${UID} docker-compose -f docker-compose.macos.yml up -d --build --remove-orphans

# --remove-orphans
