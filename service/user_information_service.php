<?php

require __DIR__ . '/../helper/json_response_parser.php';
require __DIR__ . '/../helper/database_connection.php';

class UserServiceInformation {

    function getAllUsers(): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT username, first_name, last_name, email, phone, wallet_id FROM users");
        $stmt->execute();
        $result = $stmt->fetchAll();

        return JSONResponseParser::parse($result, 'Success', 'No users found.');
    }

    function getUserByUsername(string $username): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT username, first_name, last_name, email, phone, wallet_id FROM users WHERE username = :username");
        $stmt->execute([
            ':username' => $username
        ]);
        $result = $stmt->fetch();

        return JSONResponseParser::parse($result, 'Success', 'No user found.');
    }

}