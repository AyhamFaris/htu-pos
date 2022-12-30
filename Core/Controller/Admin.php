<?php

namespace Core\Controller;

use Core\Model\User;
use Core\Base\Controller;
use Core\Model\Item;
use Core\Model\Transaction;

class Admin extends Controller
{
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
     * Undocumented function
     * @return array of data
     * return the all of items from table items
     * return the all of users from table users
     * return the total of quantity items in database
     * return the total price of all transaction from table transactions
     * return The 5 most Expensive Items
     */

    public function index()
    {
        $this->view = 'dashboard';
        $total = 0;
        $user = new User; // new model user.
        $item = new Item; // new model item.
        $transaction = new Transaction; // new model Transaction.
        $items = $item->get_all();
        $top_5_item = $item->get_top_5();
        $top_5_transaction = $transaction->get_top_5();
        $total_quantity=0;
        $transaction = new Transaction();
        $get_all_sales = $transaction->get_all();
        foreach ($get_all_sales as $sales) {
            $total += $sales->total;
        }
        foreach ($items as $item) {
            $total_quantity += $item->quantity;
        }
        $transaction = new Transaction; // new model Transaction.
        $this->data['user_info'] = $user->get_by_id($_SESSION['user']['user_id']);
        $this->data['total_users'] = count($user->get_all());
        $this->data['total_items'] = count($items);
        $this->data['total_sales'] = $total;
        $this->data['total_quantity'] = $total_quantity;
        $this->data['top_item'] = $top_5_item;
        $this->data['top_transaction'] = $top_5_transaction;
    }
}