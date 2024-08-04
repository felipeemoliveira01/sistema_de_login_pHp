<?php
include('link.php'); // Inclui a conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os campos foram enviados
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        // Obtém e sanitiza os dados do formulário
        $email = trim(htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'));
        $senha = trim(htmlspecialchars($_POST['senha'], ENT_QUOTES, 'UTF-8'));

        // Valida os dados recebidos
        if (empty($email) || empty($senha)) {
            echo "Por favor, preencha todos os campos!";
        } else {
            // Protege contra SQL Injection
            $email = $mysqli->real_escape_string($email);
            $senha = $mysqli->real_escape_string($senha);

            // Consulta ao banco de dados para verificar o usuário
            $sql_code = "SELECT * FROM usua WHERE email = '$email'";
            $sql_query = $mysqli->query($sql_code);

            if ($sql_query->num_rows === 1) {
                $usuario = $sql_query->fetch_assoc();
                
                // Verifica a senha fornecida
                if (password_verify($senha, $usuario['senha'])) {
                    session_start(); // Inicia a sessão
                    $_SESSION['user'] = $usuario['id'];
                    $_SESSION['nome'] = $usuario['nome'];
                    header("Location: main.php"); // Redireciona para a página principal
                    exit();
                } else {
                    echo "Senha incorreta. Tente novamente!";
                }
            } else {
                echo "Usuário não encontrado. Verifique seu e-mail!";
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
    <title>Login</title>
</head>
<body>
    <center>
        <h1>Login</h1>
        <form action="" method="POST">
            <p>
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required>
            </p>
            <p>
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required>
            </p>
            <p>
                <button type="submit">Entrar</button>
            </p>
            <p>
                <a href="register.php">Não tem uma conta? Crie uma aqui</a>
            </p>
        </form>
    </center>
</body>
</html>
