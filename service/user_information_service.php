<?php

require __DIR__ . '/../helper/json_response_parser.php';
require __DIR__ . '/../helper/database_connection.php';

class UserServiceInformation {

    function getAllUsers(): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT id, username, first_name, last_name, email, phone, wallet_id FROM users");
        $stmt->execute();
        $result = $stmt->fetchAll();

        return JSONResponseParser::parse($result, 'Success', 'No users found.');
    }

    function getUserByUsername(string $username): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT id, username, first_name, last_name, email, phone, wallet_id FROM users WHERE username = :username");
        $stmt->execute([
            ':username' => trim($username)
        ]);
        $result = $stmt->fetch();

        return JSONResponseParser::parse($result, 'Success', 'No user found.');
    }

    function search(string $keyword): string {
        $con = DatabaseConnection::getInstance();
        $keyword = trim($keyword);

        $stmt = $con->prepare("SELECT id, username, first_name, last_name, email, phone, wallet_id FROM users WHERE first_name LIKE :first_name 
                                    OR last_name LIKE :last_name OR email LIKE :email OR phone LIKE :phone");

        $stmt->bindValue(':first_name', '%' . $keyword . '%');
        $stmt->bindValue(':last_name', '%' . $keyword . '%');
        $stmt->bindValue(':email', '%' . $keyword . '%');
        $stmt->bindValue(':phone', '%' . $keyword . '%');

        $stmt->execute();
        $result = $stmt->fetchAll();

        return JSONResponseParser::parse($result, 'Success', 'No users found.');
    }

}