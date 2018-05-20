<?php

require __DIR__ . '/../service/transaction_service.php';

$transactionService = new TransactionService();

// Get raw transaction by id. (no INNER JOIN)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo $transactionService->getTransactionById($id);

} else if (isset($_POST['amount']) && isset($_POST['transaction_type']) && isset($_POST['user_id'])) {
    // Create a new transaction.
    $amount = $_POST['amount'];
    $transactionType = $_POST['transaction_type'];
    $userId = $_POST['user_id'];

    echo $transactionService->createTransaction($amount, $transactionType, $userId);

} else { // Get all raw transactions. (no INNER JOIN)
    echo $transactionService->getAllTransactions();
}