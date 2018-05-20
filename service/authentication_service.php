<?php

require __DIR__ . '/../helper/json_response_parser.php';
require __DIR__ . '/../helper/database_connection.php';

class AuthenticationService {

    function login(string $username, string $password): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT id, username, first_name, last_name, email, phone, wallet_id FROM users 
                    WHERE username = :username AND password = :password");
        $stmt->execute([
            ':username' => $username,
            ':password' => $password
        ]);
        $result = $stmt->fetch();

        return JSONResponseParser::parse($result, 'Success', 'Username or Password is incorrect.');
    }

}