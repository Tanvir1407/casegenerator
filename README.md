# Casablanca Generators

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Prerequisites

Before setting up the project, ensure you have the following installed:

- **PHP 8.2+**
- **Composer**
- **Node.js & NPM**
- **MySQL/MariaDB**

## Installation

1. **Clone the repository:**
   ```bash
   git clone <repository-url>
   cd casagenerators
   ```

2. **Setup the project:**
   Run the automated setup command which handles dependencies, environment configuration, key generation, and migrations (including seeding).
   ```bash
   composer setup
   ```

## Running the Application

To start the development servers (Laravel & Vite) in a single command, run:

```bash
composer dev
```

This will start:
- Laravel Development Server at `http://localhost:8000`
- Vite Development Server at `http://localhost:5173`
- Queue Listener
- Pail (Log Viewer)

## Default Credentials

The database is seeded with a default admin user:

- **Email:** `casa@admin.com`
- **Password:** `casabalanca`

> **Note:** You can access the admin panel at `http://localhost:8000/admin` (FilamentPHP).
