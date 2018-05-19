<?php

include 'service/user_information_service.php';
include 'service/wallet_service.php';
include 'helper/database_connection.php';
include 'service/authentication_service.php';

/* user information service */

// $userInformationService = new UserServiceInformation();

// $result = $userInformationService->getAllUsers();

// if (isset($_GET['username'])) {
//     $username = $_GET['username'];
//     $result = $userInformationService->getUserByUsername($username);
// }

/* ======================== */

/* authentication service */

// if (isset($_POST['username']) && isset($_POST['password'])) {
//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     $serviceAuthen = new AuthenticationService();
//     $result = $serviceAuthen->login($username, $password);
// }

/* ======================== */

/* wallet service */

$walletService = new WalletService();

// $result = $walletService->getAllWallets();

// if (isset($_GET['wallet_id'])) {
//     $walletId = $_GET['wallet_id'];
//     $result = $walletService->getWalletByWalletId($walletId);
// }

if (isset($_GET['wallet_own'])) {
    $walletOwn = $_GET['wallet_own'];
    $result = $walletService->getWalletByWalletOwn($walletOwn);
}

/* ======================== */

if (is_null($result)) {
    exit();
}

echo json_encode($result);