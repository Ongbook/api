<?php
if(!defined("SPECIALCONSTANT")) die ("Acesso negado!");

/*
     Metodo GET
     Possibilita api oferecer pela url https://api.ongbook.org/v1/entidades
     a listagem de todas entidades cadastradas.
*/

$app->get("/entidades", function() use($app)
{
     try{
          $connection = getConnection();
          $dbh = $connection->prepare("SELECT * FROM entidades");
          $dbh->execute();
          $entidades = $dbh->fetchAll(PDO::FETCH_ASSOC);
          $connection = null;

          $app->response->headers->set("Content-type", "application/json;charset=utf-8");
          $app->response->status(200);
          $app->response->body(json_encode($entidades));
     }
     catch(PDOException $e)
     {
          echo "Erro: " . $e->getMessage();
     }
});



/*
     Metodo GET - passando parâmetro.
     Possibilita a api oferecer as informações detalhada (perfil) de uma Entidade Social.
     A url deve ser consumida passando um parâmetro para seleção. No caso, @CNPJ.
*/

$app->get("/entidades/:cnpj", function($cnpj) use($app)
{
     try{
          $connection = getConnection();
          $dbh = $connection->prepare("SELECT * FROM entidades WHERE cnpj = ?");
          $dbh->bindParam(1, $cnpj);
          $dbh->execute();
          $entidade = $dbh->fetchObject();
          $connection = null;

          $app->response->headers->set("Content-type", "application/json;charset=utf-8");
          $app->response->status(200);
          $app->response->body(json_encode($entidade));
     }
     catch(PDOException $e)
     {
          echo "Erro: " . $e->getMessage();
     }
});



/*
     Metodo POST
     Possibilita a api oferecer o cadastro de Entidade Social pela url https://api.ongbook.org/v1/entidades.
*/

$app->post("/entidades/", function() use($app)
{
     $cnpj = $app->request->post("cnpj");
     $razaoSocial = $app->request->post("razaoSocial");
     $nomeFantasia = $app->request->post("nomeFantasia");
     $endereco = $app->request->post("endereco");
     $numero = $app->request->post("numero");
     $bairro = $app->request->post("bairro");
     $cidade = $app->request->post("cidade");
     $uf = $app->request->post("uf");
     $publicoAlvo = $app->request->post("publicoAlvo");
     $site = $app->request->post("site");
     $email = $app->request->post("email");
     $tel = $app->request->post("tel");
     $nomeResponsavel = $app->request->post("nomeResponsavel");
     $cel = $app->request->post("cel");

     try{
          $connection = getConnection();
          $dbh = $connection->prepare("INSERT INTO entidades VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
          $dbh->bindParam(1, $cnpj);
          $dbh->bindParam(2, $razaoSocial);
          $dbh->bindParam(3, $nomeFantasia);
          $dbh->bindParam(4, $endereco);
          $dbh->bindParam(5, $numero);
          $dbh->bindParam(6, $bairro);
          $dbh->bindParam(7, $cidade);
          $dbh->bindParam(8, $uf);
          $dbh->bindParam(9, $publicoAlvo);
          $dbh->bindParam(10, $site);
          $dbh->bindParam(11, $email);
          $dbh->bindParam(12, $tel);
          $dbh->bindParam(13, $nomeResponsavel);
          $dbh->bindParam(14, $cel);

          $dbh->execute();
          $ultimaEntidadeCadastrada = $connection->lastInsertId();
          $connection = null;

          $app->response->headers->set("Content-type", "application/json;charset=utf-8");
          $app->response->status(200);
          $app->response->body(json_encode($ultimaEntidadeCadastrada));
     }
     catch(PDOException $e)
     {
          echo "Error: " . $e->getMessage();
     }
});

/*
     Metodo PUT
     Possibilita a api oferecer a 'edição do perfil de uma Entidade Social'.
*/

/*

$app->put("/entidades/", function() use($app)
{
     $cnpj = $app->request->post("cnpj");
     $razaoSocial = $app->request->post("razaoSocial");
     $nomeFantasia = $app->request->post("nomeFantasia");
     $endereco = $app->request->post("endereco");
     $numero = $app->request->post("numero");
     $bairro = $app->request->post("bairro");
     $cidade = $app->request->post("cidade");
     $uf = $app->request->post("uf");
     $publicoAlvo = $app->request->post("publicoAlvo");
     $site = $app->request->post("site");
     $email = $app->request->post("email");
     $tel = $app->request->post("tel");
     $nomeResponsavel = $app->request->post("nomeResponsavel");
     $cel = $app->request->post("cel");

     try{
          $connection = getConnection();
          $dbh = $connection->prepare("UPDATE entidades SET (cnpj = ?, razaoSocial = ?, nomeFantasia = ?, endereco = ?,
                    numero = ?, bairro = ?, cidade = ?, uf = ?, publicoAlvo = ?, site = ?, email = ?, tel = ?, nomeResponsavel ?, cel = ?) WHERE id = ?");

          $dbh->bindParam(2, $razaoSocial);
          $dbh->bindParam(3, $nomeFantasia);
          $dbh->bindParam(4, $endereco);
          $dbh->bindParam(5, $numero);
          $dbh->bindParam(6, $bairro);
          $dbh->bindParam(7, $cidade);
          $dbh->bindParam(8, $uf);
          $dbh->bindParam(9, $publicoAlvo);
          $dbh->bindParam(10, $site);
          $dbh->bindParam(11, $email);
          $dbh->bindParam(12, $tel);
          $dbh->bindParam(13, $nomeResponsavel);
          $dbh->bindParam(14, $cel);

          $dbh->execute();
          $connection = null;

          $app->response->headers->set("Content-type", "application/json;charset=utf-8");
          $app->response->status(200);
          $app->response->body(json_encode(array("res" => 1)));
     }
     catch(PDOException $e)
     {
          echo "Error: " . $e->getMessage();
     }
});



/*
     Metodo DELETE (na verdade não haverá a possibilidade de deletar uma Entidade Social, somente desabilitar)
     O método descrito abaixo fica sendo só para motivo de aprendizado.
     Devemos implementar um metodo que possibilite a api oferecer à Entidade Social desabilitar seu cadastro.
     Com um atributo booleano.
*/

/*
$app->delete("/entidades/:cnpj", function($cnpj) use($app)
{
     try{
          $connection = getConnection();
          $dbh = $connection->prepare("DELETE FROM entidades (WHERE cnpj = ?");
          $dbh->bindParam(1, $cnpj);
          $dbh->execute();
          $connection = null;

          $app->response->headers->set("Content-type", "application/json");
          $app->response->status(200);
          $app->response->body(json_encode(array("res" => 1)));
     }
     catch(PDOException $e)
     {
          echo "Error: " . $e->getMessage();
     }
}); */