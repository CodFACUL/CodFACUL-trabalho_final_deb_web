<?php 

function login($email, $senha)
{
  global $pdo;

  $sql = "SELECT ID FROM USUARIO WHERE EMAIL = :email AND SENHA = :senha";
  $sql = $pdo->prepare($sql);
  $sql->bindValue(":email", $email);
  $sql->bindValue(":senha", $senha);
  $sql->execute();

  if ($sql->rowCount() > 0) {
      $dado = $sql->fetch();
      $_SESSION['cLogin'] = $dado['ID'];
      return true;
  } else {
      return false;
  }
}

function listaProdutos() 
{
  global $pdo;

  $sql = "
      SELECT * 
        FROM produtos AS p 
        JOIN fornecedores AS f 
          ON f.IDFornecedor = p.IDFornecedor 
        JOIN categorias AS c 
          ON c.IDCategoria = p.IDCategoria 
    ORDER BY p.IDProduto DESC;
  ";
  $sql = $pdo->prepare($sql);
  $sql->execute();

  if ($sql->rowCount() > 0) {
      return $sql->fetchAll();
  } else {
      return false;
  }
}

function listaFornecedores() 
{
  global $pdo;

  $sql = "SELECT * FROM fornecedores;";
  $sql = $pdo->prepare($sql);
  $sql->execute();

  if ($sql->rowCount() > 0) {
      return $sql->fetchAll();
  } else {
      return false;
  }
}

function listaCategorias() 
{
  global $pdo;

  $sql = "SELECT * FROM categorias;";
  $sql = $pdo->prepare($sql);
  $sql->execute();

  if ($sql->rowCount() > 0) {
      return $sql->fetchAll();
  } else {
      return false;
  }
}

function idProduto() 
{
  global $pdo;

  $sql = "SELECT * FROM produtos ORDER BY 1 DESC;";
  $sql = $pdo->prepare($sql);
  $sql->execute();

  if ($sql->rowCount() > 0) {
    $id = $sql->fetch();
    return $id['IDProduto'] + 1;
  } else {
      return 1;
  }
}

function criarProduto(
    $nome
  , $idFornecedor
  , $idCategoria
  , $quantidadeUnidade
  , $precoUnidade
  , $unidadeEstoque
  , $unidadeOrdem
  , $nivelReposicao
  , $descontinuado
) {
  global $pdo;
  $idProduto = idProduto();

  $sql = 
  "INSERT INTO produtos(IDProduto, NomeProduto, IDFornecedor, IDCategoria, QuantidadePorUnidade, PrecoUnitario, UnidadesEmEstoque, UnidadesEmOrdem, NivelDeReposicao, Descontinuado) 
        VALUES (:id, :n, :f, :c, :q, :p, :ue, :uo, :nr, :d)
  ";
  $sql = $pdo->prepare($sql);
  $sql->bindValue(":id", $idProduto);
  $sql->bindValue(":n", $nome);
  $sql->bindValue(":f", $idFornecedor);
  $sql->bindValue(":c", $idCategoria);
  $sql->bindValue(":q", $quantidadeUnidade);
  $sql->bindValue(":p", $precoUnidade);
  $sql->bindValue(":ue", $unidadeEstoque);
  $sql->bindValue(":uo", $unidadeOrdem);
  $sql->bindValue(":nr", $nivelReposicao);
  $sql->bindValue(":d", $descontinuado);
  $sql->execute();

  if ($sql->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

function editarProduto($id) 
{
  global $pdo;

  $sql = "
    SELECT * 
      FROM produtos AS p
      JOIN fornecedores AS f 
        ON f.IDFornecedor = p.IDFornecedor
      JOIN categorias AS c 
        ON c.IDCategoria = p.IDCategoria
      WHERE p.IDProduto = :id
  ";
  $sql = $pdo->prepare($sql);
  $sql->bindValue(":id", $id);
  $sql->execute();

  if ($sql->rowCount() > 0) {
    return $sql->fetch();
  } else {
    return false;
  }
}

function alterarProduto(
    $id
  , $nome
  , $idFornecedor
  , $idCategoria
  , $quantidadeUnidade
  , $precoUnidade
  , $unidadeEstoque
  , $unidadeOrdem
  , $nivelReposicao
  , $descontinuado
) 
{
  global $pdo;

  $sql = "
    UPDATE produtos 
    SET NomeProduto = :n
      , IDFornecedor = :f
      , IDCategoria = :c
      , QuantidadePorUnidade = :q
      , PrecoUnitario = :p
      , UnidadesEmEstoque = :ue
      , UnidadesEmOrdem = :uo
      , NivelDeReposicao = :nr
      , Descontinuado = :d
    WHERE IDProduto = :id
  ";
  $sql = $pdo->prepare($sql);
  $sql->bindValue(":id", $id);
  $sql->bindValue(":n", $nome);
  $sql->bindValue(":f", $idFornecedor);
  $sql->bindValue(":c", $idCategoria);
  $sql->bindValue(":q", $quantidadeUnidade);
  $sql->bindValue(":p", $precoUnidade);
  $sql->bindValue(":ue", $unidadeEstoque);
  $sql->bindValue(":uo", $unidadeOrdem);
  $sql->bindValue(":nr", $nivelReposicao);
  $sql->bindValue(":d", $descontinuado);
  $sql->execute();

  return true;
}

function deletarProduto($id) 
{
  global $pdo;

  $sqlOderns = "";
  $sqlOderns = $pdo->prepare($sqlOderns);
  $sqlOderns->bindValue(":id", $id);
  $sqlOderns->execute();

  $sql = "
    DELETE FROM ordens_detalhes WHERE IDProduto = :idOrdem;
    DELETE FROM produtos WHERE IDProduto = :idProduto;
  ";
  $sql = $pdo->prepare($sql);
  $sql->bindValue(":idOrdem", $id);
  $sql->bindValue(":idProduto", $id);
  $sql->execute();

  if ($sql->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}