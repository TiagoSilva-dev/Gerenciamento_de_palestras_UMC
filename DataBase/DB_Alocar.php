<?php
session_start();
include ("DB_Conexao.php");

$sala_id = mysqli_real_escape_string($conexao, trim($_POST['sala_id']));
$sala_local = mysqli_real_escape_string($conexao, trim($_POST['sala_local']));
$sala_numero = mysqli_real_escape_string($conexao, trim($_POST['sala_numero']));
$sala_capacidade = mysqli_real_escape_string($conexao, trim($_POST['sala_capacidade']));
// Recebendo os dados do evento inseridos no formulario

if($sala_local != "Sala de Aula"){

// Verificando que nao se repita um espaço com o mesmo numero e local

  $sql = "SELECT count(*) as total from sala where sala_numero = '$sala_numero' or sala_local = '$sala_local'";

  $result = mysqli_query($conexao, $sql);

  $row = mysqli_fetch_assoc($result);

if ($row['total'] == 1) {
  $_SESSION['local_existe'] = true;
  header('Location: ../status.php');
  exit();
} else {
  $sql = "INSERT INTO sala (sala_local,sala_numero,sala_capacidade) values ('$sala_local','$sala_numero','$sala_capacidade')";
  $conexao->query($sql);
  $_SESSION['local_criado'] = true;
  header('Location: ../status.php');
  }
}else{
    
  $sql = "SELECT count(*) as total from sala where sala_numero = '$sala_numero'";

  $result = mysqli_query($conexao, $sql);

  $row = mysqli_fetch_assoc($result);

if ($row['total'] == 1) {
  $_SESSION['local_existe'] = true;
  header('Location: ../status.php');
  exit();
}else{
  $sql = "INSERT INTO sala (sala_local,sala_numero,sala_capacidade) values ('$sala_local','$sala_numero','$sala_capacidade')";
  $conexao->query($sql);
  $_SESSION['local_criado'] = true;
  header('Location: ../status.php');

}
}
$conexao->close();

?>
