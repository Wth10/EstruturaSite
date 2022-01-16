<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['idUsuario'])){
    unset($_SESSION['idUsuario']);
}

if(!isset($_SESSION['idUsuario'])){
    header('Location: login.php');
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
    <form action="autenticacao.php" method="POST" style="justify-content: right">
        <input type="submit" value="SAIR"> 
    </form>
    </div>
</body>
</html>
