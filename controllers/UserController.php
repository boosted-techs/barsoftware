<?php

class UserController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->user_model = new Users_model();
    }

    public function index()
    {
        $this->user_model->check_login();
        if (! $this->user_model->is_admin()) {
            echo "Not allowed"; exit;
        }
        $users = $this->user_model->get_all_users();
        $this->render('users/users', array('users' => $users));
    }

    public function create()
    {
        $this->user_model->check_login();
        if (! $this->user_model->is_admin()) {
            echo "Not allowed"; exit;
        }
        $this->user_model->add_user();
    }

    public function store()
    {
        $user_data = array(
            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'password' => $this->post('password')
        );

        $this->user_model->add_user($user_data);

        $this->redirect('/users');
    }

    public function edit()
    {
        $this->user_model->check_login();
        if (! $this->user_model->is_admin()) {
            echo "Not allowed"; exit;
        }
        $this->user_model->update_user();
    }


    public function delete()
    {
        $user_id = $this->post('id');
        $this->user_model->deleteUser($user_id);

        $this->redirect('/users');
    }
}