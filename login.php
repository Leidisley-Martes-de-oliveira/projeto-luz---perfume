<?php
// LINHA 1: session_start() DEVE SER A PRIMEIRA COISA NO ARQUIVO PHP (antes de qualquer output, incluindo espaços)
session_start();

// LINHA 2: Inclui o arquivo da classe Usuario
require_once('classes/usuarios.php');

// LINHA 3: Cria uma instância da classe Usuario
$u = new Usuario;
// LINHA 4: Conecta ao banco de dados (ajuste os dados da conexão conforme necessário)
// >> CERTIFIQUE-SE QUE A PORTA 3307 ESTÁ INCLUÍDA AQUI SE SEU MYSQL ESTÁ NESSA PORTA <<
// Ex: $u->conectar("projeto_login", "localhost", "root", ""); // Se usa porta padrão 3306
// OU
$u->conectar("projeto_login", "localhost", "root", ""); // << VERIFIQUE SE SUA CHAMA TEM A PORTA 3307 SE NECESSÁRIO >>
// Ex: $u->conectar("projeto_login", "localhost", "root", "", 3307); // Se seu método conectar aceitar a porta como 5º param
// OU (se seu método conectar espera a porta na string DSN)
// $u->conectar("projeto_login", "localhost", "root", "", "3307"); // Exemplo se a porta for passada para o método
// >> ASSUMINDO QUE SEU MÉTODO CONECTAR FOI ALTERADO PARA INCLUIR A PORTA NA STRING DSN INTERNAMENTE <<
// Como na refatoração anterior: new PDO("mysql:dbname=...;host=...;port=3307", ...)

// LINHA 5: Variável para armazenar mensagens (erro ou sucesso)
$mensagem = "";
$tipoMensagem = ""; // 'sucesso' ou 'erro'

// LINHA 6: Verifica se o formulário foi submetido (se os campos de email e senha existem em $_POST)
if(isset($_POST['email']) && isset($_POST['senha'])) {

    // LINHA 7: Verifica se houve erro na conexão antes de processar o formulário
    if ($u->msgErro != "") {
         $mensagem = "Erro de conexão com o banco de dados: " . $u->msgErro;
         $tipoMensagem = "erro";
    } else {
        // LINHA 8: Pega os dados do POST (sem addslashes, pois a classe refatorada usa prepared statements)
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // LINHA 9: Verificar se os campos estão preenchidos
        if(!empty($email) && !empty($senha))
        {
            // LINHA 10: Tenta logar usando o método da classe Usuario
            if($u->logar($email, $senha)) {
                // LINHA 11: Login bem-sucedido! Redireciona para a página principal (ou index1.php se for o caso)
                // session_start() e $_SESSION['id_usuario'] já foram definidos no método logar() (na versão refatorada da classe Usuario)
                header("Location: index.php"); // Mude para index1.php se necessário
                exit(); // Importante parar o script após o redirecionamento

            } else {
                // LINHA 12: Login falhou (email e/ou senha incorretos)
                $mensagem = "E-mail e/ou senha estão incorretos!";
                $tipoMensagem = "erro";
            }
        } else {
            // LINHA 13: Campos não preenchidos
            $mensagem = "Preencha todos os campos!";
            $tipoMensagem = "erro";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login de Clientes - Faby Aromas</title> <!-- Título mais descritivo -->
  <!-- Linka o arquivo CSS específico para formulários -->
  <link rel="stylesheet" href="css/login_cadastro.css">
  <!-- Linka a fonte (se não estiver no login_cadastro.css) -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet"> -->
</head>
<body>
  <header>
      <div class="site-title"> <!-- Usei a estrutura do header do index.php para consistência -->
          <h1>LUZ & PERFUME.</h1>
      </div>
      <!-- Links no header (opcional, pode não ter no login) -->
      <div class="header-links">
           <a href="index.php">Loja</a> <!-- Exemplo de link de volta -->
      </div>
  </header>

  <main>
    <div class="container">
      <!-- LINHA AQUI: Título do formulário corrigido -->
      <h2>Autenticação do cliente</h2>

      <!-- LINHA AQUI: Exibe a mensagem se houver -->
      <?php if (!empty($mensagem)): ?>
          <div class="mensagem-<?php echo $tipoMensagem; ?>"><?php echo $mensagem; ?></div>
      <?php endif; ?>

      <form method="POST">
        <!-- LINHA AQUI: Label para o Email/Login -->
        <!-- O 'for="email"' liga este label ao input com id="email". Melhora a acessibilidade. -->
        <!-- Removida a tag <b>, estilize com CSS se necessário. -->
        <label for="email">Login:</label>
        <!-- LINHA AQUI: Input para o Email/Login -->
        <!-- Adicionado id="email" para corresponder ao 'for' do label -->
        <!-- Corrigido type de 'emai' para 'email' -->
        <input type="email" id="email" name="email" placeholder="Digite Seu E-mail" required>

        <!-- LINHA AQUI: Label para a Senha -->
        <!-- O 'for="senha"' liga este label ao input com id="senha". Melhora a acessibilidade. -->
        <!-- Removida a tag <b>. -->
        <label for="senha">Senha:</label>
        <!-- LINHA AQUI: Input para a Senha -->
        <!-- Adicionado id="senha" para corresponder ao 'for' do label -->
        <input type="password" id="senha" name="senha" placeholder="Digite Sua Senha" required>

        <button type="submit">OK</button>
        <br><br> <!-- Quebras de linha para espaçamento, considere usar CSS margin/padding -->
        <a href="cadastro.php">Cadastrar</a>
      </form>
      <br><br> <!-- Quebras de linha para espaçamento, considere usar CSS margin/padding -->
      <a href="index.php">Voltar para a Loja</a> <!-- Texto do link mais claro -->
    </div>
  </main>

  <footer>
    Rua: Em algum lugar por aí, nº 150, São Paulo, SP.<br> <!-- Corrigido 'por ai' -->
    Fone: 55 (11) 9876-54321<br>
    E-mail: <a href="mailto:123_de_oliveira_4@mail.com">123_de_oliveira_4@mail.com</a><br>
    &copy; 2023 Loja de Velas aromáticas. Todos os direitos reservados.
  </footer>
</body>
</html>
