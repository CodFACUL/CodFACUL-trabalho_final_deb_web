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
    <title>Lucas</title>
</head>

<body>
    <div class="container">
<?php
if (!empty($_SESSION['cLogin'])) {
  ?>
  <script>
      window.location.href = "./listagemProduto.php";
  </script>
  <?php
}
?>

<div class="container">
    <h2>Tela de login</h2>
    <?php
    if (!empty($_POST['senha']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if (login($email, $senha)) {
            ?>
            <script>
                window.location.href = "./listagemProduto.php";
            </script>
        <?php
            } else {
                ?>
            <div class="alert alert-danger">
                usuários e/ou senha incorretos!
            </div>
    <?php
        }
    } ?>
    <form method="POST">
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha">
        </div>
        <input type="submit" value="Entrar" class="btn btn-primary">
    </form>
</div>

</body>
</html>