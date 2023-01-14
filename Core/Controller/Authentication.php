<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\User;

class Authentication extends Controller
{
    private $user = null;

    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }

    function __construct()
    {
        $this->admin_view(false);
        if (isset($_SESSION['user'])) {
            Helper::redirect('/dashboard');
        }
    }

    /**
     * Displays login form
     *
     * @return void
     */
    public function login()
    {
        $this->view = 'login';
    }

    /**
     * Login Validation
     *
     * @return void
     */
    public function validate()
    {
        // if user doesn't exists, do not authenticate
        $user = new User();
        $logged_in_user = $user->check_username(\htmlspecialchars($_POST['username']));

        if (!$logged_in_user) {
            $this->invalid_redirect("Invalid Username or Password");
            $_SESSION['error_type'] = "error";
        }

        if (!\password_verify(\htmlspecialchars($_POST['password']), $logged_in_user->password)) {
            $this->invalid_redirect("Invalid Username or Password");
            $_SESSION['error_type'] = "error";
        }



        if (empty($logged_in_user->permissions)) {
            $this->invalid_redirect("You don't have Access to the site");
            $_SESSION['error_type'] = "error";
        }





        if (isset($_POST['remember_me'])) {
            // DO NOT ADD USER ID TO THE COOKIES - SECURITY BREACH!!!!!
            \setcookie('user_id', $logged_in_user->id, time() + (86400 * 30)); // 86400 = 1 day (60*60*24)
        }

        $_SESSION['user'] = array(
            'username' => $logged_in_user->username,
            'display_name' => $logged_in_user->display_name,
            'user_id' => $logged_in_user->id,
            'is_admin_view' => true
        );
        $_SESSION['error_type'] = "success";
        $_SESSION['message'] = 'Logged in successfully';

        $permissions = \unserialize($logged_in_user->permissions);

        $user_online = new User();
        $id_user = $_SESSION['user']['user_id'];
        $sql = "UPDATE users SET status = 'Online' WHERE id = $id_user";
        $user_online->connection->query($sql);

        if (in_array('user:read', $permissions)) {
            Helper::redirect('/dashboard');
            die;
        }
        if (in_array('seller:read', $permissions)) {
            Helper::redirect('/selling/page');
            die;
        }

        if (in_array('item:read', $permissions)) {
            Helper::redirect('/items');
            die;
        }

        if (in_array('account:read', $permissions)) {
            Helper::redirect('/accounts/page');
            die;
        }
    }


    public function logout()
    {

        $user_online = new User();
        $id_user = $_SESSION['user']['user_id'];
        $sql = "UPDATE users SET status = 'offline',last_seen = now() WHERE id = $id_user";
        $user_online->connection->query($sql);

        \session_destroy();
        \session_unset();
        \setcookie('user_id', '', time() - 3600); // destroy the cookie by setting a past expiry date
        Helper::redirect('/login');
    }

    private function invalid_redirect($msg)
    {
        $_SESSION['message'] = $msg;
        Helper::redirect('/login');
        die;
    }
}
