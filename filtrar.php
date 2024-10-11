<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar Membros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Filtrar Membros</h2>
        
        <form action="filtro.php" method="GET" class="row g-3">
            <div class="col-md-4">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome">
            </div>
            
            <div class="col-md-4">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento">
            </div>
            
            <div class="col-md-2">
                <label for="idade_minima" class="form-label">Idade Mínima</label>
                <input type="number" class="form-control" id="idade_minima" name="idade_minima" placeholder="Digite a idade mínima">
            </div>
            
            <div class="col-md-2">
                <label for="idade_maxima" class="form-label">Idade Máxima</label>
                <input type="number" class="form-control" id="idade_maxima" name="idade_maxima" placeholder="Digite a idade máxima">
            </div>
            
            <div class="col-md-4">
                <label for="batismo" class="form-label">Batismo</label>
                <select id="batismo" name="batismo" class="form-select">
                    <option value="">Selecione...</option>
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
                </select>
            </div>
            
            <div class="col-md-4">
                <label for="genero" class="form-label">Gênero</label>
                <select id="genero" name="genero" class="form-select">
                    <option value="">Selecione...</option>
                    <option value="Homem">Homem</option>
                    <option value="Mulher">Mulher</option>
                </select>
            </div>

            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="welcome.php" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
