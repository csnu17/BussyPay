<?php

require __DIR__ . '/../helper/json_response_parser.php';
require __DIR__ . '/../helper/database_connection.php';

class TransactionService {

    function getAllTransactions(): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT * FROM transactions");
        $stmt->execute();
        $result = $stmt->fetchAll();

        return JSONResponseParser::parse($result, 'Success', 'No transactions found.');
    }

    function getTransactionById(int $id): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT * FROM transactions WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();

        return JSONResponseParser::parse($result, 'Success', 'No transaction found.');
    }

    function createTransaction(float $amount, int $transactionType, int $userId): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("INSERT INTO transactions (transaction_number, amount, transaction_type, user_id, status) 
                                    VALUES (:transaction_number, :amount, :transaction_type, :user_id, :status)");
        $result = $stmt->execute([
            ':transaction_number' => mt_rand(1000000000, 9999999999), // random 10 digits number for transaction number.
            ':amount' => $amount,
            ':transaction_type' => $transactionType,
            ':user_id' => $userId,
            ':status' => 1 // success
        ]);

        return JSONResponseParser::parse($result, 'Create a new transaction successfully.', 'Create a new transaction failure.');
    }

}