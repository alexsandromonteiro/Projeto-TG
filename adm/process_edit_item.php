<?php
session_start();
include("../php/conexao.php");

$codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_NUMBER_INT);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
$id_adm = filter_input(INPUT_POST, 'id_adm', FILTER_SANITIZE_NUMBER_INT);

if(isset($_POST['preco']))
$preco = $_POST['preco'];

$composicao = filter_input(INPUT_POST, 'composicao', FILTER_SANITIZE_STRING);
if(isset($_POST['tipoItem'])) {
$tipoItem = $_POST['tipoItem'];
}
    
if(isset($_FILES['imagem'])) {

    $extensao = strtolower(substr($_FILES['imagem']['name'], -4));
    $novo_nome = md5(time()) . $extensao;
    $diretorio = "../uploads_lanches_bedidas/";

    move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novo_nome);
    
    $sql = "UPDATE itens SET descricao_item = '$descricao', preco = '$preco', 
    composicao = '$composicao', tipo_item = '$tipoItem',
    id_adm = '$id_adm' ,imagem = '$novo_nome' 
    WHERE id_itens_pedido = '$codigo' ";
    $resultado_item = mysqli_query($conexao, $sql); 
    if(mysqli_affected_rows($conexao)) {
        header("Location: ./lanchesebebidas.php");
    }
    else {
        echo "erro!";
    }
}
else {
    $sql = "UPDATE itens SET descricao_item = '$descricao', preco = '$preco', 
    composicao = '$composicao', tipo_item = '$tipoItem', id_adm = '$id_adm' WHERE 
    id_itens_pedido = '$codigo' ";
    $resultado_item = mysqli_query($conexao, $sql); 
    header("Location: ./lanchesebebidas.php");

}

?>