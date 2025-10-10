<a name="readme-top"></a>

<br/>
<br/>

<div align="center">
  <a href="https://github.com/zyx-0314/">
    zyx 0314
  </a>
<!-- * Title Section -->
  <h3 align="center">Laravel Employee Management System</h3>
</div>

<!-- * Description Section -->
<div align="center">
A comprehensive Employee Management System built with Laravel 12, featuring secure authentication, role-based access control, and full CRUD operations for employee management.
</div>

<br/>

![](https://visit-counter.vercel.app/counter.png?page=zyx-0314/ci4-template)

<!-- ! Make sure it was similar to your github -->

---

<br/>
<br/>

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#overview">Overview</a>
      <ol>
        <li>
          <a href="#key-components">Key Components</a>
        </li>
        <li>
          <a href="#technology">Technology</a>
        </li>
      </ol>
    </li>
    <li>
      <a href="#rules-practices-and-principles">Rules, Practices and Principles</a>
    </li>
    <li>
      <a href="#features">Features</a>
    </li>
    <li>
      <a href="#default-users">Default Users</a>
    </li>
    <li>
      <a href="#project-structure">Project Structure</a>
    </li>
    <li>
      <a href="#api-endpoints">API Endpoints</a>
    </li>
    <li>
      <a href="#troubleshooting">Troubleshooting</a>
    </li>
    <li>
      <a href="#resources">Resources</a>
    </li>
  </ol>
</details>

---

## Overview

This project is a **full-featured Employee Management System** built with Laravel 12, demonstrating modern web application development practices with secure authentication, role-based permissions, and comprehensive CRUD operations.

The system provides different access levels for administrators, staff, and clients, with a professional dark-themed UI using Tailwind CSS.

* **Purpose**: Complete employee management solution with security and user experience focus.
* **Audience**: Organizations needing to manage employee records with role-based access control.

### Key Components

The system includes comprehensive modules for complete employee management:

| Component                 | Purpose                                                             | Notes                                                   |
| ------------------------- | ------------------------------------------------------------------- | ------------------------------------------------------- |
| **Authentication System** | Secure login/logout with 30-day "remember me" functionality        | Session-based auth with CSRF protection, hashed passwords |
| **Role-Based Access**     | Three-tier permission system (Admin/Staff/Client)                  | Admin: full access, Staff: limited, Client: basic      |
| **Employee Management**   | Full CRUD operations for employee records                          | Admin-only access, prevents self-deletion             |
| **User Directory**        | Comprehensive user listing with role-based visibility             | Admins see all users, others see welcome page         |
| **Error Handling**        | Custom error pages (404, 403, 500) with modal validation         | Professional Laravel-themed error pages               |
| **Responsive UI**         | Dark theme with Laravel orange branding                           | Tailwind CSS with mobile-friendly design              |

### Technology

#### Language

![HTML](https://img.shields.io/badge/HTML-E34F26?style=for-the-badge\&logo=html5\&logoColor=white)
![CSS](https://img.shields.io/badge/CSS-1572B6?style=for-the-badge\&logo=css3\&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge\&logo=javascript\&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge\&logo=php\&logoColor=white)

#### Framework/Library

![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-06B6D4?style=for-the-badge\&logo=tailwindcss\&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge\&logo=laravel\&logoColor=white)

#### Databases

![PostgreSQL](https://img.shields.io/badge/PostgreSQL-336791?style=for-the-badge\&logo=postgresql\&logoColor=white)

---


## Quick Start (step-by-step)

Below are reproducible, step-by-step instructions that have been verified to get the app running on a development machine using Docker. Commands are shown for a Windows `cmd.exe` environment.

1) Build and start the development stack (rebuild to pick up any Dockerfile changes):

```cmd
docker compose up --watch
```

2) Install PHP dependencies inside the `php` container. Important: the project's seeders and factories use development-only packages (for example Faker). Install with dev dependencies so seeding works:

```cmd
docker compose exec php sh -lc "composer install --no-interaction --prefer-dist"
```

If the compose setup already ran `composer install` in the image (which may have omitted dev deps), run the command above to ensure dev packages are present at runtime.

3) Ensure an environment file exists and the application has an encryption key.

- Preferred (if a `.env.example` is present):

```cmd
docker compose exec php sh -lc "cp .env.example .env || true"
```

- If there is no `.env.example` in the repository (some copies may be missing it), create a `.env` with at least the DB and APP_KEY values (example below). Then generate a key:

```cmd
docker compose exec php sh -lc "php artisan key:generate"
```

You should see: "Application key [base64:...] set successfully." If you still see "No application encryption key has been specified" the `.env` wasn't picked up — ensure it's in `backend/.env` inside the container.

4) Run migrations and seed the database (this creates the tables and example users):

