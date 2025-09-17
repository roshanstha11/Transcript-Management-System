# 📄 Transcript Management System

A Laravel-based web application for managing academic transcript submissions with secure role-based access control. Built with scalability, clarity, and maintainability in mind.

## 🚀 Features

- 🧑‍💼 Role-based access control (`user`, `admin`, `super_admin`)
- 🔐 Authentication system with login protection and redirect logic
- 📄 Form submission interface for transcript data
- 🛡️ Middleware-driven route protection
- 🧠 Clean redirect handling to prevent loops and unauthorized access
- 📦 Built on Laravel 12 and PHP 8.1+

## 🛠️ Tech Stack

 -------------------------------------------------------
| Layer         | Technology                            |
|---------------|---------------------------------------|
| Backend       | Laravel 12                            |
| Language      | PHP 8.1                               |
| Frontend      | Blade Templates                       |
| Server        | Laragon (local dev)                   |
| Database      | MySQL (or compatible)                 |
| Auth          | Laravel Breeze / Sanctum (optional)   |
 -------------------------------------------------------

## 🔧 Setup Instructions

1. **Clone the repository**
   ```bash
   - git clone https://github.com/your-username/transcript-management-system.git
   - cd transcript-management-system

2. **Install dependencies**
    ```bash
   - composer install OR 
   - composer update

3. **Create environment file**
    ```bash
    - Download .env file from the link: https://shorturl.at/jXwBg
    - And copy to the root location of the project.

4. **Configure .env fiile**
    ```bash
    - Set your database credentials
    - Update APP_URL, DB_HOST, DB_PORT, etc.

5. **Generate application key**
    ```bash
    - php artisan key:generate

6. **Link Storage**
    ```bash
    - php artisan storage:link

7. **Run Migration**
    ```bash
    - php artisan migrate

8. **Run Database Seeder**
    ```bash
    - php artisan db:seed
    This will create a new superadmin user in the database for login.

8. **Serve the application**
    ```bash
    - php artisan serve


