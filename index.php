<?php
require_once 'vendor/autoload.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

define("SPECIALCONSTANT", true);
require 'app/libs/connect.php';
require 'app/routes/api.php';

$app->run();