```cmd
docker compose exec php sh -lc "php artisan migrate --force"
docker compose exec php sh -lc "php artisan db:seed --force"
```

If you want a clean slate and fresh seeded data, run:

```cmd
docker compose exec php sh -lc "php artisan migrate:fresh --seed --force"
```

5) Clear compiled caches (helpful after config/env changes):

```cmd
docker compose exec php sh -lc "php artisan cache:clear && php artisan view:clear && php artisan config:clear"
```

6) Access the application in your browser:

- Main Application (nginx): http://localhost:8090
- pgAdmin (if used with profile): http://localhost:8091

Notes:
- If you prefer to run commands on your host rather than inside the container, you can run `composer install`, `php artisan key:generate`, `php artisan migrate --seed` on your host machine — but ensure your PHP version and extensions match the Docker image (PHP 8.2 and postgres/pdo extensions are required).

### Local (non-Docker) quick checklist

- Install PHP 8.2 and required extensions (pdo, pdo_pgsql, pgsql, mbstring, xml, intl).
- Install Composer.
- Copy `.env.example` to `.env` or create a `.env` and set DB credentials.
- Run `composer install` (include dev deps if you plan to run seeders/tests).
- Run `php artisan key:generate`.
- Run `php artisan migrate --seed`.


## Ports & Database

Defaults used in this project (host mapping):

| Service     | Host port |
|-------------|-----------:|
| nginx (app) | 8090      |
| pgAdmin     | 8091      |
| PostgreSQL  | 5432      |

Database credentials used in examples and CI:

- Host: localhost
- Port: 5432
- Database: app
- User: app
- Password: app

## Features

### 🔐 Authentication & Security
- **Secure Login/Registration**: Email-based authentication with password hashing
- **Remember Me**: 30-day persistent sessions when enabled
- **CSRF Protection**: All forms protected against cross-site request forgery
- **Role-Based Access Control**: Three-tier permission system

### 👥 User Management
- **User Roles**:
  - **Administrator**: Full system access, employee management, user directory
  - **Staff**: Limited access to general features
  - **Client**: Basic user access and profile management
- **User Directory**: Comprehensive listing with role badges and user information

### 🏢 Employee Management (Admin Only)
- **Create Employees**: Add new admin or staff members with role assignment
- **Update Records**: Edit employee information including optional password changes
- **Delete Employees**: Remove employees with self-deletion protection
- **Employee Listing**: Filtered view showing only admin and staff members

### 🎨 User Interface
- **Dark Theme**: Professional Laravel orange and dark gray color scheme
- **Responsive Design**: Mobile-friendly interface with Tailwind CSS
- **Error Handling**: Custom error pages (404, 403, 500) with navigation
- **Modal Validation**: Interactive error displays with dismissible modals
- **Success Notifications**: Auto-hiding toast messages for successful actions

### 🧪 Testing
- **Comprehensive Test Suite**: 24 test cases covering all functionality
- **Feature Tests**: Authentication, employee management, and access control
- **Validation Tests**: Form validation and security testing
- **Permission Tests**: Role-based access verification

## Default Users

After running the seeder, you can login with these accounts:

