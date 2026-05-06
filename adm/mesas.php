<?php
session_start();
include_once("../php/conexao.php");

if(empty($_SESSION)) {
    header("Location: login.php");
}

$consulta = "SELECT imagem,id_mesa, descricao FROM mesa";
$resulConsulta = mysqli_query($conexao, $consulta);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesas</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <nav class="text-center py-2" style="background-color: gray;">
        <h2 class="">Administrador - Mesas</h2>
    </nav>
    <div class="container">
        <h3 class="mt-3">Mesas</h3>

        <div class="row row-cols-3 row-cols-md-5 g-4">
       <?php
  while($row = mysqli_fetch_array($resulConsulta))
  {
    //Extrair os campos em variáveis.
    extract($row);
    ?>
  <div class="col">
 <div class="card h-100 border-dark">
     <img src="../uploads_mesa/<?php echo "$imagem";?>" class="card-img-top" 
     alt="x-salada" height="200" width="180">
     <div class="card-body text-center">
         Código: <span style="font-size:15px;"><?php //echo $row['id_mesa'];
                                                      echo "$id_mesa";?></span> <br>
         Mesa: <span style="font-size:15px;"><?php //echo $row['descricao']; 
                                                   echo "$descricao";?></span>
     </div>
 </div>
</div>
  <?php }  ?>
        </div>

    </div>

    </div>

    <div class="sticky-bottom mt-3 border-top border-dark p-3 text-left" style="background-color: white;">
        <button class="adm-btn mb-3" onclick="adicionarMesa()">Adicionar Mesa</button>
        <button class="adm-btn mx-3" onclick="editarMesa()">Editar Mesas</button>
    </div>
    <script src="../js/bootstrap.js"></script>
	<script>
	function adicionarMesa() {
	window.location.href = "adicionar_mesa.php";
	}
    function editarMesa() {
        window.location.href = "editar_mesas.php";
    }
	</script>
</body>

</html>