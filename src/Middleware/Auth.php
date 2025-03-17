<?php
// src/Middleware/Auth.php
namespace App\Middleware;

use App\Models\User;

class Auth {
    /**
     * Check if the user is authenticated
     * Redirect to login if not
     */
    public static function handle() {
        if (!User::check()) {
            header('Location: /login');
            exit;
        }
    }

    /**
     * Check if the user is a guest (not authenticated)
     * Redirect to dashboard if authenticated
     */
    public static function guest() {
        if (User::check()) {
            header('Location: /dashboard');
            exit;
        }
    }

    /**
     * Share the auth information with all Inertia responses
     */
    public static function share() {
        return [
            'auth' => [
                'user' => User::current()
            ]
        ];
    }
}