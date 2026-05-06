<?php 
include("../php/conexao.php");
$id_itens_pedido = $_GET['id'];
if(!empty($id_itens_pedido)) {
    
    $cons_item = "SELECT id_itens_pedido, descricao_item, preco, composicao,
    tipo_item, imagem FROM itens WHERE id_itens_pedido = '$id_itens_pedido'";
    $resultado_consulta_item = mysqli_query($conexao, $cons_item);

    while($row = mysqli_fetch_array($resultado_consulta_item)) {
        //Extrair os campos em variáveis
        extract($row);
     $img=$imagem;
    }
    unlink("../uploads_lanches_bedidas/".$img);


    $del_item = "DELETE FROM itens WHERE id_itens_pedido = '$id_itens_pedido'";
    $apagar_item = mysqli_query($conexao, $del_item);
     
    if(mysqli_affected_rows($conexao)) {
        header("Location: ./lanchesebebidas.php");  
    }
    else {
        echo "<p style='color:red'>Necessário selecionar um item</p>";
    }
    
    
}
?>