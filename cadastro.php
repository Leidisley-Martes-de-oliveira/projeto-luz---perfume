<?php
// LINHA 1: session_start() DEVE SER A PRIMEIRA COISA NO ARQUIVO PHP
session_start();

// --- Opcional: Ative a exibição de erros (desative em produção!) ---
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


// LINHA 2: Inclui o arquivo da classe Usuario
require_once('classes/usuarios.php');

// LINHA 3: Cria uma instância da classe Usuario
$u = new Usuario;

// LINHA 4: Conecta ao banco de dados
// >> VERIFIQUE SE ESTA LINHA ESTÁ CORRETA PARA SEU AMBIENTE <<
// >> Certifique-se que a porta (3306, 3307, etc.) está correta na string DSN dentro do método conectar em classes/usuarios.php
$u->conectar("projeto_login", "localhost", "root", ""); // <<-- LINHA DE CONEXÃO ATIVA


// --- Verificação imediata de erro de conexão (MUITO IMPORTANTE - mantenha em produção) ---
if ($u->msgErro != "") {
    die("Erro de Conexão com o Banco de Dados: " . $u->msgErro);
}
// ---------------------------------------------------------------------------


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
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confirmarSenha = $_POST['confSenha'];
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
                    // Mensagem de sucesso pode ser exibida na página de login após redirecionamento
                    header("Location: login.php"); // <<-- REDIRECIONAMENTO REATIVADO
                    exit(); // <<-- EXIT REATIVADO

                } else {
                    // LINHA 13: Cadastro falhou. Verifica se há uma mensagem de erro específica na classe Usuario
                    if (!empty($u->msgErro)) {
                        $mensagem = "Erro no cadastro: " . $u->msgErro;
                        $tipoMensagem = "erro";
                    } else {
                        $mensagem = "E-mail já cadastrado ou falha na validação dos dados!";
                        $tipoMensagem = "erro";
                    }
                }
            } else {
                $mensagem = "Senha e confirmar senha não correspondem!";
                $tipoMensagem = "erro";
            }
        } else {
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
  <title>Cadastro de Usuário - Faby Aromas</title>
</head>
<body>
  <header>
      <div class="site-title">
          <h1>LUZ & PERFUME.</h1>
      </div>
       <div class="header-links">
           <a href="index.php">Loja</a>
      </div>
  </header>

  <main>
    <div class="container">
      <h2>Cadastro de Clientes</h2>

      <?php if (!empty($mensagem)): ?>
          <div class="mensagem-<?php echo $tipoMensagem; ?>"><?php echo $mensagem; ?></div>
      <?php endif; ?>

      <form method="POST">
        <label for="nome">Nome Completo:</label>
        <input type="text" id="nome" name="nome" placeholder="Nome Completo" required>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" placeholder="Telefone" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" placeholder="E-mail" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" placeholder="Senha" required>

        <label for="confirmarSenha">Confirmar Senha:</label>
        <input type="password" id="confirmarSenha" name="confSenha" placeholder="Confirmar Senha" required>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" placeholder="CPF (000.000.000-00)" required>

        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" placeholder="CEP" required onblur="buscarCep()">

        <label for="endereco">Endereço Completo:</label>
        <input type="text" id="endereco" name="endereco" placeholder="Endereço Completo" required>

        <button type="submit">Cadastrar</button>
      </form>
      <br>
      <a href="index.php">Voltar para a Loja</a>
    </div>
  </main>

  <script src="script/cep.js"></script>

  <footer>
    Rua: Genesio Arruda, nº 150, São Paulo, SP.<br>
    Fone: 55 (11) 9876-54321<br>
    E-mail: <a href="mailto:123_de_oliveira_4@mail.com">123_de_oliveira_4@mail.com</a><br>
    &copy; 2023 Loja de Velas aromáticas. Todos os direitos reservados.
  </footer>
</body>
</html>
