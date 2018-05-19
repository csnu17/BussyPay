<?php

include 'service/wallet_service.php';
include 'helper/database_connection.php';

$walletService = new WalletService();

$result = $walletService->getAllWallets();{}

if (isset($_GET['wallet_id'])) {
    $walletId = $_GET['wallet_id'];
    $result = $walletService->getWalletByWalletId($walletId);
}

else if (isset($_GET['wallet_own'])) {
    $walletOwn = $_GET['wallet_own'];
    $result = $walletService->getWalletByWalletOwn($walletOwn);
}

else if (isset($_POST['wallet_id']) && isset($_POST['balance']) && isset($_POST['value'])) {
    $wallet_id = $_POST['wallet_id'];
    $balance = $_POST['balance'];
    $value = $_POST['value'];

    $result = $walletService->updateBalance($wallet_id, $balance, $value);
}

echo json_encode($result);