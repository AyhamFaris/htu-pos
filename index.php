<?php
session_start();

use Core\Router;
use Core\Model\User;
use Core\Helpers\Fake;

require_once 'vendor/autoload.php';

error_reporting(E_ALL ^ E_NOTICE);

spl_autoload_register(function ($class_name) {
    if (strpos($class_name, 'Core') === false)
        return;
    $class_name = str_replace("\\", '/', $class_name); // \\ = \
    $file_path = __DIR__ . "/" . $class_name . ".php";
    require_once $file_path;
});

if (isset($_COOKIE['user_id']) && !isset($_SESSION['user'])) { // check if there is user_id cookie.
    // log in the user automatically
    $user = new User(); // get the user model
    $logged_in_user = $user->get_by_id($_COOKIE['user_id']); // get the user by id
    $_SESSION['user'] = array( // set up the user session that idecates that the user is logged in. 
        'username' => $logged_in_user->username,
        'display_name' => $logged_in_user->display_name,
        'user_id' => $logged_in_user->id,
        'is_admin_view' => true
    );
}

// For web administrators
Router::get('/login', "authentication.login"); // Displays the login form (HTML)
Router::get('/logout', "authentication.logout"); // Logs the user out
Router::post('/authenticate', "authentication.validate"); // Validation the login user

// athenticated
Router::get('/dashboard', "admin.index"); // Displays the admin dashboard

//user
Router::get('/users', "users.index"); // list of users (HTML)
Router::get('/user/profile', "users.profile"); // user profile (HTML)
Router::get('/user', "users.single"); // Displays single user (HTML)
Router::get('/users/create', "users.create"); // Display the creation form (HTML)
Router::post('/users/store', "users.store"); // Creates the users (PHP)
Router::get('/users/edit', "users.edit"); // Display the edit form (HTML)
Router::post('/users/update', "users.update"); // Updates the users (PHP)
Router::get('/users/delete', "users.delete"); // Delete the user (PHP)
Router::get('/users/edit_profile', "users.edit_profile"); // Display the edit form (HTML)
Router::post('/user/up_pro', "users.update_profile"); // Updates the user profile (PHP)
Router::post('/users/update_img', "users.update_img"); // Updates the img user (PHP)


//item
Router::get('/items', "items.index"); // list of items (HTML)
Router::get('/item', "items.single"); // Displays single item (HTML)
Router::get('/items/create', "items.create"); // Display the creation form (HTML)
Router::post('/items/store', "items.store"); // Creates the items (PHP)
Router::get('/items/edit', "items.edit"); // Display the edit form (HTML)
Router::post('/items/update', "items.update"); // Updates the items (PHP)
Router::get('/items/delete', "items.delete"); // Delete the item (PHP)

// api selling requests
Router::post('/api/item', 'selling.items_by_id');
Router::get('/api/items', 'selling.items');
Router::get('/api/selling', 'selling.index');
Router::post('/api/selling/create', 'selling.selling_create');
Router::post('/api/selling/delete', 'selling.selling_delete');


//transaction
Router::get('/selling/page', 'transactions.view_ajax');
Router::get('/transactions/edit', 'transactions.transaction_edit');
Router::post('/transactions/update', 'transactions.transaction_update');

//account
Router::get('/accounts/page', 'accounts.index');
Router::get('/account/edit', 'accounts.edit');
Router::post('/account/update', 'accounts.update');
Router::get('/account/delete', 'accounts.delete');
Router::redirect();
