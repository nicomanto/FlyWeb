<?php

namespace controllers;

use model\Order;

class OrderController extends BaseController {

    public $order;

    public function __construct(int $id_order) {
        parent::__construct();
        $this->getOrderDetails($id_order);
    }

    private function getOrderDetails(int $id_order) {
        $query = 'SELECT * FROM Ordine WHERE ID_Ordine = ?;';
       return( $this->order = new Order($this->db->runQuery($query, $id_order)[0]));
    }


}