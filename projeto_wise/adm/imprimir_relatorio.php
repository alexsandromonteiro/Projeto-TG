<?php
    session_start();
    if(empty($_SESSION)) {
        header("Location: login.php");
    }
?>

<?php 
include("../php/conexao.php");

$query_relatorio = "SELECT DATE_FORMAT(data_pedido, '%d/%m/%Y') as 'data_pedido', m.descricao as mesa, 
GROUP_CONCAT(CONCAT(pi.quantidade, ' ' , i.descricao_item) SEPARATOR ', ')
as  itens_pedido, SUM(valor_tot_item) as 'Valor_Total' 
			FROM mesa m INNER JOIN pedido p using (id_mesa)
			INNER JOIN pedido_itens pi USING (id_pedido)
			INNER JOIN itens i USING (id_itens_pedido)
			GROUP BY p.id_pedido order by i.descricao_item and data_pedido ASC";



$rows = $conexao->query($query_relatorio);

$write = "";
foreach ($rows as $row) {
    $data_pedido = $row['data_pedido'];
    $mesa = $row['mesa'];
    $itens_pedido = $row['itens_pedido'];
    $valor_total = $row['Valor_Total'];
    $valor_total = number_format($valor_total, 2, ',', '.');
    $real = "R$";
    $write .= "$data_pedido; $mesa; $itens_pedido; $real $valor_total \n";
}

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="relatorio.txt"');
echo $write;
exit;
?>

