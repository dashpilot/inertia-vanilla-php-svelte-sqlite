<?php
// bootstrap.php - Updated with session handling
require_once __DIR__ . '/vendor/autoload.php';

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize the database directory if it doesn't exist
if (!file_exists(__DIR__ . '/database')) {
    mkdir(__DIR__ . '/database', 0755, true);
}

// Create Models directory if it doesn't exist
if (!file_exists(__DIR__ . '/src/Models')) {
    mkdir(__DIR__ . '/src/Models', 0755, true);
}

// Create Middleware directory if it doesn't exist
if (!file_exists(__DIR__ . '/src/Middleware')) {
    mkdir(__DIR__ . '/src/Middleware', 0755, true);
}