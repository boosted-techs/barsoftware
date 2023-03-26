<?php

class Rooms_model extends BaseModel
{

    public function get_room_by_name($name) {
        // Query the database for the record
        // Return the record if found, otherwise return null
        $name = strtoupper($name);
        $this->db->where("room_number", $name);
        return $this->db->getOne("rooms");
    }

    public function insert_room($item_data) {
        $item = self::get_room_by_name($item_data['name']);
        if (empty($item)) {
            $room_data['room_number'] = strtoupper($item_data['name']);
            $room_data['status'] = 'free';
            $room_data['user'] = $_SESSION['user']['id'];
            $room_data['price'] = $item_data['price'];
            $room_data['created_at'] = date("Y-m-d H:i:s");
            $room_data['description'] = $item_data['description'];
            $room_data['image'] = $item_data['image'];
            return $this->db->insert("rooms", $room_data);
        }
        return false;
        // Insert new item record into 'items' table
    }

    function get_rooms() {
        $this->db->orderBy("id", "desc");
        return $this->db->get("rooms", null, "id, price, room_number, image,
        description, status, created_at, (select name from users where id = rooms.user) as user");
    }



    public function update_room($id, $name, $description, $price, $qty, $category) {
        // Update item or room record depending on category
    }

    function reserve_room($id, $action) {
        $this->db->where("id", $id);
        $this->db->update("rooms", ["status" => $action]);
    }


}