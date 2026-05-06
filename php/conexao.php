<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "restaurante";

$conexao = new mysqli($servidor, $usuario, $senha, $dbname);
if(!$conexao) {
    die("Houve um erro" . mysqli_connect_error());
}
?>