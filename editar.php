<?php
include("conexao.php");
$db = new Conexao();
$id = $_GET['id'];

if(isset($_POST['submit'])){
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $numero = $_POST['numero'];
    $batismo = $_POST['batismo'];
    $genero = $_POST['genero'];

    $sql = "UPDATE membros SET nome = '$nome', data_nascimento = '$data_nascimento', numero = '$numero', batismo = '$batismo', genero = '$genero' WHERE id = '$id'";
    $result = mysqli_query($db->conn, $sql);

    if($result){
        header("Location:welcome.php?msg=Editado com sucesso"); 
    }else{
        echo "Error: " . $sql . "<br>" . $db->conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:#00ff00;">
        Editar Informações
    </nav>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Editar registro</h3>
            <p class="text-muted">Aperte atualizar após mudar qualquer informação</p>
        </div>
        <?php
        $sql = "SELECT * FROM membros WHERE id = '$id'";
        $result = mysqli_query($db->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
        ?>
        <div class="container mt-5">
        <h2 class="mb-4">Cadastrar Membros</h2>
        <form action="" method="POST" onsubmit="return validarCelular()">
            <!-- Campo Nome -->
            <div class="mb-3">
                <label for="nome" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome completo" value="<?php echo $row['nome']; ?>" required onkeypress="return validarTexto(event)">
                <div id="mensagemNome" class="text-danger mt-1"></div>
            </div>

            <!-- Campo Data de Nascimento -->
            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo $row['data_nascimento']; ?>" required>
            </div>

            <!-- Campo Número (Celular) -->
            <div class="mb-3">
                <label for="numero" class="form-label">Número de Celular</label>
                <input type="tel" class="form-control" id="numero" name="numero" placeholder="(99) 99999-9999" value="<?php echo $row['numero']; ?>" minlength="15" maxlength="15" required>
            </div>

            <div class="row">
                <!-- Campo Batismo (Sim ou Não) -->
                <div class="col-md-6">
                    <label class="form-label">Batismo</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="batismo" id="batismo_sim" value="Sim" <?php if($row['batismo'] == 'Sim') echo 'checked'; ?> required>
                        <label class="form-check-label" for="batismo_sim">Sim</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="batismo" id="batismo_nao" value="Não" <?php if($row['batismo'] == 'Não') echo 'checked'; ?> required>
                        <label class="form-check-label" for="batismo_nao">Não</label>
                    </div>
                </div>

                <!-- Campo Gênero (Homem ou Mulher) -->
                <div class="col-md-6">
                    <label class="form-label">Gênero</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="genero" id="genero_homem" value="Homem" <?php if($row['genero'] == 'Homem') echo 'checked'; ?> required>
                        <label class="form-check-label" for="genero_homem">Homem</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="genero" id="genero_mulher" value="Mulher" <?php if($row['genero'] == 'Mulher') echo 'checked'; ?> required>
                        <label class="form-check-label" for="genero_mulher">Mulher</label>
                    </div>
                </div>
            </div>
            <div>
                    <button type="submit" class="btn btn-success" name="submit">Atualizar</button>
                    <a href="welcome.php" class="btn btn-danger">Cancelar</a>
                </div>
        </form>
    </div>
     <!-- Scripts do Bootstrap -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
     <script>
         function validarCelular() {
            const celular = document.getElementById('numero').value;
            const regexCelular = /^\(\d{2}\) \d{5}-\d{4}$|^\(\d{2}\) \d{4}-\d{4}$/;

            if (!regexCelular.test(celular)) {
                document.getElementById('mensagem').innerText = 'Número de celular inválido! Use o formato (99) 99999-9999 ou (99) 9999-9999.';
                return false; // Impede o envio do formulário
            } else {
                document.getElementById('mensagem').innerText = '';
            }
            return true; // Permite o envio do formulário
        }

        function validarTexto(event) {
            const char = String.fromCharCode(event.keyCode);
            const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ ]$/; // Permitir letras e espaços

            if (!regex.test(char)) {
                event.preventDefault(); // Impede a inserção de caracteres não permitidos
            }
        }
    </script>
</body>
</html>
