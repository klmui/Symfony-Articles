# Symfony-Articles

This is a CRUD app for articles using PHP and the Symfony framework.

Use an Apache server to run this application in your browser.

# Setup: 

1. Set up virtual host.

2. Type "composer create-project symfony/skeleton symphart" in the terminal.
Make sure you have Composer installed.

3. Go to localhost/symphart/public

# Quick Start:

## Install dependencies
composer install

## Edit the env file and add DB params

## Create Article schema
php bin/console doctrine:migrations:diff

## Run migrations
php bin/console doctrine:migrations:migrate

## Build for production
npm run build

## Run symfony server 
symfony server:start