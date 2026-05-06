<?php 
session_start();
include("../php/conexao.php");


if (isset($_GET['id_mesa'])) {
  // Obter o valor do id_mesa a partir da URL
  $id_mesa = $_GET['id_mesa'];

  // Armazenar o id_mesa na variável de sessão
  $_SESSION['id_mesa'] = $id_mesa;


if (!isset($_SESSION['id_pedido'])) {
  // Cria um novo pedido com o status "aberto" e o id_mesa armazenado na sessão
  $id_mesa = $_SESSION['id_mesa'];

  $pedido_query = "INSERT INTO pedido (status, id_mesa) VALUES ('aberto', '$id_mesa')";
  $resulPedido = mysqli_query($conexao, $pedido_query);

  // Armazena o id_pedido na SESSION
  $_SESSION['id_pedido'] = mysqli_insert_id($conexao);
}
else {
  echo " Status do pedido: aberto";
}




$itens_query = "SELECT id_itens_pedido,
descricao_item, composicao, tipo_item, imagem FROM itens";
$resulConsultaItens = mysqli_query($conexao, $itens_query);

$lanche_query = "SELECT id_itens_pedido,
descricao_item, composicao, tipo_item, imagem FROM itens WHERE tipo_item = 'lanche'";
$resulLanche = mysqli_query($conexao, $lanche_query);

$bebida_query = "SELECT id_itens_pedido,
descricao_item, composicao, tipo_item, imagem FROM itens WHERE tipo_item = 'bebida'";
$resulBebida = mysqli_query($conexao, $bebida_query);

$sql_mesa = "SELECT * FROM mesa where id_mesa = $id_mesa";
$res_mesa = $conexao->query($sql_mesa);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js">

  </script>  
  <title>Cardápio</title>
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/style.css">
  <style>
    #checkar {
      display:inline;
    }
  input.lanchebebida {
      cursor:pointer;
    }
    p {
      font-size:16px;
      margin-left:-7%;
    }
   
  </style>
</head>

<body>
  <nav class="navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <?php while($row_mesa = mysqli_fetch_assoc($res_mesa)) { extract($row_mesa); ?>
        <img src="../uploads_mesa/<?= $imagem;?>" alt="Logo" width="40" height="40" class="d-inline-block rounded-circle">
        <span class="ms-2"><?= $descricao; ?></span>
        <?php } ?>
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

  <div class="container">
  
  <!-- Barra de pesquisa -->
    <div class="mt-3 input-group mb-3">
      <input type="text" placeholder="Já sabe o que pedir? É só colocar o nome!"
        class="text-center form-control border-dark" aria-label="Default" 
        aria-describedby="inputGroup-sizing-default" id="pesquisaItem">
    </div>
    <div id="pes">

    <div class="row row-cols-3 row-cols-md-3 g-4 mt-3" >
      <a href="./lanches.php">
        <div class="col">
          <div class="card h-100 border-dark">
            <img src="../images/Hamburguer.jpg" class="card-img-top" alt=""
            style="width: 100%; height: auto;">
            <div class="card-body">
              <p class="card-title text-center" style="white-space: nowrap;">Lanches</p>
            </div>
          </div>
        </div>
      </a>

      <a href="./bebidas.php">
        <div class="col">
          <div class="card h-100 border-dark">
            <img src="../images/Bebida.jpg" class="card-img-top" alt=""
            style="width: 100%; height: auto;">
            <div class="card-body">
              <p class="card-title text-center" style="white-space: nowrap;">Bebidas</p>
            </div>
          </div>
        </div>
      </a>

    </div>

    <form action="cardapio.php" method="POST">
    <div class="text-center my-3">
      <div class="d-inline-block border border-2 rounded p-1 border-dark">
        <input type="checkbox" class="lanchebebida" 
        name="todos" id="todos" value="todos">
        <label for="">Todos</label>
      </div>
      <div class="d-inline-block mx-3 border border-2 rounded p-1 border-dark">
        <input type="checkbox" class="lanchebebida" name="lanche" id="lanche">
        <label for="">Lanches</label>
      </div>
      <div class="d-inline-block border border-2 rounded p-1 border-dark">
        <input type="checkbox" class="lanchebebida" name="bebida" id="bebida">
        <label for="">Bebidas</label>
      </div>
    </div>

    </form>
  
    <div class="display">
      
      </div>
    
  

    </div>
  </div>
  <?php 
}
  ?>
  

  <script src="../js/bootstrap.js"></script>
<script>
    // Listar tudo, lanches e bebidas com o checkbox
    $(document).ready(function() {
  $(".lanchebebida").on('click', function() {
    let is_todos = $("#todos").prop("checked");
    let is_lanche = $("#lanche").prop("checked");
    let is_bebida = $("#bebida").prop("checked");

    var lanchebebida = [];

    if(is_todos) {
      lanchebebida.push($.ajax({
        url:"fetch_todos.php",
        type:"POST",
        data:'request='+ $("#todos").val()
      }));
    }
    if(is_lanche) {
      lanchebebida.push($.ajax({
        url:"fetch_lanche.php",
        type:"POST",
        data:'request='+ $("#lanche").val()
      }));
    }
    if(is_bebida) {
      lanchebebida.push($.ajax({
        url:"fetch_bebida.php",
        type:"POST",
        data:'request='+ $("#bebida").val()
      }));
    }

    Promise.all(lanchebebida)
      .then(function(data) {
        $(".display").html(data); 
      });
  });
});

  </script>
  <script type="text/javascript">
    
    //pesquisa de itens
    $(document).ready(function(){
      $("#pesquisaItem").keyup(function(){
        var input = $(this).val();
        //alert(input);

        if(input != "") {
          $.ajax ({
         url:"fetch_pesquisa.php",
         method:"POST",
         data:{input:input},

         success:function(data) {
          $("#pes").html(data);
          $("#pes").css("display","block");
         }

          });
        }
        /*else if (input == "") {
      window.location.reload();
        }
        */
        else {
          $("#pes").css("display", "none");
        }
        
      });
    });
    
  </script>
</body>
</html>