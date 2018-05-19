<?php

include '../helper/database_connection.php';
include '../helper/constant.php';

class AuthenticationService {

    function login(string $username, string $password): array {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT username, first_name, last_name, email, phone, wallet_id FROM users 
                    WHERE username = :username AND password = :password");
        $stmt->execute([
            ':username' => $username,
            ':password' => $password
        ]);
        $result = $stmt->fetch();

        if (!$result) {
            $result = array('code' => 400, 'message' => 'Username or Password is incorrect.');
        }

        return $result;
    }

}