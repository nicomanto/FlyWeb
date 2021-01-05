<?php

namespace controllers;

class SearchController extends BaseController {

    public function searchByPlace(string $place, string $start_date=null, string $end_date=null, int $start_price=null, int $end_price=null, string $order_by=null, string $order_by_mode= null): array {
        $query = 'SELECT * FROM Viaggio WHERE (Stato LIKE ? OR Citta LIKE ? OR Localita LIKE ?)';
        $queryByCity = $this->buildQuery($query, $start_date, $end_date, $start_price, $end_price, $order_by, $order_by_mode);

        $place = '%' . $place . '%';

        // TODO: Remove this line: debug only
        // echo $queryByCity['query'];

        $travels = $this->db->runQuery($queryByCity['query'], $place, $place, $place, ...$queryByCity['params']);

        return $travels;
    }

    public function searchByTag(string $tag, string $start_date=null, string $end_date=null, int $start_price=null, int $end_price=null, string $order_by=null, string $order_by_mode= null): array {
        $query = 'SELECT * FROM Viaggio WHERE ID_Viaggio IN (SELECT ID_Viaggio FROM TagViaggio WHERE ID_Tag IN (SELECT ID_Tag FROM Tag WHERE Nome LIKE ?))';
        $queryByTag = $this->buildQuery($query, $start_date, $end_date, $start_price, $end_price, $order_by, $order_by_mode);

        $tag = '%' . $tag . '%';

        // TODO: Remove this line: debug only
        //echo $queryByTag['query'];

        $travels = $this->db->runQuery($queryByTag['query'], $tag, ...$queryByTag['params']);

        return $travels;
    }

    public function searchGeneral(string $general, string $start_date=null, string $end_date=null, int $start_price=null, int $end_price=null, string $order_by=null, string $order_by_mode= null): array {
        // Returns all records that have $general in their name
        $query = 'SELECT * FROM Viaggio WHERE (Titolo LIKE ?)';
        $queryGeneral = $this->buildQuery($query, $start_date, $end_date, $start_price, $end_price, $order_by, $order_by_mode);

        // Include all records that have $general on their name
        $general = '%' . $general . '%';

        // TODO: Remove this line: debug only
        //echo $queryGeneral['query'];

        $travels = $this->db->runQuery($queryGeneral['query'], $general, ...$queryGeneral['params']);

        return $travels;
    }

    /**
     * Build query dynmically adding date and price filters and order
     * Returns the list of params to add in the prepare statement and the query as a prepare statement
     *
     * @param string $query
     * @param string $start_date
     * @param string $end_date
     * @param integer $start_price
     * @param integer $end_price
     * @param string $order_by
     * @return array
     */
    private function buildQuery(string $query, string $start_date=null, string $end_date=null, int $start_price=null, int $end_price=null, string $order_by=null, string $order_by_mode=null): array {
        $query = $query;
        $params = [];

        // Eventally add date filter
        if (!empty($start_date) && !empty($end_date)) {
            $query .= ' AND (DataInizio > ? AND DataFine < ?)';
            array_push($params, $start_date);
            array_push($params, $end_date);
        } else if (!empty($start_date)) {
            $query .= ' AND (DataInizio > ?)';
            array_push($params, $start_date);
        } else if (!empty($end_date)) {
            $query .= ' AND (DataFine < ?)';
            array_push($params, $end_date);
        }

        // Eventually add price filter
        if (!empty($start_price) && !empty($end_price)) {
            $query .= ' AND (Prezzo > ? AND Prezzo < ?)';
            array_push($params, $start_price);
            array_push($params, $end_price);
        } else if (!empty($start_price)) {
            $query .= ' AND (Prezzo > ?)';
            array_push($params, $start_price);
        } else if (!empty($end_price)) {
            $query .= ' AND (Prezzo < ?)';
            array_push($params, $end_price);
        }

        // Add order by intro
        $query .= ' ORDER BY';

        // Utility variables
        $ordered = false;

        // Eventually add custom order by
        if ($order_by == 'Data Inizio') {
            $query .= ' DataInizio';
            $ordered = true;
        } else if ($order_by == 'Data Fine') {
            $query .= ' DataFine';
            $ordered = true;
        } else if ($order_by == 'Prezzo') {
            $query .= ' Prezzo';
            $ordered = true;
        } 
        
        
        if ($ordered) {
            if ($order_by_mode == 'Ascendente') {
                $query .= ' asc;';
            } else if ($order_by_mode == 'Discendente') {
                $query .= ' desc;';
            } else {
                $query .= ' asc;';
            }
        } else {
            $query .= ' DataInizio asc, Prezzo desc;';
        }

        return ['query' => $query, 'params' => $params];
    }
}