<?php
// src/Models/Post.php - Updated to support filtering by user
namespace App\Models;

use App\Database;

class Post {
    /**
     * Get all posts ordered by most recent first
     */
    public static function all() {
        $db = Database::getInstance();
        $stmt = $db->getPdo()->query('
            SELECT posts.*, users.name as author_name 
            FROM posts 
            LEFT JOIN users ON posts.user_id = users.id 
            ORDER BY posts.created_at DESC
        ');
        return $stmt->fetchAll();
    }

    /**
     * Find a post by its ID
     */
    public static function find($id) {
        $db = Database::getInstance();
        $stmt = $db->getPdo()->prepare('
            SELECT posts.*, users.name as author_name 
            FROM posts 
            LEFT JOIN users ON posts.user_id = users.id 
            WHERE posts.id = ?
        ');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Filter posts by a condition
     */
    public static function where($column, $value) {
        $db = Database::getInstance();
        $stmt = $db->getPdo()->prepare("
            SELECT posts.*, users.name as author_name 
            FROM posts 
            LEFT JOIN users ON posts.user_id = users.id 
            WHERE posts.{$column} = ? 
            ORDER BY posts.created_at DESC
        ");
        $stmt->execute([$value]);
        return $stmt->fetchAll();
    }

    /**
     * Create a new post
     */
    public static function create($data) {
        $db = Database::getInstance();
        $stmt = $db->getPdo()->prepare('
            INSERT INTO posts (title, content, user_id) 
            VALUES (?, ?, ?)
        ');
        
        $userId = isset($data['user_id']) ? $data['user_id'] : null;
        
        $stmt->execute([
            $data['title'], 
            $data['content'],
            $userId
        ]);
        
        return $db->getPdo()->lastInsertId();
    }

    /**
     * Update an existing post
     */
    public static function update($id, $data) {
        $db = Database::getInstance();
        
        // Check if we need to update user_id
        if (isset($data['user_id'])) {
            $stmt = $db->getPdo()->prepare('
                UPDATE posts 
                SET title = ?, content = ?, user_id = ? 
                WHERE id = ?
            ');
            
            return $stmt->execute([
                $data['title'], 
                $data['content'],
                $data['user_id'],
                $id
            ]);
        } else {
            $stmt = $db->getPdo()->prepare('
                UPDATE posts 
                SET title = ?, content = ? 
                WHERE id = ?
            ');
            
            return $stmt->execute([
                $data['title'], 
                $data['content'],
                $id
            ]);
        }
    }

    /**
     * Delete a post
     */
    public static function delete($id) {
        $db = Database::getInstance();
        $stmt = $db->getPdo()->prepare('DELETE FROM posts WHERE id = ?');
        return $stmt->execute([$id]);
    }
}