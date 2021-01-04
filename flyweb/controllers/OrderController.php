<?php

namespace controllers;

use model\Order;
use model\Travel;

class OrderController extends BaseController {

    public $order;
    public $id_order;
    public $travel_list;

    public function __construct(int $id_order) {
        parent::__construct();
        $this->$id_order=$id_order;
        $this->$order = ($this->getOrderDetails($id_order));
        $this->$travel_list = $this->getTravelByOrderList($id_order);
    }

    public function getOrderDetails(int $id_order) {
        $query = 'SELECT * FROM Ordine WHERE ID_Ordine = ?;';
        return( $this->order = new Order($this->db->runQuery($query, $id_order)[0]));
    }

    public function getTravelByOrderList($id) {
        $query = 'SELECT Viaggio.* FROM Viaggio, OrdineViaggio WHERE ID_Ordine = ? AND Viaggio.ID_Viaggio = OrdineViaggio.ID_Viaggio;';
        return $this->db->runQuery($query, $id);
    }





}