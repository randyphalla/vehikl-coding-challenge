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

### Clone Repo

```bash
git clone https://github.com/randyphalla/vehikl-coding-challenge.git
```

### Installing dependencies

```bash
# install node_modules
npm install

# install php dependencies
composer install
```

After running `composer install`, you will be prompted with a few questions related to running the command and creating the sqlite database.

- Are you sure you want to run this command? `Yes`
- The SQLite database configured for this application does not exist: database/database.sqlite.
    - Would you like to create it? `Yes`

### Create an .env file

Create an `.env` file on the root folder. Copy and paste `.env.example` into `.env`

Update `APP_URL` to `APP_URL=http://localhost:8000`

### Generate key

```bash
php artisan key:generate
```

This will generate a key in your `.env` file and update `APP_KEY`

### Starting development

#### Run database migrations

```
php artisan migrate
```

#### Start the application

Open two terminals and run each command in each terminal

```bash
# This command will start the front end environment
npm run dev

# This command will start the php environment
php artisan serve
```

Then open your browser and navigate to: [http://localhost:8000](http://localhost:8000)

### Alternative

```bash
# This commmand will start both front and back end environment
composer run dev
```

Run both front/back end and then open your browser and navigate to: [http://localhost:8000](http://localhost:8000)

### Build project

```bash
npm run build
```

### Testing (Pest)

```bash
#
php artisan test

#
php artisan test --profile
```
