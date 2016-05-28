<?php
if(!defined("SPECIALCONSTANT")) die ("Acesso negado!" );

function getConnection()
{
    try{
        
        // Servidor MySQL de teste http://freemysqlhosting.net

        $db_username = "sql3121340";
        $db_password = "riEU3kzLzf";
        $connection = new PDO("mysql:host=sql3.freemysqlhosting.net:3306;dbname=sql3121340", $db_username, $db_password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    return $connection;
}