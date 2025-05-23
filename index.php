<?php
// session_start() DEVE SER A PRIMEIRA COISA NO ARQUIVO PHP
session_start();

// Inclui o arquivo da classe Usuario
require_once('classes/usuarios.php');

// Cria uma instância da classe Usuario
$u = new Usuario;
// Conecta ao banco de dados (ajuste os dados da conexão conforme necessário)
$u->conectar("projeto_login", "localhost", "root", "");

// Verifica se houve erro na conexão
if ($u->msgErro != "") {
    // Exibe mensagem de erro de conexão (pode ser melhorado para não expor detalhes do BD)
    echo "<div class='mensagem-erro'>Erro de conexão com o banco de dados: " . $u->msgErro . "</div>";
    // Em um ambiente de produção, você não exibiria o $u->msgErro diretamente.
    // Apenas uma mensagem genérica e logaria o erro no servidor.
}

// Verifica se o usuário está logado
$isUserLogged = $u->isLogged();
// Obtém o ID do usuário logado (útil se precisar buscar dados do usuário)
$userId = $u->getUserId();

// Se quiser buscar o nome do usuário para exibir (exemplo)
// $userName = "";
// if ($isUserLogged) {
//     // Exemplo: buscar nome do usuário no BD
//     // Você precisaria adicionar um método na classe Usuario para buscar dados de um usuário pelo ID
//     // $userData = $u->getUserData($userId);
//     // if ($userData) {
//     //     $userName = $userData['nome'];
//     // }
// }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LUZ & PERFUME</title>
  <!-- Linka o arquivo CSS geral -->
  <link rel="stylesheet" href="css/styles.css">
  <!-- Linka a fonte Playfair Display (se não estiver no styles.css) -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet"> -->
</head>
<body>
  <header>
    <div class="site-title">
        <h1>LUZ & PERFUME</h1> <!-- Título/Logo -->
    </div>
    <div class="header-links">
      <?php if ($isUserLogged): // Exibe Logout se logado ?>
        <!-- <a href="profile.php">Meu Perfil</a> Exemplo -->
        <a href="logout.php">Logout</a> <!-- Link para um script de logout (criar logout.php) -->
        <?php // if (!empty($userName)) echo "<span>Bem-vindo, " . htmlspecialchars($userName) . "</span>"; ?>
      <?php else: // Exibe Login se não logado ?>
        <a href="login.php">Login</a>
      <?php endif; ?>
      <!-- Adicionar link para o carrinho aqui? Ou ele é apenas na seção abaixo? -->
      <!-- Ex: <a href="#carrinho-section">Carrinho</a> -->
    </div>
  </header>

  <main>
    <!-- Seção de Hero/Slogan (renomeada de section 1) -->
    <section class="hero-section">
      <h2>Velas aromáticas que transformam seu ambiente em um oásis de tranquilidade.</h2>
    </section>

    <!-- Seção de Produtos (renomeada de section 2) -->
    <section class="product-section">
      <!-- Título da seção de produtos (opcional) -->
      <!-- <h2>Nossos Produtos</h2> -->

      <!-- Grid de Produtos (agora um único container) -->
      <div class="product-grid">
        <!-- Produto 1 -->
        <div class="produto">
          <img src="img/vela1.jpeg" alt="Vela Aromática ">
          <h3>Vela aromática Jasmin</h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromática ', 25.99, 'img/vela1.jpeg')">Adicionar ao Carrinho</button>
        </div>
        <!-- Produto 2 -->
        <div class="produto">
          <img src="img/vela2.jpeg" alt="Vela Aromática ">
          <h3>Vela aromática Flor de laranjeira </h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromática ', 25.99, 'img/vela2.jpeg')">Adicionar ao Carrinho</button>
        </div>
        <!-- Produto 3 -->
        <div class="produto">
          <img src="img/vela3.jpeg" alt="Vela Aromática ">
          <h3>Vela aromática Buque de Flores</h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromática ', 25.99, 'img/vela3.jpeg')">Adicionar ao Carrinho</button>
        </div>
        <!-- Produto 4 -->
        <div class="produto">
          <img src="img/vela4.jpeg" alt="Vela Aromática ">
          <h3>Vela Aromática Cascas & Folhas</h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromática ', 25.99, 'img/vela4.jpeg')">Adicionar ao Carrinho</button>
        </div>
        <!-- Produto 5 -->
        <div class="produto">
          <img src="img/vela5.jpeg" alt="Vela Aromática ">
          <h3>Vela Aromática Bamboo</h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromática ', 25.99, 'img/vela5.jpeg')">Adicionar ao Carrinho</button>
        </div>
        <!-- Produto 6 -->
        <div class="produto">
          <img src="img/vela6.jpeg" alt="Vela Aromática ">
          <h3>Vela Aromática Capim Cidreira </h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromática ', 25.99, 'img/vela6.jpeg')">Adicionar ao Carrinho</button>
        </div>
        <!-- Produto 7 -->
        <div class="produto">
          <img src="img/vela7.jpeg" alt="Vela Aromática ">
          <h3>Vela Aromática Citronella</h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromática ', 25.99, 'img/vela7.jpeg')">Adicionar ao Carrinho</button>
        </div>
        <!-- Produto 8 -->
        <div class="produto">
          <img src="img/vela8.jpeg" alt="Vela Aromática ">
          <h3>Vela Aromática Frutas Vermelhas</h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromática ', 25.99, 'img/vela8.jpeg')">Adicionar ao Carrinho</button>
        </div>
      </div>
    </section>

    <!-- Seção do Carrinho (renomeada de fieldset/div .carrinho) -->
    <section class="carrinho-section" id="carrinho-section">
      <!-- O conteúdo do carrinho será preenchido pelo JavaScript -->
      <div id="carrinho">
           <h2>Carrinho de Compras</h2>
           <!-- Conteúdo do carrinho gerado por JS -->
      </div>
    </section>

  </main>

  <footer>
    Rua: Genesio Arruda, nº 150, São Paulo, SP.<br>
    Fone: 55 (11) 9876-54321<br>
    E-mail: <a href="mailto:123_de_oliveira_4@mail.com">123_de_oliveira_4@mail.com</a><br>
    &copy; 2025 Loja de Velas aromáticas. Todos os direitos reservados.
  </footer>

  <!-- Arquivos JS -->
  <!-- Script para definir se o usuário está logado (para o JS do carrinho) -->
  <script>
      // Define uma variável JS baseada no status da sessão PHP
      const isUserLogged = <?php echo $isUserLogged ? 'true' : 'false'; ?>;
  </script>
  <script src="script/carrinho.js"></script>
  <!-- O script cep.js não é usado nesta página, então não precisa linkar aqui -->

  <script>
      // Chama a função para inicializar a exibição do carrinho ao carregar a página
      // Isso garante que o título e o estado inicial (vazio) sejam mostrados.
      document.addEventListener('DOMContentLoaded', atualizarCarrinho);
  </script>

</body>
</html>