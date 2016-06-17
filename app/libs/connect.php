<?php
if(!defined("SPECIALCONSTANT")) die ("Acesso negado!" );

function getConnection()
{
    try{
        $db_username = "u769266113_bdob";
        $db_password = " ";
        $connection = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u769266113_bdob", $db_username, $db_password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    return $connection;
}