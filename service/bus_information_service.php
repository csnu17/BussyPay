<?php

require __DIR__ . '/../helper/json_response_parser.php';
require __DIR__ . '/../helper/database_connection.php';

class BusInformationService {

    function getAllBuses(): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT * FROM buses");
        $stmt->execute();
        $result = $stmt->fetchAll();

        return JSONResponseParser::parse($result, 'Success', 'No buses found.');
    }

    function getBusById(string $id): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT * FROM buses WHERE id = :id");
        $stmt->execute([
            ':id' => $id
        ]);
        $result = $stmt->fetch();

        return JSONResponseParser::parse($result, 'Success', 'No bus found.');
    }

}