<?php
require 'banco.php';


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $login = $_POST['login'];
    $password = $_POST['password'];

    login($login, $password);

}


function login ($login, $password){
    $pdo = Banco::conectar();
        $sql = "SELECT id, nome, login FROM login WHERE login = ? AND password = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($login, $password));
        $dados = $q -> fetch(PDO::FETCH_ASSOC);
    Banco::desconectar();

    if($dados['id'] > 0){
        session_start();
        $_SESSION['idUsuario'] = $dados['id'];

        echo "<h1>Foi autenticado com sucesso</h1>";
        header("Location: lista.php");

    } else {
        echo "<h1>Não está autenticado</h1>";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <head>
        <title>Login</title>
    </head>
    <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
    <div class="container justify-content-center">
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" name="login" class="form-control" id="login">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary">LOGAR</button>
            </form>
    </div>

</body>
</html>