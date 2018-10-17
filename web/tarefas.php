
    <div class="jumbotron">
        
<?php
    require_once('header.php');
    require_once('classes/tarefa.php');
    if($_POST['descricao']!='' && $_POST['titulo']!=''){
        $novo = new Tarefa();
        $novo->criar($_POST['titulo'],$_POST['descricao'],$_POST['id'],$_POST['status']);
        if($novo->salvar()){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Tarefa salva com sucesso!</strong>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
        }else{
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Algo deu errado!</strong>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
        }
    }
    ?>
    <div class="container"> 
            <h3>
                Cadastro de tarefas
            </h3>
        
    <?php
    if($_GET['edit']==1){
        $infos = unserialize(base64_decode($_GET['task']));
        $edit = TRUE;
    }
        ?>
        <form action="tarefas.php" method="post">
            <div class="form-group">
                <input type="hidden" class="form-control" name='id' value="<?=($edit)? $infos->getId(): '' ?>"/>
                <input type="text" placeholder="Titulo" class="form-control" name="titulo" value="<?=($edit)? $infos->getTitulo() : null ?>"/>
            </div>
            <div class="form-group">
                <textarea type="textarea" placeholder="Descricao" class="form-control" name="descricao" ><?=($edit)?$infos->getDescricao(): '' ?></textarea>
            </div>
            <div class="form-group"  <?=(!$edit)?'hidden':null?>> 
                <label class="col-sm-4 col-form-label"> Status :</label>
                <select name="status" class="form-control" index=<?=($edit)?$infos->getStatus(): 1 ?> >
                    <option value=0>Aberto</option>
                    <option value=1>Fechado</option>
                </select>
            </div>
            <input type="submit" class="btn btn-outline-primary btn-block" name="btn_enviar" value="Salvar"/>
        </form>
        <br/>
    </div>
    <div class="container">
        <h4>
            Tarefas cadastradas
        </h4>
    <?php
        $tarefa = new Tarefa();
        $tarefas = $tarefa->getAllTarefas();
        if(!isset($tarefas  )){
            echo "Sem tarefas cadastradas";
        }  
        else{?>
            <table class='table table-borderless table-hover'>
                <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Descricao</th>
                        <th>Titulo</th>
                        <th>Status</th>
                        <th>    </th>
                    </tr>
                </thead>
                <tbody class="table-striped">
        <?php
            foreach ($tarefas as $task){
                $edit=base64_encode(serialize($task));
                echo "<tr>
                        <td>".$task->getId()."</td>
                        <td>".$task->getTitulo()."</td>
                        <td>".$task->getDescricao()."</td>
                        <td>".($task->getStatus()? 'Fechado': 'Aberto')."</td>
                        <td>
                            <a href='tarefas.php?edit=1&task={$edit}'>
                                <span class='badge badge-pill badge-dark'>editar</span>
                            </a>
                        </td>
                    </tr>";
            }
        }?>
                </tbody>
            </table>
    </div>
</div>
<?php require_once('footer.php');