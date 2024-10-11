<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Membros</title>
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
            <span class="fs-4">Lista de Membros</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="welcome.php" class="nav-link active" aria-current="page">Lista de Membros</a></li>
            <li class="nav-item"><a href="financeiro.php" class="nav-link">Financeiro</a></li>
        </ul>
    </header>
</div>

<div class="container">
    <?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        ' . htmlspecialchars($msg) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <a href="adicionar.php" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> Adicionar novo registro</a>
    <a href="gerar_pdf.php" class="btn btn-primary mb-3"><i class="fa-solid fa-file-pdf"></i> Gerar PDF</a>
    <a href="filtrar.php" class="btn btn-warning mb-3"><i class="fa-solid fa-filter"></i> Filtrar</a>

    <table class="table table-hover text-center">
        <thead class="table-dark">
        <tr>
            <th scope="col">Código</th>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>Idade</th>
            <th>Número</th>
            <th>Batismo</th>
            <th>Gênero</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
            <?php
            include("conexao.php");
            $db = new Conexao();
            $sql = "SELECT * FROM membros";
            $result = mysqli_query($db->conn, $sql);

            while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td>
                <?php
                // Exibe a data de nascimento formatada
                $date = new DateTime($row['data_nascimento']);
                echo $date->format('d/m/Y');
                ?>
                </td>
                <td>
                <?php
                // Cálculo da idade
                $date = new DateTime($row['data_nascimento']);
                $now = new DateTime();
                $interval = $now->diff($date);
                $idade = $interval->format('%y'); // Calcula a idade
                echo $idade; // Exibe a idade na coluna correta
                ?>
                </td>
                <td><?php echo $row['numero']; ?></td>
                <td><?php echo $row['batismo']; ?></td>
                <td><?php echo $row['genero']; ?></td>
                <td>
                <a href="editar.php?id=<?php echo $row['id']; ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                <a href="deletar.php?id=<?php echo $row['id']; ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                </td>
            </tr>
            <?php
            }
            ?>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    const alert = document.querySelector('.alert');
    const financeLink = document.querySelector('.nav-link[href="financeiro.php"]');

    if (alert) {
        financeLink.style.pointerEvents = 'none'; // Desabilita o link

        // Quando a mensagem for fechada
        alert.addEventListener('closed.bs.alert', function () {
            financeLink.style.pointerEvents = 'auto'; // Reabilita o link
        });
    }
</script>
</body>
</html>
