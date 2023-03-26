<?php
class Customers_model extends BaseModel
{

    function getByEmailOrPhone($email, $phone)
    {
        return $this->db->where('email', $email)
            ->orWhere('phone', $phone)
            ->getOne('customers');
    }

    function create($data)
    {
        return $this->db->insert('customers', $data);
    }

    function get_customers() {
        return $this->db->rawQuery(
            "SELECT c.id, c.name, c.email, c.phone, c.address, c.created_at,
                   COALESCE(pending_orders, 0) AS pending_orders,
                   COALESCE(approved_orders, 0) AS approved_orders,
                           COALESCE(rejected_orders, 0) AS rejected_orders
                    FROM customers c
                    LEFT JOIN (
                       SELECT customer_id,
                              COUNT(CASE WHEN status = 'pending' THEN 1 ELSE NULL END) AS pending_orders,
                              COUNT(CASE WHEN status = 'approved' THEN 1 ELSE NULL END) AS approved_orders,
                              COUNT(CASE WHEN status = 'rejected' THEN 1 ELSE NULL END) AS rejected_orders
                       FROM orders
                       GROUP BY customer_id
                    ) o ON c.id = o.customer_id
                    ORDER BY c.id DESC;

");
    }
}
