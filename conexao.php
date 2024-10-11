<?php
class Conexao{
    private $host = "localhost";
    private $user = "root";
    private $pass = "020271mM#";
    private $database = "db1";
    public $conn;
    public function __construct(){
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->database);
    }
    public function testaConexao():string{
        if($this->conn->connect_error) return "Erro ao conectar ao banco de dados: ". $this->conn->connect_error;
       return "";
    }
}
