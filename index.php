<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faby Aromas</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/styles2.css">
</head>
<body>
  <header>
    LUZ & PERFUME.
    <div class="login">
      <a href="login.php">Login</a>
    </div>
  </header>
  <br><br><br>
  <main>
    <section class="1">
      <h2>Elevanfando o bem-estar através des aromas: Home Spray que transformam seu espaço em um oásis de tranquilidade.</h2>
    </section>
    <br>
    <!-- Início Produtos -->
    <section class="2">
      <!-- produto 1 -->
      <div class="container">
        <div class="produto">
          <img src="img/vela1.jpeg" alt="Vela Aromatizada" width="100" height="100">
          <h3>Vela Aromatizada</h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromatizada', 25.99, 'img/vela1.jpeg')">Adicionar ao Carrinho</button>
        </div>
        <!-- produto 2 -->
        <div class="produto">
          <img src="img/vela2.jpeg" alt="Vela Aromatizada" width="100" height="100">
          <h3>Vela Aromatizada</h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromatizada', 25.99, 'img/vela2.jpeg')">Adicionar ao Carrinho</button>
        </div>
        <!-- produto 3 -->
        <div class="produto">
          <img src="img/vela3.jpeg" alt="img/Vela Aromatizada" width="100" height="100">
          <h3>Vela Aromatizada</h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromatizada', 25.99, 'img/vela3.jpeg')">Adicionar ao Carrinho</button>
        </div>
        <!-- produto 4 -->
        <div class="produto">
          <img src="img/vela4.jpeg" alt="Vela Aromatizada" width="100" height="100">
          <h3>Vela Aromatizada</h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromatizada', 25.99, 'img/vela4.jpeg')">Adicionar ao Carrinho</button>
        </div>
      </div>
      <!-- produto 5 -->
      <div class="container">
        <div class="produto">
          <img src="img/vela5.jpeg" alt="Vela Aromatizada" width="100" height="100">
          <h3>Vela Aromatizada</h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromatizada', 25.99, 'img/vela5.jpeg')">Adicionar ao Carrinho</button>
        </div>
        <!-- produto 6 -->
        <div class="produto">
          <img src="img/vela6.jpeg" alt="Vela Aromatizada" width="100" height="100">
          <h3>Vela Aromatizada</h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromatizada', 25.99, 'img/vela6.jpeg')">Adicionar ao Carrinho</button>
        </div>
        <!-- produto 7 -->
        <div class="produto">
          <img src="img/vela7.jpeg" alt="Vela Aromatizada" width="100" height="100">
          <h3>Vela Aromatizada</h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromatizada', 25.99, 'img/vela7.jpeg')">Adicionar ao Carrinho</button>
        </div>
        <!-- produto 8 -->
        <div class="produto">
          <img src="img/vela8.jpeg" alt="Vela Aromatizada" width="100" height="100">
          <h3>Vela Aromatizada</h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromatizada', 25.99, 'img/vela8.jpeg')">Adicionar ao Carrinho</button>
        </div>
      </div>
    </section>
  </main>
  <fieldset>
    <!-- Carrinho -->
    <div class="carrinho">
      <h2>Carrinho de Compras</h2>
      <div id="carrinho"></div>
    </fieldset>
  </div>

  <!-- Arquivo JS externo -->
 <script src="script/carrinho.js"></script> 

  <footer>
    Rua: Em algum lugar por ai, nº 150, São Paulo, SP.<br>
    Fone: 55 (11) 9876-54321<br>
    E-mail: <a href="mailto:123_de_oliveira_4@mail.com">123_de_oliveira_4@mail.com</a><br>
    &copy; 2023 Loja de Velas aromáticas. Todos os direitos reservados.
  </footer>
</body>
</html>

