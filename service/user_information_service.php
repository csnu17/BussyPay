<?php

include '../helper/database_connection.php';

class UserServiceInformation {

    function getAllUsers(): array {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

}