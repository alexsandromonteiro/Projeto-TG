
<?php
session_start();
include("../php/conexao.php");
if(empty($_SESSION)) {
    header("Location: login.php");
}
$codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_NUMBER_INT);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
$id_adm = filter_input(INPUT_POST, 'id_adm', FILTER_SANITIZE_NUMBER_INT);

if(isset($_POST['preco']))
$preco = $_POST['preco'];

$composicao = filter_input(INPUT_POST, 'composicao', FILTER_SANITIZE_STRING);
if(isset($_POST['tipoItem'])) {
$tipoItem = $_POST['tipoItem'];
}
    
    $msg = false;
if(isset($_FILES['imagem'])) {

    $extensao = strtolower(substr($_FILES['imagem']['name'], -4));
    $novo_nome = md5(time()) . $extensao;
    $diretorio = "../uploads_lanches_bedidas/";

    move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novo_nome);
    
    $sql = "INSERT INTO itens (id_itens_pedido, descricao_item, preco, composicao, 
    tipo_item, id_adm, imagem) VALUES ('$codigo', '$descricao', '$preco', '$composicao', 
    '$tipoItem', '$id_adm', '$novo_nome')";
    if($conexao->query($sql)) {
        $msg = "Dados enviados com sucesso!";
        header("Location: ./lanchesebebidas.php");
         }
         else {
         $msg = "Falha ao enviar os dados";
         echo $msg;
         }
}









?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Item</title>
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
        <center><h2 class="">Administrador - Adicionar Item</h2></center>
    </nav>
    <br/><h2>Dados do item</h2>
    <div class="container">
    <?php if($msg != false ) echo "<p> $msg </p>" ?>
    <form action="adicionar_item.php" method="post" enctype="multipart/form-data">
        <br/><label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" required>
        <br/><label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required>
        
        <input type="hidden" id="id_adm" name="id_adm" value="<?php 
        echo $_SESSION['id_adm']?>">

        <br/><label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="any" required>
        <br/><label for="imagem">Imagem:</label>
        <input type="file" id="imagem" name="imagem" accept=".jpg,.png" required>
        <br/><label for="composicao">Composição:</label>
        <br/>
        <textarea rows="25" cols="20" id="composicao" name="composicao"
        required></textarea>
        <br/><br/><label>Tipo de item:</label><br/>
        <label for="lanche">&nbspLanche</label>
<input type="radio" name="tipoItem" id="lanche" value="lanche" required>
<label for="bebida">&nbsp&nbsp&nbspBebida</label>
<input type="radio" name="tipoItem" id="bebida" value="bebida">
<br/><div class="sticky-bottom mt-3 border-top border-dark p-3 text-center" style="background-color: white;">
<center><input type="submit" class="adm-btn mb-3" value="Confirmar Item">
    </input></center>
    </div>
</form>
</div>

<script src="../js/bootstrap.js"></script>

    
</body>
</html>