<?php
  require_once('classes/usuarios.php');
  $u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/login_cadastro.css">
  <title>Cadastro de Usuário</title>
</head>
<header>
    LUZ & PERFUME. 
  </header><br><br><br><br><br>
<body>
  <div class="container">
    <h2>Cadastro de Cliêntes</h2>
    <form method="POST">

      <input type="text" id="nome" name="nome" placeholder="Nome Completo" required> 
      <input type="text" id="telefone" name="telefone" placeholder="Telefone" required>
      <input type="email" id="email" name="email" placeholder="E-mail" required>
      <input type="password" id="senha" name="senha" placeholder="Senha" required>
      <input type="password" id="senha" name="confSenha" placeholder="Corfirmar Senha" required>
      <input type="text" id="cpf" name="cpf" placeholder="CPF (000.000.000-00)" required>
      <input type="text" id="cep" name="cep" placeholder="CEP" required onblur="buscarCep()">
      <input type="text" id="endereco" name="endereco" placeholder="Endereço Completo" required>
      
      <button type="submit">Cadastrar</button>
    </form>
	<br>
	<a href="index.php">Voltar</a>
  </div>

  <?php 
//Verificar se clicou no botão.
if(isset($_POST['nome'])) { 
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confirmarSenha = addslashes($_POST['confSenha']);
    $cpf = addslashes($_POST['cpf']);
    $cep = addslashes($_POST['cep']);
    $endereco = addslashes($_POST['endereco']);

    //Verificar se está preenchido.
    if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha) && !empty($cpf) && !empty($cep) && !empty($endereco)) {
        $u->conectar("projeto_login", "localhost", "root", "");
        if($u->msgErro == "") { //Se está tudo certo.
            if($senha == $confirmarSenha) 
            {
                if($u->cadastrar($nome, $telefone, $email, $senha, $cpf, $cep, $endereco)) 
                {
                    echo "<br>Cadastrado com sucesso! Acesse para entrar!";
                } else {
                    echo "<br>E-mail já cadastrado!";
                }
            } else {
                echo "<br>Senha e confirmar senha não correspondem!";
            }
        } else {
            echo "Erro: ".$u->msgErro;
        }
    } else {
        echo "<br>Preencha todos os campos!";
    }
}
?>

<script src="script/cep.js"></script>

  <footer>
    Rua: Em algum lugar por ai, nº 150, São Paulo, SP.<br>
    Fone: 55 (11) 9876-54321<br>
    E-mail: <a href="mailto:123_de_oliveira_4@mail.com">123_de_oliveira_4@mail.com</a><br>
    &copy; 2023 Loja de Velas aromáticas. Todos os direitos reservados.
  </footer>
</body>
</html>