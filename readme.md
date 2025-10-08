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

## Quick Start (Docker)

Run the development stack and the app (rebuild if needed):

```cmd
docker compose up --watch
```

Run Presentation:

```cmd
docker compose up
```

- Run migrations:
```cmd
docker compose exec php sh -lc "php artisan migrate"
```

- Run seeders:
```cmd
docker compose exec php sh -lc "php artisan db:seed"
```

- Reset database with fresh data:
```cmd
docker compose exec php sh -lc "php artisan migrate:fresh --seed"
```

- Run tests:
```cmd
docker compose exec php sh -lc "php artisan test"
```

- Clear caches:
```cmd
docker compose exec php sh -lc "php artisan cache:clear && php artisan view:clear && php artisan config:clear"
```

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

## Troubleshooting

### Permission Errors
If you encounter file permission errors like "Permission denied" for storage directories:

```cmd
docker compose exec php sh -lc "chmod -R 775 storage bootstrap/cache"
docker compose exec php sh -lc "chown -R www-data:www-data storage bootstrap/cache"
```

### Clear Caches
If you're seeing stale data or view compilation errors:

```cmd
docker compose exec php sh -lc "php artisan cache:clear && php artisan view:clear && php artisan config:clear"
```

### Database Issues
If you need to reset the database completely:

```cmd
docker compose exec php sh -lc "php artisan migrate:fresh --seed"
```

### Container Issues
If the containers aren't working properly:

```cmd
docker compose down
docker compose up --build
```

### Access Application
- **Main Application**: http://localhost:8090
- **Database Admin (pgAdmin)**: http://localhost:8091
  - Email: admin@admin.com
  - Password: admin

### Common Issues

1. **500 Internal Server Error**: Usually permissions issue, run the permission fix commands above
2. **CSRF Token Mismatch**: Clear browser cookies and try again
3. **Database Connection Error**: Ensure PostgreSQL container is running
4. **View Not Found**: Run `php artisan view:clear` to clear compiled views