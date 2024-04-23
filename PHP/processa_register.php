<?php
// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta ao banco de dados
    $conn = new mysqli("localhost", "usuario", "senha", "nome_do_banco");

    // Verifica se a conexão foi bem-sucedida
    if ($conn->connect_error) {
        die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
    }

    // Obtém os dados do formulário de registro
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Verifica se o nome de usuário já está em uso
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Nome de usuário já em uso";
    } else {
        // Insere o novo usuário no banco de dados
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "Usuário registrado com sucesso";
        } else {
            echo "Erro ao registrar o usuário: " . $conn->error;
        }
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>
