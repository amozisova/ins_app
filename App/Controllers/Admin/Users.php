<?php

namespace App\Controllers\Admin;

use \Core\View;
/**
 * User admin controller
 */

class Users extends \Core\Controller
{
    /**
     * Before filter
     *
     *@return void
     */
    protected function before()
    {
        //Make sure an admin user is logged in for example
        //return false;
    }

    /**
     * Display the index page
     * 
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('User/index.html');
    }
}
