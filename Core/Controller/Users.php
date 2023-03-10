<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Helpers\Tests;
use Core\Model\User;

class Users extends Controller
{
        use Tests;
        public function render()
        {
                if (!empty($this->view))
                        $this->view();
        }

        function __construct()
        {
                $this->auth();
                $this->admin_view(true);
        }

        /**
         * Gets all users
         *
         * @return array
         */
        public function index()
        {
                $this->permissions(['user:read']);
                $this->view = 'users.index';
                $user = new User; // new model User.
                $this->data['users'] = $user->get_all();
                $this->data['users_count'] = count($user->get_all());
        }

        /**
         * return each user 
         */

        public function single()
        {
                $this->permissions(['user:read']);
                $this->view = 'users.single';
                $user = new User();
                $this->data['user'] = $user->get_by_id($_GET['id']);
        }

        /**
         * Display the HTML form for user creation
         *
         * @return void
         */
        public function create()
        {
                $this->permissions(['user:create']);
                $this->view = 'users.create';
        }

        /**
         * Creates new post
         *
         * @return void
         */
        public function store()
        {
                $this->permissions(['user:create']);

        


                        if (empty($_POST['username'])) {

                                $_SESSION['error_type'] = "error";
                                $_SESSION['message'] = 'username_param_not_found';
                                Helper::redirect('/users/create');
                        }

                        if (empty($_POST['display_name'])) {

                                $_SESSION['error_type'] = "error";
                                $_SESSION['message'] = 'display_name_param_not_found';
                                Helper::redirect('/users/create');
                        }

                        if (empty($_POST['email'])) {

                                $_SESSION['error_type'] = "error";
                                $_SESSION['message'] = 'email_param_not_found';
                                Helper::redirect('/users/create');
                        }
                        if (empty($_POST['password'])) {

                                $_SESSION['error_type'] = "error";
                                $_SESSION['message'] = 'password_param_not_found';
                                Helper::redirect('/users/create');
                        }



                        $user = new User();
                        $_POST['username'] =  \htmlspecialchars($_POST['username']);
                        $_POST['display_name'] =  \htmlspecialchars($_POST['display_name']);
                        $_POST['email'] =  \htmlspecialchars($_POST['email']);

                        $permissions = null;
                        switch ($_POST['role']) {
                                case 'admin':
                                        $permissions = User::ADMIN;
                                        break;

                                case 'procurement':
                                        $permissions = User::PROCUREMENT;
                                        break;

                                case 'seller':
                                        $permissions = User::SELLER;
                                        break;

                                case 'account':
                                        $permissions = User::ACCOUNT;
                                        break;
                        }
                        unset($_POST['role']);
                        $_POST['permissions'] = \serialize($permissions);

                        $result = self::check_empty_user();
                        if ($result) {
                                $_POST['password'] = \password_hash($_POST['password'], \PASSWORD_DEFAULT);
                                $user->create($_POST);
                                $_SESSION['error_type'] = "success";
                                $_SESSION['message'] = 'user Created';
                                Helper::redirect('/users');
                        }
               
        }

        /**
         * Display the HTML form for user update
         *
         * @return void
         */
        public function edit()
        {
                $this->permissions(['user:read', 'user:update']);
                $this->view = 'users.edit';
                $user = new User();
                $this->data['user'] = $user->get_by_id($_GET['id']);
        }

