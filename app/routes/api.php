<?php
if(!defined("SPECIALCONSTANT")) die ("Acesso negado!");

/* Metodo GET */

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

/* Metodo GET */

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

/* Metodo POST */

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
          $bookId = $connection->lastInsertId();
          $connection = null;

          $app->response->headers->set("Content-type", "application/json;charset=utf-8");
          $app->response->status(200);
          $app->response->body(json_encode($bookId));
     }
     catch(PDOException $e)
     {
          echo "Error: " . $e->getMessage();
     }
});

/* Metodo PUT

$app->put("/books/", function() use($app)
{
     $title = $app->request->put("title");
     $isbn = $app->request->put("isbn");
     $author = $app->request->put("author");
     $id = $app->request->put("id");

     try{
          $connection = getConnection();
          $dbh = $connection->prepare("UPDATE books SET title = ?, isbn = ?, author = ?, created_at = NOW() WHERE id = ?");
          $dbh->bindParam(1, $title);
          $dbh->bindParam(2, $isbn);
          $dbh->bindParam(3, $author);
          $dbh->bindParam(4, $id);
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

/* Metodo DELETE

$app->delete("/books/:id", function($id) use($app)
{
     try{
          $connection = getConnection();
          $dbh = $connection->prepare("DELETE FROM books (WHERE id = ?");
          $dbh->bindParam(1, $id);
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