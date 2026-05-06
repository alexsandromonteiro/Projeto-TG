<?php
include("../php/conexao.php");
$id = $_GET['id'];
if(!empty($id)) {
    
    $cons_pedido_itens = "SELECT * FROM pedido_itens";

    $resultado_consulta_item = $conexao->query($cons_pedido_itens);


    $del_item_carrinho = "DELETE FROM pedido_itens WHERE id = '$id'";
    $apagar_item_carrinho = mysqli_query($conexao, $del_item_carrinho);
     
    if(mysqli_affected_rows($conexao)) {
        header("Location: ./carrinho.php");  
    }
    else {
        echo "<p style='color:red'>Necessário selecionar um item</p>";
    }
    
    
}
?>