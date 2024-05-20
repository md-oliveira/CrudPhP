<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Operação</title>
</head>
<body>

<div class="card-container">  
    <form method="POST" action="interface.php">   
        <div class="Adicionar"> 
            <div class="card-add">                   
                <h1>Cadastro</h1>
                <div class="textfield">
                    <label for="usuario">Renomear Usuário</label>
                    <input type="text" id="NameUser" name="novoNome" placeholder="Novo nome">
                </div>    
                <input type="hidden" name="userId" value="<?php echo isset($_POST['userId']) ? $_POST['userId'] : ''; ?>">
                <input type="hidden" name="nome" value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : ''; ?>">
                <!--botao de renomear-->
                <button type="submit" name="cadastro" class="btn-cadastro">Renomear</button>  
            </div>
        </div>
    </form>
</div>

</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["userId"]) && isset($_POST["nome"]) && isset($_POST["novoNome"])) {
    $userId = $_POST["userId"];    
    $nome = $_POST["nome"];
    $novoNome = $_POST["novoNome"];

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "Crud";

    $conexao = mysqli_connect($hostname, $username, $password, $database);

    if (!$conexao) {
        die("Conexão falha: " . mysqli_connect_error());
    }

    $updatequery = "UPDATE Usuarios SET Nome ='$novoNome' WHERE Id ='$userId' AND Nome ='$nome'";

    if (mysqli_query($conexao, $updatequery)) {
        echo "<script>alert('Usuário renomeado com sucesso!');</script>";  
    } else {
        echo "Erro ao renomear";
    }

    mysqli_close($conexao);
}
?>
