<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Filtrar Financeiro</h3>
        <form action="processar_filtro.php" method="POST">
            <!-- Campo Ano -->
            <div class="mb-3">
                <label for="ano" class="form-label">Ano</label>
                <input type="number" class="form-control" id="ano" name="ano" placeholder="Digite o ano" min="2000" max="2100" >
            </div>

            <!-- Campo Mês -->
            <div class="mb-3">
                <label for="mes" class="form-label">Mês</label>
                <select class="form-control" id="mes" name="mes" >
                    <option value="" selected disabled>Selecione o mês</option>
                    <option value="01">Janeiro</option>
                    <option value="02">Fevereiro</option>
                    <option value="03">Março</option>
                    <option value="04">Abril</option>
                    <option value="05">Maio</option>
                    <option value="06">Junho</option>
                    <option value="07">Julho</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setembro</option>
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>
                </select>
            </div>

            <!-- Campo Água -->
            <div class="mb-3">
                <label for="agua_min" class="form-label">Água (Min)</label>
                <input type="number" class="form-control" id="agua_min" name="agua_min" placeholder="Valor mínimo gasto com água" min="0">
                <label for="agua_max" class="form-label">Água (Max)</label>
                <input type="number" class="form-control" id="agua_max" name="agua_max" placeholder="Valor máximo gasto com água" min="0">
            </div>

            <!-- Campo Luz -->
            <div class="mb-3">
                <label for="luz_min" class="form-label">Luz (Min)</label>
                <input type="number" class="form-control" id="luz_min" name="luz_min" placeholder="Valor mínimo gasto com luz" min="0">
                <label for="luz_max" class="form-label">Luz (Max)</label>
                <input type="number" class="form-control" id="luz_max" name="luz_max" placeholder="Valor máximo gasto com luz" min="0">
            </div>

            <!-- Campo Doação -->
            <div class="mb-3">
                <label for="doacao_min" class="form-label">Doação (Min)</label>
                <input type="number" class="form-control" id="doacao_min" name="doacao_min" placeholder="Valor mínimo de doações" min="0">
                <label for="doacao_max" class="form-label">Doação (Max)</label>
                <input type="number" class="form-control" id="doacao_max" name="doacao_max" placeholder="Valor máximo de doações" min="0">
            </div>

            <!-- Campo Eventos -->
            <div class="mb-3">
                <label for="eventos_min" class="form-label">Eventos (Min)</label>
                <input type="number" class="form-control" id="eventos_min" name="eventos_min" placeholder="Valor mínimo gasto com eventos" min="0">
                <label for="eventos_max" class="form-label">Eventos (Max)</label>
                <input type="number" class="form-control" id="eventos_max" name="eventos_max" placeholder="Valor máximo gasto com eventos" min="0">
            </div>

            <!-- Campo Outros -->
            <div class="mb-3">
                <label for="outros_min" class="form-label">Outros (Min)</label>
                <input type="number" class="form-control" id="outros_min" name="outros_min" placeholder="Valor mínimo de outras despesas" min="0">
                <label for="outros_max" class="form-label">Outros (Max)</label>
                <input type="number" class="form-control" id="outros_max" name="outros_max" placeholder="Valor máximo de outras despesas" min="0">
            </div>

            <!-- Campo Lucro Total -->
            <div class="mb-3">
                <label for="lucro_total_min" class="form-label">Lucro Total (Min)</label>
                <input type="number" class="form-control" id="lucro_total_min" name="lucro_total_min" placeholder="Valor mínimo do lucro total" min="0">
                <label for="lucro_total_max" class="form-label">Lucro Total (Max)</label>
                <input type="number" class="form-control" id="lucro_total_max" name="lucro_total_max" placeholder="Valor máximo do lucro total" min="0">
            </div>

            <!-- Campo Despesas Totais -->
            <div class="mb-3">
                <label for="despesas_totais_min" class="form-label">Despesas Totais (Min)</label>
                <input type="number" class="form-control" id="despesas_totais_min" name="despesas_totais_min" placeholder="Valor mínimo das despesas totais" min="0">
                <label for="despesas_totais_max" class="form-label">Despesas Totais (Max)</label>
                <input type="number" class="form-control" id="despesas_totais_max" name="despesas_totais_max" placeholder="Valor máximo das despesas totais" min="0">
            </div>

            <!-- Campo Saldo -->
            <div class="mb-3">
                <label for="saldo_min" class="form-label">Saldo (Min)</label>
                <input type="number" class="form-control" id="saldo_min" name="saldo_min" placeholder="Valor mínimo do saldo" min="0">
                <label for="saldo_max" class="form-label">Saldo (Max)</label>
                <input type="number" class="form-control" id="saldo_max" name="saldo_max" placeholder="Valor máximo do saldo" min="0">
            </div>

            <!-- Botões -->
            <button type="submit" class="btn btn-success">Aplicar Filtro</button>
            <a href="financeiro.php" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
