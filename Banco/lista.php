<?php
require 'banco.php';
require 'autenticacao.php';


    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $nome = '';
    $pais = '';
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['txt_nome'];
        $pais = $_POST['txt_pais'];
    }  

    $cidades_sql = "SELECT city.ID, city.Name, city.Population, country.Name as CountryName FROM city INNER JOIN country ON city.CountryCode = country.Code "
                   . " WHERE city.CountryCode like '%".$pais."%' AND city.Name LIKE '%".$nome."%'";

    Banco::desconectar();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Informações da cidade</title>
</head>

<body>
<div class="container">
    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well">Informações da cidade</h3>
            </div>
            <div class="container">
                <p>
                    <a href="criar.php">Adicionar</a>
                </p>
            </div>
            <div class="container">
                <form action="lista.php" method="POST">
                <input type="text" name="txt_nome" id="txt_nome" placeholder="Nome da Cidade">
                <input type="text" name="txt_pais" id="txt_pais" placeholder="Código do País">
                <input type="submit" value="Pesquisar">
                </form>
            </div>
            <div class="container">
                    <table>
						<tr>
                            <th>Nome</th>
                            <th>População</th>
                            <th>Nome do Pais</th>
                        </tr>
						<?php 
							foreach($pdo -> query($cidades_sql) as $row){
						?>
                            <tr>
								<td><?php echo $row['Name']; ?></td>
								<td><?php echo $row['Population']; ?></td>
								<td><?php echo $row['CountryName']; ?></td>
                                <td><a href="alterar.php?id=<?php echo $row['ID'];?>">alterar</a></td>
                                <td><a href="excluir.php?id=<?php echo $row['ID'];?>">Excluir</a></td>
                            </tr>
						<?php
							}
						?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
