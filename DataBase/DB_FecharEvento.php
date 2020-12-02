<?php
session_start();
include("DB_Conexao.php");

$idevento = mysqli_real_escape_string($conexao, trim($_POST['fechado']));

$sql = "UPDATE evento SET evento_fechado = '1' WHERE id_evento = '$idevento'";
$conexao->query($sql);

header('Location: /certificado.php');


 
?>