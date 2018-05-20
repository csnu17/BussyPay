<?php

require __DIR__ . '/../helper/json_response_parser.php';
require __DIR__ . '/../helper/database_connection.php';

class WalletService {

    function getAllWallets(): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT id, wallet_id, balance, wallet_own FROM wallets");
        $stmt->execute();
        $result = $stmt->fetchAll();

        return JSONResponseParser::parse($result, 'Success', 'No wallets found.');
    }

    function getWalletByWalletId(string $walletId): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT id, wallet_id, balance, wallet_own FROM wallets WHERE wallet_id = :wallet_id");
        $stmt->execute([
            ':wallet_id' => trim($walletId)
        ]);
        $result = $stmt->fetch();

        return JSONResponseParser::parse($result, 'Success', 'No wallet found.');
    }

    function getWalletByWalletOwn(string $walletOwn): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT id, wallet_id, balance, wallet_own FROM wallets WHERE wallet_own = :wallet_own");
        $stmt->execute([
            ':wallet_own' => trim($walletOwn)
        ]);
        $result = $stmt->fetch();

        return JSONResponseParser::parse($result, 'Success', 'No wallet found.');
    }

    function updateBalance(string $wallet_id, float $currentBalance, float $value): string {
        $con = DatabaseConnection::getInstance();

        $adjustedBalance = $currentBalance + $value; // value can be minus. So current balance will be subtracted.
 
        $stmt = $con->prepare("UPDATE wallets SET balance = :balance WHERE wallet_id = :wallet_id");
        $result = $stmt->execute([
            ':balance' => $adjustedBalance,
            ':wallet_id' => trim($wallet_id)
        ]);

        return JSONResponseParser::parse($result, 'Update balance successfully.', 
                                            'Update balance unsuccessfully. Please try again later.');
    }

}