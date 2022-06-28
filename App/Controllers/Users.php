<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * User controller
 *
 */
class Users extends \Core\Controller
{
    /**
     * Show the User Details page
     *
     * @return void
     */
    public function viewAction()
    {
        $userData = $this->showClientData();

        View::renderTemplate('UserDetails/index.html', ['user' => $userData]);
    }

    /**
     * Let user edit their contact details
     *
     * @return void
     */
    public function editAction()
    {
        $userData = $this->showClientData();

        View::renderTemplate('UserDetails/edit.html', ['user' => $userData]);
    }

    /**
     * Let user submit changes to their contact details via form
     *
     * @return void
     */
    public function submitAction()
    {
        $this->editClientData();

        View::renderTemplate('UserDetails/submit.html', ['test' => $_POST]);
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
        $userData = $user->getClientData($id, $query);
        return $userData;
    }

/**
 * Function to edit contact details of a user
 * passes data submitted by user via form to User model
 *
 * @return void
 */
   private function editClientData()
    {
        $user = new User;
        $id = $_SESSION['user_id'];
        $formData = $_POST;
        $user->setClientData($id, $formData);
    }
}
