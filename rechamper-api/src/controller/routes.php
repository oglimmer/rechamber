<?php

namespace Controller;

require_once 'UserController.php';

$user_controller = new UserController();

$base_path = "/rechamper/rechamper-api";

$routes = array(
    'GET ' . $base_path . '/api/v1/users' => array('controller' => $user_controller, 'method' => 'handleGetRequest'),
    'POST ' . $base_path . '/api/V1/users' => array('controller' => $user_controller, 'method' => 'handlePostRequest'),
);

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['REQUEST_URI'];

header('Content-Type: application/json');

if (isset($routes[$method . ' ' . $endpoint])) {
    $route = $routes[$method . ' ' . $endpoint];
    $controller = $route['controller'];
    $methodToCall = $route['method'];
    $responseData = $controller->$methodToCall();
    echo $responseData;
} else {
    http_response_code(404);
    $responseData = array(
        'error' => 'Endpoint not found'
    );
    echo json_encode($responseData);
}
