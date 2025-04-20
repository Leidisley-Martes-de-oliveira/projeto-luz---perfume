<?php
require_once('classes/usuarios.php');
$u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Clientes</title>
  <link rel="stylesheet" href="css/login_cadastro.css">
  
</head>
<header>
    LUZ & PERFUME. 
    <div class="login"> 
    </div>
  </header><br><br>
<body><br><br><br>
  <div class="container">
    <h2>Altenticação do cliente </h2>
    <form method="POST">
      
      <label for="email"><b>Login:</b></label>
      <input type="emai" id="email" name="email" placeholder="Digite Seu E-mail" required>
      
      <label for="senha"><b>Senha:</b></label>
      <input type="password" id="senha" name="senha" placeholder="Digite Sua Senha" required>
	  
    <button type="submit">OK</button><br><br>
	  <a href="cadastro.php">Cadastrar</a>
	 
    </form>
	<br><br>
	<a href="index.php">Voltar</a>
  </div>

<?php
    if(isset($_POST['email']) && isset($_POST['senha'])) { 
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    //Verificar se está preenchido.
    if(!empty($email) && !empty($senha)) 
    {
      $u->conectar("projeto_login", "localhost", "root", "");
      if($u->msgErro == "")
      {
          if($u->logar($email, $senha)) { 
            echo "<script>localStorage.setItem('usuarioLogado', true);</script>";
            header("Location: index1.php"); 
            die; 
}

}

          else
          {
            echo "E-mail e/ou senha estão incorretos!";
          } 
 
    }
    else
    {
      echo "Erro: ".$u->msgErro;
    }
    } else {
    echo "Preencha todos os campos!";
}
?>

  <footer>
    Rua: Em algum lugar por ai, nº 150, São Paulo, SP.<br>
    Fone: 55 (11) 9876-54321<br>
    E-mail: <a href="mailto:123_de_oliveira_4@mail.com">123_de_oliveira_4@mail.com</a><br>
    &copy; 2023 Loja de Velas aromáticas. Todos os direitos reservados.
  </footer>
</body>
</html>