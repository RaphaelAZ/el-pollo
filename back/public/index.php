<?php

use App\Sys\App;

include_once "../vendor/autoload.php";

const PUBLIC_DIR = __DIR__;
define("APP_DIR", realpath(PUBLIC_DIR . "/../app/"));
define("DATA_DIR", realpath(APP_DIR . "/data"));

$app = new App();
$app->init();