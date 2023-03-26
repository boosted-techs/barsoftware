<?php

class HomeController extends BaseController
{
    function __construct()
    {
        parent::__construct();

        $this->users_model = new Users_model();

    }

    function index() {
        $this->view->render("login");
    }

    function dashboard() {
        $this->users_model->check_login();
        if ($this->users_model->is_admin())
            $this->view->render("dashboard");
        if ($this->users_model->is_receptionist())
            $this->redirect("/orders");
        if ($this->users_model->is_cashier())
            $this->redirect("/orders");
    }

}