<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $data_consulta = $_POST['data_consulta'];
    $hora_consulta = $_POST['hora_consulta'];
    $observacao = $_POST['observacao'];
    $consultas = implode(', ', $_POST['consultas']);
    $valor_consulta = $_POST['valor_consulta'];


    $query = "SELECT NOME FROM beneficiarios WHERE CPF = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $cpf);
    $stmt->execute();
    $stmt->bind_result($nomeExistente);
    $stmt->fetch();
    $stmt->close();

    if ($nomeExistente && strtolower($nomeExistente) !== strtolower($nome)) {
        echo "<script>alert('O CPF $cpf já está associado ao nome $nomeExistente. Por favor, verifique os dados.'); window.history.back();</script>";
        exit();
    }

    $query = "SELECT * FROM beneficiarios WHERE DATA_CONSULTA = ? AND HORA_CONSULTA = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $data_consulta, $hora_consulta);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "<script>alert('Já existe uma consulta agendada para este horário neste dia.'); window.history.back();</script>";
        $stmt->close();
        exit();
    }
    $stmt->close();

    $query = "INSERT INTO beneficiarios (NOME, CPF, TELEFONE, EMAIL, DATA_CONSULTA, HORA_CONSULTA, OBSERVACAO, consulta, valor_consulta)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssssss', $nome, $cpf, $telefone, $email, $data_consulta, $hora_consulta, $observacao, $consultas, $valor_consulta);
    
    if ($stmt->execute()) {
        echo "<script>alert('Consulta agendada com sucesso!'); window.location.href='/labnorte/agendamento/agendamento.html';</script>";
    } else {
        echo "<script>alert('Erro ao agendar a consulta. Tente novamente.'); window.history.back();</script>";
    }
    $stmt->close();
    $conn->close();
}
?>
