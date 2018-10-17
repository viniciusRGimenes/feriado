<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="./css/login.css" rel="stylesheet">

</head>

<?php
    if($_GET["erro"] == 171) {
        ?>
        <div class="alert alert-danger text-center" id="alert" role="alert">Usuário ou Senha inválida</div>

        <?php
    }
?>

<body>
    <div class="container">
        <form action="autenticar.php" method="post">
        <div class="form-group">
            <h1 class="text-center">Login</h1>
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" name="email">
            <small id="emailHelp" class="form-text text-muted">Nunca compartilhe sua senha com ninguém.</small>
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" placeholder="Senha" name="senha">
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
        <a href='cadastro.php'> Não tenho cadastro....</a>
        </form>
    </div>
</body>

<?php
    require_once('footer.php');
?>