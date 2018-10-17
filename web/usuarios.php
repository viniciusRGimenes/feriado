
    <div class="jumbotron">
        
<?php
    require_once('header.php');
    require_once('classes/usuario.php');

    $id = $_POST["id"];
    $senha = $_POST["senha_editar"];
    if($id!=''&& $senha != '') {
       
        $user = new Usuario();
        $cadastro_valido = $user->Editar_usuario($id, $senha);
        if($cadastro_valido){
            echo "<script>alert('Deu Bom');
            window.location.href = 'usuarios.php';
            </script>";
            
        }else{
                echo "Algo deu errado";
        }
    
    }else{
        echo "Informe a nova senha";
    }
    
?>    
    <div class="container">
        <h4>
            Usuários cadastrados
        </h4>
    <?php
        $usuario = new Usuario();
        $usuarios = $usuario->getAllUsuarios();
        if(!isset($usuarios)){
            echo "Sem usuarios cadastradas";
        }  
        else{?>
            <table class='table table-borderless table-hover'>
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Log</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                       
                    </tr>
                </thead>
                <tbody class="table-striped">
        <?php

            
            foreach ($usuarios as $valor){
                  
                echo "<tr>
                        <td>".$valor["id"]."</td>
                        <td>".$valor['email']."</td>
                        <td>".$valor['status']."</td>
                        <td>".$valor['log']."</td>
                        <td><a href='usuarios.php?id={$valor["id"]}&edit=1'>Editar</a></td>
                        <td><a href='excluir.php?id={$valor["id"]}&delete=1'>Excluir</a></td>
                    </tr>";
            }
        ?>
        <?php
        $database = new Database();
        if($_GET['edit']==1){
        $sql = "SELECT * FROM usuario where id = {$_GET['id']}";
        $result = $database->executar($sql);
        $user = $result->fetch_assoc();
        

        ?>
        <?php
        $database =  new Database();
        if($_GET['delete']==1){
        $sql = "DELETE FROM `usuario` WHERE `usuario`.`id` = {$_GET['id']}";
        $result = $database->executar($sql);
        $user = $result->fetch_assoc();
        }

        ?>

            <form action = "usuarios.php" method = "post">
  <table>
        <h2> Editar Senha</h2>
        <tr>
            <td>
                <input value=<?echo $user['id']?> name='id' style="display:none"/>
                <label>E-mail</label>
                <label><?echo $user['email'];?></label>
            </td>
        </tr>  

        <tr>
            <td>

                <label>Senha</label>
                <input type="password" name="senha_editar" />

            </td>
        </tr>

        <tr>
            <td>
                <input type="submit" name="botao_editar" value="Salvar" />
            </td>
        </tr>
    </table>
    </form>
    <?php
    } }
    ?>
       
                </tbody>
            </table>
    </div>
</div>
<?php require_once('footer.php');?>