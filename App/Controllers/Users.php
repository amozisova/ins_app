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
        View::renderTemplate('UserDetails/index.html');
        $UserDetails = new User;
        $showData = $UserDetails->getUserDetails($_SESSION['user_id']);
        echo $showData->name;
        echo $showData->surname;
    }

    //funguje, ale je to nešikovné spojení - dořešit


/*
    public function showDataAction() {
        $UserDetails = new User;
        $showData = $UserDetails->getUserDetails($_SESSION['user_id']);
        echo $showData->name;
        echo $showData->surname;
       
    }
*/
}
