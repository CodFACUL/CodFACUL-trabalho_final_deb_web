<?php
require "config.php";
require "funcoes.php";

if (empty($_SESSION['cLogin'])) {
  ?>
  <script>
      window.location.href = "./index.php";
  </script>
  <?php
}

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

$produtos = listaProdutos();

if (!empty($_GET['acao'])) {
  if ($_GET['acao'] == 'deletar') {
    if (deletarProduto($_GET['id'])) {
      ?>
    <script>
      window.location.href = "./listagemProduto.php";
    </script>
  <?php
    }
  }
}
?>

<div class="container">
  <h2>lista de Produtos</h2>
  <a href="?acao=sair">Sair</a>
  <a href="./adicionarProduto.php" class="btn btn-default">Adicionar</a>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome Produto</th>
        <th scope="col">Nome Fornecedor</th>
        <th scope="col">Nome Categoria</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($produtos as $produto): ?>
        <tr>
          <th scope="row"><?= $produto['IDProduto'] ?></th>
          <td><?= $produto['NomeProduto'] ?></td>
          <td><?= $produto['NomeCompanhia'] ?></td>
          <td><?= $produto['NomeCategoria'] ?></td>
          <td>
            <a href="editarProduto.php?id=<?= $produto['IDProduto'] ?>" class="btn btn-default">Editar</a>
            <a href="?&acao=deletar&id=<?= $produto['IDProduto'] ?>" class="btn btn-default">Deletar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>