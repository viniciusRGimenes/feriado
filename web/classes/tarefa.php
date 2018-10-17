<?php 
require_once('database.php');

class Tarefa{
    const CHAMADO_ABERTO = 0;
    const CHAMADO_FECHADO = 1;

    private $id = null;
    private $titulo;
    private $descricao;
    private $status;
    private $log;

    public function criar($titulo,$descricao,$id = null,$status = null,$log = null){
        $this->setId($id);
        $this->setTitulo($titulo);
        $this->setDescricao($descricao);
        $this->setStatus($status ? $status: self::CHAMADO_ABERTO);
        if($log == null){
            //TODO: refatorar log;
            //Mockado enquanto a autenticacao do usuario não ta pronta
            $log = array(
                    array(
                        "usuario"=>"user",
                        "alteracao"=> "criou registro",
                        "data"=> date("Y-m-d H:i:s")
                    ));
        }
        $this->setLog($log);
    }
    public function setLog($log){
         if($this->log != null)
            $aux = $this->getLog();
         $aux[] = $log;
         $this->log =serialize($aux);
    }
    public function getLog(){   
       return unserialize($this->log);
    }
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }
    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    
    public function getTitulo(){
        return $this->titulo;
    }
    
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function salvar(){
        $retorno = false;
        if(isset($this->titulo)&& isset($this->descricao)){
            $database = new Database();
            if($this->id == null){
                $sql = "insert into `tarefa`(`titulo`,`descricao`,`status`,`log`) 
                    values ('{$this->titulo}','{$this->descricao}',{$this->status},'{$this->log}' )";
            }
            else{
                //TODO: refatorar log;
                //Mockado enquanto a autenticacao do usuario não ta pronta
                $this->setLog(array(
                    "usuario"=>"user",
                    "alteracao"=> "editou o registro",
                    "data"=> date("Y-m-d H:i:s")
                ));
                $sql = "update `tarefa` 
                    set titulo ='{$this->titulo}', descricao = '{$this->descricao}', status = {$this->status}, log = '{$this->log}' where id = {$this->id}";
            }

            if($database->executar($sql)===true){
                $retorno = true;
            }
            else echo $e->error.' '.$sql;
        }
        return $retorno;
    }
    // Será o melhor lugar para essa função?   
    public function getAllTarefas(){
        $query  = "SELECT * FROM `tarefa`";
        $database = new Database();
        $result = $database->executar($query);
        $tarefas = [];
        if( $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $tarefa = new Tarefa();
                $tarefa->criar(
                    $row['titulo'],
                    $row['descricao'],
                    $row['id'],
                    $row['status'],
                    $row['log']
                );
                $tarefas[] = $tarefa;
            }
        }
        return $tarefas;
    }
}