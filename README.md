# Laravel User Management API

This is a Laravel project for managing users. This README will guide you to set up the project, run migrations and seeders, start the server, and test the API using Postman.

---

## Table of Contents

1. [Clone the Repository](#clone-the-repository)
2. [Install Dependencies](#install-dependencies)
3. [Environment Setup](#environment-setup)
4. [Run Migrations and Seeders](#run-migrations-and-seeders)
5. [Start the Laravel Server](#start-the-laravel-server)
6. [Testing the API with Postman](#testing-the-api-with-postman)
7. [Compile Frontend Assets](#compile-frontend-assets)
8. [Notes](#notes)

---

## Clone the Repository

# Install Dependencies

git clone https://github.com/jobelGolde12/user_profile_api.git
cd user_profile_api

Install Dependencies
composer install
npm install
npm run dev

# Environment Setup
cp .env.example .env
php artisan key:generate

# Run all migrations:

php artisan migrate

# Run the UserSeeder specifically:

php artisan db:seed --class=UserSeeder

# Start the Laravel Server
php artisan serve