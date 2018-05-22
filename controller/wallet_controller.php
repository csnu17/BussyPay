<?php

require __DIR__ . '/../service/wallet_service.php';

$walletService = new WalletService();

// Get wallet by wallet id.
if (isset($_GET['wallet_id'])) {
    $walletId = $_GET['wallet_id'];
    $result = $walletService->getWalletByWalletId($walletId);
}

// Get wallet by wallet own.
else if (isset($_GET['wallet_own'])) {
    $walletOwn = $_GET['wallet_own'];
    $result = $walletService->getWalletByWalletOwn($walletOwn);
}

// Update balance in wallet.
else if (isset($_POST['wallet_own_id']) && isset($_POST['value'])) {
    $wallet_own_id = $_POST['wallet_own_id'];
    $value = $_POST['value'];

    $result = $walletService->updateBalance($wallet_own_id, $value);
} else { // Get all wallets.
    $result = $walletService->getAllWallets();
}

echo $result;