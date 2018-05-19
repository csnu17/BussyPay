<?php

include 'service/wallet_service.php';
include 'helper/database_connection.php';

$walletService = new WalletService();

$result = $walletService->getAllWallets();

if (isset($_GET['wallet_id'])) {
    $walletId = $_GET['wallet_id'];
    $result = $walletService->getWalletByWalletId($walletId);
}

else if (isset($_GET['wallet_own'])) {
    $walletOwn = $_GET['wallet_own'];
    $result = $walletService->getWalletByWalletOwn($walletOwn);
}

echo json_encode($result);