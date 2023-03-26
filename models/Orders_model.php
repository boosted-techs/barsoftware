<?php

class Orders_model extends BaseModel
{
    function __construct()
    {
        parent::__construct();
        $this->customers_model = new Customers_model();
        $this->rooms_model = new Rooms_model();
    }

    function get_orders($order = false, $user = false, $customer = false): MysqliDb|array|string
    {
        $query = "
                id,
        (SELECT name FROM customers WHERE id = orders.customer_id) AS customer,
        (SELECT name FROM users WHERE id = orders.user_id) AS user,
        order_type,
        status,
        created_at
            
";
        if ($order)
            $this->db->where("id", $order);
        if ($user)
            $this->db->where("user_id", $user);
        if ($customer)
            $this->db->where("customer_id", $customer);

        $this->db->orderBy("id", "desc");
        $result = $this->db->get("orders",null, $query);
        $i = 0;
        foreach ($result as $row) {
            $result[$i]['amount'] = self::get_items_summation($row['id'], $row['order_type']);
            $i++;
        }

        return $result;

    }

    function get_items_summation($order, $type) {
        $this->db->where("order_id", $order);
        if ($type == 'bar')
            $this->db->join("items", 'items.id = order_items.item_id', 'left');
        else
            $this->db->join("rooms", 'rooms.id = order_items.item_id', 'left');
        return $this->db->getValue("order_items", "sum(price * quantity)");
    }

    function get_order_items($order) {
        return $this->db->rawQuery("
            SELECT oi.id AS order_id,
            CASE WHEN o.order_type = 'bar' THEN i.name ELSE r.room_number END AS item_name, oi.quantity,
            CASE WHEN o.order_type = 'bar' THEN i.price ELSE r.price END AS price,
            CASE WHEN o.order_type = 'bar' THEN i.status ELSE r.status END AS status
            FROM order_items oi
            JOIN orders o ON oi.order_id = o.id
            LEFT JOIN items i ON oi.item_id = i.id AND o.order_type = 'bar'
            LEFT JOIN rooms r ON oi.item_id = r.id AND o.order_type = 'room'
            where oi.order_id = '$order'
            order by item_name asc
        ");

    }

    function save_order() {
        $rooms = isset($_POST['rooms']) ? $_POST['rooms'] : '';
        $items = isset($_POST['items']) ? $_POST['items'] : '';
        $qty = isset($_POST['qty']) ? $_POST['qty'] : '';
        $customer = [
            "name" => trim($_POST['names']),
            "email" => trim($_POST['email']),
            "phone" => trim($_POST['phone']),
            "address" => trim($_POST['address']),
            "created_at" => date("Y-m-d H:i:s")
        ];
        if (empty($customer['name']) || empty($customer['email']) || empty($customer['phone'])) {
            $this->redirect_with_error("/orders/new", "Email or phone number or customer names shouldn't be left blank");
        }

        $id = $this->customers_model->getByEmailOrPhone($customer['email'], $customer['phone']);
        if (empty($id))
            $id = $this->customers_model->create($customer);
        if (is_array($id))
            $id = $id['id'];
        $user = $_SESSION['user']['id'];
        if (! empty($items))
            self::create_order_items($items, $qty, $id, $user);
        if (! empty($rooms))
            self::create_room_orders($rooms, $id, $user);
        $this->redirect_with_error("/orders/new", "Order(s) successfully created");
    }

    function create_order_items($items, $qty, $customer, $user) {
        $data = ["customer_id" => $customer,
            "user_id" => $user,
            "order_type" => "bar",
            "status" => "pending",
        ];
        $id = $this->db->insert("orders", $data);
        $i = 0;
        foreach ($items as $item) {
            $data = ['order_id' => $id,
                "quantity" => $qty[$i],
                "item_id" => $item];
            $this->db->insert("order_items", $data);
        }
    }

    function create_room_orders($items, $customer, $user) {
        $data = ["customer_id" => $customer,
            "user_id" => $user,
            "order_type" => "room",
            "status" => "pending",
        ];
        $id = $this->db->insert("orders", $data);
        foreach ($items as $item) {
            $data = ['order_id' => $id,
                "quantity" => 1,
                "item_id" => $item];

            $this->db->insert("order_items", $data);
            $this->rooms_model->reserve_room($item, 'booked');
        }
    }

    function complete_order($order, $action) {
        $order_ = self::get_orders($order)[0]['order_type'];
        if ($action == "reject" && $order_ == 'room') {
            $this->db->where("order_id", $order);
            $rooms = $this->db->get("order_items", null, 'item_id');
            foreach ($rooms as $room) {
                $this->rooms_model->reserve_room($room, "free");
            }
        }
        $status = $action == "complete" ? 'approved' : 'rejected';
        $this->db->where("id", $order);
        $this->db->update("orders", ['status' => $status, "approved_by" => $_SESSION['user']['id']]);
    }

}