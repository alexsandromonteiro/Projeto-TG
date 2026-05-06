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
    <title>Editar mesas</title>
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
        <h2 class="">Administrador - Editar mesas</h2>
    </nav>
    <div class="container">
        <h3 class="mt-3">Mesas</h3>

        <div class="row row-cols-3 row-cols-md-5 g-4">
       <?php
  while($row = mysqli_fetch_array($resulConsulta))
  {
    //Extrair campos em variáveis.
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
         <div>
         <hr class="linha" id="linha">
        <button class="editar"><?php echo "<a href='editar_m.php?id=". $row['id_mesa'] 
        . "'>Editar</a>" 
        ?></button>
         <!--<button class="editar" size="5" onclick="editarM()">Editar</button>-->
         <button class="excluir" size="5">
            <?php echo "<a href='excluir_m.php?id=". $row['id_mesa'] 
        . "'>Excluir</a>" ?></button>
  </div>
     </div>
 </div>
</div>
  <?php }  ?>
        </div>

    </div>

    </div>
  </body>
    </html>