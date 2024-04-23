<?php
// Conexão com o banco de dados
$servername = "127.0.0.1";
$username = "JC";
$password = "P@drao2405!*";
$dbname = "lol";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    echo "ERRO: " . $e->getMessage();
}