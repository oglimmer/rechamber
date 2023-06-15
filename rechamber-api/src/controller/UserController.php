<?php

namespace app\Controller;

use ReflectionException;

use app\Database\DAO;
use app\Database\UserDao;
use app\Service\UserService;
use app\Model\UserModel;
use app\Service\UserServiceImpl;
use function app\utils\getObjectProperties;

class UserController
{
    private Dao $dao;
    private UserDao $user_dao;
    private UserService $user_service;

    public function __construct()
    {
        $this->dao = new Dao();
        $this->user_dao = new UserDao($this->dao);
        $this->user_service = new UserServiceImpl($this->user_dao);
    }

    public function handleGetRequest(array $params): string
    {
        if (count($params) > 0) {
            if (isset($params["id"])) {
                header('Content-Type: application/json');
                $user = $this->user_service->getUser($params["id"]);
                try {
                    return json_encode(getObjectProperties($user));
                } catch (ReflectionException) {
                    http_response_code(500);
                    header('Content-Type: application/json');
                    return json_encode(["error" => "Cannot get object properties."]);
                }
            } else {
                http_response_code(400);
                header('Content-Type: application/json');
                return json_encode(["error" => "Id is missing."]);
            }
        }

        return json_encode($this->user_service->getUsers());
    }

    public function handlePostRequest(array $body): string
    {
        if (count($body) > 0) {
            if (isset($body["username"]) && isset($body["email"]) && isset($body["password"])) {
                header('Content-Type: application/json');
                $user_model = new UserModel($body["username"], $body["email"], $body["password"]);
                $this->user_service->createUser($user_model);
                return json_encode(["success" => "User inserted to database."]);
            }
        }

        http_response_code(400);
        header('Content-Type: application/json');
        return json_encode(["error" => "Missing data in body."]);
    }

    public function handlePutRequest(array $params, array $body): string
    {
        if (count($params) > 0 && count($body) > 0) {
            if (isset($params["id"]) && isset($body["username"]) && isset($body["email"]) && isset($body["password"])) {
                header('Content-Type: application/json');
                $user_model = new UserModel($body["username"], $body["email"], $body["password"]);
                $this->user_service->updateUser($params["id"], $user_model);
                return json_encode(["success" => "User updated in database."]);
            }
        }

        http_response_code(400);
        header('Content-Type: application/json');
        return json_encode(["error" => "Missing data in params or body."]);
    }

    public function handleDeleteRequest(array $params): string
    {
        if (count($params) > 0) {
            if (isset($params["id"])) {
                header('Content-Type: application/json');
                $this->user_service->deleteUser($params["id"]);
                return json_encode(["success" => "User deleted in database."]);
            }
        }

        http_response_code(400);
        header('Content-Type: application/json');
        return json_encode(["error" => "Missing params."]);
    }
}
