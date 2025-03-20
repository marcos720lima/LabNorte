<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'labnorte';

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cpf']) && isset($_POST['status'])) {
    $cpf = $_POST['cpf'];
    $status = $_POST['status'];

    $sql = "UPDATE beneficiarios SET status_consulta = ? WHERE cpf = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $status, $cpf);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conexao->error]);
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $sql = "SELECT nome, cpf, email, telefone, data_consulta, hora_consulta, observacao, consulta, valor_consulta, status_consulta FROM beneficiarios WHERE status_consulta = 'nao_realizada'";
    $result = $conexao->query($sql);
    
    if ($result->num_rows > 0) {
        $pacientes = [];
        while ($row = $result->fetch_assoc()) {
            $pacientes[] = $row;
        }
        echo json_encode($pacientes);
    } else {
        echo json_encode([]);
    }
}

$conexao->close();
?>
