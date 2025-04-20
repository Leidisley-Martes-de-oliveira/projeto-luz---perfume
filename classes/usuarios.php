<?php

Class Usuario
{
	private $pdo;
	public $msgErro = "";

	public function conectar($nome, $host, $usuario, $senha)
	{
		global $pdo;
		try{
			$pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario,$senha);
		}catch (Exception $e){
			$msgErro = $e->getMessage();

		}
		
	}

	public function cadastrar($nome, $telefone, $email, $senha, $cpf, $cep, $endereco)
	{
		global $pdo;
		//Verificar se já existe um e-mail cadastrado.
		$sql = $pdo->prepare("SELECT id_usuario From usuarios WHERE email = :e");
		$sql->bindValue(":e", $email);
		$sql->execute();
		
		if($sql->rowCount() > 0)
		{
			return false; //Já cadastrado.
		}
		else
		{
			//Caso não esteja cadastrado, cadastrar no banco de dados.
			$sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha, cpf, cep, endereco) VALUES (:n, :t, :e, :s, :c, :cp, :en )");
			$sql->bindValue(":n", $nome);
			$sql->bindValue(":t", $telefone);
			$sql->bindValue(":e", $email);
			$sql->bindValue(":s", md5($senha));
			$sql->bindValue(":c", $cpf);
			$sql->bindValue(":cp", $cep);
			$sql->bindValue(":en", $endereco);
			$sql->execute();

			return true;
		}

	}

	public function logar($email, $senha)
	{
		global $pdo;
		//Verificar se o email e senha estão cadastrados, se sim
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
		$sql->bindValue(":e", $email);
		$sql->bindValue(":s", md5($senha));
		$sql->execute();

		if($sql->rowCount() > 0)
		{
			//Entrar no sistema (sessão)
			$dado = $sql->fetch();
			session_start();
			$_SESSION['id_usuario'] = $dado['id_usuario'];
			return true; //Cadastrado com sucesso.
		}
		else
		{
			return false; // Não foi possível logar.
		}



	}

}

?>