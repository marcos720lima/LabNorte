<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $conn = new mysqli("localhost", "root", "", "labnorte");

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Usuário removido com sucesso.";
        header("Location: admin.php"); 
        exit;
    } else {
        echo "Erro ao remover usuário: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
