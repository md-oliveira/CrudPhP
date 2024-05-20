<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renomear</title>
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
                    <th></th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $hostname = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "Crud";
                    
                    $conexao = mysqli_connect($hostname, $username, $password, $dbname);
                 
                    if (!$conexao) {
                        die("Conexão falha: " . mysqli_connect_error());
                    }
                 
                    $query = "SELECT Id, Nome FROM Usuarios"; 
                    $resultado = mysqli_query($conexao, $query);
                 
                        
                    if (mysqli_num_rows($resultado) > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>" . $row['Nome'] . "</td>";
                            echo "<td>" . $row['Senha'] . "</td>";
                            echo "<td>
                                <form method='POST' action='interface.php'>
                                    <input type='hidden' name='userId' value='" . $row['Id'] . "'>
                                    <input type='hidden' name='nome' value='" . $row['Nome'] . "'>
                                    <button type='submit'>Rename</button>
                                </form>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Nenhum usuário encontrado</td></tr>";
                    }

                    mysqli_close($conexao);
                ?>
            </tbody>
        </table>
    </div>
            
   





















</body>