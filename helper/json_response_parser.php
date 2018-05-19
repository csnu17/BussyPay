<?php

class JSONResponseParser {

    public static function parse($result, string $successMessage, string $errorMessage): string {
        if ($result) { // success case, parse data with status code and its contents.
            $responseArray = array('code' => 200,
                                    'message' => $successMessage,
                                    'data' => $result);
            return json_encode($responseArray);

        } else { // error case
            return json_encode(array('code' => 400, 'message' => $errorMessage));
        }
    }

}