| Role          | Email                | Password        | Access Level                    |
|---------------|---------------------|-----------------|--------------------------------|
| Administrator | admin@example.com   | adminpassword   | Full system access             |
| Staff         | staff@example.com   | staffpassword   | Limited system access          |
| Client        | client@example.com  | password123     | Basic user access              |

## Project Structure

```
backend/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php      # Authentication logic
│   │   └── EmployeeController.php  # Employee CRUD operations
│   └── Models/
│       └── User.php               # User model with roles and methods
├── resources/views/
│   ├── auth/                      # Login and registration forms
│   ├── employees/                 # Employee management views
│   ├── errors/                    # Custom error pages
│   └── layouts/                   # Base layouts with modals
├── database/
│   ├── migrations/                # Database schema
│   └── seeders/                   # Sample data generation
└── tests/
    └── Feature/                   # Comprehensive test suite
```

## API Endpoints

### Authentication Routes
```
GET  /login          - Show login form
POST /login          - Process login
GET  /register       - Show registration form
POST /register       - Process registration
POST /logout         - Logout user
```

### Employee Management Routes (Admin Only)
```
GET    /employees        - List all employees
GET    /employees/create - Show create form
POST   /employees        - Store new employee
GET    /employees/{id}/edit - Show edit form
PUT    /employees/{id}   - Update employee
DELETE /employees/{id}   - Delete employee
```

### General Routes
```
GET  /                  - Welcome page (role-based content)
GET  /users            - User directory (admin only)
```

## Troubleshooting (common issues and fixes)

Below are the most common problems you may see and how to fix them.

1) "No application encryption key has been specified" / 500 error

- Cause: `APP_KEY` is missing or `.env` isn't present/loaded.
- Fix:

```cmd
docker compose exec php sh -lc "php artisan key:generate"
docker compose exec php sh -lc "php artisan config:clear && php artisan cache:clear"
```

2) "Class \"Faker\\Factory\" not found" or factory/seed errors

- Cause: the repository's factories use Faker or other dev packages which are in `require-dev`. If the container image was built with `composer install --no-dev` those packages won't be available.
- Fix: install dev dependencies inside the running container before seeding:

```cmd
docker compose exec php sh -lc "composer install --no-interaction --prefer-dist"
```

Or, for a permanent fix in development, rebuild the image to include dev deps (not recommended for production images):

```cmd
docker compose up --build
```

3) "relation \"cache\" does not exist" when clearing cache

- Cause: cache driver is configured to use the database, but the cache table has not been created.
- Fix: either switch to `file` cache driver in `.env` (CACHEDRIVER=file) or create the cache table and migrate:

```cmd
docker compose exec php sh -lc "php artisan cache:table && php artisan migrate"
```

4) Permission errors for `storage` or `bootstrap/cache`

```cmd
docker compose exec php sh -lc "chmod -R 775 storage bootstrap/cache || true"
docker compose exec php sh -lc "chown -R www-data:www-data storage bootstrap/cache || true"
```

5) Containers fail to start or show 500 immediately after startup

- Steps to debug:
  - Inspect backend logs: `docker compose exec php sh -lc "tail -n 200 storage/logs/laravel.log"`
  - Ensure DB container is healthy and reachable (postgres must report healthy).
  - Re-run `php artisan migrate --force` and the seeders manually to see errors.

6) If `composer` scripts try to copy `.env.example` but it does not exist

- Some workflows expect `.env.example` to be in the repo. If you don't have it, create a minimal `.env` file (at least DB_* + APP_KEY). Example minimal contents:

```text
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:GENERATE_THIS_WITH_KEY_COMMAND
APP_DEBUG=true
APP_URL=http://localhost:8090

DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=app
DB_USERNAME=app
DB_PASSWORD=app
```

Then run `php artisan key:generate` inside the container.

If you want, you can copy a tested `.env` into `backend/.env` before starting Docker. The repository may include a `.env` created during development (check `backend/.env`), but do not commit sensitive values to source control.

If you run into a specific error not listed here, open `backend/storage/logs/laravel.log` and paste the last 50–200 lines when requesting help.