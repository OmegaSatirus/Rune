<?php
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

// Recebe os dados do formulário de registro
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Verifica se o nome de usuário ou o e-mail já estão em uso
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "Nome de usuário ou e-mail já em uso";
} else {
    // Insere o novo usuário no banco de dados
    $stmt_insert = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt_insert->bind_param("sss", $username, $email, $password);
    if ($stmt_insert->execute()) {
        echo "Usuário registrado com sucesso";
        header("Location: ../login.html");
    } else {
        echo "Erro ao registrar o usuário";
    }
}

$stmt->close();
if(isset($stmt_insert)) {
    $stmt_insert->close();
}
$conn->close();
?>
