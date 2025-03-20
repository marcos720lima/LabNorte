<?php
session_start();

$host = 'localhost';
$usuario_db = 'root';
$senha_db = '';
$banco = 'labnorte';

$conexao = new mysqli($host, $usuario_db, $senha_db, $banco);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

$username = $_POST['nome'];
$password = $_POST['senha'];

$stmt = $conexao->prepare("SELECT * FROM usuarios WHERE nome = ? AND senha = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();


    $_SESSION['logado'] = true;
    $_SESSION['usuario'] = $usuario['nome'];
    $_SESSION['perfil'] = $usuario['perfil']; 

   
    $stmt_log = $conexao->prepare("INSERT INTO logs (nome_usuario) VALUES (?)");
    $stmt_log->bind_param("s", $usuario['nome']);
    $stmt_log->execute();
    $stmt_log->close();


    if ($usuario['perfil'] === 'admin') {
        header("Location: /grupo10/admin/admin.php");
    } else {
        header("Location: /grupo10/agendamento/agendamento.html");
    }
    exit;
} else {
    echo "Usuário ou senha incorretos!";
}

$stmt->close();
$conexao->close();
?>
