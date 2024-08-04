<?php
session_start(); // Inicia a sessão para poder encerrar

// Limpa todas as variáveis de sessão
$_SESSION = array();

// Se a sessão estiver usando cookies, exclui o cookie de sessão
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600, // Tempo no passado para garantir que o cookie seja excluído
        $params["path"], $params["domain"], $params["secure"], $params["httponly"]
    );
}

// Destroi a sessão
session_destroy();

// Redireciona para a página de login
header("Location: index.php");
exit();
?>
