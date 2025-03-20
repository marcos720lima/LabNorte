<?php 
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['perfil'] !== 'admin') {
    header('Location: /labnorte/login/login.html');
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

$result = $conexao->query("SELECT nome_usuario, data_login FROM logs ORDER BY data_login DESC");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Acessos</title>
    <link rel="stylesheet" href="relatorio.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<header class="navbar">
        <div class="logo">Lab Norte</div>
        <nav>
            <ul class="nav__links">
                <li><a href="/grupo10/admin/admin.php">Usuários</a></li>
                <li><a href="/grupo10/admin/new_user.html">Cadastrar Usuários</a></li>
                <li><a href="/grupo10/admin/relatorio.php">Relatório de Acesso</a></li>
            </ul>
        </nav>
        <a href="/grupo10/index.html" class="sair-btn">Sair</a>
    </header>

    <div class="container">
        <h1>Relatório de Acessos</h1>
        <table>
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Data e Hora do Login</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nome_usuario']); ?></td>
                        <td><?php echo $row['data_login']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <button class="imprimir-btn" onclick="window.print()">
        <span class="material-icons">print</span> Imprimir Relatório
    </button>

</body>
</html>

<?php
$conexao->close();
?>
