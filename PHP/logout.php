<?php
// Iniciar a sessão
session_start();

// Destruir todas as variáveis de sessão
$_SESSION = array();

// Excluir o cookie de sessão, se existir
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/');
}

// Destruir a sessão
session_destroy();

// Redirecionar para a página de login
header("Location: ../login.html");
exit();
?>
