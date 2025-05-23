<?php

// Certifique-se de que session_start() é chamado no TOPO de todos os scripts PHP que usam esta classe
// Ex: session_start(); // <-- Adicione isso no topo de index.php, login.php, cadastro.php, etc.

Class Usuario
{
	private $pdo; // Propriedade para armazenar a conexão PDO
	public $msgErro = ""; // Propriedade para mensagens de erro

	// Método para conectar ao banco de dados
	// Idealmente, a conexão seria feita no construtor ou passada para ele.
	// Mas mantendo sua estrutura de ter um método conectar:
	public function conectar($nome, $host, $usuario, $senha)
	{
		// Não usamos mais global $pdo aqui, a conexão será armazenada em $this->pdo
		try{
			$this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host.";port=3307", $usuario,$senha);
            
			// Define o modo de erro para exceções para facilitar a depuração
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// Define o charset para evitar problemas de acentuação e garantir compatibilidade
			$this->pdo->exec("set names utf8");

		}catch (PDOException $e){ // Captura PDOException específica para erros de banco de dados
			$this->msgErro = $e->getMessage(); // Atribui o erro à propriedade da classe
		}
	}

	// Método para cadastrar um novo usuário
	public function cadastrar($nome, $telefone, $email, $senha, $cpf, $cep, $endereco)
	{
		// Verifica se a conexão PDO foi estabelecida
		if ($this->pdo === null) {
            $this->msgErro = "Erro: Conexão com o banco de dados não estabelecida.";
            return false;
        }

		// Verificar se já existe um e-mail cadastrado.
		$sql = $this->pdo->prepare("SELECT id_usuario From usuarios WHERE email = :e");
		$sql->bindValue(":e", $email);
		$sql->execute();

		if($sql->rowCount() > 0)
		{
			return false; // Email já cadastrado.
		}
		else
		{
			// 1. HASH a senha antes de inserir usando password_hash()
			// PASSWORD_DEFAULT usa o algoritmo de hashing mais forte disponível (atualmente bcrypt)
			// e gera um sal aleatório automaticamente.
			$senhaHashed = password_hash($senha, PASSWORD_DEFAULT);

			// Caso não esteja cadastrado, cadastrar no banco de dados.
			$sql = $this->pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha, cpf, cep, endereco) VALUES (:n, :t, :e, :s, :c, :cp, :en )");
			$sql->bindValue(":n", $nome);
			$sql->bindValue(":t", $telefone);
			$sql->bindValue(":e", $email);
			$sql->bindValue(":s", $senhaHashed); // Armazena o HASH da senha segura
			$sql->bindValue(":c", $cpf);
			$sql->bindValue(":cp", $cep);
			$sql->bindValue(":en", $endereco);
			$sql->execute();

			return true; // Cadastrado com sucesso.
		}
	}

	// Método para logar um usuário
	public function logar($email, $senha)
	{
		// Verifica se a conexão PDO foi estabelecida
		if ($this->pdo === null) {
            $this->msgErro = "Erro: Conexão com o banco de dados não estabelecida.";
            return false;
        }

		// 1. Buscar o usuário pelo email (apenas o email e o hash da senha armazenado)
		// Não verificamos a senha na query SQL
		$sql = $this->pdo->prepare("SELECT id_usuario, senha FROM usuarios WHERE email = :e");
		$sql->bindValue(":e", $email);
		$sql->execute();

		if($sql->rowCount() > 0)
		{
			$dado = $sql->fetch(PDO::FETCH_ASSOC); // Pega os dados do usuário (incluindo o hash da senha)
			$senhaHashedDoBD = $dado['senha']; // Pega o hash armazenado no banco de dados

			// 2. Verificar se a senha fornecida corresponde ao HASH armazenado usando password_verify()
			// password_verify() lida com o sal automaticamente.
			if (password_verify($senha, $senhaHashedDoBD)) {
				// Senha correta! Iniciar a sessão e armazenar o ID do usuário
				// session_start() DEVE SER CHAMADO NO TOPO DOS SCRIPTS QUE USAM SESSÃO!
				// Não é ideal chamar session_start() dentro de um método de classe assim.
				// session_start(); // <-- Remova esta linha se já chamou no topo do script chamador

				$_SESSION['id_usuario'] = $dado['id_usuario']; // Armazena ID do usuário na sessão
				return true; // Login bem-sucedido.
			} else {
				return false; // Senha incorreta.
			}
		}
		else
		{
			return false; // Email não encontrado.
		}
	}

    // Método auxiliar para verificar se o usuário está logado
    public function isLogged() {
        // session_start() DEVE SER CHAMADO NO TOPO DA PÁGINA ANTES DE USAR $_SESSION
        return isset($_SESSION['id_usuario']);
    }

    // Método auxiliar para obter o ID do usuário logado
     public function getUserId() {
        // session_start() DEVE SER CHAMADO NO TOPO DA PÁGINA ANTES DE USAR $_SESSION
        return $this->isLogged() ? $_SESSION['id_usuario'] : null;
    }


    // Método auxiliar para fazer logout
    public function logout() {
        // session_start() DEVE SER CHAMADO NO TOPO DA PÁGINA
        session_unset(); // Remove todas as variáveis de sessão
        session_destroy(); // Destrói a sessão
        // Note: O redirecionamento geralmente é feito no script que CHAMOU o logout, não dentro da classe.
        // Ex: header("Location: index.php"); exit();
    }
}
