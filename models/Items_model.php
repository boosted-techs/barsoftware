<?php

class Items_model extends BaseModel
{
    public function get_item_by_name($name) {
        // Query the database for the record
        // Return the record if found, otherwise return null
        $name = strtoupper($name);
        $this->db->where("name", $name);
        return $this->db->getOne("items");
    }

    public function insert_item($item_data) {
        $item = self::get_item_by_name($item_data['name']);
        if (empty($item)) {
            $item_data['name'] = strtoupper($item_data['name']);
            $item_data['status'] = 1;
            $item_data['user'] = $_SESSION['user']['id'];
            $item_data['date_created'] = date("Y-m-d H:i:s");

            return $this->db->insert("items", $item_data);
        }
        return false;
        // Insert new item record into 'items' table
    }

    public function update_item() {
        // Update item or room record depending on category
        $action_on_price = $_POST['pr'];
        $qty = trim($_POST['qty']);
        $item = trim($_POST['item']);
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);
        if (empty($name))
            $this->redirect_with_error("/items/{$item}/edit", "An error occurred");
        $data = [
            "name" => $name,
            "stock_level" => $qty,
            "description" => $description
        ];
        if ($action_on_price == 2)
            $data['stock_level'] =  $qty;
        elseif ($action_on_price == 3)
            self::receive_new_stock($item, $qty);

        $this->db->where("id", $item);
        $this->db->update("items", $data);
        $this->redirect_with_error("/items/{$item}/edit", "Item {$name} updated");
    }

    function receive_new_stock($item, $stock) {

        $this->db->rawQuery("update items set stock_level = stock_level + '$stock' where id = '$item'");
    }

    function get_items($item = false) {
        if ($item)
            $this->db->where("items.id", $item);
        $this->db->orderBy("id", "desc");
        return $this->db->get("items", null, " id, price, name, image, description, 
    (SELECT SUM(quantity) FROM order_items 
     LEFT JOIN orders ON orders.id = order_items.order_id 
     where orders.status = 'approved') as qty_sold, 
    stock_level, status, date_created, supplier_id, 
    (SELECT name FROM users WHERE id = items.user) as user 
   ");
    }
    /*
     * +971556399353
     */


}