<?php

require __DIR__ . '/../service/transaction_service.php';

$transactionService = new TransactionService();

// Get transaction by id.
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo $transactionService->getTransactionById($id);

} else if (isset($_POST['amount']) && isset($_POST['transaction_type']) && isset($_POST['user_id']) && isset($_POST['bus_id'])) {
    // Create a new transaction.
    $amount = $_POST['amount'];
    $transactionType = $_POST['transaction_type'];
    $userId = $_POST['user_id'];
    $busId = $_POST['bus_id'];
    
    echo $transactionService->createTransaction($amount, $transactionType, $userId, $busId);

} else { // Get all transactions depends on type (top_up or payment) If you want all, just do not send $_GET['type'] from caller side.
    $type = null;
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
    }
    
    echo $transactionService->getAllTransactions($type);
}
