<?php
if (!isset($_GET['id'])) {
    die("ID do usuário não fornecido.");
}

$conn = new mysqli("localhost", "root", "", "labnorte");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
} else {
    die("Usuário não encontrado.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
     <header class="navbar">
        <div class="logo">ClinicFlow</div> 
        <nav>
            <ul class="nav__links">
            <li><a href="/grupo10/admin/admin.php">Usuários</a></li>
                <li><a href="/grupo10/admin/new_user.html">Cadastrar Usuários</a></li>
                <li><a href="/grupo10/admin/relatorio.php">Relatório de Acesso</a></li>
            </ul>
        </nav>
        <a href="/grupo10/index.html" class="sair-btn">Sair</a>
      </header>
    <div class="edit-container">
        <h2>Editar Usuário</h2>
        <form action="att_usuario.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>" required>
            <label for="senha">Senha:</label>
            <input type="text" id="senha" name="senha" value="<?php echo $usuario['senha']; ?>" required>
            <label for="perfil">Perfil:</label>
            <input type="text" id="perfil" name="perfil" value="<?php echo $usuario['perfil']; ?>" required>
            <button type="submit" class="salvar-btn">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>
