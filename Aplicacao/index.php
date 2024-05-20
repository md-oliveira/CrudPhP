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
    <div class="card">
        <form method="post" action="index.php">   
            <div class="card-add">                   
                <h1>Cadastro</h1>
                <div class="textfield">
                    <label for="usuario">Novo Usuário</label>
                    <input type="text" name="usuario" placeholder="Nome Usuário">
                </div>    
                <div class="textfield">    
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha">
                </div>    
                <button type="submit" name="cadastro" class="btn-cadastro">Cadastro</button>
            </div>
        </form>
    </div>

    <div class="card">
        <form method="post" action="index.php">   
            <div class="card-destroy">                   
                <h1>Deletar <br> Usuários</h1>
                
                <a href="../Destroy/tabela.php" class="btn-destroy">Deletar</a>
                <a href="../Rename/rename.php" class="renomear">Renomear</a>
            
            
            </div>
        </form>
    </div>

    
</div>

</body>
</html>
