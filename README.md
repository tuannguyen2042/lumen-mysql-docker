# Lumen + MySQL + Docker

1. Rename `.env.example` to `.env` (or use your own `.env`)

2. In `.env`, change `DB_HOST=127.0.0.1` to `DB_HOST=your_mysql_container_name` (`DB_HOST=db` in this example)

3. Build and run project with:

```
docker-compose --env-file prod.env up --build
```

## Start service locally
php -S localhost:8000 -t public

## Postman collection
nevo.postman_collection.json

## API document
http://localhost:8000/swagger-ui.html

## Run integration tests with Codeception
php vendor/bin/codecept run unit

## Run API test with Codeception
php vendor/bin/codecept run api

## Run all tests with Codeception
php vendor/bin/codecept run