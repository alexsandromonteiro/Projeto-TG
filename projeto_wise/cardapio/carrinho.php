<?php 
session_start();
include("../php/conexao.php");
$id_pedido = $_SESSION['id_pedido'];
$id_mesa = $_SESSION['id_mesa'];

$sql_itens = "SELECT pi.id, descricao_item, composicao,imagem as im
FROM itens 
INNER JOIN        pedido_itens as pi USING (id_itens_pedido)
INNER JOIN         pedido USING (id_pedido) WHERE 
                id_pedido = '$id_pedido' and id_mesa = '$id_mesa'";

$res_itens = $conexao->query($sql_itens);

$sql_valor_total = "SELECT pi.id, sum(valor_tot_item) as soma
FROM itens INNER JOIN
        pedido_itens as pi USING (id_itens_pedido) 
        WHERE id_pedido = '$id_pedido'
        ORDER BY (descricao_item)";

$res_valor_total = $conexao->query($sql_valor_total);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrinho</title>
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/style.css">
  <style>
 .trash {
      position: absolute;
      width: 50%;
      height: 80%;
      display: flex;
      align-items: center;
      border-radius: 18px;
      transition: .2s ease-out;
      right: -30px;
      top: 20px;
      color: #fff;
      background: #ff0033;
      justify-content: flex-end;
      z-index: -1;
    }

    .trash:hover {
      transform: translateX(40px);
    }

    .trash-icon {
      height: 130px;
    }
  </style>


</head>

<body>
<div id="enviar-pedido" class="z-1 position-absolute top-50 start-50 translate-middle py-3 rounded">
  <p class="display-5 mt-5">Posso mandar os chefes fazerem?</p>
  <div class="fixed-bottom mb-3 d-flex justify-content-center">
    <button onclick="pedidoEnviado()" class="enviar-pedido-button rounded" style="background-color: rgb(0, 255, 0);">Sim!</button>
    <span class="mx-3"></span>
    <button onclick="pedidoNaoEnviado()" class="enviar-pedido-button rounded" style="background-color: red;">Não!</button>
  </div>
</div>
  <!--
  <div id="enviar-pedido" class="z-1 position-absolute top-50 start-50 translate-middle py-3 rounded">
    <p class="display-5 mt-5">Posso mandar os chefes fazerem?</p>
    <div class="fixed-bottom mb-3">
      <button onclick="pedidoEnviado()" class="enviar-pedido-button rounded"
        style="background-color: rgb(0, 255, 0);">Sim!</button>
      <span class="mx-3"></span>
      <button onclick="pedidoNaoEnviado()" class="enviar-pedido-button rounded"
        style="background-color: red;">Não!</button>
    </div>
  </div>
  -->

  <div id="opacity-background">

    <nav class="navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="./cardapio.php?id_mesa=<?=$_SESSION['id_mesa']?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
              d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
          </svg>
          <span class="ms-2">Carrinho</span>
        </a>
      </div>
    </nav>
    <?php 
    if(mysqli_num_rows($res_itens) == 0) {
      echo "<div class='text-center position-absolute top-50 start-50 translate-middle'>
                    <h1>Carrinho Vazio</h1>
                    <br/><p>O seu carrinho está vazio,<br/>
                    adicione itens e eles irão<br/> aparecer aqui!</p>
                </div>";
  } 
    else {
    ?>
     <?php while($row = mysqli_fetch_assoc($res_itens)){
      extract($row) ?>
    
    <div class="container m-3">
      <div class="card mb-3 text-center border-0" 
      style="max-width: 250px; margin: 0 auto; z-index: 1;"> <!--540-->
        <button class="trash border border-dark">
          <a href="./excluir_it_carrinho.php?id=<?php echo $id; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
              <path 
              d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
            </svg>
          </a>
        </button>
        <div class="row bg-white rounded border border-dark">
          <div class="col">
            <img src="../uploads_lanches_bedidas/<?= $im;?>" 
            class="img-fluid rounded-lg p-3" alt="">
          </div>
          <div class="col">
            <div class="card-body">
              <h5 class="card-title"><span><?= $descricao_item;?></span></h5>
              <p class="card-text"><span><?= $composicao; ?></span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>

    <div class="text-center mb-3">
    <?php foreach($res_valor_total as $valorTotal): extract($valorTotal); 
      $soma_pedido = $soma;
      $soma_pedido = number_format($soma_pedido, 2, ',', '.');
      ?>
      <button id="" class="rounded py-3 carrinho-button" 
      onclick="enviarPedido()">Finalizar Pedido - R$ <?= $soma_pedido ?></button>
      <?php endforeach; } ?>

    </div>

  </div>

  <script src="../js/bootstrap.js"></script>
  <script src="../js/script.js"></script>
  <script>
    function pedidoEnviado() {
      window.location.href="./enviaPedido.php";
    }
    function pedidoNaoEnviado() {
      window.location.reload();
    }
  </script>
</body>

</html>