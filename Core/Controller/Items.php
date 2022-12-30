<?php

namespace Core\Controller;

use Core\Model\Item;
use Core\Helpers\Tests;
use Core\Helpers\Helper;
use Core\Base\Controller;

class Items extends Controller
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



    ///
    /**
     * Gets all item
     *
     * @return array
     */
    public function index()
    {
        $this->permissions(['item:read']);
        $this->view = 'items.index';
        $item = new Item; // new model post.
        $this->data['items'] = $item->get_all();
        $this->data['items_count'] = count($item->get_all());
    }

    public function single()
    {
        $this->permissions(['item:read']);
        $this->view = 'items.single';
        $item = new Item();
        $this->data['item'] = $item->get_by_id($_GET['id']);
    }

    /**
     * Display the HTML form for item creation
     *
     * @return void
     */
    public function create()
    {
        $this->permissions(['item:create']);
        $this->view = 'items.create';
    }

    /**
     * Creates new item
     *
     * @return void
     */
    public function store()
    {
        $this->permissions(['item:create']);

        try {

            if (empty($_POST['title'])) {
                    $this->http_code = 421;
                    throw new \Exception('item_name_param_not_found');
            }

            if (empty($_POST['cost'])) {
                    $this->http_code = 422;
                    throw new \Exception('cost_of_item_not_found');
            }

            if (empty($_POST['price'])) {
                    $this->http_code = 423;
                    throw new \Exception('price_of_item_not_found');
            }
            if (empty($_POST['quantity'])) {
                    $this->http_code = 423;
                    throw new \Exception('quantity_of_item_not_found');
            }

        $item = new Item();
        $_POST['user_id'] = $_SESSION['user']['user_id'];
        $_POST['title'] =  \htmlspecialchars($_POST['title']);
        $_POST['cost'] =  \htmlspecialchars($_POST['cost']);
        $_POST['price'] =  \htmlspecialchars($_POST['price']);
        $_POST['quantity'] =  \htmlspecialchars($_POST['quantity']);

        $result = self::check_empty();
        if ($result) {
            $item->create($_POST);
            $_SESSION['error_type'] = "success";
            $_SESSION['message'] = 'Item Created';
            Helper::redirect('/items');
        }
    }catch (\Exception $error) {
                $this->response_schema['success'] = false;
                $this->response_schema['message_code'] = $error->getMessage();
        }
    }

    /**
     * Display the HTML form for item update
     *
     * @return void
     */
    public function edit()
    {
        $this->permissions(['item:read', 'item:update']);
        $this->view = 'items.edit';
        $item = new Item();
        $selected_item = $item->get_by_id($_GET['id']);;
        $this->data['item'] = $selected_item;
    }

    /**
     * Updates the item
     *
     * @return void
     */
    public function update()
    {
        $this->permissions(['item:read', 'item:update']);
        $item = new Item();

        $item_id = $_POST['id'];
        $_POST['title'] =  \htmlspecialchars($_POST['title']);
        $_POST['cost'] =  \htmlspecialchars($_POST['cost']);
        $_POST['price'] =  \htmlspecialchars($_POST['price']);
        $_POST['quantity'] =  \htmlspecialchars($_POST['quantity']);
        $_POST['description'] =  \htmlspecialchars($_POST['description']);
        $item->update($_POST);
        $_SESSION['error_type'] = "success";
        $_SESSION['message'] = 'Item Updated';

        Helper::redirect('/item?id=' . $_POST['id']);
    }

    /**
     * Delete the item
     *
     * @return void
     */
    public function delete()
    {
        $this->permissions(['item:read', 'item:delete']);
        $item = new Item();
        $item->delete($_GET['id']);
        $_SESSION['error_type'] = "success";
        $_SESSION['message'] = 'Item Deleted';
        Helper::redirect('/items');
    }

    public function top()
    {
        $this->view = 'items.top';
        $item = new Item();
        $this->data['items'] = $item->get_top_5();
        $this->data['items_count'] = count($item->get_top_5());
    }
}
