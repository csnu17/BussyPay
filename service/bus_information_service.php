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

    function getBusById(int $id): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT * FROM buses WHERE id = :id");
        $stmt->execute([
            ':id' => $id
        ]);
        $result = $stmt->fetch();

        return JSONResponseParser::parse($result, 'Success', 'No bus found.');
    }

    function search(string $keyword): string {
        $con = DatabaseConnection::getInstance();
        $keyword = trim($keyword);

        $stmt = $con->prepare("SELECT * FROM buses WHERE bus_name LIKE :bus_name 
                                    OR source LIKE :source OR terminal LIKE :terminal");

        $stmt->bindValue(':bus_name', '%' . $keyword . '%');
        $stmt->bindValue(':source', '%' . $keyword . '%');
        $stmt->bindValue(':terminal', '%' . $keyword . '%');

        $stmt->execute();
        $result = $stmt->fetchAll();

        return JSONResponseParser::parse($result, 'Success', 'No buses found.');
    }

}