<?php

require 'banco.php';
require 'utilidades.php';
require 'autenticacao.php';


function InserirCidade($nome, $district, $country_code, $population){
    $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $insert = "INSERT INTO city(`Name`, `CountryCode`, `District`, `Population`) VALUES ('". $nome ."','". $country_code ."','". $district ."','". $population ."')";
        $q = $pdo->prepare($insert);
        $q->execute();
    Banco::desconectar();
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $nome = $_POST['txt_nome'];
    $country_code = $_POST['slc_country_code'];
    $district = $_POST['txt_district'];
    $population = $_POST['txt_population'];

    if (ValidarCidadeExiste($nome, $district, 0) == 0){
        InserirCidade($nome, $district, $country_code, $population);
        header("Location: lista.php");
    } else {
        echo "<p><h3> Cidade já existe! </h3></p>";
    }
}
else {
    $paises = PreencherCampoPais();
}

?>

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
                </div>
            </div>
            <div class="container">
                <form action="criar.php" method="POST">
                    Nome<input type="text" name="txt_nome" id="txt_nome" placeholder="Nome da Cidade"> <br>
                    Código de país 
                    <select name="slc_country_code" id="slc_country_code">
                        <option value=""> Selecione </option>
                        <?php 
							foreach($paises as $pais) {
						?>
                            <option value="<?php echo $pais['code'] ?>"> <?php echo $pais['name'] ?> </option>
                        <?php 
							}
						?>
                    </select>
                    Distrito<input type="text" name="txt_district" id="txt_district" placeholder="Distrito"><br>
                    População<input type="text" name="txt_population" id="txt_population" placeholder="População"><br>
                    <input type="submit" value="Enviar">
                </form>
            </div>
        </div>
    <body>
</html>
