<?php
header('Access-Control-Allow-Origin: *');
require_once 'vendor/autoload.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

define("SPECIALCONSTANT", true);

// Configuracao PDO - acesso ao db
require 'app/libs/connect.php';

// Rotas
require 'app/routes/entidades.php';
require 'app/routes/enderecos.php';

$app->run();