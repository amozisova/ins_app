<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Login controller
 *
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
     * Log in a user
     * Checks data submitted via login form 
     * if verified, logins user
     * 
     * @return void
     */
    public function loginAction()
    {
        $submittedData = new User;
        $user = $submittedData->checkLogin($_POST['email'], $_POST['password']);
        $loginError='';
        if ($user) {

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user->client_id;
            $_SESSION['name'] = $user->name;
            $_SESSION['surname'] = $user->surname;

            $this->redirect('/');
     
        } else {
            $loginError='Chybné přihlašovací údaje. Zkuste to znovu.';
            View::renderTemplate('Home/index.html', ['email' => $_POST['email'],'loginError' => $loginError]);

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