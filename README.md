# The Vehikl Oil Change Challenge

TODO:

## Description

TODO:

## Getting Started

### Dependencies

```
Composer v2.8.12
Laravel Installer 5.18.0
Node v22.13.1
```

### Installing

```
npm install
```

### Starting development

```
composer run dev
```

### Building Project

```
npm run build
```

## Migrations
> https://laravel.com/docs/12.x/migrations

`php artisan migrate` |
`php artisan migrate:rollback` | drops cars table
`php artisan migrate:fresh` | Drops all tables and reruns migrations

## Seeders
> https://laravel.com/docs/12.x/seeding

`php artisan db:seed --class=CarSeeder`

### Insert

`php artisan tinker` |

```
\DB::table('cars')->insert([
  [
    'id' => 1,
    'name' => 'Si',
    'current_odometer' => 6000,
    'previous_oil_change_odometer' => 4000,
    'previous_oil_change_date' => '2025-06-19',
  ],
  [
    'id' => 2,
    'name' => 'Hatchback',
    'current_odometer' => 4000,
    'previous_oil_change_odometer' => 3500,
    'previous_oil_change_date' => '2025-08-19',
  ],
  [
    'id' => 3,
    'name' => 'Accord Sedan',
    'current_odometer' => 10000,
    'previous_oil_change_odometer' => 6000,
    'previous_oil_change_date' => '2024-01-19',
  ],
  [
    'id' => 4,
    'name' => 'HR-V',
    'current_odometer' => 34000,
    'previous_oil_change_odometer' => 30000,
    'previous_oil_change_date' => '2023-12-19',
  ],
]);
```

`\DB::table('cars')->get();` |

## Create Controllers

`php artisan make:controller AwesomeController`