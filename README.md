## ENVIRONMENT:
- sudo apt install mysql-server
- sudo apt install apache2
- sudo apt install php8.1

## LOCAL, DEV, STG, PROD Commands:
- composer install
- touch .env, and paste .env.example content into .env file
- php artisan key:generate
- php artisan migrate:fresh --seed
- php artisan config:cache
- php artisan optimize:clear

## Schedule endpoints documentation
- php artisan scribe:generate

## Documentation route:
- http://127.0.0.1:8000/docs

## Database setup in .env file

DB_CONNECTION=mysql
DB_HOST=your-host //example 127.0.0.1
DB_PORT=3306
DB_DATABASE=trello_lar
DB_USERNAME= //your-username
DB_PASSWORD= //your-password
