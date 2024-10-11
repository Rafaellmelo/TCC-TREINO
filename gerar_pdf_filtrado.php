<?php
include("conexao.php");
require('fpdf/fpdf.php'); // Inclua a biblioteca FPDF


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

// Cria o PDF
$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Cabeçalho da Tabela
$pdf->Cell(10, 10, 'ID', 1); // Diminuído para 10
$pdf->Cell(60, 10, 'Nome', 1);
$pdf->Cell(25, 10, 'Data de Nas', 1);
$pdf->Cell(12, 10, 'Idade', 1); // Diminuído para 10
$pdf->Cell(40, 10, 'Número', 1);
$pdf->Cell(15, 10, 'Bat.', 1); // Diminuído para 15
$pdf->Cell(20, 10, 'Gênero', 1);
$pdf->Ln();

// Preenche os dados no PDF
while ($row = mysqli_fetch_assoc($result)) {
    // Calcula a idade com base na data de nascimento
    $date = new DateTime($row['data_nascimento']);
    $now = new DateTime();
    $interval = $now->diff($date);
    $idade = $interval->format('%y');

    $pdf->Cell(10, 10, $row['id'], 1); // Diminuído para 10
    $pdf->Cell(60, 10, $row['nome'], 1);
    $pdf->Cell(25, 10, $date->format('d/m/Y'), 1);
    $pdf->Cell(12, 10, $idade, 1); // Diminuído para 10
    $pdf->Cell(40, 10, $row['numero'], 1);
    $pdf->Cell(15, 10, $row['batismo'], 1); // Diminuído para 15
    $pdf->Cell(20, 10, $row['genero'], 1);
    $pdf->Ln();
}

// Output do PDF
$pdf->Output('D', 'membros_filtrados.pdf');

// Fecha a conexão com o banco de dados
mysqli_close($db->conn);
?>
