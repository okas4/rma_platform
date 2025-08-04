# rma_platform

This project is a web-based Laravel application designed to manage insurance case files locally, using XAMPP as the development environment.

---

## Features

- Secure authentication (employees and administrators)
- Submission and tracking of refund requests
- File uploads (PDF, images) for each case
- Administrative interface for:
  - Viewing and managing all submitted cases
  - Assigning statuses: `Received`, `en_cour`, `accept`, `refuse`, `send`
  - Adding refusal reasons for rejected cases
- Real-time update notifications via status changes

---

## Technologies Used

- Laravel 12.20.0
- PHP 8+
- MySQL (via XAMPP)
- Laravel Breeze (authentication scaffolding)
- Blade templating engine
- Tailwind CSS, Vite, Alpine.js
- Bootstrap 5
- jQuery
- DataTables
- Composer
- Carbon (date formatting)

---

## Key Dependencies

- **Laravel Breeze**: Lightweight starter kit for authentication  
- **Tailwind CSS, Vite, Alpine.js**: Frontend integration with Laravel  
- **Bootstrap 5**: UI components and layout  
- **jQuery + DataTables**: Enhanced data tables with search, filter, pagination

---

## Installation

### Requirements

Make sure you have installed:

- PHP 8.1 or higher  
- Composer  
- Node.js and npm  
- XAMPP  

### Steps

1. **Clone the repository** or download the ZIP and place it in your XAMPP `htdocs` folder:

    ```bash
    git clone https://your-repository-url.git
    ```

2. **Start XAMPP**, then launch **Apache** and **MySQL**.

3. **Create a database** in phpMyAdmin (`http://localhost/phpmyadmin`):

    - Click **New**
    - Enter a database name (e.g. `rma_platform`)
    - Click **Create**

4. **Configure your `.env` file**:

    - Copy `.env.example` to `.env`
    - Update the database connection settings:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=rma_platform
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Install PHP dependencies**:

    ```bash
    composer install
    ```

6. **Install and build frontend assets**:

    ```bash
    npm install
    npm run build
    ```

7. **Generate the application key**:

    ```bash
    php artisan key:generate
    ```

8. **Run database migrations**:

    ```bash
    php artisan migrate
    ```

9. **Launch the application**:

    - Access via browser at:

      ```
      http://localhost/rma_platform/public
      ```

    - Or use the Laravel development server:

      ```bash
      php artisan serve
      ```

---

## File Structure Highlights

- `routes/web.php` — Application routes  
- `app/Http/Controllers/DossierController.php` — Main controller  
- `resources/views/` — Blade templates  
- `public/` — Public assets and uploaded files

---
