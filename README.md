
# rma_platform

This project is a web-based application for managing insurance cases, developed with Laravel and used locally via XAMPP.

---



## Features

- User authentication (employees / admin)

- Creation and follow-up of refund requests

- Upload and view files (PDF, images)

- Administration interface:

  - Consultation and management of files

  - Assigning statuses: 'Received', 'en_cour', 'accept', 'refuse', 'send'

  - Adding Refusal Reasons
  
- Update notifications



##  Key Dependencies
-Laravel – PHP web framework

-Laravel Breeze – Simple auth  starter kit  

Includes:

-Authentication (login/register)

-Basic routes, controllers & views

-Integration with Tailwind, Vite, Alpine

-Bootstrap 5 – Responsive CSS framework 

-jQuery – Required for some Bootstrap and DataTables features

-DataTables – jQuery plugin for enhanced HTML tables
## Installation

1. Clone the repository and install PHP dependencies:
   
   ```bash

   composer install

2. Start xampp

    launch Apache

    launch MySql
    
3. Change env Config

    DB_CONNECTION=mysql

    DB_HOST=127.0.0.1

    DB_PORT=3306

    DB_DATABASE=your_database

    DB_USERNAME=root
    
    DB_PASSWORD=

4. Generate the application key:

    ```bash
    php artisan key:generate

5. Run database migrations:

    ```bash
    php artisan migrate

6. Start the development server:

    ```bash
    php artisan serve



    
##  File Structure Highlights
-routes/web.php: Web routes

-app/Http/Controllers/DossierController.php: Main controller

-resources/views/: Blade templates

-public/: Public assets and uploaded files
## Technologies
- Laravel 12.20.0
- PHP 8+
- MySQL (via XAMPP)
- Bootstrap 5
- Blade Templating
- Composer
- Carbon (date formatting)
