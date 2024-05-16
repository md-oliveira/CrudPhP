<!--TODA ESSA INTERFACE EU FIZ COM BASE EM VIDEOS DO YOUTUBE O FOCO AQUI E A PROGRAMAÇAO BACK END-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9e9e9;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Usuários</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Senha</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                    ## fazendo conexão com o banco de dados
                    $hostname="localhost";## nome do servidor
                    $username = "root";## usuario
                    $password = "";# senha
                    $dbname = "Crud";# banco de dados
                   
                $conexao =mysqli_connect($hostname, $username, $password, $dbname);#conexao sendo feita com as informações 
                ##mude as informações do banco de dados de acordo com suas informações





                if(!$conexao){## verificando conexão se der erro ele relata
                    die("Conexão falha:".mysqli_connect_error() );
                }
                
                $query ="SELECT Nome , Senha FROM Usuarios"; ## seleciona a tabela usuarios e traz as informações
                $resultado = mysqli_query($conexao,$query); ## armazenando as informações junto com a conexão
                
                if(mysqli_num_rows($resultado)> 0){ ## compara as linhas e ve se tem alguma com esse resultado

                    while($row = mysqli_fetch_assoc($resultado)){#escreve o resultado na tabela
                        echo "<tr>";
                        echo "<td>" . $row['Nome'] . "</td>";
                        echo "<td>" . $row['Senha'] . "</td>";
                        #aqui criamos um botao que vai ser usado como metodo para cadeia de eventos
                        # esse botão ira armazenar a informação que contem na coluna 'nome' no bd
                        echo"<td><button onclick='excluirUsuario(\"" . $row['Nome'] . "\")'>Excluir</button></td>";
                        echo "</tr>";
                    }
                } else{echo"<script>Nenhum uśuario encontrado</script>";}# mostra a mensagem na tela
                
            mysqli_close($conexao);# fecha conexão
            ?>
            
                
            </tbody>
        </table>
    </div>

    
    <!--JAVASCRIPT-->
    
    <script>

    //aqui criamos uma função que sera chamada quando o botão de excluir for acionado
    // e tambem trazemos que estava dentro da coluna 'nome' no bd
    function excluirUsuario(nomeUsuario) {
     //aqui criamos um pop up na tela do usuario que traz a pergunta se ele deseja excluir
     //ao clikar em sim o pop up retorna o valor true caso contrario volta false

     var confirmacao = confirm("Deseja excluir o usuário '" + nomeUsuario + "'?");

    //ao voltar o valor true damos inicio a cadeia de eventos
    if (confirmacao) {
        // aqui nessas variaveis usamos o metodo XMLHttpRequest para fazer trocas das informações com o bd
        // esse metodo e um pouco dificil de se entender se quiser procure na internet XMLHttpRequest javascript
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            
            // aqui fazemos uma 'pergunta para o servidor' perguntamos se o envio de dados foram enviados e recebidos
            // aqui tambem usamos o metodo readystate no caso aqui ele pergunta se o envio de dados foram
            // igual a '4' e se o envio do servidor foi igual a '200'
            //não vou me aprofundar mas basicamente esses numeros  protocolos do servidor
            if (this.readyState == 4 && this.status == 200) {
                alert("Usuário excluído com sucesso !!");// exibe mensagem na tela
                
                var usuarioDeletado = document.getElementById("usuarioDeletado");
                //agora ao recarregar a pagina os usuarios excluidos não serão mostrados na tabela
                if (usuarioDeletado && usuarioDeletado.value === "true") {
                    location.reload(); 
                }
            }
        };

        //aqui tambem se trata daqueles protocolos de servidos
        //nessas 3 linhas de codigo estamos iniciando um metodo post para envio de informações com php
        // e tambem estamos enviando o nome de usuario
        xhr.open("POST", "", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("nomeUsuario=" + nomeUsuario);
    }
}
</script>


<!--PHP-->
    
<?php  

// para evitar problemas toda vez que for fazer uma operação no bd use try e cath

try {
    
    #CONEXÃO COM O BANCO
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Crud";

    $conn = new mysqli($servername, $username, $password, $dbname);
    #################################    
    
    
    if ($conn->connect_error) {#verificando se a conexão foi bem sucedida
        die("Conexão falhou: " . $conn->connect_error);
    }

    # aqui estamos pegando as informações que foram enviadas pelo metodo post
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nomeUsuario"])) {
        
        #apos isso colocamos o que o metodo post trouxe para o php dentro dessa variavel
        $nomeUsuario = $_POST["nomeUsuario"];

        #comando sql para deletar o usuario
        $query = "DELETE FROM Usuarios WHERE Nome = '$nomeUsuario' ";

        #executando a consulta slq
        if ($conn->query($query) === TRUE) {
            echo "Usuário Deletado";
            echo '<input type="hidden" id="usuarioDeletado" value="true">'; // Sinalizador para JavaScript
        } else {
            echo "Erro ao excluir usuário: " . $conn->error;
        }

        $conn->close();
        exit; 
    }

    // se der algum erro sera mostrado
} catch (Exception $e) {
    echo "Erro ao excluir usuário: " . $e->getMessage();
}
?>

</body>
</html>
