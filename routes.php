<?php
$routes = array(
    '/' => 'HomeController@index',
    '/dashboard' => 'HomeController@dashboard',
    '/login' => 'AuthController@login',
    '/logout' => 'AuthController@logout',
    '/users' => 'UserController@index',
    '/users/create' => 'UserController@create',
    '/users/store' => 'UserController@store',
    '/users/edit' => 'UserController@edit',
    '/users/update' => 'UserController@update',
    '/users/delete' => 'UserController@delete',
    '/users/:user/orders' => 'OrdersController@user_orders',

    /*
     * Items
     */
    '/items'    => "itemsController@index",
    '/items/add' => "ItemsController@add_item",
    '/items/rooms' => "ItemsController@rooms",
    '/items/save' => "ItemsController@save_item",
    '/items/:item/edit' => "ItemsController@edit_item",
    '/items/edit' => "ItemsController@save_edit",
    '/items/:room/mark-booked' => "itemsController@book",

    /*
     * Orders
     */
    '/orders' => "OrdersController@index",
    '/orders/create' => "OrdersController@create_order",
    '/orders/new' => "OrdersController@new_order",
    '/orders/save' => "OrdersController@save_order",

    '/orders/:order' => 'OrdersController@order',
    '/orders/:order/:action' => "OrdersController@complete_order",

    /*
     * Customers
     */
    '/customers' => "CustomersController@index",
    '/customers/:customer/orders' => 'OrdersController@customer_orders',
);