<?php

namespace app\Service;

use app\Database\UserDao;
use app\Model\UserDTO;
use app\Model\UserModel;

class UserServiceImpl implements UserService
{
    private UserDao $user_dao;

    public function __construct(UserDao $user_dao)
    {
        $this->user_dao = $user_dao;
    }

    public function getUsers(): array
    {
        return $this->user_dao->findUsers();
    }

    public function getUser(string $id): ?UserDTO
    {
        return $this->user_dao->findUser($id);
    }

    public function createUser(UserModel $user_model): void
    {
        $this->user_dao->createUser($user_model);
    }

    public function updateUser(string $id, UserModel $user_model): void
    {
        $user = $this->user_dao->findUser($id);

        $user->setUsername($user_model->getUsername());
        $user->setEmail($user_model->getEmail());
        $user->setPassword($user_model->getPassword());

        $this->user_dao->updateUser($id, $user);
    }

    public function deleteUser(string $id): void
    {
        $this->user_dao->deleteUser($id);
    }
}
