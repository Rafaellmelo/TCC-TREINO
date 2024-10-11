<?php
include('conexao.php'); // Inclua sua conexão com o banco de dados

if (isset($_POST['submit'])) {
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if (!empty($nova_senha) && !empty($confirmar_senha)) {
        if ($nova_senha === $confirmar_senha) {
            // Sem hash, a senha será salva diretamente
            $db = new Conexao();
            // Atualizando a tabela 'password' com a nova senha
            $sql = "UPDATE login SET password = ?";
            $stmt = $db->conn->prepare($sql);
            $stmt->bind_param('s', $nova_senha);

            if ($stmt->execute()) {
                header("Location: welcome.php?msg=Senha alterada com sucesso!");
            } else {
                echo "Erro ao atualizar a senha: " . $db->conn->error;
            }
        } else {
            echo "As senhas não coincidem!";
        }
    } else {
        echo "Por favor, preencha todos os campos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trocar Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Trocar Senha</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nova_senha" class="form-label">Nova Senha</label>
                <input type="password" class="form-control" id="nova_senha" name="nova_senha" required>
            </div>
            <div class="mb-3">
                <label for="confirmar_senha" class="form-label">Confirmar Senha</label>
                <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Trocar Senha</button>
        </form>
        <a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
