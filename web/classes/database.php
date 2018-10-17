<?php
class Database{

    private $db_server = 'feriado_db_1';
    private $db_user = 'root';
    private $db_password = 'phprs';
    private $db_database = 'tarefas';

    private $db_conexao;
    public function __construct(){
        $this->conectar();
    }
    
    //Realiza a conecção com o banco de dados
    private function conectar(){
        $conn = new mysqli($this->db_server,$this->db_user,$this->db_password,$this->db_database);
        if($conn->connect_error){
            die("Erro ao tentar conectar no banco de dados: ". $conn->connect_error);
        }
        $this->db_conexao = $conn;
    }
    public function executar($sql){
        return $this->db_conexao->query($sql);
    }
}