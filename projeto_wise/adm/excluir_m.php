<?php 
include("../php/conexao.php");
$id_mesa = $_GET['id'];
if(!empty($id_mesa)) {
    $cons_mesa = "SELECT id_mesa, descricao, imagem
     FROM mesa WHERE id_mesa = '$id_mesa'";
    $resultado_consulta_mesa = mysqli_query($conexao, $cons_mesa);

    while($row = mysqli_fetch_array($resultado_consulta_mesa)) {
        //Extrair os campos em variáveis
        extract($row);
     $img=$imagem;
    }
    unlink("../uploads_mesa/".$img);

    $del_mesa = "DELETE FROM mesa WHERE id_mesa = '$id_mesa'";
    $apagar_mesa = mysqli_query($conexao, $del_mesa);

    if(mysqli_affected_rows($conexao)) {
        header("Location: ./mesas.php");
    }
    else {
        echo "<p style='color:red'>Necessário selecionar uma mesa</p>";
    }
}



?>
