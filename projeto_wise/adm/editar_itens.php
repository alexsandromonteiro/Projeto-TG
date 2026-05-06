<?php 
session_start();
include_once("../php/conexao.php");

if(empty($_SESSION)) {
    header("Location: login.php");
}

$consultaLanche = "SELECT id_itens_pedido, descricao_item, composicao, preco, imagem 
FROM itens WHERE tipo_item = 'lanche'";
$resulConsultaLanche = mysqli_query($conexao, $consultaLanche);

?>
<?php
$consultaBebida = "SELECT id_itens_pedido, descricao_item, composicao, preco,
imagem FROM itens WHERE tipo_item = 'bebida'";
$resulConsultaBebida = mysqli_query($conexao, $consultaBebida);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar itens</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .linha {
          width:200px;
          border-top: 3px solid #000000;
          background-color:#000000;
          margin-left:-9%;
        }
        .editar {
            margin-left:-57%;
            width:45%;
            height:10%;
            color:white;
            background-color:black;
            border:none;
        }
        
        .excluir {
            margin-right:-57%;
            width:56%;
            color:white;
            background-color:black;
            border:none; 
        }
        a {
            font-size:15px;
            margin-left: -7%;
            background-color:black;
            color:white;
        }
    </style>
</head>

<body>
    <nav class="text-center py-2" style="background-color: gray;">
        <h2 class="">Administrador - Editar Itens</h2>
    </nav>
    <div class="container">
        <h3 class="mt-3">Lanches</h3>

        <div class="row row-cols-3 row-cols-md-5 g-4">
        <?php
  while($row = mysqli_fetch_array($resulConsultaLanche))
  {
    //Extrair os campos em variáveis.
    extract($row);
    ?>

            <div class="col">
                <div class="card h-100 border-dark">
                    <img src="../uploads_lanches_bedidas/<?php echo "$imagem";?>" 
                    class="card-img-top" alt="" width="250" height="180">
                    <div class="card-body text-center">
                        Código: <span><?php //echo $row['id_itens_pedido']; 
                                            echo "$id_itens_pedido";?></span> <br>
                        <span><?php echo $row['descricao_item'];?></span> <br>
                        Composição:<strong><span><br><?php //echo $row['composicao'];
                                                             echo "$composicao"?>
                    </span></strong><br>
                        Preço: <span><?php //echo $row['preco']; 
                                           echo "$preco";?></span>
                        <div>
         <hr class="linha" id="linha">
        <button class="editar"><?php echo "<a href='editar_it.php?id=". 
        $row['id_itens_pedido'] 
        . "'>Editar</a>" 
        ?></button>
         <button class="excluir" size="5">
            <?php echo "<a href='excluir_it.php?id=". $row['id_itens_pedido'] 
        . "'>Excluir</a>" ?></button>
  </div>
                    </div>
                </div>
            </div>
            <?php }  ?>
        </div>

        <h3 class="mt-3">Bebidas</h3>

        <div class="row row-cols-3 row-cols-md-5 g-4">
        <?php
  while($rowBebida = mysqli_fetch_array($resulConsultaBebida))
  {
    //Extrair os campos em variáveis.
    extract($rowBebida);
    ?>

            <div class="col">
                <div class="card h-100 border-dark">
            <img src="../uploads_lanches_bedidas/<?php echo "$imagem"?>" 
                    class="card-img-top" alt="" width="250" height="180">
                    <div class="card-body text-center">
                        Código: <span><?php //echo $rowBebida['id_itens_pedido'];
                                             echo "$id_itens_pedido";?></span> <br>
                        <span><?php //echo $rowBebida['descricao_item'];
                                    echo "$descricao_item";?></span> <br>
                        Composição: <strong><span><?php //echo $rowBebida['composicao'];
                                                        echo "$composicao";?>
                    </span></strong> <br>
                        Preço: <span><?php //echo $rowBebida['preco'];
                                            echo "$preco"?></span>
                        <div>
         <hr class="linha" id="linha">
        <button class="editar"><?php echo "<a href='editar_it.php?id=". 
        $rowBebida['id_itens_pedido'] 
        . "'>Editar</a>" 
        ?></button>
         <button class="excluir" size="5">
            <?php echo "<a href='excluir_it.php?id=". $rowBebida['id_itens_pedido'] 
        . "'>Excluir</a>" ?></button>
  </div>
                    </div>
                </div>
            </div>
            <?php }  ?>
        </div>

    </div>
    <script src="../js/bootstrap.js"></script>
</body>

</html>