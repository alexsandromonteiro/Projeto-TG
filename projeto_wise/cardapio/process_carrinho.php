<?php
session_start();
include("../php/conexao.php");
$id_pedido = $_SESSION['id_pedido'];
$id_item = $_POST['id_item'];
$quantidade = $_POST['quant'];
$valor_total = $_POST['valorTotal'];


$sql = "INSERT INTO pedido_itens (id_pedido, id_itens_pedido, quantidade, valor_tot_item)
        VALUES ('$id_pedido','$id_item', '$quantidade', '$valor_total')";

$res = $conexao->query($sql);

if ($res) {
        $id_inserido = $conexao->insert_id;
    
        $selecao_pedido_itens = "SELECT * FROM pedido_itens";
        $res_pedido_itens = $conexao->query($selecao_pedido_itens);
    
        if (isset($_POST['pontolanche']) && !empty($_POST['pontolanche'])) {
            $ponto_lanche = $_POST['pontolanche'];
    
            $update_pedido_itens = "UPDATE pedido_itens SET 
                descricao_ponto_lanche = '$ponto_lanche' WHERE id_pedido = '$id_pedido' 
                and id = '$id_inserido'"; 
    
            $res= $conexao->query($update_pedido_itens);
        }
}

header("Location: ./carrinho.php");


?>