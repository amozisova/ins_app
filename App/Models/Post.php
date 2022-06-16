<?php

namespace App\Models;

use PDO;
use PDOException;

/**
 * Post model
 */
class Post extends \Core\Model
{
    /**
     * Get all the posts as an associative array
     * 
     * @return array
     */
    public static function getAll()
    {
        try {
            $db = static::getDB();

            $stmt = $db->query('SELECT posts_id, title, content FROM posts ORDER BY date');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
