<?php
session_start();
include("../php/conexao.php");

if(isset($_POST['codigo'])) {
 $codigo = $_POST['codigo'];
}
if(isset($_POST['descricao'])) {
    $descricao = $_POST['descricao'];
    } 
    $id_adm = filter_input(INPUT_POST, 'id_adm', FILTER_SANITIZE_NUMBER_INT);
    if(isset($_FILES['imagem'])) {
        $extensao = strtolower(substr($_FILES['imagem']['name'], -4));
        $novo_nome = md5(time()) . $extensao;
        $diretorio = "../uploads_mesa/";
    
        move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novo_nome);
    
        $sql = "UPDATE mesa SET descricao = '$descricao', id_adm = '$id_adm', 
        imagem = '$novo_nome' 
        WHERE id_mesa = '$codigo' ";
        $resultado_mesa = mysqli_query($conexao, $sql); 
        if(mysqli_affected_rows($conexao)) {
            header("Location: ./mesas.php");
        }
        else {
            echo "erro!";
        }
    }
    else {
        $sql = "UPDATE mesa SET descricao = '$descricao', id_adm = '$id_adm' 
        WHERE id_mesa = '$codigo' ";
        $resultado_mesa = mysqli_query($conexao, $sql); 
        header("Location: ./mesas.php");
    
    }
        
    ?>