<?php

class CustomersController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->user_model = new Users_model();
        $this->customers_model = new Customers_model();

    }

    function index() {
        $customers = $this->customers_model->get_customers();
        $this->view->render("customers/customers", ['customers' => $customers]);
    }
}