<?php
include("conexao.php");

$db = new Conexao();

// Verifica a conexão
if (!$db->conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Inicializa a consulta básica
$sql = "SELECT * FROM financeiro WHERE 1=1";

// Filtra pelo ano
if (!empty($_POST['ano'])) {
    $ano = mysqli_real_escape_string($db->conn, $_POST['ano']);
    $sql .= " AND ano = '$ano'";
}

// Filtra pelo mês
if (!empty($_POST['mes'])) {
    $mes = mysqli_real_escape_string($db->conn, $_POST['mes']);
    $sql .= " AND mes = '$mes'";
}

// Filtra pelo valor da água
if (!empty($_POST['agua_min']) || !empty($_POST['agua_max'])) {
    if (!empty($_POST['agua_min'])) {
        $agua_min = mysqli_real_escape_string($db->conn, $_POST['agua_min']);
        $sql .= " AND agua >= '$agua_min'";
    }
    if (!empty($_POST['agua_max'])) {
        $agua_max = mysqli_real_escape_string($db->conn, $_POST['agua_max']);
        $sql .= " AND agua <= '$agua_max'";
    }
}

// Filtra pelo valor da luz
if (!empty($_POST['luz_min']) || !empty($_POST['luz_max'])) {
    if (!empty($_POST['luz_min'])) {
        $luz_min = mysqli_real_escape_string($db->conn, $_POST['luz_min']);
        $sql .= " AND luz >= '$luz_min'";
    }
    if (!empty($_POST['luz_max'])) {
        $luz_max = mysqli_real_escape_string($db->conn, $_POST['luz_max']);
        $sql .= " AND luz <= '$luz_max'";
    }
}

// Filtra pelo valor de doações
if (!empty($_POST['doacao_min']) || !empty($_POST['doacao_max'])) {
    if (!empty($_POST['doacao_min'])) {
        $doacao_min = mysqli_real_escape_string($db->conn, $_POST['doacao_min']);
        $sql .= " AND doacao >= '$doacao_min'";
    }
    if (!empty($_POST['doacao_max'])) {
        $doacao_max = mysqli_real_escape_string($db->conn, $_POST['doacao_max']);
        $sql .= " AND doacao <= '$doacao_max'";
    }
}

// Filtra pelo valor de eventos
if (!empty($_POST['eventos_min']) || !empty($_POST['eventos_max'])) {
    if (!empty($_POST['eventos_min'])) {
        $eventos_min = mysqli_real_escape_string($db->conn, $_POST['eventos_min']);
        $sql .= " AND eventos >= '$eventos_min'";
    }
    if (!empty($_POST['eventos_max'])) {
        $eventos_max = mysqli_real_escape_string($db->conn, $_POST['eventos_max']);
        $sql .= " AND eventos <= '$eventos_max'";
    }
}

// Filtra pelo valor de outros
if (!empty($_POST['outros_min']) || !empty($_POST['outros_max'])) {
    if (!empty($_POST['outros_min'])) {
        $outros_min = mysqli_real_escape_string($db->conn, $_POST['outros_min']);
        $sql .= " AND outros >= '$outros_min'";
    }
    if (!empty($_POST['outros_max'])) {
        $outros_max = mysqli_real_escape_string($db->conn, $_POST['outros_max']);
        $sql .= " AND outros <= '$outros_max'";
    }
}

// Executa a consulta e armazena o resultado
$result = mysqli_query($db->conn, $sql);

// Verifica se há resultados
if (mysqli_num_rows($result) > 0) {
    // Exibe os resultados conforme o formato desejado
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados Filtrados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Resultados Filtrados</h2>
        <a href="filtrar_financeiro.php" class="btn btn-secondary mb-3">Voltar</a>
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>Ano</th>
                    <th>Mês</th>
                    <th>Água</th>
                    <th>Luz</th>
                    <th>Doação</th>
                    <th>Eventos</th>
                    <th>Outros</th>
                    <th>Saldo</th>
                    <th>Lucro Total</th>
                    <th>Despesas Totais</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['ano']; ?></td>
                    <td><?php echo $row['mes']; ?></td>
                    <td><?php echo number_format($row['agua'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($row['luz'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($row['doacao'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($row['eventos'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($row['outros'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($row['saldo'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($row['lucro_total'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($row['despesa_total'], 2, ',', '.'); ?></td>
                    <td>
                        <a href="detalhes_financeiro.php?ano=<?php echo $row['ano']; ?>&mes=<?php echo $row['mes']; ?>" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i> Ver Detalhes</a>
                            <a href="editar_financeiro.php?ano=<?php echo $row['ano']; ?>&mes=<?php echo $row['mes']; ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-edit"></i> Editar</a>
                            <a href="deletar_financeiro.php?ano=<?php echo $row['ano']; ?>&mes=<?php echo $row['mes']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este registro?');"><i class="fa-solid fa-trash"></i> Excluir</a>
                        </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
} else {
    echo '<script>alert("Nenhum resultado encontrado!"); window.location.href="filtrar_financeiro.php";</script>';
}
?>
