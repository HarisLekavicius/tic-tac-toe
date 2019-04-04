# Docker

start docker containers
```
docker-compose up -d
```

# Laravel

## Startup
install dependencies
```
docker exec -it laravelapp composer install
```
add .env for nevironment variables
```
docker exec -it laravelapp cp .env.example .env
```
generate key
```
docker exec -it laravelapp php artisan key:generate
```

Now app shoud work on `localhost:8080` host

# Additional info

## Artisan usage

```
docker exec -it laravelapp php artisan {command}
```

## update dependencies
```
docker exec -it laravelapp composer update
```

## key generate
```
docker exec -it laravelapp php artisan key:generate
```
