<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User;

/**
 * User controller
 *
 */
class Users extends \Core\Controller
{
    /**
     * Display the User Details page
     *
     * @return void
     */
    public function viewAction()
    {
        $userData = $this->showClientData();

        View::renderTemplate('UserDetails/index.html', (array) $userData);
    }

    /**
     * Display the edit details page
     *
     * @return void
     */
    public function editAction()
    {
        $userData = $this->showClientData();

        View::renderTemplate('UserDetails/edit.html', (array) $userData);
    }

    /**
     * Display the submit details page
     * Submit changes to user's contact details via form
     *
     * @return void
     */
    public function submitAction()
    {
        $this->editClientData($_POST);

        View::renderTemplate('UserDetails/submit.html', (array) $_POST);
    }

    /**
     * Function to display contact details of a user
     * Sends user ID and client data to User model
     *
     * @return void
     */
    private function showClientData()
    {
        $user = new User;
        $id = $_SESSION['user_id'];
        $query = 'name, surname, street, city, zipcode, email, phone';
        $tableName = 'clients';
        $userData = $user->getClientData($id, $tableName, $query);
        return $userData;
    }

    /**
     * Function to edit contact details of a user
     * checks data submitted by user via form and passes them to User model
     *
     * @return void
     */
    private function editClientData()
    {
        $user = new User;
        $id = $_SESSION['user_id'];
        $tableName = 'clients';
        $_POST = array_filter($_POST); //drop empty values

        if (empty($_POST)) {
            return;
        } else {
            $formData = $_POST;
            $user->setClientData($id, $tableName, $formData);
        }
    }

    /**
     * Display the edit details page
     *
     * @return void
     */
    public function editLoginAction()
    {
        $userData = $this->showLoginData();
        //print_r($userData);
        // echo $userData[0]['email'];

        View::renderTemplate('UserDetails/editLogin.html', (array) $userData);
    }

    private function showLoginData()
    {
        $user = new User;
        $id = $_SESSION['user_id'];
        $query = 'email, password_hash';
        $tableName = 'clients';
        $userData = $user->getClientData($id, $tableName, $query);
        return $userData;
    }

    public function submitLoginAction()
    {

        //prepare data for verification
        $dataCheck = $_POST;

        //verify password
        $passwordChecked = $this->verifyLoginData($dataCheck);

        //TESTING//
        print_r($passwordChecked);

        // pass data to View
        View::renderTemplate('UserDetails/submitLogin.html', (array) $_POST);
    }

    private function verifyLoginData($dataCheck)
    {
        $errorMsg = [];

        // print_r($dataCheck);
        /* check if new email was added
        if(!empty($dataCheck['email'])) {
        $email=$dataCheck['email'];
        } else array_push($errorMsg,'Přihlašovací email zůstává stejný.');
        */


        //check if new password was added and typed correctly
        if (empty($dataCheck['newpassword']) || empty($dataCheck['newpassword_repeat'])) {

            if ($dataCheck['newpassword'] !== $dataCheck['newpassword_repeat']) {
                array_push($errorMsg, 'Zadaná hesla se neshodují.');
                return $errorMsg;
            }
            array_push($errorMsg, 'Nové heslo nebylo správně zadáno. Zadejte znovu.');
        } else {

            //check if change was confirmed by old password
            if (empty($dataCheck['password'])) {
                array_push($errorMsg, 'Nebylo zadáno stávající heslo k potvrzení změny.');
                return $errorMsg;
            } else {

                if (!empty($errorMsg)) {
                    return $passwordChecked = $errorMsg;
                } else {
                    //send password to model for verification
                    $user = new User;
                    $id = $_SESSION['user_id'];
                    $tableName = 'clients';
                    $query = 'password_hash';
                    $enteredPswd = $dataCheck['password'];
                    $newPswd=$dataCheck['newpassword'];
                    $passwordChecked = $user->setClientPassword($id, $tableName, $query, $enteredPswd, $newPswd);
                    return $passwordChecked;
                }
            }
        }
    }
}
