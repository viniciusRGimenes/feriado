<?php
require_once('database.php');

class Usuario{
private $email;
private $senha;
private $status;
private $log;
private $id;

public function setEmail($email){
    $this->email;
}
public function getEmail($email){
    $this->email;
}
public function setSenha($senha){
    $this->senha;
}
public function getSenha($senha){
    $this->senha;
}
public function setStatus($status){
    $this->status;
}
public function getStatus($status){
    $this->status;
}
public function setLog($log){
    $this->log;
}
public function getLog($log){
    $this->log;
}
public function setId($id){
    $this->email;
}
public function getId($id){
    $this->email;
}

public function cadastrar_usuario($email = "", $senha = "", $status = "", $log=""){
    $retorno = false;
    if($email == "" || $senha  == ""){
        return false;
    }

$this->setEmail($email);
$this->setSenha($senha);
$this->setStatus($status);
$this->setLog($log);
    
$database = new Database();
$criptografia = md5($senha);      
$sql = "INSERT INTO `usuario` (`id`, `email`, `senha`, `status`, `log`)
    VALUES (NULL,'".$email."','".$criptografia."',0,'".$log."')";
$result = $database->executar($sql);

if($result === TRUE){
    $retorno = true;
}
return  $retorno;

}


public function autenticar_usuario($email = "", $pass = ""){
$boolean = false;

if($email == "" || $pass == "") {
    return false;
}

$database = new Database();
$pass = md5($pass);

$this->setEmail($email);

$sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$pass'";

$query = $database->executar($sql);

if($query->num_rows > 0) {
    $boolean = true;
}
return $boolean;
}

public function getAllUsuarios(){
$query  = "SELECT * FROM `usuario`";
$database = new Database();
$result = $database->executar($query);
$usuarios = [];
if( $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $usuario = array('id'=>$row['id'],'email'=>$row['email'], 'senha'=>$row['senha'], 'status'=>$row['status'],'log'=>$row['log']);
        $usuarios[] = $usuario;
    }
}
return $usuarios;
}

public function Editar_usuario($id = "", $senha = ""){ 
$database = new Database();
if($id != ''){
    $criptografada = md5($senha);
    $sql = "UPDATE usuario SET senha ='".$criptografada."' WHERE id = ".$id;
    return ($database->executar($sql)===TRUE);
        
}}}
