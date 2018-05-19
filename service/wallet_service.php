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

}