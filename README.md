# Notification Demo Application

This is a demo application to show notification functionality in a Laravel application.

## Prerequisites

- PHP 8.3
- Docker Desktop
- Composer
- NodeJS v20+ / NPM v10+

## Setting up the project

### Installation

Start by cloning the repository:
```sh
git clone git@github.com:rjp2525/ga-notifications-demo
```

Open a terminal instance within the cloned directory, then install dependencies for PHP + JS
```sh
composer install
npm i && npm run build
```

Copy `.env.example` to `.env` and set the application key:
```sh
php artisan key:generate
```
Set the required app key and secret for Reverb (these are two strings of letters/numbers, 20 characters long):
```env
REVERB_APP_KEY=
REVERB_APP_SECRET=
```
Start the Docker container (detached) with Sail:
```sh
./vendor/bin/sail up -d
```
Migrate and seed the database:
```sh
./vendor/bin/sail artisan migrate --seed
```
