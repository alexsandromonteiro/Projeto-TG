<?php
session_start();
include("../php/conexao.php");

if(empty($_SESSION)) {
    header("Location: login.php");
}

$id_itens_pedido = $_GET['id'];
$result_item = " SELECT * FROM itens where id_itens_pedido = '$id_itens_pedido' ";
$resultado_item = mysqli_query($conexao, $result_item);
$row_item = mysqli_fetch_assoc($resultado_item);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Item</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        #lanche, #bebida {
            display:inline;
            cursor: pointer;
        }
        input {
            display:block;
        }
        textarea {
            width: 65%;
            height: 150px;
            padding: 9px 5px;
            box-sizing: border-box;
            border: 2px solid #000;
            border-radius: 4px;
            background-color: #f8f8f8;
            font-size: 17px;
            resize: none;
            
        }
        
    </style>
</head>

<body>
    <nav class="text-center py-2" style="background-color: gray;">
        <center><h2 class="">Administrador - Editar Item</h2></center>
    </nav>
    <br/><h2>Dados do item</h2>
    <div class="container">
    <form action="process_edit_item.php" method="post" enctype="multipart/form-data">
        <br/>
        <input type="hidden" id="codigo" name="codigo" 
        value="<?php echo $row_item['id_itens_pedido'];?>">
        <br/><label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao"
        value = "<?php echo $row_item['descricao_item'];?>">

        <input type="hidden" id="id_adm" name="id_adm" value="<?php 
        echo $_SESSION['id_adm']?>">

        <br/><label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="any"
        value="<?php echo $row_item['preco'];?>">
        <br/><label for="imagem">Imagem:</label>
        <input type="button" onclick="desativar_imagem()" 
        value="Manter a mesma imagem">
        <br/><input type="file" id="imagem" name="imagem" accept=".jpg,.png">
        <br/><label for="composicao">Composição:</label>
        <br/>
        <textarea rows="25" cols="20" id="composicao" name="composicao"
        ><?php echo $row_item['composicao'] ?></textarea>
        <br/><br/><label>Tipo de item:</label><br/>
        <label for="lanche">&nbspLanche</label>
<input type="radio" name="tipoItem" id="lanche" value="lanche"
<?php 
if($row_item['tipo_item'] == 'lanche') {
    echo "checked";
}
?>
>
<label for="bebida">&nbsp&nbsp&nbspBebida</label>
<input type="radio" name="tipoItem" id="bebida" value="bebida"
<?php 
if($row_item['tipo_item'] == 'bebida') {
    echo "checked";
}
?>
>
<br/><div class="sticky-bottom mt-3 border-top border-dark p-3 text-center" style="background-color: white;">
<center><input type="submit" class="adm-btn mb-3" value="Atualizar item">
    </input></center>
    </div>
</form>
</div>

<script src="../js/bootstrap.js"></script>
<script>
function desativar_imagem() {
        let des_imagem = document.querySelector("input#imagem");
        des_imagem.disabled = true;
    }
</script>    
</body>
</html>