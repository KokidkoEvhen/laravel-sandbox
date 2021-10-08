# Eloquent

## Step 1. Clone the repository

## Step 2. Building and running containers

```
docker-compose up -d
```

## Step 3. Create and seed tables
```
# Go to container
docker-compose exec php-apache bash

# Migrate and ssed
php artisan migrate:fresh --seed
```
