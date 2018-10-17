<?php
session_start();
require_once('classes/usuario.php');
if(!isset($_SESSION['logado'])){
   exit(header('location:login.php'));
}

if(isset($_SESSION['usuario'])){
   $email = $_SESSION['usuario'];
}

$logout = $_GET['logout'];

if($logout == 1){
   session_unset();
   exit(header('location:login.php'));
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>

<!--<style>
    form {
    
        width: 400px; 
        height: 150px; 
        left: 50%; 
        margin: -130px 0 0 -210px; 
        padding:10px;
        position: absolute; 
        top: 30%;
         }
       
</style>-->


<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="usuarios.php">Usuários</a>
            </li>
            <li class="nav-item active">
                    <a class="nav-link" href="tarefas.php">Tarefas</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="cadastro.php">Cadastrar</a>
            </li>
            <li class="nav-item active right-align">
                <a class="nav-link" href="./index.php?logout=1">logout</a>
            </li>
        </ul>
    </nav>
<!--
/* Sugestão:
    inserir toda a logica de autenticação do usuario no header, pois ele será chamado em todas as paginas;
*/-->
<?php
if(isset($_SESSION['usuario'])){

    echo '<a href="./index.php?logout=1">Sair</a>';
 
 }
 
 ?>
 