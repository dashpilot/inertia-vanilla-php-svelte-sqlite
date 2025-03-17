<?php
// src/Models/User.php
namespace App\Models;

use App\Database;

class User {
    /**
     * Find a user by email
     */
    public static function findByEmail($email) {
        $db = Database::getInstance();
        $stmt = $db->getPdo()->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    /**
     * Find a user by ID
     */
    public static function find($id) {
        $db = Database::getInstance();
        $stmt = $db->getPdo()->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Create a new user
     */
    public static function create($data) {
        $db = Database::getInstance();
        $stmt = $db->getPdo()->prepare('
            INSERT INTO users (name, email, password) 
            VALUES (?, ?, ?)
        ');
        
        $stmt->execute([
            $data['name'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
        
        return $db->getPdo()->lastInsertId();
    }

    /**
     * Attempt to authenticate a user with email and password
     */
    public static function attempt($email, $password) {
        $user = self::findByEmail($email);
        
        if (!$user) {
            return false;
        }
        
        if (password_verify($password, $user['password'])) {
            // Store user in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            return true;
        }
        
        return false;
    }

    /**
     * Get the currently authenticated user
     */
    public static function current() {
        if (isset($_SESSION['user_id'])) {
            return [
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'],
                'email' => $_SESSION['user_email']
            ];
        }
        
        return null;
    }

    /**
     * Check if a user is authenticated
     */
    public static function check() {
        return isset($_SESSION['user_id']);
    }

    /**
     * Log out the current user
     */
    public static function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        return true;
    }
}