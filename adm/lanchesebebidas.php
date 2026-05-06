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
    <title>Lanches e Bebidas</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <nav class="text-center py-2" style="background-color: gray;">
        <h2 class="">Administrador - Lanches e Bebidas</h2>
    </nav>
    <div class="container">
        <h3 class="mt-3">Lanches</h3>

        <div class="row row-cols-3 row-cols-md-5 g-4">
        <?php
  while($row = mysqli_fetch_array($resulConsultaLanche))
  {
    //Extraindo cada campo em uma variável
    extract($row);
    ?>

            <div class="col">
                <div class="card h-100 border-dark">
                    <img src="../uploads_lanches_bedidas/<?php echo "$imagem";?>" 
                    class="card-img-top" alt="" width="250" height="180">
                    <div class="card-body text-center">
                        Código: <span><?php // echo $row['id_itens_pedido']; 
                                               echo "$id_itens_pedido";?>
                    
                    </span> <br>
                        <span><?php //echo $row['descricao_item'];
                                     echo "$descricao_item";?>
                        </span> <br>
                        Composição:<strong><span><br><?php //echo $row['composicao'];
                                                             echo "$composicao";?>
                    </span></strong><br>
                        Preço: <span><?php //echo $row['preco']; 
                                           echo "$preco";?></span>
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
    //Extrair os campos em variáveis
    extract($rowBebida);
    ?>

            <div class="col">
                <div class="card h-100 border-dark">
                    <img src="../uploads_lanches_bedidas/<?php echo "$imagem" ?>" 
                    class="card-img-top" alt="" width="250" height="180">
                    <div class="card-body text-center">
                        Código: <span><?php //echo $rowBebida['id_itens_pedido'];
                                            echo "$id_itens_pedido";?></span> <br>
                        <span><?php echo $rowBebida['descricao_item']?></span> <br>
                        Composição: <strong><span><?php // echo $rowBebida['composicao'] 
                                                    echo "$composicao";?>
                    </span></strong> <br>
                        Preço: <span><?php //echo $rowBebida['preco']
                                            echo "$preco";?></span>
                    </div>
                </div>
            </div>
            <?php }  ?>
        </div>

    </div>

    <div class="sticky-bottom mt-3 border-top border-dark p-3 text-left" style="background-color: white;">
        <button class="adm-btn mb-3" onclick="adicionar_item()">Adicionar Item</button>
        <button class="adm-btn mx-3" onclick="editar_itens()">Editar Itens</button>
    </div>
    <script src="../js/bootstrap.js"></script>
    <script>
        function adicionar_item() {
            window.location.href = "./adicionar_item.php"
        }
        function editar_itens() {
            window.location.href = "./editar_itens.php";
        }
    </script>
</body>

</html>