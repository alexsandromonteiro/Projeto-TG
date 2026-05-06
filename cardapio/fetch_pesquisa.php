<?php 
include("../php/conexao.php");
if(isset($_POST['input'])) {

    $input = $_POST['input'];

    $sql = "SELECT * FROM itens WHERE descricao_item LIKE '%{$input}%'";

    $resultado_itens = mysqli_query($conexao, $sql);

    if(mysqli_num_rows($resultado_itens) > 0) {?>
     
     <?php
     while($row = mysqli_fetch_assoc($resultado_itens)) {
     ?>
     <a href="adicionarAoCarrinho.php?iditem=<?= $row['id_itens_pedido'];?>">
     <div class="card mb-3 text-center border-dark" style="max-width: 540px; margin: 0 auto">
        <div class="row">
          <div class="col">
            
            <img src="../uploads_lanches_bedidas/<?php echo $row['imagem']?>" class="img-fluid rounded-lg p-3" alt="">
          </div>
          <div class="col">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['descricao_item'];?></h5>
              <p class="card-text"><?php echo $row['composicao']?></p>
            </div>
          </div>
        </div>
      </div>
      </a>
    <?php 
    
   }
   ?>
   <?php
    }
    else {
        echo "
		<div class='text-center d-flex align-items-center justify-content-center vh-100'>
    <div style='margin-top: -140px;'>
        <h1>Item não encontrado</h1>
        <br/>
		 <p style='margin-left:3%;font-size:20px;text-align:center;'>Dei uma procurada aqui<br/>
		 <span style='margin-left: 3%'>mas não achei o que está</span>
		 <br/><span style='margin-left: -6%'>procurando</span>, desculpe.</p>
    </div>
</div>";

        }
}

 



    ?>

