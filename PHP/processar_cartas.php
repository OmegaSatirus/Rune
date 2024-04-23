<?php
// Inicia a sessão
session_start();

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "lol";

    // Dados do formulário
    $user_id = $_SESSION['user_id']; // ID do usuário obtido da sessão
    $cartasComum = $_POST['cartas-comum'];
    $cartasEpico = $_POST['cartas-epico'];
    $cartasLendario = $_POST['cartas-lendario'];

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
    }

    // Prepara e executa a consulta para inserir as cartas na tabela user_cards
    $stmt = $conn->prepare("INSERT INTO user_cards (user_id, rarity, card_number, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isii", $user_id, $rarity, $card_number, $quantity);

    // Insere as cartas comuns
    $rarity = "comum";
    for ($i = 0; $i < $cartasComum; $i++) {
        $card_number = rand(0, 11);
        $quantity = 1;
        $stmt->execute();
    }

    // Insere as cartas épicas
    $rarity = "epica";
    for ($i = 0; $i < $cartasEpico; $i++) {
        $card_number = rand(0, 4);
        $quantity = 1;
        $stmt->execute();
    }

    // Insere as cartas lendárias
    $rarity = "lendaria";
    for ($i = 0; $i < $cartasLendario; $i++) {
        $card_number = rand(0, 2);
        $quantity = 1;
        $stmt->execute();
    }

    // Fecha a conexão e a declaração
    $stmt->close();
    $conn->close();

    // Redireciona de volta para a página maiscards.html
    header("Location: ../testes.html");
    exit();
} else {
    // Se o formulário não foi submetido corretamente, redirecione para a página de origem
    header("Location: ../testes.html");
    exit();
}
?>