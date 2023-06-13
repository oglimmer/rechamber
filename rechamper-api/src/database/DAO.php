<?php
namespace Database;

require_once(__DIR__ . "/../config/config.php");

use mysqli;

class DAO
{
    private $conn;

    public function __construct()
    {
        global $DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME, $DB_PORT;
        $this->conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME, $DB_PORT);
        if ($this->conn->connect_error) {
            header('Content-Type: application/json');
            http_response_code(500);
            $response = array('error' => 'Database connection failed: ' . $this->conn->connect_error);
            echo json_encode($response);
            exit;
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
