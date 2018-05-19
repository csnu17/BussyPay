<?php

include '../helper/database_connection.php';

class UserServiceInformation {

    function getAllUsers(): array {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT username, first_name, last_name, email, phone, wallet_id FROM users");
        $stmt->execute();
        $result = $stmt->fetchAll();

        if (!$result) {
            $result = array('code' => 400, 'message' => 'No users found.');
        }

        return $result;
    }

    function getUserByUsername(string $username): array {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT username, first_name, last_name, email, phone, wallet_id FROM users WHERE username = :username");
        $stmt->execute([
            ':username' => $username
        ]);
        $result = $stmt->fetch();

        if (!$result) {
            $result = array('code' => 400, 'message' => 'No user found.');
        }

        return $result;
    }

}