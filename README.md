# Getting started

## Installation
Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x/installation)

Clone the repository

    git clone https://github.com/robertfederico/admin-dashboard.git
    
Switch to the repo folder

    cd admin-dashboard
    
Install all the dependencies using composer

    composer install

Install all the dependencies using npm

    npm install
    
Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate
    
Run the database migrations and populate the database with seed data (**Set the database connection in .env before migrating**)

    php artisan migrate:refresh --seed
 
Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000
