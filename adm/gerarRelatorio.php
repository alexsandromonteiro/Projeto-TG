<?php
    session_start();
    if(empty($_SESSION)) {
        header("Location: login.php");
    }
?>

<?php 
include("../php/conexao.php");
$sql = "SELECT DATE_FORMAT(data_pedido, '%d/%m/%Y') as 'data_pedido', 
m.descricao as mesa, 
GROUP_CONCAT(CONCAT(pi.quantidade, ' ' , i.descricao_item) SEPARATOR ', ')
as  itens_pedido, SUM(valor_tot_item) as 'Valor_Total' 
			FROM Mesa m INNER JOIN Pedido p using (id_mesa)
			INNER JOIN pedido_itens pi USING (id_pedido)
			INNER JOIN Itens i USING (id_itens_pedido)
			GROUP BY p.id_pedido order by i.descricao_item and data_pedido ASC";

$inserir_sql = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar Relatório</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        a#imprimir {
            position:fixed;
            top: -0.0em;
            right: 1em;
        }
        table {
            border:1px solid #000000;
            border-collapse: collapse;
        }
        td, th {
  border: 1px solid #000000;
  padding: 8px;
   } 

    </style>
    
</head>

<body>
    <nav class="text-center py-2" style="background-color: gray;">
        <h2 class="">Administrador - Gerar Relatório</h2>
    </nav>

    <nav class="navbar">
    <div class="container-fluid fixed-top p-0">
        <a href="imprimir_relatorio.php" id="imprimir">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-printer"
                viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                <path
                    d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
            </svg>
            <p id="imp">Imprimir</p>
        </a>
    </div>
</nav>


    <div class="container">
        <table class="table text-center mt-3">
            <thead>
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Pedido</th>
                    <th scope="col">Valor Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($inserir_sql as $relatorio) : extract($relatorio);
                $Valor_Total = number_format($Valor_Total, 2, ',', '.'); 
                ?>
                <tr>
                    <td scope="row"><?=$data_pedido;?></td>
                    <td><?= $mesa;?></td>
                    <td><?=$itens_pedido;?></td>
                    <td>R$ <?=$Valor_Total?></td>
                </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
    </div>
    <script src="../js/bootstrap.js"></script>
</body>

</html>