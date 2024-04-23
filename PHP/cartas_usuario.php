<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Conexão com o banco de dados
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "lol";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Obtém o ID do usuário da sessão
$user_id = $_SESSION['user_id'];

// Consulta para obter as cartas do usuário
$sql = "SELECT rarity, card_number, COUNT(*) AS quantity FROM user_cards WHERE user_id = $user_id GROUP BY rarity, card_number";
$result = $conn->query($sql);

// Variáveis para armazenar as quantidades de cartas de cada raridade
$comuns = $incomuns = $raras = $epicas = $lendarias = $miticas = 0;

// Array para armazenar as cartas do usuário
$cartas_usuario = array();

// Processa os resultados da consulta
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $carta = $row['rarity'] . $row['card_number']; // Identificador da carta
        $quantidade = $row['quantity']; // Quantidade de cartas
        $cartas_usuario[$carta] = $quantidade; // Armazena a quantidade de cada carta no array

        // Incrementa as quantidades totais de cartas por raridade
        switch ($row['rarity']) {
            case 'comum':
                $comuns += $quantidade;
                break;
            case 'incomum':
                $incomuns += $quantidade;
                break;
            case 'rara':
                $raras += $quantidade;
                break;
            case 'epica':
                $epicas += $quantidade;
                break;
            case 'lendaria':
                $lendarias += $quantidade;
                break;
            case 'mitica':
                $miticas += $quantidade;
                break;
        }
    }
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartas do Usuário</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .cartao {
            display: inline-block;
            margin: 10px;
        }

        .cartao iframe {
            width: 200px;
            height: 300px;
        }
    </style>
</head>

<body>
    <h1>Cartas do Usuário</h1>

    <h2>Montes de Cartas</h2>
    <div>
        <h3>Comuns</h3>
        <p>Quantidade: <?php echo $comuns; ?></p>
        <?php
        // Exibe as cartas comuns do usuário
        foreach ($cartas_usuario as $carta => $quantidade) {
            if (substr($carta, 0, 5) == "comum") {
                $card_number = substr($carta, 5); // Extrai o número da carta
                echo "<div class='cartao'>";
                echo "<iframe src='../cards/comuns/$card_number.html'></iframe>";
                echo "<p>Quantidade: $quantidade</p>";
                echo "</div>";
            }
        }
        ?>

        <h3>Incomuns</h3>
        <p>Quantidade: <?php echo $incomuns; ?></p>
        <?php
        // Exibe as cartas incomuns do usuário
        foreach ($cartas_usuario as $carta => $quantidade) {
            if (substr($carta, 0, 8) == "incomum") {
                $card_number = substr($carta, 8); // Extrai o número da carta
                echo "<div class='cartao'>";
                echo "<iframe src='../cards/incomuns/$card_number.html'></iframe>";
                echo "<p>Quantidade: $quantidade</p>";
                echo "</div>";
            }
        }
        ?>

        <h3>Raras</h3>
        <p>Quantidade: <?php echo $raras; ?></p>
        <?php
        // Exibe as cartas raras do usuário
        foreach ($cartas_usuario as $carta => $quantidade) {
            if (substr($carta, 0, 4) == "rara") {
                $card_number = substr($carta, 4); // Extrai o número da carta
                echo "<div class='cartao'>";
                echo "<iframe src='../cards/rara/$card_number.html'></iframe>";
                echo "<p>Quantidade: $quantidade</p>";
                echo "</div>";
            }
        }
        ?>

        <h3>Épicas</h3>
        <p>Quantidade: <?php echo $epicas; ?></p>
        <?php
        // Exibe as cartas épicas do usuário
        foreach ($cartas_usuario as $carta => $quantidade) {
            if (substr($carta, 0, 5) == "epica") {
                $card_number = substr($carta, 5); // Extrai o número da carta
                echo "<div class='cartao'>";
                echo "<iframe src='../cards/epica/$card_number.html'></iframe>";
                echo "<p>Quantidade: $quantidade</p>";
                echo "</div>";
            }
        }
        ?>

        <h3>Lendárias</h3>
        <p>Quantidade: <?php echo $lendarias; ?></p>
        <?php
        // Exibe as cartas lendárias do usuário
        foreach ($cartas_usuario as $carta => $quantidade) {
            if (substr($carta, 0, 8) == "lendaria") {
                $card_number = substr($carta, 8); // Extrai o número da carta
                echo "<div class='cartao'>";
                echo "<iframe src='../cards/lendaria/$card_number.html'></iframe>";
                echo "<p>Quantidade: $quantidade</p>";
                echo "</div>";
            }
        }
        ?>

        <h3>Míticas</h3>
        <p>Quantidade: <?php echo $miticas; ?></p>
        <?php
        // Exibe as cartas míticas do usuário
        foreach ($cartas_usuario as $carta => $quantidade) {
            if (substr($carta, 0, 6) == "mitica") {
                $card_number = substr($carta, 6); // Extrai o número da carta
                echo "<div class='cartao'>";
                echo "<iframe src='../cards/mitica/$card_number.html'></iframe>";
                echo "<p>Quantidade: $quantidade</p>";
                echo "</div>";
            }
        }
        ?>
    </div>
</body>

</html>