<?php

class AuthController extends BaseController
{
    function __construct()
    {
        parent::__construct();

        $this->users_model = new Users_model();

    }

    function login() {
        if ($this->is_user_authenticated()) {
            $this->redirect('/dashboard');
        }

        if ($this->is_post_request()) {
            $email = $this->post('email');
            $password = $this->post('password');

            $user = $this->users_model->get_user_by_email($email);

            if ($user && md5($password) === $user['password']) {
                // User is authenticated, set user data in session and redirect to dashboard
                $_SESSION['user'] = $user;
                $this->redirect('/dashboard');
            } else {
                // Authentication failed, redirect back to login page with error message
                $this->redirect_with_error('/login', 'Invalid email or password.');
            }
        }
        $this->render('login');
    }

    function logout() {
        // Unset all session variables
        $_SESSION = array();

        // Delete session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Destroy the session
        session_destroy();

        // Redirect to login page
        $this->redirect('/login');
    }


    function is_user_authenticated() {
        return isset($_SESSION['user']);
    }
}

