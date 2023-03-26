<?php

class Statistics_model extends BaseModel
{
    function get_stats() {
       $this->db->groupBy("status");
       $orders = $this->db->getOne("orders", "count(id) as orders");
    }
}