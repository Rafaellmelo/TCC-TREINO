<?php
// Incluindo a biblioteca FPDF
require('fpdf/fpdf.php');

class PDF extends FPDF {
    function Header() {
        // Cabeçalho do PDF
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Detalhes Financeiros', 0, 1, 'C');
    }

    function Table($data) {
        $this->SetFont('Arial', '', 12);
        foreach ($data as $key => $value) {
            $this->Cell(50, 10, $key, 1);
            // Apenas formatar os valores que são numéricos
            if (is_numeric($value)) {
                $this->Cell(50, 10, number_format($value, 2, ',', '.'), 1);
            } else {
                $this->Cell(50, 10, $value, 1);
            }
            $this->Ln();
        }
    }
}

// Criando o PDF
$pdf = new PDF();
$pdf->AddPage();

// Conectando ao banco de dados
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

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pdf->Table($row);
} else {
    $pdf->Cell(0, 10, 'Nenhum registro encontrado.', 1, 1, 'C');
}

// Saída do PDF
$pdf->Output('D', 'detalhes_financeiro.pdf');
?>
