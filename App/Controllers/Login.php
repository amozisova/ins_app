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

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user->client_id;

            $this->redirect('/');
            // View::renderTemplate('User/index.html', ['name' => $_POST['email'],]);
        } else {

            View::renderTemplate('Login/new.html', ['email' => $_POST['email'],]);
            echo 'Chybné přihlašovací údaje. Zkuste to znovu.';
        }
    }

    /**
     * Log out a user
     *
     * @return void
     */
    public function destroyAction()
    {
        // Unset all of the session variables
        $_SESSION = [];

        // Delete the session cookie
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        // Finally destroy the session
        session_destroy();

        $this->redirect('/');
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