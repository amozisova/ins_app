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
  
        $user = new User;
        $query='name, surname, street, city, zipcode, email, phone';
        $userData = $user->getUserDetails($_SESSION['user_id'],$query);
    
        View::renderTemplate('UserDetails/index.html', ['user' => $userData]);
        //print_r($userData); //je to array
        //echo $showData['street'];
    
    }

    public function editAction()
    {
        View::renderTemplate('UserDetails/edit.html');

    
    }

    public function submitAction()
    {
        View::renderTemplate('UserDetails/edit.html');

    
    }


/*
    public function showDataAction() {
        $UserDetails = new User;
        $showData = $UserDetails->showUserDetails($_SESSION['user_id']);
        echo $showData->name;
        echo $showData->surname;
       
    }
*/
}
