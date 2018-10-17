<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Confirmação de exclusão</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    

<form action="excluir.php" method="post">
<table>
        <h2> Confirmação de exclusão</h2>
        <tr>
            <td>
                <input value=<?echo $user['id']?> name='id' style="display:none"/>
                <label>ID</label>
                <label><?echo $user['email'];?></label>
            </td>
        </tr>  

        <tr>
            <td>
                <input type="submit" name='id' value="Excluir" />
                
            </td>
            <td><a href='excluir.php?id={$valor["id"]}&delete=1'>Excluir</a></td>v
        </tr>
    </table>
    </form> 
    

        <?php
        if($_POST['delete']==1){
            $sql = "DELETE FROM usuario where id = {$_POST['id']}";
            $result = $database->executar($sql);
            $user = $result->fetch_assoc();
        }
        ?>





 
</body>
</html>



