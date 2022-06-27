<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * User controller
 *
 */
class Insurances extends \Core\Controller
{

    /**
     * Show the User Details page
     *
     * @return void
     */
    public function viewAction()
    {
        View::renderTemplate('Insurance/index.html');
    }
}