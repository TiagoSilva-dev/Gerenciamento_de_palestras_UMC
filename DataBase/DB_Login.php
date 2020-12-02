<?php
session_start();
include 'DB_Conexao.php';

if (empty($_POST['part_rgm_matricula']) || empty($_POST['part_senha'])) {
  header('Location: /index.php');
  exit();
}

$rgm_matricula = mysqli_real_escape_string($conexao, trim($_POST['part_rgm_matricula']));
$senha = mysqli_real_escape_string($conexao, trim($_POST['part_senha']));

$sql = "SELECT * from coordenador where coord_matricula = '{$rgm_matricula}' and coord_senha = md5('{$senha}')";

$resultado = mysqli_query($conexao, $sql);

while ($registro = mysqli_fetch_array($resultado)) {
  $_SESSION['nome'] = $registro['coord_nome'];
}
$row = mysqli_num_rows($resultado);

if ($row == 1) {
  $_SESSION['usuario'] = $rgm_matricula;

  header('Location: /painel.php');
  exit();
} else {
  $sql = "SELECT * from participante where part_rgm_matricula = '{$rgm_matricula}' and part_senha = md5('{$senha}')";
  $resultado = mysqli_query($conexao, $sql);

  while ($registro = mysqli_fetch_array($resultado)) {
    $_SESSION['nome'] = $registro['part_nome'];
  }
  $row2 = mysqli_num_rows($resultado);

  if ($row2 == 1) {
    // Cria uma sessao com o nome usuario que vai receber o valor da variavel usuario
    $_SESSION['usuario'] = $rgm_matricula;

    header('Location: /Participante.php');
    exit();
  } else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: /index.php');
    exit();
  }
  $conexao->close();
}
