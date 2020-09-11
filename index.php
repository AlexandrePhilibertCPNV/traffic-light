<?php

session_start();

$request_uri = '';
$get_params_offset = stripos($_SERVER['REQUEST_URI'], '?');

// Remove GET parameters from request uri
if ($get_params_offset) {
    $request_uri = substr($_SERVER['REQUEST_URI'], 0, $get_params_offset);
} else {
    $request_uri = $_SERVER['REQUEST_URI'];
}

ob_start();

switch ($request_uri) {
    case '':
    case '/':
        require_once 'controllers/index.php';
        require_once 'views/index.php';
        break;
    default:
        http_response_code(404);
        break;
}

$_VIEW = ob_get_clean();

require 'layout.php';
