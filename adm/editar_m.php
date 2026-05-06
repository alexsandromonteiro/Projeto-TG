<?php
session_start();
include("../php/conexao.php");

if(empty($_SESSION)) {
    header("Location: login.php");
}

$id_mesa = $_GET['id'];
$result_mesa = " SELECT * FROM mesa where id_mesa = '$id_mesa' ";
$resultado_mesa = mysqli_query($conexao, $result_mesa);
$row_mesa = mysqli_fetch_assoc($resultado_mesa);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Editar mesa</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        input {
            display:block;
        }
    </style>
</head>
<body>
    <nav class="text-center py-2" style="background-color: gray;">
        <center><h2 class="">Administrador - Editar mesa </h2></center>
    </nav>
    <br/><h2>Dados da mesa</h2>
    <div class="container">
    <form action="process_edit_mesa.php" method="POST" 
    enctype="multipart/form-data">
    <br/>
        <input type="hidden" id="codigo" name="codigo" value=<?php 
        echo $row_mesa['id_mesa']?>>
        <br/><label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" value="<?php 
        echo $row_mesa['descricao'];?>">

        <input type="hidden" id="id_adm" name="id_adm" value="<?php 
        echo $_SESSION['id_adm']?>">
        
        <br/><label for="imagem">Imagem:</label>
        <input type="button" onclick="desativar_imagem()" 
        value="Manter a mesma imagem">
        <br/><input type="file" id="imagem" name="imagem" accept=".jpg,.png">
        <br/><br/><br/><br/>
        <div class="sticky-bottom mt-3 border-top border-dark p-3 text-center" style="background-color: white;">
        <center><input type="submit"class="adm-btn mb-3" value="Atualizar mesa">
    </input></center>
            </div>
    </form>
</div>

<script src="../js/bootstrap.js"></script>
<script>
    function desativar_imagem() {
        let des_imagem = document.querySelector("input#imagem");
        des_imagem.disabled = true;
    }
</script>
</body>
</html>