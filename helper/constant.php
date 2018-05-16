<?php

class HTTPStatusCode {
    // 200 series
    const success = 200;

    // 400 series
    const unauthorized = 401;

    // 500 series
    const serverError = 500;
}

class HTTPStatusMessage {
    // 200 series
    const success = 'Connect database successfully.';

    // 400 series
    const unauthorized = 'Username or Password is incorrect.';

    // 500 series
    const serverError = 'Internal server error.';
}