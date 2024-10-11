<?php
include("conexao.php");
$db = new Conexao();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter dados do formulário
    $ano = intval($_POST['ano']);
    $mes = $_POST['mes'];
    $agua = isset($_POST['agua']) ? $_POST['agua'] : 0;
    $luz = isset($_POST['luz']) ? $_POST['luz'] : 0;
    $doacao = isset($_POST['doacao']) ? $_POST['doacao'] : 0;
    $eventos = isset($_POST['eventos']) ? $_POST['eventos'] : 0;
    $outros = isset($_POST['outros']) ? $_POST['outros'] : 0;

    // Calcular total
    $despesa_total = $agua + $luz + $outros;
    $lucro_total = $doacao + $eventos;
    $saldo = $lucro_total - $despesa_total;

    // Atualizar o registro
    $sql = "UPDATE financeiro SET agua = ?, luz = ?, doacao = ?, eventos = ?, outros = ?, saldo = ?, lucro_total = ?, despesa_total = ? WHERE ano = ? AND mes = ?";
    $stmt = $db->conn->prepare($sql);
    $stmt->bind_param('ddddddddis', $agua, $luz, $doacao, $eventos, $outros, $saldo, $lucro_total, $despesa_total, $ano, $mes);

    if ($stmt->execute()) {
        header("Location: financeiro.php?msg=Registro atualizado com sucesso!");
    } else {
        header("Location: financeiro.php?msg=Erro ao atualizar o registro!");
    }
    exit;
} else {
    header("Location: financeiro.php?msg=Requisição inválida!");
    exit;
}
?>
