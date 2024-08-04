<?php
include('link.php'); // Inclui a conexão com o banco de dados
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém e sanitiza os dados do formulário
    $nome = trim(htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8'));
    $email = trim(htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'));
    $senha = trim(htmlspecialchars($_POST['senha'], ENT_QUOTES, 'UTF-8'));

    // Valida os dados recebidos
    if (empty($nome) || empty($email) || empty($senha)) {
        echo "Todos os campos são obrigatórios!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "O e-mail fornecido não é válido!";
    } elseif (strlen($senha) < 8) {
        echo "A senha deve ter pelo menos 8 caracteres!";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $senha)) {
        echo "A senha deve conter pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial!";
    } else {
        // Protege contra SQL Injection
        $nome = $mysqli->real_escape_string($nome);
        $email = $mysqli->real_escape_string($email);
        $senha = $mysqli->real_escape_string($senha);

        // Verifica se o e-mail já está em uso
        $sql_check = "SELECT * FROM usua WHERE email = '$email'";
        $result_check = $mysqli->query($sql_check);

        if ($result_check->num_rows > 0) {
            echo "Esse e-mail já está registrado. Por favor, use um e-mail diferente.";
        } else {
            // Criptografa a senha para segurança
            $senha_hash = password_hash($senha, PASSWORD_ARGON2ID);
            
            // Insere o novo usuário no banco de dados
            $sql_insert = "INSERT INTO usua (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash')";
            if ($mysqli->query($sql_insert)) {
                // Redireciona para a página principal após o registro bem-sucedido
                header("Location: main.php");
                exit();
            } else {
                echo "Houve um erro ao registrar sua conta: " . $mysqli->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuário</title>
</head>
<body>
    <center>
        <h1>Crie sua conta</h1>
        <form action="" method="POST">
            <p>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" required>
            </p>
            <p>
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required>
            </p>
            <p>
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required>
            </p>
            <p>
                <button type="submit">Registrar</button>
            </p>
            <p>
                Já tem uma conta? <a href="index.php">Faça login aqui</a>
            </p>
        </form>
    </center>
</body>
</html>
