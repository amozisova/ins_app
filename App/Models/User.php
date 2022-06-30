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
    /*
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }*/

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
     * @param string $tableName  DB table name
     * @param string $query  DB table rows to be fetched
     * @return void
     */
    private function fetchClientData($id, $tableName, $query = '*')
    {
        $sql = 'SELECT ' . $query . ' FROM '.$tableName. ' WHERE client_id = :id';
        
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_NAMED);
        $stmt->execute();
        $userData = $stmt->fetchAll();
        return $userData;
    }

    /*
    private function DBData($sqlOperation, $query = '*', $DBtable, $condition)
    {
        $sql = $sqlOperation . $query . ' FROM '.$DBtable. ' WHERE '.$condition;
               
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        $userData = $stmt->fetch();
        return $userData;
    }
    */

    /**
     * Returns data from database to be viewed
     * calls fetchClientData function
     *
     * @param int $id  user id from current session
     * @param string $tableName  name of the database table
     * @param string $query  DB table rows to be fetched
     * @return void
     */
    public function getClientData($id, $tableName, $query = '*')
    {
        $userData = $this->fetchClientData($id, $tableName, $query);

        return $userData;
    }

    /**
     * Connects to the database and updates clients table
     *
     * @param int $id user id from current session
     * @param string $tableName name of the database table
     * @param string $sqlQuery
     * @return void
     */
    private function updateClientData($id, $tableName, $sqlQuery)
    {
        $sql = 'UPDATE '.$tableName.' SET ' . $sqlQuery . ' WHERE client_id = :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * Sends client data to the database to be updated
     * calls updateClientData function
     *
     * @param int $id user id from current session
     * @param string $tableName name of the database table
     * @param array $formData submitted by user via form
     * @return void
     */
    public function setClientData($id, $tableName, $formData)
    {
        $sqlQuery = $this->formatForSQL($formData);

        $this->updateClientData($id, $tableName, $sqlQuery);
    }

    /**
     * Formats $_POST data to SQL string 
     *
     * @param array $formdata
     * @return string
     */
    private function formatForSQL($formData)
    {
        $queryString = '';
        foreach ($formData as $Key => $Value) {
            $queryString .= $Key . '=' . '\'' . $Value . '\'' . ', ';
        }
        return rtrim($queryString, " ,"); // returns string key='value', key='value' etc.
    }

    /**private function getPassword($userData) {
 $hashedPassword=$userData['password_hash'];
 $getPassword }**/
}
