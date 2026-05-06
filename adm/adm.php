<?php
    session_start();
    if(empty($_SESSION)) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adm</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        a#sair {
            position:fixed;
            top: 0.5em;
            right: 1em;
        }
    </style>
</head>

<body>
    <nav class="text-center py-2" style="background-color: gray;">
        <h2 class="">Administrador - Página Inicial</h2>
    </nav>
    <nav class="navbar">
    <div class="container-fluid fixed-top p-0">
        <a href="logout.php" id="sair" class="btn btn-danger">Sair</a>
    </div>
    </nav>
    <div class="container">
        <p class="mt-5">Bem vindo(a) à parte do administrador da Wise QR CODE Solution</p>
        <div class="mt-5 text-center">
            <a href="lanchesebebidas.php"><button class="adm-btn">Lanches e Bebidas</button></a>
            <a href="mesas.php"><button class="adm-btn m-4">Mesas</button></a>
            <a href="gerarRelatorio.php"><button class="adm-btn">Gerar Relatório</button></a>
            <a href="gerarQRCode.php"><button class="adm-btn m-4">Gerar QR Code</button></a>
        </div>
    </div>
    <script src="../js/bootstrap.js"></script>
</body>

</html>