# The Vehikl Oil Change Challenge

## Objective

Create a small Laravel app that helps determine whether a car is due for an oil change based on odometer and date inputs.

A car needs an oil change if either of the following is true:
- It’s been more than 5000 km since the last oil change, or
- It’s been more than 6 months since the last oil change.

## Requirements
- PHP 8.4 or higher
- Composer v2.8.12
- Laravel Installer 5.18.0
- SQLite
- Node v22.13.1

### Installing dependencies

```
npm install
```

### Starting development

#### Run database migrations

```
php artisan migrate
```

#### Start the application

Open two terminals and run each command in each terminal

```
npm run dev
```
```
php artisan serve
```

Then open your browser and navigate to: [http://localhost:8000](http://localhost:8000)

### Alternative
```
composer run dev
```

Run both front/back end and then open your browser and navigate to: [http://localhost:8000](http://localhost:8000)

### Build project
```
npm run build
```

### Testing (Pest)

```
php artisan test
```

## Migrations
> https://laravel.com/docs/12.x/migrations

- `php artisan migrate` | run migrations
- `php artisan migrate:rollback` | drops cars table
- `php artisan migrate:fresh` | Drops all tables and reruns migrations

## If vendor folder is missing
Run `composer install` command in the root folder to install dependencies
