<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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

    <div class="container">
          <h2>Usuários Cadastrados</h2>

           <div class="usuarios-container">
       <?php
         $conn = new mysqli("localhost", "root", "", "labnorte");

         if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
          }

         $sql = "SELECT id, nome, email, senha, perfil FROM usuarios";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='usuario-card'>
                    <h3>ID: " . $row['id'] . "</h3>
                    <p><strong>Nome:</strong> " . $row['nome'] . "</p>
                    <p><strong>Email:</strong> " . $row['email'] . "</p>
                    <p><strong>Senha:</strong> " . $row['senha'] . "</p>
                    <p><strong>Perfil:</strong> " . $row['perfil'] . "</p>
                    <div class='usuario-actions'>
                        <form action='editar_usuario.php' method='GET'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <button type='submit' class='editar-btn'>Editar</button>
                        </form>
                        <form action='remover_usuario.php' method='POST'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <button type='submit' class='remover-btn'>Remover</button>
                        </form>
                    </div>
                  </div>";
          }
        } else {
        echo "Nenhum usuário encontrado.";
        }

       $conn->close();
      ?>
    </div>
  </div>
</body>
</html>
