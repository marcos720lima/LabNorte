<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'labnorte';

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

$sql = "SELECT NOME, CPF, DATA_CONSULTA, HORA_CONSULTA, OBSERVACAO, status_consulta 
        FROM beneficiarios 
        ORDER BY NOME";
$result = $conexao->query($sql);

$pacientes = [];
while ($row = $result->fetch_assoc()) {
    $cpf = $row['CPF'];
    if (!isset($pacientes[$cpf])) {
        $pacientes[$cpf] = [
            'nome' => $row['NOME'],
            'cpf' => $row['CPF'],
            'consultas' => []
        ];
    }
    $pacientes[$cpf]['consultas'][] = [
        'data_consulta' => $row['DATA_CONSULTA'],
        'hora_consulta' => $row['HORA_CONSULTA'],
        'observacao' => $row['OBSERVACAO'],
        'status_consulta' => $row['status_consulta']
    ];
}

header('Content-Type: application/json');
echo json_encode(array_values($pacientes));
?>
