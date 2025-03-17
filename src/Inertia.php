<?php
// src/Inertia.php - Updated to share auth data
namespace App;

use App\Middleware\Auth;

class Inertia
{
    public static function render($component, $props = [])
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Merge auth data into the props
        $props = array_merge($props, Auth::share());
        
        $page = [
            'component' => $component,
            'props' => $props,
            'url' => $_SERVER['REQUEST_URI'],
            'version' => self::getVersion(),
        ];

        if (self::isInertiaRequest()) {
            // Set the X-Inertia header for Inertia requests
            header('X-Inertia: true');
            header('Content-Type: application/json');
            echo json_encode($page);
            exit;
        }

        return self::renderServerSideApp($page);
    }

    private static function isInertiaRequest()
    {
        return isset($_SERVER['HTTP_X_INERTIA']) && $_SERVER['HTTP_X_INERTIA'] === 'true';
    }

    private static function renderServerSideApp($page)
    {
        $jsonPage = htmlspecialchars(json_encode($page), ENT_QUOTES, 'UTF-8');
        
        ob_start();
        include __DIR__ . '/../resources/views/app.php';
        return ob_get_clean();
    }

    private static function getVersion()
    {
        // Simple versioning - use file modification time
        $jsPath = __DIR__ . '/../public/assets/app.js';
        return file_exists($jsPath) ? filemtime($jsPath) : '1.0.0';
    }
}