<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['perfil'] !== 'admin') {
    header('Location: /grupo10/index.html');
    exit;
}

$host = 'localhost';
$usuario_db = 'root';
$senha_db = '';
$banco = 'labnorte';

$conexao = new mysqli($host, $usuario_db, $senha_db, $banco);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha']; 
$perfil = $_POST['perfil'];

$stmt_check = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt_check->bind_param("s", $email);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    echo "<script>
        alert('E-mail já cadastrado!');
        window.location.href = '/grupo10/admin/new_user.html';
    </script>";
    $stmt_check->close();
    $conexao->close();
    exit;
}

$stmt_check->close();

$stmt_insert = $conexao->prepare("INSERT INTO usuarios (nome, email, senha, perfil) VALUES (?, ?, ?, ?)");
$stmt_insert->bind_param("ssss", $nome, $email, $senha, $perfil);

if ($stmt_insert->execute()) {
    echo "<script>
        alert('Usuário cadastrado com sucesso!');
        window.location.href = '/grupo10/admin/admin.php';
    </script>";
} else {
    echo "<script>
        alert('Erro ao cadastrar usuário!');
        window.location.href = '/grupo10/admin/new_user.html';
    </script>";
}

$stmt_insert->close();
$conexao->close();
?>
