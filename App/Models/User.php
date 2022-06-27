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
    //public $errors = []; // v řešenní !!!

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

    /**
     * Connects to database and fetch data from the clients table
     *
     * @param int $id  ID number of client
     * @param string $query  DB table rows to be fetched
     * @return void
     */
    private function fetchUserDetails($id, $query = '*')
    {
        $sql = 'SELECT ' . $query . ' FROM clients WHERE client_id = :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        $userData = $stmt->fetch();
        return $userData;
    }

    /**
     * returns data from database to be viewed
     *
     * @param int $id  ID number of client
     * @param string $query  DB table rows to be fetched
     * @return void
     */
    public function getUserDetails($id, $query = '*')
    {
        $userData = $this->fetchUserDetails($id, $query);

        return (array)$userData;
    }
    /**private function getPassword($userData) {
    $hashedPassword=$userData['password_hash'];
    $getPassword
}**/
}