        /**
         * Updates the user
         *
         * @return void
         */
        public function update()
        {
                $this->permissions(['user:read', 'user:update']);
                $user = new User();
                $user_info = $user->get_by_id($_POST['id']);

                $permissions = null;
                switch ($_POST['role']) {
                        case 'admin':
                                $permissions = User::ADMIN;
                                break;

                        case 'procurement':
                                $permissions = User::PROCUREMENT;
                                break;

                        case 'seller':
                                $permissions = User::SELLER;
                                break;

                        case 'account':
                                $permissions = User::ACCOUNT;
                                break;
                }
                unset($_POST['role']);
                $_POST['permissions'] = \serialize($permissions);
                $password_new = empty($_POST['new-password']) ? NULL : \password_hash($_POST['new-password'], \PASSWORD_DEFAULT);
                $_POST['password'] = empty($_POST['new-password']) ? $user_info->password : $password_new;
                unset($_POST['new-password']);

                if (empty($_POST['username'])) {

                        $_SESSION['error_type'] = "error";
                        $_SESSION['message'] = 'username_param_not_found';
                        Helper::redirect('/users/edit?id='.$_POST['id']);
                        die();
                }

                if (empty($_POST['display_name'])) {

                        $_SESSION['error_type'] = "error";
                        $_SESSION['message'] = 'display_name_param_not_found';
                        Helper::redirect('/users/edit?id='.$_POST['id']);
                        die();
                }

                if (empty($_POST['email'])) {

                        $_SESSION['error_type'] = "error";
                        $_SESSION['message'] = 'email_param_not_found';
                        Helper::redirect('/users/edit?id='.$_POST['id']);
                        die();
                }
                if (empty($_POST['password'])) {

                        $_SESSION['error_type'] = "error";
                        $_SESSION['message'] = 'password_param_not_found';
                        Helper::redirect('/users/edit?id='.$_POST['id']);
                        die();
                }

                $user->update($_POST);
                $_SESSION['error_type'] = "success";
                $_SESSION['message'] = 'user updated';
                Helper::redirect('/user?id=' . $_POST['id']);
        }

        /**
         * Updates the img user
         */

        public function update_img()
        {
                if (!empty($_FILES)) {
                        $targetDir =  "./resources/Images/";
                        $fileName = basename($_FILES["upload"]["name"]);

                        $user = new User;

                        move_uploaded_file($_FILES['upload']['tmp_name'],  $targetDir . $fileName);
                        if (!empty($fileName)) {
                                $user_id = $_SESSION['user']['user_id'];
                                $sql = "UPDATE users SET img='$fileName' WHERE id=$user_id";
                                $user->connection->query($sql);
                                $_SESSION['error_type'] = "success";
                                $_SESSION['message'] = 'img user updated';
                                Helper::redirect('/user/profile');
                        } else {

                                $_SESSION['error_type'] = "success";
                                $_SESSION['message'] = 'img user updated';
                                Helper::redirect('/user/profile');
                        }
                }
        }

        /**
         * Delete the user
         *
         * @return void
         */
        public function delete()
        {
                $this->permissions(['user:read', 'user:delete']);
                $user = new User();
                $user->delete($_GET['id']);
                $_SESSION['error_type'] = "success";
                $_SESSION['message'] = 'user deleted';
                Helper::redirect('/users');
        }

        /**
         * Display the HTML form user profile
         */

        public function profile()
        {
                $this->view = 'users.user-profile';
                $user = new User();
                $selected_user = $user->get_by_id($_SESSION['user']['user_id']);
                $this->data['info'] = $selected_user;
                $date_create = new \DateTime($selected_user->created_at);
                $date_update = new \DateTime($selected_user->updated_at);
                $selected_user->created_at = $date_create->format('d/m/Y');
                $selected_user->updated_at = $date_update->format('d/m/Y');
        }

        /**
         * Display the HTML form for user_profile update
         */

        public function edit_profile()
        {
                $this->view = 'users.edit_profile';
                $user = new User();
                $this->data['info'] = $user->get_by_id($_GET['id']);
        }

        /**
         * Updates the user_profile
         */

        public function update_profile()
        {
                $user = new User();
                $user_info = $user->get_by_id($_POST['id']);
                $_POST['username'] =  \htmlspecialchars($_POST['username']);
                $_POST['display_name'] =  \htmlspecialchars($_POST['display_name']);
                $_POST['email'] =  \htmlspecialchars($_POST['email']);
                $password_new = empty($_POST['new-password']) ? NULL : \password_hash($_POST['new-password'], \PASSWORD_DEFAULT);
                $_POST['password'] = empty($_POST['new-password']) ? $user_info->password : $password_new;
                unset($_POST['new-password']);
                $user->update($_POST);
                $_SESSION['error_type'] = "success";
                $_SESSION['message'] = 'user updated';
                Helper::redirect('/user/profile?id=' . $_POST['id']);
        }
}