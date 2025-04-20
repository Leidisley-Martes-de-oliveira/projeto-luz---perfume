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
  </header><br><br><br>
  <main>
    <section class="1">
      <h2>Elevanfando o bem-estar através des aromas: Home Spray que transformam seu espaço em um oásis de tranquilidade.</h2>
    </section><br>
    
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
          <img src="img/vela3.jpeg" alt="Vela Aromatizada" width="100" height="100">
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
            <button onclick="adicionarAoCarrinho('img/Vela Aromatizada', 25.99, 'img/vela5.jpeg')">Adicionar ao Carrinho</button>
        </div>
   
        
        <!-- produto 6 -->
        <div class="produto">
          <img src="img/vela6.jpeg" alt="Vela Aromatizada" width="100" height="100">
          <h3>Vela Aromatizada</h3>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('img/Vela Aromatizada', 25.99, 'img/vela6.jpeg')">Adicionar ao Carrinho</button>
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
          <h3>Vela Aromatizada</h3><br>
          <p>R$25,99</p>
          <button onclick="adicionarAoCarrinho('Vela Aromatizada', 25.99, 'img/vela8.jpeg')">Adicionar ao Carrinho</button>
        </div>
      </div>
      <!-- Fim Produtos -->

     <fieldset> 
      <!-- Carrinho -->
    <div class="carrinho">
      <h2>Carrinho de Compras</h2>
      <div id="carrinho"></div>
      </fieldset>
    </div>
    </section>
  </main>
  
<script>
    const carrinho = [];
    function adicionarAoCarrinho(nome, preco, imagem) {
        carrinho.push({ nome, preco, imagem });
        atualizarCarrinho();
    }
    function atualizarCarrinho() {
        const carrinhoDiv = document.getElementById('carrinho');
        carrinhoDiv.innerHTML = ''; // Limpar carrinho atual
        
        // Cabeçalho do carrinho
        const headerDiv = document.createElement('div');
        headerDiv.innerHTML = '<h2>Sua Lista de Pedidos</h2>';
        carrinhoDiv.appendChild(headerDiv);
        
        // Lista de itens do carrinho
        const listaDiv = document.createElement('div');
        listaDiv.style.border = '1px solid #ccc';
        listaDiv.style.padding = '10px';
        carrinho.forEach((item, index) => {
            const itemDiv = document.createElement('div');
            itemDiv.style.padding = '10px';
            itemDiv.style.borderBottom = '1px solid #ccc';
            const imagem = document.createElement('img');
            imagem.src = item.imagem;
            imagem.style.width = '50px';
            imagem.style.height = '50px';
            itemDiv.appendChild(imagem);
            itemDiv.innerHTML += `${item.nome} - R$ ${item.preco.toFixed(2)}`;
            const excluirButton = document.createElement('button');
            excluirButton.innerHTML = 'Excluir';
            excluirButton.onclick = () => excluirItem(index);
            itemDiv.appendChild(excluirButton);
            listaDiv.appendChild(itemDiv);
        });
        carrinhoDiv.appendChild(listaDiv);
        
        // Total do carrinho
        const total = carrinho.reduce((acc, item) => acc + item.preco, 0);
        const totalDiv = document.createElement('div');
        totalDiv.style.fontWeight = 'bold';
        totalDiv.style.fontSize = '18px';
        totalDiv.innerHTML = `Total: R$ ${total.toFixed(2)}`;
        carrinhoDiv.appendChild(totalDiv);
        
        // Botão de compra
        if (carrinho.length > 0) {
            const comprarButton = document.createElement('button');
            comprarButton.innerHTML = 'Comprar';
            comprarButton.onclick = comprar;
            carrinhoDiv.appendChild(comprarButton);
        }
    }
    function excluirItem(index) {
        carrinho.splice(index, 1); // Remove o item do carrinho
        atualizarCarrinho();
    }
    function comprar() {
        if (carrinho.length === 0) {
            alert('Seu carrinho está vazio!');
            return;
        }
        let total = carrinho.reduce((acc, item) => acc + item.preco, 0);
        alert(`Compra realizada com sucesso! Total: R$ ${total.toFixed(2)} em breve você receberá um e-mail com os dados para pamento`);
        carrinho.length = 0; // Limpar carrinho após a compra
        atualizarCarrinho();
    }
</script>

  <footer>
   Rua: Em algum lugar por ai, nº 150, São Paulo, SP.<br>
    Fone: 55 (11) 9876-54321<br>
    E-mail: <a href="mailto:123_de_oliveira_4@mail.com">123_de_oliveira_4@mail.com</a><br>
    &copy; 2023 Loja de Velas aromáticas. Todos os direitos reservados.
  </footer>
</body>
</html>
