<?php
session_start();
unset($_SESSION["email"]);
unset($_SESSION["nome_adm"]);
unset($_SESSION["id_adm"]);
session_destroy();
header("Location: ../index.html");
exit;
?>