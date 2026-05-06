<?php
session_start();
include("../php/conexao.php");
$id_pedido = $_SESSION['id_pedido'];
$sql_update = $conexao->query("UPDATE pedido SET hora_pedido = NOW(), 
data_pedido = CURRENT_TIMESTAMP(), status = 'fechado'
WHERE id_pedido = '$id_pedido'");

unset($_SESSION["id_pedido"]);
unset($_SESSION["id_mesa"]);
header("Location: cardapio.php");
?>