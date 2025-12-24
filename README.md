# The Vehikl Oil Change Challenge

## Objective

Create a small Laravel app that helps determine whether a car is due for an oil change based on odometer and date inputs.

A car needs an oil change if either of the following is true:
- It’s been more than 5000 km since the last oil change, or
- It’s been more than 6 months since the last oil change.

## Getting Started

### Dependencies

```
Composer v2.8.12
Laravel Installer 5.18.0
Node v22.13.1
```

### Installing

`npm install` | install dependencies

### Starting development

- `composer run dev` and `http://localhost:8000` | run project and open application in the browser

- `php artisan migrate` | run migrations

### Building Project

`npm run build` | build laravel project

### Testing (Pest)
> https://laravel.com/docs/12.x/testing

`php artisan test` | Running tests

`php artisan test --testsuite=Feature --stop-on-failure` | Running tests on Feature

## Migrations
> https://laravel.com/docs/12.x/migrations

- `php artisan migrate` | run migrations
- `php artisan migrate:rollback` | drops cars table
- `php artisan migrate:fresh` | Drops all tables and reruns migrations

## Create Migration
> https://laravel.com/docs/12.x/migrations

`php artisan make:migration create_awesome_table`

## Create Controller
> https://laravel.com/docs/12.x/controllers

`php artisan make:controller AwesomeController`

## Create Model
> https://laravel.com/docs/12.x/eloquent#introduction

`php artisan make:model YourAwesomeModel`

## Additional Information
- https://laravel.com/docs/12.x/helpers#dates
- https://carbon.nesbot.com/docs/
- https://laravel.com/docs/12.x/validation#creating-form-requests
- https://laravel.com/docs/12.x/eloquent
- https://laravel.com/docs/12.x/queries
- https://laravel.com/docs/12.x/errors
-