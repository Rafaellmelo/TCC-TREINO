<?php
include("conexao.php");

$db = new Conexao();

// Verifica a conexão
if (!$db->conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Inicializa a consulta básica
$sql = "SELECT * FROM membros WHERE 1=1";

// Verifica se algum filtro foi preenchido e adiciona à consulta
if (!empty($_GET['nome'])) {
    $nome = mysqli_real_escape_string($db->conn, $_GET['nome']);
    $sql .= " AND nome LIKE '%$nome%'";
}

if (!empty($_GET['data_nascimento'])) {
    $data_nascimento = $_GET['data_nascimento'];
    $sql .= " AND data_nascimento = '$data_nascimento'";
}

// Filtra por idade mínima e máxima
if (!empty($_GET['idade_minima']) || !empty($_GET['idade_maxima'])) {
    $hoje = new DateTime(); // Data atual

    // Se a idade mínima for fornecida, calcula a data de nascimento mínima
    if (!empty($_GET['idade_minima'])) {
        $idade_minima = (int) $_GET['idade_minima'];
        $data_nasc_minima = $hoje->sub(new DateInterval('P' . $idade_minima . 'Y'))->format('Y-m-d');
        $sql .= " AND data_nascimento <= '$data_nasc_minima'";
    }

    // Reseta a data para a data atual (após subtrair a idade mínima)
    $hoje = new DateTime();

    // Se a idade máxima for fornecida, calcula a data de nascimento máxima
    if (!empty($_GET['idade_maxima'])) {
        $idade_maxima = (int) $_GET['idade_maxima'];
        $data_nasc_maxima = $hoje->sub(new DateInterval('P' . $idade_maxima . 'Y'))->format('Y-m-d');
        $sql .= " AND data_nascimento >= '$data_nasc_maxima'";
    }
}

if (!empty($_GET['batismo'])) {
    $batismo = $_GET['batismo'];
    $sql .= " AND batismo = '$batismo'";
}

if (!empty($_GET['genero'])) {
    $genero = $_GET['genero'];
    $sql .= " AND genero = '$genero'";
}

// Executa a consulta e armazena o resultado
$result = mysqli_query($db->conn, $sql);

// Verifica se há resultados
if (mysqli_num_rows($result) > 0) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados Filtrados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Resultados Filtrados</h2>
        <a href="welcome.php" class="btn btn-secondary mb-3"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
        <a href="gerar_pdf_filtrado.php?<?php echo http_build_query($_GET); ?>" class="btn btn-primary mb-3"><i class="fa-solid fa-file-pdf"></i> Gerar PDF</a>

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
                while ($row = mysqli_fetch_assoc($result)) {
                    // Calcula a idade com base na data de nascimento
                    $date = new DateTime($row['data_nascimento']);
                    $now = new DateTime();
                    $interval = $now->diff($date);
                    $idade = $interval->format('%y');
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td>
                    <?php
                    // Convertendo a data de nascimento para o formato brasileiro (DD/MM/YYYY)
                    $data_nascimento = new DateTime($row['data_nascimento']);
                    echo $data_nascimento->format('d/m/Y'); // Exibe a data no formato brasileiro
                    ?>
                </td>
                    <td><?php echo $idade; ?></td>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
} else {
    // Se não houver resultados, exibe a mensagem "Nenhum cadastro encontrado"
    echo '
    <script>
    window.location.href="filtrar.php";
    alert("Nenhum cadastro encontrado");
    </script>
    ';
}
?>
