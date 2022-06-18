<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Login controller
 *
 * PHP version 7.0
 */
class Login extends \Core\Controller
{

    /**
     * Show the login page
     *
     * @return void
     */
    public function newAction()
    {
        View::renderTemplate('Login/new.html');
    }

    /**
     *  checks data submitted via login form 
     *  if verified, logins user
     * 
     */
    public function loginAction()
    {
        $submittedData = new User;
        $user = $submittedData->checkLogin($_POST['email'], $_POST['password']);

        if ($user) {

            $_SESSION['user_id'] = $user->id;

            $this->redirect('/');
            // View::renderTemplate('User/index.html', ['name' => $_POST['email'],]);
        } else {

            View::renderTemplate('Login/new.html', ['email' => $_POST['email'],]);
            echo 'Chybné přihlašovací údaje. Zkuste to znovu.';
        }
    }
}

 /*
    public function createAction()
    {
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