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

# Notes on installing packages (for my own reference)

composer require annotations

composer require twig

composer require doctrine maker

composer require form

# The DB

## Create the DB

php bin/console doctrine:database:create

## Create an entity for articles

php bin/console make:entity Article

## Create/Edit model

Edit Articles.php in entities folder

When you're done, type "php bin/console doctrine:migrations:diff"

Run migration: "php bin/console doctrine:migrations:migrate"

Viewing all articles in console:
"php bin/console doctrine:query:sql 'SELECT * FROM article'"