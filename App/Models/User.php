<?php

namespace App\Models;

use PDO;

/**
 * User model
 */
class User extends \Core\Model
{
    /**
     * Error messages
     * @var array
     */
    //public $errors = [];

    /**
     * Class constructor
     * @param array $data  Initial property values (optional)
     * @return void
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    /**
     * Find a user model by email address
     * @param string $email email address to search for
     * @return mixed User object if found, false otherwise
     */
    public function findByEmail($email)
    {
        $sql = 'SELECT * FROM clients WHERE email = :email';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Authenticate login of user
     * @param string $email
     * @param string $password
     * @return mixed $user The user object or false if authentication fails
     */
    public function checkLogin($email, $password)
    {
        $user = $this->findByEmail($email);

        if ($user) {
            if (password_verify($password, $user->password_hash)) {
                return $user;
            } //else return $this->errors='Chybně zadaný email.';
        }

        return false;
    }

public function getUserName(){

}


}
/**
 * Find a user model by ID
 *
 * @param string $id The user ID
 *
 * @return mixed User object if found, false otherwise
 
 public static function findByID($id)
 {
 $sql = 'SELECT * FROM clients WHERE id = :id';
 $db = static::getDB();
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':id', $id, PDO::PARAM_INT);
 $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
 $stmt->execute();
 return $stmt->fetch();
 
 }
 */
