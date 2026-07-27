# GemuList

GemuList is a web application built with the Laravel framework. It provides a robust and modern foundation for managing and displaying lists of games.

## Prerequisites

Before setting up the project locally, ensure you have the following installed on your machine:
- PHP (>= 8.3)
- Composer
- Node.js & NPM
- MySQL Databse

## Local Development Setup

Follow these steps to build and run the application on your local machine:

### 1. Clone the repository

`
git clone https://github.com/Cahzello/GemuList.git
`

### 2. Navigate into the project directory

`
cd GemuList
`

### 3. Install PHP dependencies

`
composer install
`

### 4. Install JavaScript dependencies

`
npm install
`

### 5. Set up the environment configuration

Copy the example .env file to create your own environment file:

`
cp .env.example .env
`

*(On Windows, use: copy .env.example .env)*

### 6. Generate the application key

`
php artisan key:generate
`

### 7. Run database migrations

Create the database structure. By default, Laravel uses an SQLite database located at database/database.sqlite:

`
php artisan migrate
`

### 8. Build the frontend assets

Compile the Tailwind CSS and Vite assets:

`
npm run build
`

For hot-reloading during development, run instead:

`
npm run dev
`

### 9. Start the local development server

`
php artisan serve
`

You can now access the application at [http://localhost:8000](http://localhost:8000).

## Tech Stack
- **Framework:** Laravel 13
- **Frontend:** Vite, Tailwind CSS 4
- **Testing:** Pest PHP
