<?php
// Iniciar a sessão
session_start();
// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    // Se o usuário não estiver logado, redirecionar para a página de login
    header("Location: ../login.html");
    exit();
}

// Obter o ID do usuário da sessão
$user_id = $_SESSION['user_id'];

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

// Consulta o banco de dados para obter informações do usuário
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) { // Se encontrou o usuário
    $user_data = $result->fetch_assoc();
    $username = $user_data['username'];
    $email = $user_data['email'];
} else {
    // Se não encontrou o usuário, redirecionar para o login
    header("Location: ../login.html");
    exit();
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="../_css/style.css">
</head>

<body>
<header class="AlinhadoArd FlexH">
    <div>
      <a href="../jogos.html"><img Id="logo" src="../_assests/league-of-legends.svg" alt="Logo League of Legends" /></a>
    </div>
    <div>
      <a href="../cards.html">Cards</a>
    </div>
    <div>
      <a href="../maiscards.html">+ cards</a>
    </div>
    <div>
      <a href="../PHP/cartas_usuario.php">Meus Cards</a>
    </div>
    <div>
      <a href="../PHP/perfil.php">perfil</a>
    </div>
  </header>
    <main class="AlinhadoCen FlexV main-content-section">
        <div class="Gamemode">
            <h1>Perfil do Usuário</h1>
            <p>Bem-vindo, <?php echo $username; ?>!</p>
            <p>Seu email é: <?php echo $email; ?></p>
            <p><a href="./logout.php">Sair</a></p>
        </div>
    </main>
</body>

</html>