<?php
require 'fpdf/fpdf.php';
require ('conexao.php');

// Função para calcular a idade a partir da data de nascimento
function calculaIdade($dataNascimento) {
    $dataNascimento = new DateTime($dataNascimento);
    $dataAtual = new DateTime();
    $idade = $dataAtual->diff($dataNascimento);
    return $idade->y;
}

// Criando o PDF
$db = new Conexao();
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Título do PDF
$pdf->Cell(190, 10, 'Lista de Membros', 0, 1, 'C');
$pdf->Ln(10);

// Cabeçalho da Tabela com larguras maiores
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(15, 10, 'ID', 1, 0, 'C');
$pdf->Cell(50, 10, 'Nome', 1, 0, 'C');
$pdf->Cell(40, 10, 'Data de Nascimento', 1, 0, 'C');
$pdf->Cell(15, 10, 'Idade', 1, 0, 'C');
$pdf->Cell(40, 10, 'Numero', 1, 0, 'C');
$pdf->Cell(15, 10, 'Batismo', 1, 0, 'C');
$pdf->Cell(15, 10, 'Genero', 1, 1, 'C');

// Conteúdo da Tabela
$pdf->SetFont('Arial', '', 10);
$sql = "SELECT * FROM membros";
$result = mysqli_query($db->conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $idade = calculaIdade($row['data_nascimento']);
    
    // Preenchendo as células com larguras maiores
    $pdf->Cell(15, 10, $row['id'], 1, 0, 'C');
    $pdf->Cell(50, 10, $row['nome'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['data_nascimento'], 1, 0, 'C');
    $pdf->Cell(15, 10, $idade, 1, 0, 'C');
    $pdf->Cell(40, 10, $row['numero'], 1, 0, 'C');
    $pdf->Cell(15, 10, $row['batismo'], 1, 0, 'C');
    $pdf->Cell(15, 10, $row['genero'], 1, 1, 'C');
}

// Gerando o PDF
$pdf->Output('D', 'lista_de_membros.pdf');
?>
