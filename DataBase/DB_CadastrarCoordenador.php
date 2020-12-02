<?php
session_start();
include "DB_Conexao.php";
// Recebendo os dados do coordenador inseridos no formulario
$coord_matricula = mysqli_real_escape_string($conexao, trim($_POST['coord_matricula']));
$coord_nome = mysqli_real_escape_string($conexao, trim($_POST['coord_nome']));
$coord_email = mysqli_real_escape_string($conexao, trim($_POST['coord_email']));
$coord_senha = mysqli_real_escape_string($conexao, trim(md5($_POST['coord_senha'])));

$sql = "SELECT count(*) as total from participante where part_rgm_matricula = '$coord_matricula' or part_email = '$coord_email'";
// Seleciona o total de participante que tem o rgm = a matricula de coordenador
$result = mysqli_query($conexao, $sql);

$row = mysqli_fetch_assoc($result);

if ($row['total'] == 1) {
  $_SESSION['usuario_existe'] = true;
  exit();
} else {
  //Para garantir que nao existe um coordenador com matricula repetida
  $sql = "SELECT count(*) as total from coordenador where coord_matricula = '$coord_matricula' or coord_email ='$coord_email'";
  $result = mysqli_query($conexao, $sql);
  $row = mysqli_fetch_assoc($result);
}
if ($row['total'] == 1) {
  $_SESSION['coord_nao_criado'] = true;
  header('Location: ../status.php');
  exit();
} else {
  // Se a matricula digita nao conferir com nenhuma cadastrada no banco , a conta de coordenador e criada
  $sql = "INSERT INTO coordenador (coord_matricula, coord_nome, coord_email, coord_senha) VALUES ('$coord_matricula','$coord_nome','$coord_email','$coord_senha')";
}
if ($conexao->query($sql) === true) {
  $_SESSION['coord_sucesso'] = true;
  header('Location: ../status.php');
}

$conexao->close();

exit();
?>
