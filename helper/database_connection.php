<?php

include 'constant.php';

class DatabaseConnection {

    private $host = 'localhost';
    private $port = '3306';
    private $user = 'root';
    private $password = 'root';
    private $db = 'bussypay';

    function connect() {
        $con = @new mysqli($this->host, $this->user, $this->password, $this->db);

        if ($con->connect_error) {
            $response = array('code' => HTTPStatusCode::serverError, 'message' => $con->connect_error);
        } else {
            $response = array('code' => HTTPStatusCode::success, 'message' => HTTPStatusMessage::success);
        }
        
        echo json_encode($response);
    }

    // Do not forgot to implement close connection fucntion.
}
