function buscarCep() {
      var cep = document.getElementById('cep').value.replace(/\D/g, '');
      if (cep.length !== 8) {
        alert("CEP inválido!");
        return;
      }
      fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then(response => response.json())
        .then(data => {
          if (data.erro) {
            alert("CEP não encontrado!");
          } else {
            document.getElementById('endereco').value = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
          }
        })
        .catch(error => console.error('Erro ao buscar CEP:', error));
    }