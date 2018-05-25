<?php

require __DIR__ . '/../helper/json_response_parser.php';
require __DIR__ . '/../helper/database_connection.php';
require __DIR__ . '/wallet_service.php';

class TransactionService extends SharedService {

    function getAllTransactions($type): string {
        $con = DatabaseConnection::getInstance();
        $type = trim($type);

        $sql = "SELECT transactions.transaction_number, transactions.amount, transactions.transaction_date, 
                        users.first_name, users.last_name, buses.bus_name,buses.source, buses.terminal, transaction_status.status FROM transactions 
                        INNER JOIN users ON transactions.user_id = users.id 
                        INNER JOIN transaction_status ON transactions.status = transaction_status.id 
                        INNER JOIN buses ON transactions.bus_id = buses.id";

        if ($type) {
            $sql .= " WHERE transactions.transaction_type = :transaction_type";

            if ($type === 'top_up') {
                $transaction_type = 1;
            } else if ($type === 'payment') {
                $transaction_type = 2;
            } else {
                return JSONResponseParser::parse(null, '', 'Type is accepted only top_up or payment.', parent::countRecords('transactions'));
            }
        }

        $sql .= " ORDER BY transactions.id DESC";
        $stmt = $con->prepare($sql);

        if ($type) {
            $stmt->execute([
                ':transaction_type' => $transaction_type
            ]);
        } else {
            $stmt->execute();
        }

        $result = $stmt->fetchAll();

        return JSONResponseParser::parse($result, 'Success', 'No transactions found.', parent::countRecords('transactions'));
    }

    function search($type, string $keyword): string {
        $con = DatabaseConnection::getInstance();
        $type = trim($type);
        $keyword = trim($keyword);

        if ($type === 'top_up') {
            $transaction_type = 1;
        } else if ($type === 'payment') {
            $transaction_type = 2;
        } else {
            return JSONResponseParser::parse(null, '', 'Type is accepted only top_up or payment.', parent::countRecords('transactions'));
        }

        $sql = "SELECT transactions.transaction_number, transactions.amount, transactions.transaction_date, 
                        users.first_name, users.last_name, buses.bus_name,buses.source, buses.terminal, transaction_status.status FROM transactions 
                        INNER JOIN users ON transactions.user_id = users.id 
                        INNER JOIN transaction_status ON transactions.status = transaction_status.id 
                        INNER JOIN buses ON transactions.bus_id = buses.id 
                        WHERE transactions.transaction_type = :transaction_type AND 
                        (transactions.transaction_number = :transaction_number OR 
                        transactions.status = :status OR 
                        transactions.user_id = :user_id) 
                        ORDER BY transactions.id DESC";

        $stmt = $con->prepare($sql);

        $stmt->bindValue(':transaction_type', $transaction_type);
        $stmt->bindValue(':transaction_number', $keyword);
        $stmt->bindValue(':status', $keyword);
        $stmt->bindValue(':user_id', $keyword);

        $stmt->execute();

        $result = $stmt->fetchAll();

        return JSONResponseParser::parse($result, 'Success', 'No transactions found.', parent::countRecords('transactions'));
    }

    function createTransaction(float $amount, int $transactionType, int $userId, int $busId, int $status): string {
        $con = DatabaseConnection::getInstance();

        if ($transactionType == 1) {
            $busId = 99; // if transaction type is top_up, we will assign bus_id as 99.
        }

        $stmt = $con->prepare("INSERT INTO transactions (transaction_number, amount, transaction_type, user_id, bus_id, status) 
                                    VALUES (:transaction_number, :amount, :transaction_type, :user_id, :bus_id, :status)");
        $result = $stmt->execute([
            ':transaction_number' => mt_rand(1000000000, 9999999999), // random 10 digits number for transaction number.
            ':amount' => $amount,
            ':transaction_type' => $transactionType,
            ':user_id' => $userId,
            ':bus_id' => $busId, // $busId is always 99 if transaction type is 1 (top_up)
            ':status' => $status
        ]);

        // Update balance in wallet according to the transaction.
        $walletService = new WalletService();
        $walletService->updateBalance($userId, $amount);

        return JSONResponseParser::parse($result, 'Create a new transaction successfully.', 'Create a new transaction failure.', parent::countRecords('transactions'));
    }

}