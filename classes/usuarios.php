<?php

// Certifique-se de que session_start() é chamado no TOPO de todos os scripts PHP que usam esta classe
// Ex: session_start(); // <-- Adicione isso no topo de index.php, login.php, cadastro.php, etc.

Class Usuario
{
	private $pdo; // Propriedade para armazenar a conexão PDO
	public $msgErro = ""; // Propriedade para mensagens de erro

	// Método para conectar ao banco de dados
	public function conectar($nome, $host, $usuario, $senha)
	{
		try{
			// >> AJUSTE A PORTA AQUI PARA A QUE SEU MYSQL ESTÁ USANDO NO XAMPP (ex: 3306, 3307, 2207) <<
			$this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host.";port=3307", $usuario,$senha);

			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo->exec("set names utf8");

		}catch (PDOException $e){
			$this->msgErro = $e->getMessage();
		}
	}


// Método para cadastrar um novo usuário
public function cadastrar($nome, $telefone, $email, $senha, $cpf, $cep, $endereco)
{
    // --- VERIFICAÇÃO DE EMAIL EXISTENTE ---
    try {
        $sql = $this->pdo->prepare("SELECT id_usuario From usuarios WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();

        if($sql->rowCount() > 0)
        {
            return false; // Email já cadastrado.
        }
    } catch (PDOException $e) {
        $this->msgErro = "Erro na verificação de e-mail: " . $e->getMessage();
        return false;
    }
    // --- FIM VERIFICAÇÃO DE EMAIL EXISTENTE ---

    // Se o email não existe, prossiga para a inserção

    // 1. HASH a senha antes de inserir usando password_hash()
    $senhaHashed = password_hash($senha, PASSWORD_DEFAULT);


    // --- INSERÇÃO NO BANCO DE DADOS ---
    try {
        $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha, cpf, cep, endereco) VALUES (:n, :t, :e, :s, :c, :cp, :en )");
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":t", $telefone);
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", $senhaHashed); // Armazena o HASH gerado
        $sql->bindValue(":c", $cpf);
        $sql->bindValue(":cp", $cep);
        $sql->bindValue(":en", $endereco);

        $sql->execute(); // <-- A execução que pode falhar

        // Se chegou aqui, a execução foi bem-sucedida
        return true; // Cadastrado com sucesso.

    } catch (PDOException $e) {
        $this->msgErro = "Erro na inserção do usuário: " . $e->getMessage();
        return false;
    }
    // --- FIM INSERÇÃO NO BANCO DE DADOS ---
}


	// Método para logar um usuário
	public function logar($email, $senha)
	{
		$email = trim($email);
		$senha = trim($senha);
		if ($this->pdo === null) {
            $this->msgErro = "Erro: Conexão com o banco de dados não estabelecida.";
            return false;
        }

		// 1. Buscar o usuário pelo email
		$sql = $this->pdo->prepare("SELECT id_usuario, senha FROM usuarios WHERE email = :e");
		$sql->bindValue(":e", $email);
		$sql->execute();

		if($sql->rowCount() > 0) // Encontrou um usuário com este email
		{
			$dado = $sql->fetch(PDO::FETCH_ASSOC);
			$senhaHashedDoBD = $dado['senha']; // Pega o hash armazenado no banco de dados


			// 2. Verificar se a senha fornecida corresponde ao HASH armazenado
			$isPasswordCorrect = password_verify($senha, $senhaHashedDoBD);


			if ($isPasswordCorrect) {
				$_SESSION['id_usuario'] = $dado['id_usuario'];
				return true;
			} else {
				return false;
			}
		}
		else
		{
			return false; // Email não encontrado.
		}
	}

    public function isLogged() {
        return isset($_SESSION['id_usuario']);
    }

     public function getUserId() {
        return $this->isLogged() ? $_SESSION['id_usuario'] : null;
    }

    public function logout() {
        session_unset();
        session_destroy();
    }
}
