# Getting started

## Installation
Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x/installation)

Clone the repository

    git clone https://github.com/robertfederico/admin-dashboard.git
    
Switch to the repo folder

    cd admin-dashboard
    
Install composer dependencies 

    composer install

Install NPM dependencies

    npm install
    
Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Create an empty database and update .env file

    In the .env file fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD options to match the credentials of the database you just created.

Run the database migrations and populate the database with seed data (**Set the database connection in .env before migrating**)

    php artisan migrate:refresh --seed
 
Development

    npm run dev

Start the local development server
    
    php artisan serve

You can now access the server at http://localhost:8000
