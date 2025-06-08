start: build

build:
	docker compose -f ./server/docker-compose.yml up -d --build --remove-orphans
