# StartupConnect

StartupConnect is a beginner-friendly Laravel full-stack project for listing startup events such as hackathons, meetups, workshops, founder talks, coding contests, internship fairs, webinars, and entrepreneurship seminars.

## Main Features

- User registration, login, logout, session handling, password hashing, and validation.
- Public event listing with search, category filter, and online/offline mode filter.
- Event details page with registration link and bookmark button.
- User dashboard with profile details and bookmarked events.
- Admin panel for event CRUD and category CRUD.
- Event image upload to `public/uploads`.
- Laravel MVC, routes, controllers, models, migrations, Blade templates, middleware, and Eloquent relationships.

## Setup Guide

1. Install XAMPP and start Apache and MySQL.
2. Install Composer and PHP dependencies with `composer install`.
3. Copy `.env.example` to `.env` if `.env` does not exist.
4. Set database values in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=startupconnect
DB_USERNAME=root
DB_PASSWORD=
```

5. Create a MySQL database named `startupconnect` in phpMyAdmin.
6. Generate the app key with `php artisan key:generate`.
7. Run migrations and seed sample data with `php artisan migrate --seed`.
8. Start the project with `php artisan serve`.
9. Open `http://127.0.0.1:8000`.

## Deploy On Render

This project includes a `Dockerfile`, so create a Render Web Service from the GitHub repository and choose Docker as the runtime.

Recommended Render environment variables:

```env
APP_NAME=StartupConnect
APP_ENV=production
APP_KEY=base64:your-generated-laravel-key
APP_DEBUG=false
APP_URL=https://your-service-name.onrender.com
LOG_CHANNEL=stderr
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
RUN_MIGRATIONS=true
RUN_SEEDERS=true
```

Generate `APP_KEY` locally with:

```bash
php artisan key:generate --show
```

The SQLite setup above is enough for a live demo. For a production app with persistent data, replace the `DB_*` values with an external MySQL database and set `RUN_SEEDERS=false` after the first deploy. The real `.env` file is intentionally ignored and should be configured in Render, not committed to GitHub.

## Login Details

Normal users can register from the Register page.

Admin login after seeding:

- Email: `admin@startupconnect.test`
- Password: `password`

The admin check is intentionally simple for college submission: the middleware treats the seeded admin email as the administrator.

## How The Project Works

Routes in `routes/web.php` connect URLs to controller methods. Public routes show the home, about, contact, events list, and event detail pages. Protected routes use `auth` middleware for dashboard and bookmarks. Admin routes use both `auth` and custom `admin` middleware.

Controllers in `app/Http/Controllers` receive requests, validate form data, call models, and return Blade views. For example, `EventController` handles event listing, search, filtering, details, CRUD, and image upload.

Models in `app/Models` connect PHP classes to database tables using Eloquent ORM. `Category` has many `Event` records, `Event` belongs to one `Category`, and `User` belongs to many bookmarked events through the `bookmarks` table.

Migrations in `database/migrations` create the database tables: `users`, `categories`, `events`, and `bookmarks`. Running `php artisan migrate` builds the database structure.

Blade templates in `resources/views` create the frontend. The master layout is `resources/views/layouts/app.blade.php`. Navbar and footer are included from `resources/views/partials`. Pages use `@extends`, `@section`, `@yield`, and `@include`.

CRUD means Create, Read, Update, and Delete. In StartupConnect, admins can create, view, edit, and delete events and categories. Laravel resource routes provide clean URLs for these operations.

The frontend connects to the backend through HTML forms and links. Forms include `@csrf` for security. When a form is submitted, Laravel routes send the data to a controller, the controller validates it, then Eloquent saves it to MySQL.

## Important Files

- `routes/web.php`: all web routes.
- `app/Http/Controllers/EventController.php`: event list, search, filter, details, CRUD, and upload logic.
- `app/Http/Controllers/AuthController.php`: registration, login, and logout.
- `app/Http/Middleware/AdminMiddleware.php`: protects admin pages.
- `app/Models/Event.php`, `Category.php`, `Bookmark.php`, `User.php`: database models and relationships.
- `resources/views`: all Blade templates.
- `public/css/style.css`: simple custom styling.
- `public/uploads`: uploaded event images.
