<?php
include("conexao.php");
$db = new Conexao();

// Obter ano e mês da URL
$ano = isset($_GET['ano']) ? intval($_GET['ano']) : 0;
$mes = isset($_GET['mes']) ? $_GET['mes'] : '';

// Verificar se o registro existe antes de tentar excluir
$sql = "SELECT * FROM financeiro WHERE ano = ? AND mes = ?";
$stmt = $db->conn->prepare($sql);
$stmt->bind_param('is', $ano, $mes);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Executar a exclusão
    $delete_sql = "DELETE FROM financeiro WHERE ano = ? AND mes = ?";
    $delete_stmt = $db->conn->prepare($delete_sql);
    $delete_stmt->bind_param('is', $ano, $mes);
    
    if ($delete_stmt->execute()) {
        // Redirecionar após a exclusão com uma mensagem de sucesso
        header("Location: financeiro.php?msg=Registro excluído com sucesso!");
        exit;
    } else {
        // Redirecionar com mensagem de erro
        header("Location: financeiro.php?msg=Erro ao excluir o registro!");
        exit;
    }
} else {
    // Redirecionar se o registro não existir
    header("Location: financeiro.php?msg=Registro não encontrado!");
    exit;
}
?>
