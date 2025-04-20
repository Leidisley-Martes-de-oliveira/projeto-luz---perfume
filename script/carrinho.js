const carrinho = [];
    function adicionarAoCarrinho(nome, preco, imagem) {
      const usuarioLogado = localStorage.getItem('usuarioLogado');
      if (usuarioLogado) {
        carrinho.push({ nome, preco, imagem });
        atualizarCarrinho();
      } else {
        alert('Você precisa estar logado para adicionar itens ao carrinho!');
        window.location.href = 'login.php', 'index.php';
      }
    }
    function atualizarCarrinho() {
      const carrinhoDiv = document.getElementById('carrinho');
      carrinhoDiv.innerHTML = '';
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
      carrinho.splice(index, 1);
      atualizarCarrinho();
    }
    function comprar() {
      if (carrinho.length === 0) {
        alert('Seu carrinho está vazio!');
        return;
      }
      let total = carrinho.reduce((acc, item) => acc + item.preco, 0);
      alert(`Compra realizada com sucesso! Total: R$ ${total.toFixed(2)}`);
      carrinho.length = 0;
      atualizarCarrinho();
    }