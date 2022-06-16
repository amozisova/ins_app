<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Models\User;


class Login extends \Core\Controller { 

    /**
     * Log in a user
     *
     * @return void
     */
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
        }
    }

}