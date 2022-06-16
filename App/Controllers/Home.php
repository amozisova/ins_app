<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Models\User;

/**
 * Home controller
 */

class Home extends \Core\Controller
{

    /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {
        echo "(before) ";
        //return false;
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {
        echo " (after)";
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Home/index.html', [
            'name' => 'Dave', 'colours' => ['red', 'green', 'blue']
        ]);
    }


    /**
     *  funguje; dále rozpracovat
     * 
     */

    public function loginAction()
    {
        $user = User::checkLogin($_POST['email'], $_POST['password']);

        if($user) {
            echo "Funguje. Údaje sedí.";
        } else echo 'Nefunguje.';
    }
}

/**
 * 
 */
/*
    public function loginAction()
    {
        
    $userlogin = $_POST['email'];
    $userpswd= $_POST['password'];

    echo ('přihlášení'.$userlogin.$userpswd);

    }
*/

/*
public function loginAction() {
    $user = User::authenticate($_POST['email'], $_POST['password']);

    if ($user) {

        Auth::login($user);

        $this->redirect(Auth::getReturnToPage());

    } else {

        View::renderTemplate('Home/index.html', [
            'email' => $_POST['email'],
        ]);

        echo ('Chyba přihlášení!'); //tbd
    }
}
*/
