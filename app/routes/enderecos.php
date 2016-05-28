<?php
if(!defined("SPECIALCONSTANT")) die ("Acesso negado!");

/*
     Metodo GET
     Possibilita api oferecer pela url https://api.ongbook.org/v1/enderecos
     a listagem de todas enderecos das Entidades cadastradas.
*/

$app->get("/enderecos", function() use($app)
{
     try{
          $connection = getConnection();
          $dbh = $connection->prepare("SELECT * FROM endereco");
          $dbh->execute();
          $enderecos = $dbh->fetchAll(PDO::FETCH_ASSOC);
          $connection = null;

          $app->response->headers->set("Content-type", "application/json;charset=utf-8");
          $app->response->status(200);
          $app->response->body(json_encode($enderecos));
     }
     catch(PDOException $e)
     {
          echo "Erro: " . $e->getMessage();
     }
});
