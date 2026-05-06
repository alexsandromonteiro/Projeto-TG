<?php 
session_start();
include("../php/conexao.php");
$iditem = $_GET['iditem'];

$sql = "SELECT * FROM itens WHERE id_itens_pedido = '$iditem'";

$res = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar ao Carrinho</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <style>
        .comp {
            font-size:16px;
        }
        #qnt {
            width:10%;
            border:none;
            color:#000;
            text-align:center;
            background-color:white;
         }
         
    </style>
</head>

<body>
    <nav class="navbar fixed-top">
        <div class="container-fluid">
        <a class="navbar-brand" href="./cardapio.php?id_mesa=<?=$_SESSION['id_mesa']?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
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

    
     <?php 
     while($row_item = mysqli_fetch_assoc($res)) {
     extract($row_item);
     ?>
    <div class="text-center">
        <img src="../uploads_lanches_bedidas/<?php echo $imagem?>" 
        alt="" style="width: 70%; height:auto;">
    </div>
    
    <div class="container text-center mt-3">
        <h3><?php echo $descricao_item;?></h3>
        <p class="comp"><?php echo $composicao;?></p><br/>

        <!-- parte nova -->
        <div class="display-3 d-flex flex-sm-row align-items-center">
  <center><button class="pedido-quantidade-button decrement-btn">-</button>
  <input type="text" class="mx-5 input-qnt" value="1" id="qnt" disabled>
  <button class="pedido-quantidade-button increment-btn">+</button></center>
</div>
        <form action="process_carrinho.php" method="POST">
        <textarea class="mt-3" name="pontolanche" id="pontolanche"
        placeholder="Ponto da carne? Tirar a cebola? Diga ao chefe como você quer o seu lanche! (É opcional)"></textarea>
    </div>
    <div class="text-center mb-3">
        <input type="hidden" name="valorTotal" class="valorTotal" step="any">
        <input type="hidden" name="id_item" value="<?= $id_itens_pedido?>">
        <input type="hidden" class="input-qnt" name="quant" 
        value="1" id="qnt">
         <button id="" class="rounded py-3 mt-4 carrinho-button">
            Adicionar ao Carrinho - R$</button>
    </div>
    </form>
   <?php } ?>

    </div>
    <script src="../js/bootstrap.js"></script>
    
    
    <script>
 $(document).ready(function() {
//Adicionar
 $('.increment-btn').click(function () { 
    
  let qtn = $('.input-qnt').val();
  
  let value = parseInt(qtn, 10);

  value = isNaN(value) ? 0 : value;

  if(value < 100) {
     value++;
     $('.input-qnt').val(value);
  }
 });
 //Remover
 $('.decrement-btn').click(function () { 
  let qtn = $('.input-qnt').val();
  
  let value = parseInt(qtn, 10);

  value = isNaN(value) ? 0 : value;

  if(value > 1) {
     value--;
     $('.input-qnt').val(value);
  }
 });

 //Adicionar itens
 $('.increment-btn').click(function() {
    
    // obtendo o preço unitário do item
    let preco_unitario = <?php echo $preco; ?>;

    // obtendo a quantidade selecionada pelo usuário
    let qtn = $('.input-qnt').val();
    let quantidade = parseInt(qtn, 10);

    // calculando o preço total do item
    let preco_total = (preco_unitario * quantidade);

    // atualizando o texto do botão "Adicionar ao Carrinho"
    $('.carrinho-button').text('Adicionar ao Carrinho - R$ ' + 
    preco_total.toFixed(2).replace('.',','));
    $('.valorTotal').val(preco_total.toFixed(2));

 });

 
 //Retirar quantidade de itens
 $('.decrement-btn').click(function() {

    // obtendo o preço unitário do item
    let preco_unitario = <?php echo $preco; ?>;

    // obtendo a quantidade selecionada pelo usuário
    let qtn = $('.input-qnt').val();
    let quantidade = parseInt(qtn, 10);

    // verificando se a quantidade selecionada é maior do que zero
    if (quantidade > 0) {

    
    // calculando o novo preço total do item
        let preco_total = preco_unitario * quantidade;

        // atualizando o valor exibido na tela
        $('.input-qnt').val(quantidade);
        $('.carrinho-button').text('Adicionar ao Carrinho - R$ ' + preco_total.toFixed(2).replace('.',','));
        $('.valorTotal').val(preco_total.toFixed(2));
    }
});

//Iniciar a página com 1 item selecionado como padrão
let preco_unitario = <?php echo $preco; ?>;

let qtn = $('.input-qnt').val(0);
let quantidade = parseInt(qtn, 10);

let preco_total = preco_unitario * quantidade;

$('.carrinho-button').text('Adicionar ao Carrinho - R$ ' + 
preco_total.toFixed(2).replace('.',','));
$('.increment-btn').trigger('click');
 });
</script>
</body>

</html>