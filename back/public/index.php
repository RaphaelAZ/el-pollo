<?php

use App\Sys\App;

include_once "../vendor/autoload.php";

const PUBLIC_DIR = __DIR__;
define("APP_DIR", realpath(PUBLIC_DIR . "/../app/"));
define("DATA_DIR", realpath(APP_DIR . "/data"));

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

$app = new App();
$app->init();