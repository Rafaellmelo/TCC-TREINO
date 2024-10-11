<?php
include("conexao.php");
$db = new Conexao();

if (isset($_POST['submit'])) {
    // Receber os dados do formulário e converter para float
    $ano = $_POST['ano'];
    $mes = $_POST['mes'];
    $agua = isset($_POST['agua']) ? floatval($_POST['agua']) : 0;
    $luz = isset($_POST['luz']) ? floatval($_POST['luz']) : 0;
    $doacao = isset($_POST['doacao']) ? floatval($_POST['doacao']) : 0;
    $eventos = isset($_POST['eventos']) ? floatval($_POST['eventos']) : 0;
    $outros = isset($_POST['outros']) ? floatval($_POST['outros']) : 0;

    // Calcular os valores de despesa total, lucro total e saldo
    $despesa_total = $agua + $luz + $outros;
    $lucro_total = $doacao + $eventos;
    $saldo = $lucro_total - $despesa_total;

    // Inserir os dados na tabela financeiro
    $sql = "INSERT INTO financeiro (ano, mes, agua, luz, doacao, eventos, outros, saldo, lucro_total, despesa_total)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $db->conn->prepare($sql);
$stmt->bind_param("ssdddddddd", $ano, $mes, $agua, $luz, $doacao, $eventos, $outros, $saldo, $lucro_total, $despesa_total);


    // Executar a query e verificar se foi bem-sucedido
    if ($stmt->execute()) {
       header("Location: financeiro.php?msg=Salvo com sucesso");
    } else {
        echo "Erro ao salvar o registro financeiro: " . $stmt->error;
    }

    // Fechar a declaração
    $stmt->close();
}
?>
