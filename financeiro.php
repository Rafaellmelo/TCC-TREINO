<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
         .float-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 10px; /* Espaçamento entre os botões */
        }
    </style>
</head>
<body>
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4">Relatório Financeiro</span>
        </a>
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="welcome.php" class="nav-link active" aria-current="page">Lista de Membros</a></li>
            <li class="nav-item"><a href="financeiro.php" class="nav-link">Financeiro</a></li>  
        </ul>
    </header>
</div>
<div class="container">
    <?php
    include("conexao.php");
    $db = new Conexao();

    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        ' . htmlspecialchars($msg) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    // Consultar os dados da tabela financeiro
    $sql = "SELECT * FROM financeiro ORDER BY ano DESC, mes DESC";
    $result = $db->conn->query($sql);
    ?>
    <a href="adicionar_financeiro.php" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> Novo registro financeiro</a>
    <a href="gerar_pdf_financeiro.php" class="btn btn-primary mb-3"><i class="fa-solid fa-file-pdf"></i> Gerar PDF</a>
    <table class="table table-hover text-center">
    <a href="filtrar_financeiro.php" class="btn btn-warning mb-3"><i class="fa-solid fa-filter"></i> Filtrar</a>
        <thead class="table-dark">
            <tr>
                <th>Ano</th>
                <th>Mês</th>
                <th>Lucro Total</th>
                <th>Despesas Totais</th>
                <th>Saldo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['ano']; ?></td>
                        <td><?php echo $row['mes']; ?></td>
                        <td><?php echo number_format($row['lucro_total'], 2, ',', '.'); ?></td>
                        <td><?php echo number_format($row['despesa_total'], 2, ',', '.'); ?></td>
                        <td><?php echo number_format($row['saldo'], 2, ',', '.'); ?></td>
                        <td>
                        <a href="detalhes_financeiro.php?ano=<?php echo $row['ano']; ?>&mes=<?php echo $row['mes']; ?>" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i> Ver Detalhes</a>
                            <a href="editar_financeiro.php?ano=<?php echo $row['ano']; ?>&mes=<?php echo $row['mes']; ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-edit"></i> Editar</a>
                            <a href="deletar_financeiro.php?ano=<?php echo $row['ano']; ?>&mes=<?php echo $row['mes']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este registro?');"><i class="fa-solid fa-trash"></i> Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhum registro encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="float-buttons">
    <a href="trocar_usuario.php" class="btn btn-info">
        <i class="fa-solid fa-user-edit"></i> Trocar Usuário
    </a>
    <a href="trocar_senha.php" class="btn btn-warning">
        <i class="fa-solid fa-key"></i> Trocar Senha
    </a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
