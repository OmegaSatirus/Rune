<?php
// Iniciar a sessão
session_start();

// Conexão com o banco de dados
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "lol";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Recebe os dados do formulário de login
$email = $_POST['email']; // Modificado para pegar o e-mail
$password = $_POST['password'];

// Consulta o banco de dados para verificar se o usuário existe 
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) { // Se encontrou um usuário com o e-mail
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) { // Verifica a senha
        // Login bem-sucedido: Iniciar a sessão e redirecionar
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../index.html"); // Redireciona para a página inicial
        exit();
    } else {
        echo "Senha incorreta";
    }
} else {
    echo "Usuário não encontrado";
}

$stmt->close();
$conn->close();
?>
