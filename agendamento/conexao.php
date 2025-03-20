<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: /labnorte/login/login.html');
    exit;
}

$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'labnorte';

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
