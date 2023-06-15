<?php

namespace app\service;

use app\model\UserDTO;
use app\model\UserModel;

interface UserService
{
    public function getUsers(): array;
    public function getUser(string $id): UserDTO;
    public function createUser(UserModel $user_model): void;
    public function updateUser(string $id, UserModel $user_model): void;
    public function deleteUser(string $id): void;
}
