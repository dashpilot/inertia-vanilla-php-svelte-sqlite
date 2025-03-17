# Inertia Blog

A modern blog application built with Inertia.js, Svelte 5, and PHP without any framework dependencies.

## Features

-   **Modern SPA Experience** without the complexity of a traditional SPA setup
-   **No PHP Framework Required** - just vanilla PHP with a router
-   **Svelte 5 Frontend** with latest component patterns
-   **SQLite Database** for simple data persistence
-   **Authentication System** for user management
-   **Clean, Modern Design** inspired by the Inertia.js website

## Setup

```bash
# Download the repository
npx degit https://github.com/dashpilot/inertia-vanilla-php-svelte-sqlite

# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install

# Start the development servers
npm run dev
```

This will start:

-   PHP development server at http://localhost:8000
-   Vite dev server at http://localhost:3000

## Project Structure

```
inertia-blog/
├── composer.json
├── package.json
├── vite.config.js
├── database/
│   └── blog.sqlite
├── public/
│   ├── index.php
│   ├── assets/
│   └── .htaccess
├── resources/
│   ├── js/
│   │   ├── app.js
│   │   ├── Pages/
│   │   │   ├── Home.svelte
│   │   │   ├── Posts/
│   │   │   ├── About.svelte
│   │   │   ├── Contact.svelte
│   │   │   └── Dashboard.svelte
│   │   └── Components/
│   │       ├── Layout.svelte
│   │       └── PostCard.svelte
│   └── views/
│       └── app.php
├── routes/
│   └── web.php
├── src/
│   ├── Inertia.php
│   ├── Database.php
│   ├── Middleware/
│   │   └── Auth.php
│   └── Models/
│       ├── Post.php
│       └── User.php
└── bootstrap.php
```

## How It Works

1. Requests are handled by the PHP server via `routes/web.php`
2. Route handlers use `Inertia::render()` to return data to the client
3. Inertia.js manages the frontend, updating components without full page reloads
4. SQLite database stores blog posts and user accounts
5. Authentication is managed through PHP sessions

## Key Components

-   **Layout.svelte**: Main site layout with navigation and auth handling
-   **Home.svelte**: Landing page with featured content
-   **Posts/**: Blog post listing, creation, editing, and viewing
-   **Dashboard.svelte**: User dashboard with post management
-   **About.svelte & Contact.svelte**: Static information pages

## Why This Approach?

This project demonstrates that you can build modern, reactive web applications without heavy framework dependencies. By combining vanilla PHP with Inertia.js and Svelte, you get:

-   Full control over your code without framework constraints
-   Excellent performance without excessive abstraction layers
-   Simpler debugging with less magic happening behind the scenes
-   A smaller, more focused codebase that's easier to understand

## Default Login

-   Email: admin@example.com
-   Password: admin123
