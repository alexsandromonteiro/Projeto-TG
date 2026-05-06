<?php
session_start();
include("../php/conexao.php");


if(empty($_SESSION)) {
    header("Location: login.php");
}


if(isset($_POST['codigo'])) {
$codigo = $_POST['codigo'];
}
if(isset($_POST['descricao'])) {
$descricao = $_POST['descricao'];
} 
$id_adm = filter_input(INPUT_POST, 'id_adm', FILTER_SANITIZE_NUMBER_INT);

$msg = false;
if(isset($_FILES['imagem'])) {

    $extensao = strtolower(substr($_FILES['imagem']['name'], -4));
    $novo_nome = md5(time()) . $extensao;
    $diretorio = "../uploads_mesa/";

    move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novo_nome);

    $sql = "INSERT INTO mesa (id_mesa, descricao, id_adm, imagem) 
    VALUES ('$codigo','$descricao', '$id_adm',
    '$novo_nome')";
    if($conexao->query($sql)) {
   $msg = "Dados enviados com sucesso!";
   header("Location: ./mesas.php");
    }
    else
    $msg = "Falha ao enviar os dados";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar mesa</title>
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
        <center><h2 class="">Administrador - Adicionar mesa </h2></center>
    </nav>
    <br/><h2>Dados da mesa</h2>
    <div class="container">
        <?php if($msg != false ) echo "<p> $msg </p>" ?>
    <form action="adicionar_mesa.php" method="post" 
    enctype="multipart/form-data">
        <br/><label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" required>
        <br/><label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required> 

        <input type="hidden" id="id_adm" name="id_adm" value="<?php 
        echo $_SESSION['id_adm']?>">
        
        <br/><label for="imagem">Imagem:</label>
        <input type="file" id="imagem" name="imagem" accept=".jpg,.png" required>
        <br/><br/><br/><br/>
        <div class="sticky-bottom mt-3 border-top border-dark p-3 text-center" style="background-color: white;">
        <center><input type="submit"class="adm-btn mb-3" value="Adicionar Mesa">
    </input></center>
            </div>
    </form>
</div>

<script src="../js/bootstrap.js"></script>

</body>
</html>