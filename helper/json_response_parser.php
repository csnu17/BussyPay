<?php

class JSONResponseParser {

    public static function parse(array $result, string $successMessage, string $errorMessage): array {
        if ($result) { // success case, parse data with status code and its contents.
            $responseArray = array('code' => 200,
                                    'message' => $successMessage,
                                    'data' => $result);
            return $responseArray;

        } else { // error case
            return json_encode(array('code' => 400, 'message' => $errorMessage));
        }
    }

}