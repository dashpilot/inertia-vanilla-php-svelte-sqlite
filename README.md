# Inertia for Vanilla PHP with Svelte 5

A lightweight implementation of Inertia.js v2 with plain PHP and Svelte 5. No frameworks required.

This version uses Svelte, but there's also a [Vue version](https://github.com/dashpilot/inertia-vanilla-php)

## Why?

Modern PHP comes with many powerful features built-in:

-   Database connections with PDO
-   Session handling
-   File system operations
-   Array functions and more

This project leverages these capabilities while adding just what you need to build modern SPAs:

-   **Simple but powerful** - Just PHP, a router, and Inertia.js
-   **No framework overhead** - Use PHP's built-in features directly
-   **Modern UX** - SPA-like experience without building a separate API
-   **Lightweight** - Understand your entire codebase without framework complexity
-   **Svelte 5 Ready** - Uses the latest Svelte 5 with Inertia.js v2

## Installation

```bash
# Clone the repository using degit (no git history)
npx degit dashpilot/inertia-vanilla-php-svelte my-project

# Navigate to project directory and install dependencies
cd my-project
composer install
npm install
```

## Usage

### Development

Run both the Vite dev server and PHP server concurrently:

```bash
# Start both servers with a single command
npm run dev
```

This will start:

-   PHP development server at http://localhost:8000
-   Vite dev server (for assets) at http://localhost:3000

Always access your app through http://localhost:8000

### Production

Build your assets for production:

```bash
# Build optimized assets
npm run build
```

Then deploy your application to your production server. In production, all assets are served directly from the `public/assets` directory.

## How It Works

1. Use the PHP router to define routes
2. Return page data with `Inertia::render('PageName', ['prop' => 'value'])`
3. Inertia.js handles client-side page transitions, history, and state

## Svelte 5 Implementation

This implementation is specifically configured to work with Svelte 5 and Inertia.js v2, using:

-   The new component initialization approach with `mount` from Svelte
-   Modern Inertia directives like `use:inertia` for links
-   Proper TypeScript support (optional)
-   Full hot module replacement (HMR) for development

## Backend PHP Structure

The PHP backend remains simple and focused:

-   A router for defining server routes
-   An Inertia adapter class for rendering pages
-   Your page controllers/handlers
-   Built-in PHP features for everything else

Enjoy the simplicity of vanilla PHP with the power of modern frontend tooling!
