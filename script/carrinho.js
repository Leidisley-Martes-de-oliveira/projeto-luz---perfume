// Assumimos que a variável `isUserLogged` é definida no script PHP (index.php)
// Ex: <script> const isUserLogged = <?php echo isset($_SESSION['id_usuario']) ? 'true' : 'false'; ?>; </script>

const carrinho = [];

function adicionarAoCarrinho(nome, preco, imagem) {
  // Verifica se o usuário está logado usando a variável definida pelo PHP
  if (isUserLogged) {
    // Adiciona o item ao array do carrinho
    carrinho.push({ nome, preco, imagem });
    // Atualiza a exibição do carrinho na página
    atualizarCarrinho();
    // Opcional: feedback visual ao usuário (ex: um item adicionado ao carrinho flutuante)
    console.log(`Item "${nome}" adicionado ao carrinho.`); // Feedback no console
    alert(`"${nome}" adicionado ao carrinho!`); // Feedback via alert (pode ser melhorado)
  } else {
    alert("Você precisa estar logado para adicionar itens ao carrinho!");
    // Redireciona para a página de login
    window.location.href = "login.php"; // Apenas um destino por vez

    // Nota: Em um sistema real, a adição ao carrinho também deveria
    // envolver uma requisição ao backend para armazenar o carrinho
    // no banco de dados associado ao usuário logado.
  }
}

function atualizarCarrinho() {
  // Seleciona o container onde o carrinho será exibido
  const carrinhoDiv = document.getElementById("carrinho"); // ID do div no HTML
  // Limpa o conteúdo atual
  carrinhoDiv.innerHTML = "";

  // Cria e adiciona o cabeçalho do carrinho
  const headerDiv = document.createElement("div");
  headerDiv.innerHTML = "<h2>Sua Lista de Pedidos</h2>"; // Título
  carrinhoDiv.appendChild(headerDiv);

  // Cria um container para a lista de itens do carrinho, para aplicar estilos
  const listaContainer = document.createElement("div");
  listaContainer.id = "carrinho-lista-container"; // ID para estilização CSS
  carrinhoDiv.appendChild(listaContainer);

  // Verifica se há itens no carrinho
  if (carrinho.length === 0) {
    // Exibe mensagem se o carrinho estiver vazio
    const vazioMsg = document.createElement("p");
    vazioMsg.textContent = "Seu carrinho está vazio.";
    vazioMsg.style.textAlign = "center";
    listaContainer.appendChild(vazioMsg);
  } else {
    // Itera sobre os itens no array do carrinho
    carrinho.forEach((item, index) => {
      // Cria um div para cada item
      const itemDiv = document.createElement("div");
      itemDiv.classList.add("carrinho-item"); // Adiciona classe para estilização CSS

      // Adiciona a imagem do item
      const imagem = document.createElement("img");
      imagem.src = item.imagem;
      imagem.alt = item.nome; // Alt text para acessibilidade
      itemDiv.appendChild(imagem);

      // Adiciona o texto com nome e preço
      const textoItem = document.createElement("span");
      textoItem.textContent = `${item.nome} - R$ ${item.preco.toFixed(2)}`;
      itemDiv.appendChild(textoItem);

      // Adiciona o botão de excluir para cada item
      const excluirButton = document.createElement("button");
      excluirButton.innerHTML = "Excluir";
      // Adiciona um event listener para remover o item ao clicar
      excluirButton.onclick = () => excluirItem(index);
      itemDiv.appendChild(excluirButton);

      // Adiciona o div do item ao container da lista
      listaContainer.appendChild(itemDiv);
    });
  }

  // Calcula o total do carrinho
  const total = carrinho.reduce((acc, item) => acc + item.preco, 0);

  // Cria e adiciona o elemento para exibir o total
  const totalDiv = document.createElement("div");
  totalDiv.classList.add("carrinho-total"); // Adiciona classe para estilização CSS
  totalDiv.innerHTML = `Total: R$ ${total.toFixed(2)}`;
  carrinhoDiv.appendChild(totalDiv);

  // Adiciona o botão de compra se houver itens no carrinho
  if (carrinho.length > 0) {
    const comprarButton = document.createElement("button");
    comprarButton.classList.add("carrinho-comprar-button"); // Adiciona classe para estilização CSS
    comprarButton.innerHTML = "Comprar";
    // Adiciona um event listener para a ação de compra
    comprarButton.onclick = comprar;
    carrinhoDiv.appendChild(comprarButton);
  }
}

// Função para remover um item do carrinho pelo índice
function excluirItem(index) {
  // Remove o item do array
  carrinho.splice(index, 1);
  // Atualiza a exibição do carrinho
  atualizarCarrinho();
  console.log(`Item no índice ${index} removido.`); // Feedback
}

// Função para simular a finalização da compra
function comprar() {
  if (carrinho.length === 0) {
    alert("Seu carrinho está vazio!");
    return;
  }

  let total = carrinho.reduce((acc, item) => acc + item.preco, 0);
  alert(`Compra simulada realizada com sucesso! Total: R$ ${total.toFixed(2)}`);

  // Limpa o carrinho após a compra simulada
  carrinho.length = 0;
  atualizarCarrinho();

  // Nota: Em um sistema real, a compra envolveria enviar os dados
  // do carrinho para o backend para processamento (pagamento, pedido, etc.).
}
