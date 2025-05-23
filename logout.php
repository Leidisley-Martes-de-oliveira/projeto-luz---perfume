
<?php
// session_start() DEVE SER A PRIMEIRA COISA NO ARQUIVO PHP
session_start();

// Inclui o arquivo da classe Usuario
require_once('classes/usuarios.php');

// Cria uma instância da classe Usuario
$u = new Usuario;
// Não precisa conectar ao BD para apenas fazer logout da sessão,
// a menos que você tenha lógica de logout que interaja com o BD.
// $u->conectar("projeto_login", "localhost", "root", "");

// Chama o método logout da classe Usuario
$u->logout(); // Este método já remove as variáveis de sessão e destrói a sessão

// Redireciona o usuário para a página principal após o logout
header("Location: index.php");
exit(); // Garante que o script pare após o redirecionamento

?>


?>