<?php
// src/Database.php - Updated with users table
namespace App;

class Database {
    private $pdo;
    private static $instance;

    private function __construct() {
        $dbPath = __DIR__ . '/../database/blog.sqlite';
        $this->pdo = new \PDO('sqlite:' . $dbPath);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        
        // Create tables if they don't exist
        $this->initTables();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPdo() {
        return $this->pdo;
    }

    private function initTables() {
        // Create posts table
        $this->pdo->exec('
            CREATE TABLE IF NOT EXISTS posts (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT NOT NULL,
                content TEXT NOT NULL,
                user_id INTEGER,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id)
            )
        ');

        // Create users table
        $this->pdo->exec('
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                email TEXT NOT NULL UNIQUE,
                password TEXT NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ');

        // Check if users table is empty
        $userCount = $this->pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
        if ($userCount == 0) {
            // Add a default admin user
            $stmt = $this->pdo->prepare('
                INSERT INTO users (name, email, password) VALUES (?, ?, ?)
            ');
            // Password: admin123
            $stmt->execute([
                'Admin User', 
                'admin@example.com',
                password_hash('admin123', PASSWORD_DEFAULT)
            ]);
        }

        // Add some sample data if the posts table is empty
        $postCount = $this->pdo->query('SELECT COUNT(*) FROM posts')->fetchColumn();
        if ($postCount == 0) {
            $stmt = $this->pdo->prepare('
                INSERT INTO posts (title, content, user_id) VALUES 
                (?, ?, ?), 
                (?, ?, ?)
            ');
            $stmt->execute([
                'Getting Started with Inertia.js', 
                'Inertia.js is a new approach to building classic server-driven web apps. It allows you to create fully client-side rendered, single-page apps, without the complexity that comes with modern SPAs.',
                1,
                'Using SQLite with PHP',
                'SQLite is a C library that provides a lightweight disk-based database that doesn\'t require a separate server process. It\'s perfect for smaller applications or prototypes.',
                1
            ]);
        }
    }
}