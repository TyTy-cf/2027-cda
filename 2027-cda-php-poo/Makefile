DOCKER_COMPOSE ?= docker compose
DOCKER_USER ?= "$(shell id -u):$(shell id -g)"
ENV ?= "dev"
PREFIX ?= "db_pokemons"
DB_NAME="db_pokemons"

init:
	@$(MAKE) up-build
	@echo "Waiting for the database to be ready..."
	@sleep 5
	@$(MAKE) db

db:
	@echo "DELETE DB... and importing initial database structure and data..."
	@docker compose exec -T mariadb mariadb -uroot -proot $(DB_NAME) < ./bdd_pokemons.sql
	@echo "Database import completed."

up:
	@docker compose up -d

up-build:
	@docker compose up -d --build

down:
	@docker compose down

php:
	@docker compose exec php bash
