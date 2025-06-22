<?php

use App\Sys\App;

include_once "../vendor/autoload.php";

/** The absolute path towards the 'public' directory. */
const PUBLIC_DIR = __DIR__;

/** The absolute path of the root folder for the project. */
define("ROOT_DIR", realpath(PUBLIC_DIR . "/../"));

/** The absolute path of the PHP files for the app. */
define("APP_DIR", realpath(ROOT_DIR . "app/"));

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