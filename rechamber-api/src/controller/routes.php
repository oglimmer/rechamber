<?php

namespace Controller;

require_once 'UserController.php';

$user_controller = new UserController();

$base_path = "/rechamber/rechamber-api";

$routes = array(
    'GET ' . $base_path . '/api/v1/users' => array('controller' => $user_controller, 'method' => 'handleGetRequest'),
);

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['REQUEST_URI'];
$queryString = parse_url($endpoint, PHP_URL_QUERY);
$endpoint = parse_url($endpoint, PHP_URL_PATH);

header('Content-Type: application/json');

if (isset($routes[$method . ' ' . $endpoint])) {
    $route = $routes[$method . ' ' . $endpoint];
    $controller = $route['controller'];
    $methodToCall = $route['method'];
    if ($method === "GET") {
        $params = array();
        if (!empty($queryString)) {
            parse_str($queryString, $params);
        }
        $responseData = $controller->$methodToCall($params);
    } else if ($method === "POST") {
        if (isset($_POST)) {
            $body = $_POST;
        }
        $responseData = $controller->$methodToCall($body);
    }
    echo $responseData;
} else {
    http_response_code(404);
    $responseData = array(
        'error' => 'Endpoint not found'
    );
    echo json_encode($responseData);
}
