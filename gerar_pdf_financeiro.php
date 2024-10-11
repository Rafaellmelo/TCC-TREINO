<?php
require('fpdf/fpdf.php');
include("conexao.php");

class PDF extends FPDF {
    function Header() {
        // Adiciona um título ao cabeçalho
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Relatorio Financeiro', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        // Adiciona uma linha ao rodapé
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function Table($header, $data) {
        // Títulos
        $this->SetFont('Arial', 'B', 12);
        foreach ($header as $i => $col) {
            if ($i == 3) { // Para a coluna "Despesas Totais"
                $this->Cell(50, 10, $col, 1); // Ajustado para 50
            } else {
                $this->Cell(30, 10, $col, 1);
            }
        }
        $this->Ln();
        
        // Dados
        $this->SetFont('Arial', '', 12);
        foreach ($data as $row) {
            $this->Cell(30, 10, $row['ano'], 1);
            $this->Cell(30, 10, $row['mes'], 1);
            $this->Cell(30, 10, number_format($row['lucro_total'], 2, ',', '.'), 1);
            $this->Cell(50, 10, number_format($row['despesa_total'], 2, ',', '.'), 1); // Aumentado para 50
            $this->Cell(30, 10, number_format($row['saldo'], 2, ',', '.'), 1);
            $this->Ln();
        }
    }
}

// Criação do PDF
$pdf = new PDF();
$pdf->AddPage();

// Consultar os dados da tabela financeiro
$db = new Conexao();
$sql = "SELECT * FROM financeiro ORDER BY ano DESC, mes DESC";
$result = $db->conn->query($sql);

// Verificar se existem registros
if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Adiciona cada registro ao array de dados
    }

    // Títulos da tabela
    $header = ['Ano', 'Mês', 'Lucro Total', 'Despesas Totais', 'Saldo'];
    $pdf->Table($header, $data);
} else {
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(0, 10, 'Nenhum registro encontrado.', 0, 1, 'C');
}

// Saída do PDF
$pdf->Output('D', 'relatorio_financeiro.pdf');
?>
