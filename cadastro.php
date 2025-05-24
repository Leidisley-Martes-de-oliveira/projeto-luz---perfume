
<?php
// LINHA 1: session_start() DEVE SER A PRIMEIRA COISA NO ARQUIVO PHP
session_start();

// LINHA 2: Inclui o arquivo da classe Usuario
require_once('classes/usuarios.php');

// LINHA 3: Cria uma instância da classe Usuario
$u = new Usuario;
// LINHA 4: Conecta ao banco de dados (ajuste os dados da conexão conforme necessário)
// >> CERTIFIQUE-SE QUE A PORTA 3307 ESTÁ INCLUÍDA AQUI SE SEU MYSQL ESTÁ NESSA PORTA <<
// Ex: $u->conectar("projeto_login", "localhost", conectar aceitar a porta como 5º param
// OU (se seu método conectar espera a porta na string DSN)
// $u->conectar("projeto_login", "localhost", "root", "", "3307"); // Exemplo se a porta for passada para o método
// >> ASSUMINDO QUE SEU MÉTODO CONECTAR FOI ALTERADO PARA INCLUIR A PORTA NA STRING DSN INTERNAMENTE <<
// Como na refatoração anterior: new PDO("mysql:dbname=...;host=...;port=3307", ...)


// LINHA 5: Variável para armazenar mensagens (erro ou sucesso)
$mensagem = "";
$tipoMensagem = ""; // 'sucesso' ou 'erro'

// LINHA 6: Verificar se o formulário foi submetido (se o campo nome existe em $_POST)
if(isset($_POST['nome'])) {

    // LINHA 7: Verifica se houve erro na conexão antes de processar o formulário
    if ($u->msgErro != "") {
         $mensagem = "Erro de conexão com o banco de dados: " . $u->msgErro;
         $tipoMensagem = "erro";
    } else {
        // LINHA 8: Pega os dados do POST (sem addslashes, pois a classe refatorada usa prepared statements)
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confirmarSenha = $_POST['confSenha']; // Nome do campo já estava correto
        $cpf = $_POST['cpf'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];

        // LINHA 9: Verificar se está preenchido.
        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha) && !empty($cpf) && !empty($cep) && !empty($endereco)) {
            // LINHA 10: Verifica se as senhas coincidem
            if($senha == $confirmarSenha)
            {
                // LINHA 11: Tenta cadastrar usando o método da classe Usuario
                if($u->cadastrar($nome, $telefone, $email, $senha, $cpf, $cep, $endereco))
                {
                    // LINHA 12: Cadastro com sucesso! Redireciona para a página de login
                    // Mensagem de sucesso pode ser exibida na página de login após redirecionamento (ex: via parâmetro URL ou sessão flash)
                    // Mas o mais comum é apenas redirecionar.
                    header("Location: login.php"); // Redireciona para a página de login
                    exit(); // Importante parar o script após o redirecionamento

                } else {
                    // LINHA 13: Email já cadastrado
                    $mensagem = "E-mail já cadastrado!";
                    $tipoMensagem = "erro";
                }
            } else {
                // LINHA 14: Senhas não correspondem
                $mensagem = "Senha e confirmar senha não correspondem!";
                $tipoMensagem = "erro";
            }
        } else {
            // LINHA 15: Campos não preenchidos
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
  <link rel="stylesheet" href="css/login_cadastro.css">
  <title>Cadastro de Usuário - Faby Aromas</title> <!-- Título mais descritivo -->
  <!-- Linka a fonte (se não estiver no login_cadastro.css) -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet"> -->
</head>
<body>
  <header>
      <div class="site-title"> <!-- Usei a estrutura do header do index.php para consistência -->
          <h1>LUZ & PERFUME.</h1>
      </div>
      <!-- Links no header (opcional, pode não ter no cadastro) -->
       <div class="header-links">
           <a href="index.php">Loja</a> <!-- Exemplo de link de volta -->
      </div>
  </header>

  <main>
    <div class="container">
      <!-- LINHA AQUI: Título do formulário corrigido -->
      <h2>Cadastro de Clientes</h2>

      <!-- LINHA AQUI: Exibe a mensagem se houver -->
      <?php if (!empty($mensagem)): ?>
          <div class="mensagem-<?php echo $tipoMensagem; ?>"><?php echo $mensagem; ?></div>
      <?php endif; ?>

      <form method="POST">
        <!-- Adicionamos Labels e IDs para cada campo para acessibilidade -->

        <!-- LINHA AQUI: Label e Input para Nome Completo -->
        <label for="nome">Nome Completo:</label>
        <input type="text" id="nome" name="nome" placeholder="Nome Completo" required>

        <!-- LINHA AQUI: Label e Input para Telefone -->
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" placeholder="Telefone" required>

        <!-- LINHA AQUI: Label e Input para E-mail -->
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" placeholder="E-mail" required>

        <!-- LINHA AQUI: Label e Input para Senha -->
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" placeholder="Senha" required>

        <!-- LINHA AQUI: Label e Input para Confirmar Senha -->
        <label for="confirmarSenha">Confirmar Senha:</label>
        <!-- Corrigido o placeholder -->
        <input type="password" id="confirmarSenha" name="confSenha" placeholder="Confirmar Senha" required>

        <!-- LINHA AQUI: Label e Input para CPF -->
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" placeholder="CPF (000.000.000-00)" required>

        <!-- LINHA AQUI: Label e Input para CEP -->
        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" placeholder="CEP" required onblur="buscarCep()">

        <!-- LINHA AQUI: Label e Input para Endereço Completo -->
        <label for="endereco">Endereço Completo:</label>
        <input type="text" id="endereco" name="endereco" placeholder="Endereço Completo" required>

        <button type="submit">Cadastrar</button>
      </form>
      <br> <!-- Quebra de linha, considere usar CSS -->
      <a href="index.php">Voltar para a Loja</a> <!-- Texto do link mais claro -->
    </div>
  </main>

  <!-- Arquivos JS -->
  <!-- Script para buscar CEP -->
  <script src="script/cep.js"></script>

  <footer>
    Rua: Genesio Arruda, nº 150, São Paulo, SP.<br> <!-- Corrigido 'por ai' -->
    Fone: 55 (11) 9876-54321<br>
    E-mail: <a href="mailto:123_de_oliveira_4@mail.com">123_de_oliveira_4@mail.com</a><br>
    &copy; 2023 Loja de Velas aromáticas. Todos os direitos reservados.
  </footer>
</body>
</html>
