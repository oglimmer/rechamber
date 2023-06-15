<?php

namespace app\Database;

use mysqli;

use app\Config\Config;

class Dao
{
    private mysqli $conn;

    public function __construct()
    {
        $this->conn = new mysqli(Config::$DB_HOST, Config::$DB_USERNAME, Config::$DB_PASSWORD, Config::$DB_NAME, Config::$DB_PORT);
        if ($this->conn->connect_error) {
            header('Content-Type: application/json');
            http_response_code(500);
            $response = array('error' => 'Database connection failed: ' . $this->conn->connect_error);
            echo json_encode($response);
            exit;
        }
    }

    public function getConnection(): mysqli
    {
        return $this->conn;
    }
}
