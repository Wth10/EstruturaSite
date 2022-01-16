<?php

function PreencherCampoPais(){
    
    $paises = "SELECT code, name FROM country";
    $pdo = Banco::conectar();
        $dados = $pdo -> query($paises);
    Banco::desconectar();

    return $dados;
}

function ValidarCidadeExiste($nome, $district, $id)
{
    $quantidade_cidades_existentes = "SELECT COUNT(NAME) as quantidadeCidades FROM city WHERE Name = ? and District = ? and ID != ?";
    $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($quantidade_cidades_existentes);
        $q->execute(array($nome, $district, $id));
        $dados = $q -> fetch(PDO::FETCH_ASSOC);     
    Banco::desconectar();
       
    return $dados['quantidadeCidades'];
}

?>