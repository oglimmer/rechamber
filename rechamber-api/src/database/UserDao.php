<?php

namespace app\Database;

use app\Model\UserDTO;
use app\Model\UserModel;

class UserDao
{
    public Dao $dao;

    public function __construct(Dao $dao)
    {
        $this->dao = $dao;
    }

    public function findUsers(): array
    {
        $query = "SELECT * FROM users";
        $stmt = $this->dao->getConnection()->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();

        if (!$result->num_rows > 0) {
            return array();
        }

        return $result->fetch_assoc();
    }

    public function findUser(string $id): ?UserDTO
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->dao->getConnection()->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if (!$result->num_rows > 0) {
            return null;
        }

        $data = $result->fetch_assoc();

        $id = $data["id"];
        $username = $data["username"];
        $email = $data["email"];
        $password = $data["password"];

        return new UserDTO($id, $username, $email, $password);
    }

    public function findUserByEmail(string $email): ?UserDTO
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->dao->getConnection()->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if (!$result->num_rows > 0) {
            return null;
        }

        $data = $result->fetch_assoc();

        $id = $data["id"];
        $username = $data["username"];
        $email = $data["email"];
        $password = $data["password"];

        return new UserDTO($id, $username, $email, $password);
    }

    public function createUser(UserModel $user_dto): void
    {
        $username = $user_dto->getUsername();
        $email = $user_dto->getEmail();
        $password = password_hash($user_dto->getPassword(), PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->dao->getConnection()->prepare($query);
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();
    }

    public function updateUser(string $id, UserDTO $user_model): void
    {
        $query = "UPDATE users SET username = ?, SET email = ?, password = ? WHERE id = ?";
        $stmt = $this->dao->getConnection()->prepare($query);
        $username = $user_model->getUsername();
        $email = $user_model->getEmail();
        $password = password_hash($user_model->getPassword(), PASSWORD_DEFAULT);
        $stmt->bind_param("ssss", $username, $email, $password, $id);
        $stmt->execute();
    }

    public function deleteUser(string $id): void
    {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->dao->getConnection()->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
    }
}
