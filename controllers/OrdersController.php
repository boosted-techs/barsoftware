<?php

class OrdersController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->user_model = new Users_model();
        $this->items_model = new Items_model();
        $this->rooms_model = new Rooms_model();
        $this->orders_model = new Orders_model();
    }

    function index($user = false, $customer = false) {
        $this->user_model->check_login();
        $orders = $this->orders_model->get_orders(user: $user, customer: $customer);
        $this->view->render("orders/orders", ['orders' => $orders]);
    }

    function user_orders($user) {
        $this->user_model->check_login();
        self::index(user: $user);
    }

    function new_order() {
        $this->user_model->check_login();
        if (! $this->user_model->is_admin()) {
            if (! $this->user_model->is_receptionist()) {
                echo "Not allowed";
                exit;
            }
        }
        $orders = $this->rooms_model->get_rooms();
        $items = $this->items_model->get_items();
        $this->view->render("orders/create", ['rooms' => $orders, 'items' => $items]);
    }

    function save_order() {
        $this->orders_model->save_order();
    }

    function order($order) {
        $orders = $this->orders_model->get_orders(order :$order);
        $order_items = $this->orders_model->get_order_items($order);
        $this->view->render("orders/order", ['order' => $orders, 'items' => $order_items]);
    }

    function complete_order($order, $action) {
        $this->user_model->check_login();
        if (! $this->user_model->is_admin()) {
            if (! $this->user_model->is_cashier()) {
                echo "Not allowed";
                exit;
            }
        }
        $this->orders_model->complete_order($order, $action);
        $this->redirect("/orders/" . $order);
    }

    function customer_orders($customer) {
        self::index(customer: $customer);
    }

}