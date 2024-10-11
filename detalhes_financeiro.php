<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes Financeiros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="mt-4">Detalhes Financeiros</h1>
    
    <?php
    include("conexao.php");
    $db = new Conexao();

    // Obter ano e mês da URL
    $ano = isset($_GET['ano']) ? intval($_GET['ano']) : 0;
    $mes = isset($_GET['mes']) ? $_GET['mes'] : '';

    // Consultar os detalhes do registro
    $sql = "SELECT * FROM financeiro WHERE ano = ? AND mes = ?";
    $stmt = $db->conn->prepare($sql);
    $stmt->bind_param('is', $ano, $mes);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0):
        $row = $result->fetch_assoc();
    ?>
    <a href="gerar_pdf_detalhes_financeiro.php?ano=<?php echo $ano; ?>&mes=<?php echo $mes; ?>" class="btn btn-secondary mb-3">
            <i class="fa-solid fa-file-pdf"></i> Gerar PDF Detalhes
        </a>
        <table class="table table-striped">
            <tr>
                <th>Ano</th>
                <td><?php echo $row['ano']; ?></td>
            </tr>
            <tr>
                <th>Mês</th>
                <td><?php echo $row['mes']; ?></td>
            </tr>
            <tr>
                <th>Água</th>
                <td><?php echo number_format($row['agua'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Luz</th>
                <td><?php echo number_format($row['luz'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Doação</th>
                <td><?php echo number_format($row['doacao'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Eventos</th>
                <td><?php echo number_format($row['eventos'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Outros</th>
                <td><?php echo number_format($row['outros'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Lucro Total</th>
                <td><?php echo number_format($row['lucro_total'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Despesas Totais</th>
                <td><?php echo number_format($row['despesa_total'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Saldo</th>
                <td><?php echo number_format($row['saldo'], 2, ',', '.'); ?></td>
            </tr>
        </table>
        
        <a href="editar_financeiro.php?ano=<?php echo $row['ano']; ?>&mes=<?php echo $row['mes']; ?>" class="btn btn-warning">Editar</a>
        <a href="financeiro.php" class="btn btn-secondary">Voltar</a> <!-- Botão de voltar -->
        
    <?php else: ?>
        <div class="alert alert-warning">Nenhum registro encontrado para o ano <?php echo $ano; ?> e mês <?php echo $mes; ?>.</div>
        <a href="financeiro.php" class="btn btn-secondary">Voltar</a> <!-- Botão de voltar caso não haja registros -->
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
