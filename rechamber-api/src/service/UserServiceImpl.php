<?php

namespace Service;

use Exception;

use Database\UserDao;
use Model\UserDTO;
use Model\UserModel;

class UserServiceImpl implements UserService
{
    private $user_dao;

    public function __construct(UserDao $user_dao)
    {
        $this->user_dao = $user_dao;
    }

    public function getUsers(): array
    {
        return $this->user_dao->findUsers();
    }

    public function getUser(string $id): UserDTO
    {
        $user = $this->user_dao->findUser($id);

        if (!isset($user)) {
            throw new Exception("User does not exists.");
        }

        return $user;
    }

    public function createUser(UserModel $user_model): void
    {
        $user = $this->user_dao->findUserByEmail($user_model->getEmail());

        if (isset($user)) {
            throw new Exception("User already exists.");
        }

        $this->user_dao->createUser($user_model);
    }

    public function updateUser(string $id, UserModel $user_model): void
    {
        $user = $this->user_dao->findUser($id);

        if (!isset($user)) {
            throw new Exception("User does not exists.");
        }

        $user->setUsername($user_model->getUsername());
        $user->setEmail($user_model->getEmail());
        $user->setPassword($user_model->getPassword());

        $this->user_dao->updateUser($id, $user);
    }

    public function deleteUser(string $id): void
    {
        $user = $this->user_dao->findUser($id);

        if (!isset($user)) {
            throw new Exception("User does not exists.");
        }

        $this->user_dao->deleteUser($id);
    }
}
