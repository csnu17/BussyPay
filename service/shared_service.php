<?php

require_once __DIR__ . '/../helper/database_connection.php';

class SharedService {

    protected function countRecords(string $tableName): int {
        $con = DatabaseConnection::getInstance();

        $sql = "SELECT count(*) as records FROM " . $tableName;
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['records'];
    }

}