<?php 
include("../php/conexao.php");
if(isset($_POST['confirmar'])) {
$email = $_POST["email"];
$senha = md5($_POST["senha"]);
$sql = "UPDATE administrador SET senha = '$senha' WHERE email = '$email' ";
$atualiza_senha = mysqli_query($conexao,$sql);
header("Location: ./login.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <style>
        input {
            display:block;
        }
        body {
            background-color:#f2f2f2;
            font-size:17px;
        }
    </style>
    <title>Recuperar senha ADM</title>
</head>
<body>
<br><br><br><h4>Recuperar senha - ADM</h4>
<div class="position-absolute top-50 start-50 translate-middle text-left">
        <div class="card">
        <div class="card-body">
    
        <form action="./recup_senha.php" method="POST">
    <div class="mb-3">
     <label for="">E-mail</label>
     <input type="email" id="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
    <label>Nova senha</label>
    <input type="password" id="senha" name="senha" class="form-control">
    </div>
    <button type="submit" name="confirmar" class="btn btn-primary">Confirmar</button><br>
    </form>
    </div>
    </div>
    </div>
</body>
</html>
