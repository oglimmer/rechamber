<?php

namespace Controller;

require_once "../utils/objectToJsonMapper.php";

use Database\Dao;
use Database\UserDao;
use Service\UserService;

use function Utils\getObjectProperties;

class UserController
{
    private Dao $dao;
    private UserDao $user_dao;
    private UserService $user_service;

    public function __construct() {
        $this->dao = new Dao();
        $this->user_dao = new UserDao($this->dao);
        $this->user_service = new UserService($this->user_dao);
    }

    public function handleGetRequest(array $params): string
    {
        if (count($params) > 0) {
            if (isset($params["id"])) {
                header('Content-Type: application/json');
                $user = $this->user_service->getUser($params["id"]);
                return json_encode(getObjectProperties($user));
            } else {
                http_response_code(400);
                header('Content-Type: application/json');
                return json_encode(["error" => "Id is missing."]);
            }
        }

        return json_encode($this->user_service->getUsers());
    }

    // Implement the rest
    public function handlePostRequest(array $body): string
    {
        $responseData = array(
            'message' => 'POST request received for /api/v1/users',
            'data' => $body
        );

        return json_encode($responseData);
    }

    public function handlePutRequest(array $params, array $body): string
    {
        $responseData = array(
            'message' => 'Put request received for /api/v1/users',
        );

        return json_encode($responseData);
    }

    public function handleDeleteRequest(array $params): string
    {
        $requestData = $params;

        $responseData = array(
            'message' => 'Delete request received for /api/v1/users',
            'data' => $requestData
        );

        return json_encode($responseData);
    }
}
