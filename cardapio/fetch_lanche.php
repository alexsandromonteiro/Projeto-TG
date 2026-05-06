<?php
include("../php/conexao.php");
if(isset($_POST['request'])) {
    $request = $_POST['request'];

    $query = "SELECT id_itens_pedido, composicao, descricao_item, preco, 
    tipo_item, imagem, tipo_item
    FROM itens WHERE tipo_item = 'lanche'";
    $resulConsultaLanche = mysqli_query($conexao, $query);
    $count = mysqli_num_rows($resulConsultaLanche);
}

?>
<?php
while($row = mysqli_fetch_assoc($resulConsultaLanche)) {
            ?>
      <a href="./adicionarAoCarrinho.php?iditem=<?=$row['id_itens_pedido']?>">
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
      <?php } ?>
