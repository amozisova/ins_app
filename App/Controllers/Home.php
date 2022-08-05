<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 */

class Home extends \Core\Controller
{
    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Home/index.html');
    }
}