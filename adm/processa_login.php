<?php
session_start();

if(empty($_POST)|| (empty($_POST["email"]) || (empty($_POST["senha"])))) {
header("Location: login.php");
}
include("../php/conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM administrador WHERE email = '$email' 
AND senha = '".md5($senha)."'";

$res = mysqli_query($conexao, $sql) or die ($conexao->error);

$row = $res->fetch_object();

$qtd = $res->num_rows;

if($qtd > 0) {
$_SESSION["email"] = $email;
$_SESSION["id_adm"] = $row->id_adm;
$_SESSION["nome_adm"] = $row->nome_adm;
header("Location: ./adm.php");
} 
else 
header("Location: ./login.php?erro=dadosinvalidos");



?>