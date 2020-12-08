<?php
require "config.php";
require "funcoes.php";

if (!empty($_GET['acao'])) {
  if ($_GET['acao'] == 'sair') {
    unset($_SESSION['cLogin']);
    ?>
    <script>
        window.location.href = "./index.php";
    </script>
    <?php
  }
}
 ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>lucas</title>
</head>

<body>
    <div class="container">
      <?php 
if (empty($_SESSION['cLogin'])) {
  ?>
  <script>
      window.location.href = "./index.php";
  </script>
  <?php
}
  $fornecedores = listaFornecedores();
  $categorias = listaCategorias();

  if (!empty($_POST['nomeProduto'])) {

    if(criarProduto(
        $_POST['nomeProduto']
      , $_POST['fornecedor']
      , $_POST['categoria']
      , $_POST['QuantidadePorUnidade']
      , $_POST['PrecoUnitario']
      , $_POST['UnidadesEmEstoque']
      , $_POST['UnidadesEmOrdem']
      , $_POST['nvelDeReposicao']
      , $_POST['descontinuado'])
    ) { 
      ?>
      <script>
          window.location.href = "./listagemProduto.php";
      </script>
      <?php
    } else {
    echo '<div class="alert alert-danger">
              Não foi possivel adicionar Produto!
          </div>';
    }
  }
?>

<div class="container">
  <h2>Adicionar Produto</h2>
  <form method="POST" >
    <div>
      <label for="fornecedor">Fornecedor:</label>
      <select class="form-control" name="fornecedor" id="fornecedor">
        <?php foreach($fornecedores as $fornecedor): ?>
          <option value="<?= $fornecedor['IDFornecedor'] ?>"><?= $fornecedor['NomeCompanhia'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div>
      <label for="categoria">Categoria:</label>
      <select class="form-control" name="categoria" id="categoria">
        <?php foreach($categorias as $categoria): ?>
          <option value="<?= $categoria['IDCategoria'] ?>"><?= $categoria['NomeCategoria'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div>
      <label for="nomeProduto">Nome do Produto:</label>
      <input class="form-control" type="text" name="nomeProduto">
    </div>

    <div>
      <label for="QuantidadePorUnidade">Quantidade por Unidade:</label>
      <input class="form-control" type="text" name="QuantidadePorUnidade">
    </div>

    <div>
      <label for="PrecoUnitario">Preço por unidade:</label>
      <input class="form-control" type="text" name="PrecoUnitario">
    </div>

    <div>
      <label for="UnidadesEmEstoque">Unidade em Estoque:</label>
      <input class="form-control" type="text" name="UnidadesEmEstoque">
    </div>

    <div>
      <label for="UnidadesEmOrdem">Unidade em Ordem:</label>
      <input class="form-control" type="text" name="UnidadesEmOrdem">
    </div>

    <div>
      <label for="nvelDeReposicao">Nivel de Reposição:</label>
      <input class="form-control" type="text" name="nvelDeReposicao">
    </div>

    <div>
      <label for="descontinuado">Descontinuado:</label>
      <select class="form-control" name="descontinuado" id="descontinuado">
        <option value="T">T</option>
        <option value="F">F</option>
      </select>
    </div>

    <button type="submit" class="btn btn-default mt-5">Adicionar</button>
    <a href="./listagemProduto.php" class="btn btn-default mt-5">Voltar</a>
  </form><br><br>

  <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
