DOCKER_COMPOSE ?= docker compose
DOCKER_USER ?= "$(shell id -u):$(shell id -g)"
export USER_ID ?= $(shell id -u)
export GROUP_ID ?= $(shell id -g)

init:
	@docker compose down
	@docker compose build --no-cache
	@docker compose up -d

up:
	@docker compose up -d --build

down:
	@docker compose down
