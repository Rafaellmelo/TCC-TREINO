<?php
include('conexao.php'); // Inclua sua conexão com o banco de dados

if (isset($_POST['submit'])) {
    $novo_usuario = $_POST['novo_usuario'];

    if (!empty($novo_usuario)) {
        $db = new Conexao();
        // Atualizando a tabela 'username' com o novo nome de usuário
        $sql = "UPDATE login SET username = ?";
        $stmt = $db->conn->prepare($sql);
        $stmt->bind_param('s', $novo_usuario);

        if ($stmt->execute()) {
            header("Location: welcome.php?msg=Usuário alterado com sucesso!");
        } else {
            echo "Erro ao atualizar o nome de usuário: " . $db->conn->error;
        }
    } else {
        echo "Por favor, insira um novo nome de usuário!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trocar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Trocar Usuário</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="novo_usuario" class="form-label">Novo Nome de Usuário</label>
                <input type="text" class="form-control" id="novo_usuario" name="novo_usuario" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Trocar Usuário</button>
        </form>
        <a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
