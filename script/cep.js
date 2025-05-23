function buscarCep() {
<<<<<<< HEAD
    // Pega o valor do input de CEP e remove caracteres não numéricos
    var cep = document.getElementById("cep").value.replace(/\D/g, "");
  
    // Verifica se o CEP tem 8 dígitos
    if (cep.length !== 8) {
      alert("CEP inválido!");
      // Limpa o campo de endereço se o CEP for inválido
      document.getElementById("endereco").value = "";
      return;
    }
  
    // URL da API ViaCEP
    var url = `https://viacep.com.br/ws/${cep}/json/`;
  
    // Faz a requisição usando Fetch API
    fetch(url)
      .then((response) => {
        // Verifica se a resposta foi OK (status 200-299)
        if (!response.ok) {
          throw new Error(`Erro HTTP! Status: ${response.status}`);
        }
        // Converte a resposta para JSON
        return response.json();
      })
      .then((data) => {
        // Verifica se a resposta JSON contém um erro
        if (data.erro) {
          alert("CEP não encontrado!");
          document.getElementById("endereco").value = ""; // Limpa o campo
        } else {
          // Preenche o campo de endereço com os dados retornados
          // Note: O logradouro, bairro, localidade e uf vêm da API. O número e complemento
          // geralmente precisam ser digitados pelo usuário separadamente em campos próprios.
          // Para simplificar, estamos colocando tudo junto como "Endereço Completo".
          // Em um formulário mais completo, haveria campos separados para logradouro, número, complemento, bairro, cidade, estado.
          document.getElementById(
            "endereco"
          ).value = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
        }
      })
      .catch((error) => {
        // Trata erros na requisição
        console.error("Erro ao buscar CEP:", error);
        alert("Erro ao buscar CEP. Tente novamente.");
        document.getElementById("endereco").value = ""; // Limpa o campo em caso de erro
      });
  }
=======
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
>>>>>>> 8e32636e889cf19168819f3897b67fdb662befa0
