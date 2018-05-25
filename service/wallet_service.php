<?php

require_once __DIR__ . '/../helper/json_response_parser.php';
require_once __DIR__ . '/../helper/database_connection.php';
require __DIR__ . '/shared_service.php';

class WalletService extends SharedService {

    function getAllWallets(): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT wallets.id, wallets.wallet_id, wallets.balance, users.username, 
                                    users.first_name, users.last_name 
                                    FROM wallets INNER JOIN users ON wallets.wallet_own = users.id");
        $stmt->execute();
        $result = $stmt->fetchAll();

        return JSONResponseParser::parse($result, 'Success', 'No wallets found.', parent::countRecords('wallets'));
    }

    function getWalletByWalletOwn(string $walletOwn): string {
        $con = DatabaseConnection::getInstance();

        $stmt = $con->prepare("SELECT wallets.id, wallets.wallet_id, wallets.balance, users.username, 
                                    users.first_name, users.last_name 
                                    FROM wallets INNER JOIN users ON wallets.wallet_own = users.id 
                                    WHERE wallets.wallet_id = :wallet_id");
                                    
        $stmt->execute([
            ':wallet_id' => trim($walletOwn)
        ]);
        $result = $stmt->fetchAll();

        return JSONResponseParser::parse($result, 'Success', 'No wallet found.', parent::countRecords('wallets'));
    }

    function updateBalance(int $wallet_own_id, float $value): string {
        $con = DatabaseConnection::getInstance();

        // Get current balance
        $stmt = $con->prepare("SELECT balance FROM wallets WHERE wallet_own = :wallet_own");
        $stmt->execute([
            ':wallet_own' => $wallet_own_id // (user id that owns the wallet.)
        ]);
        $result = $stmt->fetch();
        $balance = $result['balance'];

        $adjustedBalance = $balance + $value; // value can be minus. So current balance will be subtracted.
 
        $stmt = $con->prepare("UPDATE wallets SET balance = :balance WHERE wallet_own = :wallet_own");
        $result = $stmt->execute([
            ':balance' => $adjustedBalance,
            ':wallet_own' => $wallet_own_id // (user id that owns the wallet.)
        ]);

        return JSONResponseParser::parse($result, 'Update balance successfully.', 
                                            'Update balance unsuccessfully. Please try again later.', parent::countRecords('wallets'));
    }

}