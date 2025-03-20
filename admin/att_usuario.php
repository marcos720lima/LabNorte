<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "labnorte");

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha']; 
    $perfil = $_POST['perfil'];

    $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ?, perfil = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nome, $email, $senha, $perfil, $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Usuário atualizado com sucesso!');
            window.location.href = '/grupo10/admin/admin.php';
        </script>";
    } else {
        echo "<script>
            alert('Erro ao atualizar o usuário!');
            window.history.back();
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
