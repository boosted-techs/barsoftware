<?php
//namespace Models;
class Users_model extends BaseModel
{

    // Check if user is logged in and return user details
    public function check_login() {
        if (isset($_SESSION['user'])) {
           return $_SESSION['user'];
        }
        header('Location: /login');
        exit;
    }

    // Check if user is a cashier
    public function is_cashier() {
        $user = $this->check_login();
        return $user['role'] === 'cashier';
    }

    // Check if user is a receptionist
    public function is_receptionist() {
        $user = $this->check_login();
        return $user['role'] === 'receptionist';
    }

    // Check if user is an admin
    public function is_admin() {
        $user = $this->check_login();
        return $user['role'] === 'admin';
    }

    public function get_user_by_email($email)
    {
        $this->db->where('email', $email);
        return $this->db->getOne('users');
    }

    function get_all_users($user = false) {
        if ($user)
            $this->db->where("id", $user);

        $this->db->orderBy("id", "desc");
        return $this->db->get("users", null, "
        *, (select count(id) from orders where user_id = users.id) as orders
        ");
    }

    function add_user() {
        //print_r($_POST);
        $names = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $password = trim($_POST['password']);
        $role = $_POST['role'];
        if (empty($names) or empty($email))
            $this->redirect_with_error("/users", "Name or email shouldn't be left blank");
        $this->db->where("email", $email);
        $user = $this->db->getValue("users", 'id');
        if ($user)
            $this->redirect_with_error("/users", "Email address exists");
        else {
            $this->db->insert("users", [
                "name" => $names,
                "email" => $email,
                "phone" => $phone,
                "password" => md5($password),
                "role" => $role,
                "created_at" => date("Y-m-d H:i:s")
            ]);
            $this->redirect_with_error("/users", "{$names} has been added with email {$email} and password {$password}");
        }
    }

    function get_user_by_id($id) {

    }

    function update_user() {
        print_r($_POST);
        $password = trim($_POST['password']);
        $check_box  = isset($_POST['checkbox']);
        $names = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $role = trim($_POST['role']);
        $access = trim($_POST['access']);
        $user = trim($_POST['user']);
        if (empty($names) or empty($email))
            $this->redirect_with_error("/users", "Name or email shouldn't be left blank");
        $data = [
            "name" => $names,
            "email" => $email,
            "phone" => $phone,
            "password" => md5($password),
            "role" => $role,
            "access" => $access
        ];
        $this->db->where("id", $user);
        $this->db->update("users", $data);
        if ($check_box) {
            $this->db->where("user", $user);
            $this->db->update("users", ['password' => md5($password)]);
        }
        $this->redirect_with_error("/users", "{$names} has been modified.");
    }

}