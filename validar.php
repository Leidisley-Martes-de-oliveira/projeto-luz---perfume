<?php
require_once('conexao.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$tel = $_POST['telefone'];
$cpf = $_POST['cpf'];
$cep = $_POST['cep'];
$end = $_POST['endereco'];

$bancoDados = new db();
$link = $bancoDados->conecta_mysql();

$nome = mysqli_real_escape_string($link, $nome);
$email = mysqli_real_escape_string($link, $email);
$senha = mysqli_real_escape_string($link, $senha);
$tel = mysqli_real_escape_string($link, $tel);
$cpf = mysqli_real_escape_string($link, $cpf);
$cep = mysqli_real_escape_string($link, $cep);
$end = mysqli_real_escape_string($link, $end);

$sql = "INSERT INTO usuario(nome, email, senha, telefone, cpf, cep, endereco) VALUES('$nome', '$email', $senha, '$tel', '$cpf', '$cep', '$end')";

mysqli_query($link, $sql);

?>
<br>

<h3 >Cadastro efetuado com sucesso!</h3><br>
<a href="index.html"> Voltar </a>