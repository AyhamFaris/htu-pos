<?php

namespace Core\Controller;

use Core\Helpers\Helper;
use Core\Base\Controller;
use Core\Model\Item;
use Core\Model\Transaction;


class Transactions extends Controller
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


    public function view_ajax()
    {
        $this->view = 'transactions.index';
    }

    /**
     * Display the HTML form for transaction update
     */

    public function transaction_edit()
    {
        
        $this->view = 'transactions.edit';
        $transaction = new Transaction();
        // $selected_transaction = $transaction->get_by_id($_GET['id']);

        $stmt = $transaction->connection->prepare("SELECT transactions.* ,items.title as name_item FROM `transactions` INNER JOIN items on items.id = transactions.item_id WHERE transactions.id = ?");
        $stmt->bind_param('i', $_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $res = $result->fetch_object();

        $this->data['transaction'] = $res;
    }

    /**
    * Updates the transaction
    */

    // Check if the post quantity more than quantity current in table item 
    // $quantity_transaction The current quantity in transaction table
    // $quantity_item The current quantity in item table
    // $post_quantity The Post updated quantity item
    // $result_differance_quantity = $post_quantity - $quantity transcation
    // if result_deffirance_quantity > $quantity_item => error The $post_quantity more than item in database

    public function transaction_update()
    {
        $transaction = new Transaction();
        $selected_transaction = $transaction->get_by_id($_POST['id']);

        $item = new Item();
        $selected_item = $item->get_by_id($_POST['item_id']);

        $id_transaction = $_POST['id'];
        $id_item = $_POST['item_id'];
        $post_quantity = $_POST['quantity'];
        $quantity_transaction = $selected_transaction->quantity;
        $quantity_item = $selected_item->quantity;

        $result_quantity = 0;
        $item_final = 0;

        if ($post_quantity == "") {
            $_SESSION['message'] = "The Transaction is updated";
            $_SESSION['error_type'] = "success";
            Helper::redirect('/selling/page');
            die;
        }
        $price_total = $selected_item->price * $post_quantity;

        if ($quantity_item != 0) {

            if ($post_quantity > $quantity_transaction) {
                // 2 - 3  = // Item Qauntity +

                $result_quantity = $post_quantity - $quantity_transaction;
                $item_final = $quantity_item - $result_quantity;
            }
        } else {
            $_SESSION['message'] = "The Item is Empty";
            $_SESSION['error_type'] = "error";
            Helper::redirect('/selling/page');
        }
        $result_differance_quantity = $post_quantity - $quantity_transaction;
        if ($result_differance_quantity > $quantity_item) {
            $_SESSION['message'] = "item quantity in stock not enogh";
            $_SESSION['error_type'] = "error";
            Helper::redirect('/selling/page');
            die;
        }


        if ($post_quantity < $quantity_transaction) {
            // 2 - 3  = // Item Qauntity +

            $result_quantity = $quantity_transaction - $post_quantity;
            $item_final = $result_quantity + $quantity_item;
        }

        $stmt = $item->connection->prepare("UPDATE items SET quantity = ? WHERE id = ?");
        $stmt->bind_param('ii',$item_final,$id_item);
        $stmt->execute();
        $stmt->close();



        $stmt_transaction = $transaction->connection->prepare("UPDATE transactions SET quantity = ?,total = ? WHERE id = ?");
        $stmt_transaction->bind_param('iii',$post_quantity,$price_total,$id_transaction);
        $stmt_transaction->execute();
        $stmt_transaction->close();

        $_SESSION['message'] = "The Transaction is updated";
        $_SESSION['error_type'] = "success";
        Helper::redirect('/selling/page');
    }

    
}
