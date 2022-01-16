<?php
    require 'Banco.php';
    require 'utilidades.php';
    require 'autenticacao.php';

    $paises = PreencherCampoPais();

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['txt_nome'];
        $district = $_POST['txt_district'];
        $population = $_POST['txt_population'];
        $country_code = $_POST['slc_country_code'];
        $id = $_POST['hdn_identificador'];

        ExcluirCidade($id);
        // header("Location: lista.php"); 
    } else {
        if(!isset($_GET['id'])){
            header('Location: lista.php');
        }
        $cidade = ObterCidade($_GET['id']);

        $name = $cidade['Name'];
        $district = $cidade['District'];
        $population = $cidade['Population'];
        $country_code = $cidade['CountryCode'];
        $id = $cidade['ID'];
    }

    function ObterCidade($id){
        $pdo = Banco::conectar();
            $sql = "SELECT ID, Name, District, Population, CountryCode FROM city WHERE ID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            $cidade = $q->fetch(PDO::FETCH_ASSOC);
        Banco::desconectar();

        return $cidade;
    }

    function ExcluirCidade($id){
        $pdo = Banco::conectar();
            $sql = "DELETE FROM city WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
        Banco::desconectar();

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
                        <h3 class="well">Informações da cidade - Exclusão</h3>
                    </div>
                </div>
            </div>
            <div class="container">
                <form action="excluir.php" method="POST">
                
                    <input type="hidden" readonly name="hdn_identificador" id="hdn_identificador" value="<?php echo $id ?>"> 
                    Nome
                    <input type="text" name="txt_nome" id="txt_nome" placeholder="Nome da Cidade" value="<?php echo $name ?>" readonly> 
                    <br>
                    
                    Código de país 
                    <select name="slc_country_code" readonly id="slc_country_code">
                        <option value=""> Selecione </option>
                        <?php 
							foreach($paises as $pais) {
						?>
                            <option value="<?php echo $pais['code'] ?>" <?php if ($pais['code'] == $country_code) echo 'selected'; ?>> <?php echo $pais['name'] ?> </option>
                        <?php 
							}
						?>
                    </select>
                    Distrito
                    <input type="text" readonly name="txt_district" id="txt_district" placeholder="Distrito" value="<?php echo $district ?>"><br>
                    População
                    <input type="text" readonly name="txt_population" id="txt_population" placeholder="População" value="<?php echo $population ?>"><br>
                   
                    <input type="submit" value="Deletar">
                </form>
            </div>
        </div>
    <body>
</html>