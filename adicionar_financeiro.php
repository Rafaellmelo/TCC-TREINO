<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Cadastro de Registro Financeiro</h2>
    <form action="salvar_financeiro.php" method="POST">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="ano" class="form-label">Ano</label>
                <input type="text" class="form-control" id="ano" name="ano" placeholder="Ex: 2024" required>
            </div>
            <div class="col-md-6">
                <label for="mes" class="form-label">Mês</label>
                <select class="form-select" id="mes" name="mes" required>
                    <option value="" disabled selected>Selecione o mês</option>
                    <option value="Janeiro">Janeiro</option>
                    <option value="Fevereiro">Fevereiro</option>
                    <option value="Março">Março</option>
                    <option value="Abril">Abril</option>
                    <option value="Maio">Maio</option>
                    <option value="Junho">Junho</option>
                    <option value="Julho">Julho</option>
                    <option value="Agosto">Agosto</option>
                    <option value="Setembro">Setembro</option>
                    <option value="Outubro">Outubro</option>
                    <option value="Novembro">Novembro</option>
                    <option value="Dezembro">Dezembro</option>
                </select>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="agua" class="form-label">Água (R$)</label>
                <input type="number" step="0.01" class="form-control" min="0" id="agua" name="agua" placeholder="Ex: 150.00">
            </div>
            <div class="col-md-4">
                <label for="luz" class="form-label">Luz (R$)</label>
                <input type="number" step="0.01" class="form-control" min="0" id="luz" name="luz" placeholder="Ex: 200.00">
            </div>
            <div class="col-md-4">
                <label for="doacao" class="form-label">Doação (R$)</label>
                <input type="number" step="0.01" class="form-control" min="0" id="doacao" name="doacao" placeholder="Ex: 500.00">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="eventos" class="form-label">Eventos (R$)</label>
                <input type="number" step="0.01" class="form-control" min="0" id="eventos" name="eventos" placeholder="Ex: 300.00">
            </div>
            <div class="col-md-6">
                <label for="outros" class="form-label">Outros (R$)</label>
                <input type="number" step="0.01" class="form-control" min="0" id="outros" name="outros" placeholder="Ex: 100.00">
            </div>
        </div>

        <!-- Botões para enviar ou cancelar -->
        <button type="submit" name="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Salvar Registro</button>
        <a href="financeiro.php" class="btn btn-danger"><i class="fa-solid fa-times"></i> Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+BMUqa24l5gWb2mC3gAJWf3/nA9p" crossorigin="anonymous"></script>
</body>
</html>
