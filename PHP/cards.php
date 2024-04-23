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

// Obtém as cartas do usuário
$user_id = 1; // Substitua pelo ID do usuário logado
$sql = "SELECT card_name, quantity FROM user_cards WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Exibe as cartas do usuário
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Carta: " . $row["card_name"] . " - Quantidade: " . $row["quantity"] . "<br>";
    }
} else {
    echo "O usuário não possui nenhuma carta.";
}

$stmt->close();
$conn->close();
?>
