<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado; caso contrário, redireciona para a página de login
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
</head>
<body>
    <center>
        <h1>
            <?php 
            // Exibe uma mensagem de boas-vindas personalizada se o nome do usuário estiver disponível
            if (isset($_SESSION['nome']) && !empty($_SESSION['nome'])) {
                echo "Olá, " . htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8') . "! Que bom ver você aqui!";
            } else {
                echo "Olá! Bem-vindo de volta!";
            }
            ?>
        </h1>
        <hr>
        <p>
            <a href="logout.php">Sair</a> <!-- Link para deslogar -->
        </p>
    </center>
</body>
</html>
