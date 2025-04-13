<?php
//conecção com banco de dados
class db{
    private $host = 'localhost';
    private $usuario = 'root';
    private $senha = '';
    private $database = 'cliente';

    public function conecta_mysql(){
        $con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);
        return $con;
    }
}
?>

