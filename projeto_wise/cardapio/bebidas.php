<?php
session_start();
include("../php/conexao.php");

$sql = "SELECT id_itens_pedido, descricao_item, tipo_item, imagem, 
composicao FROM itens
WHERE tipo_item = 'bebida'";
$resultado_bebida = mysqli_query($conexao, $sql); 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bebidas</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="./cardapio.php?id_mesa=<?=$_SESSION['id_mesa']?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
                <spam class="ms-2">Bebidas</spam>
            </a>
            <a href="./carrinho.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-cart"
                    viewBox="0 0 16 16">
                    <path
                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
            </a>
        </div>
    </nav>

    <?php while($row_bebida = mysqli_fetch_assoc($resultado_bebida)) {
        extract($row_bebida);
        
        ?>
    <a href="./adicionarAoCarrinho.php?iditem=<?=$id_itens_pedido?>">
    <div class="container mt-3">

        <div class="card mb-3 text-center border-dark" style="max-width: 540px; margin: 0 auto">
            <div class="row">
                <div class="col">
                    <img src="../uploads_lanches_bedidas/<?php echo $imagem; ?>" 
                    class="img-fluid rounded-lg p-3" alt="">
                </div>
                <div class="col">
                    <div class="card-body">
                        <h5 class="card-title"><span><?php echo $descricao_item; ?>
                    </span></h5>
                        <p class="card-text"><span><?php echo $composicao;?></span></p>
                    </div>
                </div>
            </div>
        </div>
    </a>
    </div>
  <?php } ?>
    <script src="../js/bootstrap.js"></script>
</body>

</html>