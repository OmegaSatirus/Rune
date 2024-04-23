<?php
// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta ao banco de dados
    $conn = new mysqli("localhost", "usuario", "senha", "nome_do_banco");

    // Verifica se a conexão foi bem-sucedida
    if ($conn->connect_error) {
        die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
    }

    // Obtém os dados do formulário de login
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verifica as credenciais do usuário
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Login bem-sucedido";
    } else {
        echo "Credenciais inválidas";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>
