<?php

include '../helper/database_connection.php';

class WalletService {

    function getAllWallets(): array {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT wallet_id, balance, wallet_own FROM wallets");
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    function getWalletByWalletId(string $walletId): array {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT wallet_id, balance, wallet_own FROM wallets WHERE wallet_id = :wallet_id");
        $stmt->execute([
            ':wallet_id' => $walletId
        ]);
        $result = $stmt->fetch();

        return $result;
    }

    function getWalletByWalletOwn(string $walletOwn): array {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT wallet_id, balance, wallet_own FROM wallets WHERE wallet_own = :wallet_own");
        $stmt->execute([
            ':wallet_own' => $walletOwn
        ]);
        $result = $stmt->fetch();

        return $result;
    }

    function updateBalance(string $wallet_id, float $currentBalance, float $value): array {
        $con = DatabaseConnection::getInstance();

        $adjustedBalance = $currentBalance + $value; // value can be minus. So current balance will be subtracted.
 
        $stmt = $con->prepare("UPDATE wallets SET balance = :balance WHERE wallet_id = :wallet_id");
        $result = $stmt->execute([
            ':balance' => $adjustedBalance,
            ':wallet_id' => $wallet_id
        ]);

        if ($result) {
            return array('code' => 200, 'message' => 'Update balance successfully.'); 
        } else {
            return array('code' => 400, 'message' => 'Update balance unsuccessfully. Please try again later.');
        }
    }

}