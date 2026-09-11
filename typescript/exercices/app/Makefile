DOCKER_COMPOSE ?= docker compose
DOCKER_USER ?= "$(shell id -u):$(shell id -g)"

up:
	@docker compose up -d

up-build:
	@docker compose up -d --build

up-build-linux:
	@docker compose down
	@docker compose build --no-cache --build-arg USER_ID=$$(id -u) --build-arg GROUP_ID=$$(id -g) && docker compose up -d

down:
	@docker compose down

node:
	@docker compose exec node bash

l-node:
	@docker compose logs node -f
