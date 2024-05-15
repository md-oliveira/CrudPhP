<?php

#quero dizer que essa interface no qual está presente no site eu peguei  do youtube  


##antes de começarmos precisamos fazer a conexão com o banco de dados mysql

$nome = $_POST['usuario']; ## criando variavel que ira receber as informações do usuário
$senha = $_POST['senha']; ## o mesmo aqui

##precisamos fazer a conexão com o banco de dados mysql , eu fiz tudo em um servidor local
$hostname = "localhost"; #endereco do servidor
$username = "root"; #usuario
$password = ""; #senha
$database = "Crud"; # nome do banco de dados , coloque o nome do seu database

# como meu servidor é local eu não tenho senha e usuário , caso voce for acessar um servidor que peça esses requisitos voce deve colocar, 
# caso o seu servidor for local faça igual a mim
$conexao = mysqli_connect($hostname, $username, $password, $database); # fazendo conexão com o banco de dados

# verificando se o botão foi clicado
if(isset($_POST['login'])) # se caso for clicado ele acionara o metodo post e vai trazer a cadeia de eventos relacionado ao botão "Login"
{
    if (!$conexao) { # tentar fazer a conexão e ser de erro ele mostra 
        die("Conexão falhou: " . mysqli_connect_error());
  


    $query ="SELECT * FROM Usuarios WHERE Nome = '$nome' AND Senha = '$senha'"; # consulta sql que verifica se o usuario esta cadastrado, substitua o nome do banco e as tabelas
    $resultado = mysqli_query($conexao, $query);#variavel que armazena a pesquisa sql                                                                              # pelo o seus

    if ($resultado && mysqli_num_rows($resultado) >0){ # verifica se o usuario esta no banco de dados

        echo"<script>alert('Usuário encontrado');</script>"; # joga na tela uma mensagem



    }

    else{

        echo"<script>alert('Usuário não encontrado');</script>"; # Joga na tela uma mensagem

    }

}
// mysqli_close($conexao); ## fecha conexão isso é opcional

?>

<!-- INTERFACE HTML -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>

<div class="main-login">

<div class="left-login">
    <h1>Login <br> Entre para nosso time</h1>
   <img src="imagem/blood-research-animate (1).svg" class="left-login-image" alt="Imagem">

</div>



<!--Para trazermos as informações dos campos no qual o usuario preencheu precisamos usar o metodo post -->


<form method="post" action="index.php">
    <div class="right-login">

        <div class="card-login">

            <h1>Login</h1>
            
            <div class="textfield">

                <label for="usuario">Usuário</label>
                <input type="text" name ="usuario" placeholder="Usuário">

            </div>    
        
            <div class="textfield">    
                <label for="senha">Senha</label>
                <input type="password" name ="senha" placeholder="Senha">
            </div>    
            
            <button type ="submit" name="login" class="btn-login">Login</button>
            
        </div>
    </div>
</form>

</div>













</body>
</html>

