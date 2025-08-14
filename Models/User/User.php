<?php

class User
{

    function findUserByEmail($connection, $email)
    {
        $stmt = $connection->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function createUser($connection, $name, $email, $password)
    {
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $connection->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

        if ($stmt->execute([$name, $email, $passwordHashed])) {
            return $connection->lastInsertId();
        } else {
            return false;
        }
    }
}
