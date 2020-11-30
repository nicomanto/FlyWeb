<?php

namespace model;

use mysqli;
use \Exception;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

class Database {
    private $host_name;
    private $user_name;
    private $password;
    private $db_name;
    private $is_connected;
    private $db;

    public function __construct(string $host_name = '', string $user_name = '', string $password = '', string $db_name = '') {
        $this->host_name = $host_name != '' ? $host_name : $_ENV['DB_HOST'];
        $this->user_name = $user_name != '' ? $user_name : $_ENV['DB_USER'];
        $this->password = $password != '' ? $password : $_ENV['DB_PASSWORD'];
        $this->db_name = $db_name != '' ? $db_name : $_ENV['DB_DATABASE'];
        $this->is_connected = FALSE;
    }

    /**
     * Establish a connection with database or throw an exception
     */
    public function connect() {
        if ($this->db == null) {
            $this->db = new mysqli($this->host_name, $this->user_name, $this->password, $this->db_name);
            if ($this->db->connect_errno > 0) {
                throw new Exception('C\'è stato un errore nella connessione con il database. L\'errore che si è verificato è il seguente: ' . $this->db->connect_error);
            } else {
                $this->db->set_charset('utf8');
                $this->is_connected = TRUE;
            }
        }
    }

    /**
     * Disconnect from database
     */
    public function disconnect(): bool {
        $this->is_connected = !($this->db->close());
        return !($this->is_connected);
    }

    /**
     * Wrapper per mysqli_real_escape_string($link, $escapestr).
     */
    public function escapeString($string): string {
        if (!($this->is_connected)) {
            throw new Exception('Non è attiva una connessione con il database.');
        }
        return $this->db->real_escape_string($string);
    }

    /**
     * Runs $query query with all given params in order.
     * Query must be in prepare_stmt format (with '?'s)
     *
     * @param string $query
     * @param array $params
     * @return
     */
    public function runQuery(string $query, ...$params) {

        //echo $query;

        $stmt = mysqli_stmt_init($this->db);
        
        // Running prepare statement
        if (!mysqli_stmt_prepare($stmt, $query)) {
            // Failed
            echo "error " . mysqli_error($this->db);
            exit();
        }

        // Bind params only if some params are provided
        if (func_num_args() > 1) {
            // Binding actual parameters
            $paramsType = $this->detectParamsType($params);
            mysqli_stmt_bind_param($stmt, $paramsType, ...$params);
        }
        // Executing query
        $executed = mysqli_stmt_execute($stmt);
        
        if (!$executed) {
            echo 'Error running query: ' . mysqli_error($this->db);
        }

        $results = mysqli_stmt_get_result($stmt);

        // Return result as associative array
        // return mysqli_fetch_all($results);
        if ($results) {
            return $this->fetchAllRows($results);
        } else {
            //echo "No results available for this query";
        }
    }

    /**
     * Undocumented function
     *
     * @param array $params
     * @return string
     */
    private function detectParamsType(array $params): string {
        $paramsType = '';
        foreach ($params as $param) {
            switch (gettype($param)) {
                case 'integer':
                    $paramsType = $paramsType . 'i';
                    break;
                case 'double':
                    $paramsType = $paramsType . 'd';
                    break;
                default:
                    $paramsType = $paramsType . 's';
                    break;
            }
        }

        return $paramsType;
    }

    /**
     * Fetch all rows as associative array
     *
     * @param [type] $result
     * @return array
     */
    private function fetchAllRows($result): array {
        $data = [];
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }  
        return $data;
    }
}
