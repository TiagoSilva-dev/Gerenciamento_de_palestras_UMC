<?php
session_start();
include ("DB_Conexao.php");

// Recebendo o RGM/Matricula do Usuario Logado 
$user = $_SESSION['usuario'];

$Senha_Atual = mysqli_real_escape_string($conexao, trim(md5($_POST['senha_atual'])));
$Nova_Senha = mysqli_real_escape_string($conexao, trim(md5($_POST['nova_senha'])));
// Recebendo a senha atual , e a senha nova do usuario 

// ------------------------------------------ PARTICIPANTE -------------------------------------------------------

$sql = "SELECT count(*) as total from participante where part_senha = '{$Senha_Atual}' and part_rgm_matricula = '{$user}'";
// Consulta responsavel por dizer se existe ou nao um usuario com esta senha 
$result = mysqli_query($conexao, $sql);

$row = mysqli_fetch_assoc($result);

// Verificando se existe um usuario com a senha que foi informada , caso exista a troca e feita pela senha nova 
if(strlen($user)>7)
{
  if ($row['total'] == 1) {
    $sql = "UPDATE participante SET part_senha = '$Nova_Senha' where part_rgm_matricula = '{$user}' and part_senha = '{$Senha_Atual}'";
    $conexao->query($sql);
    $_SESSION['senha_alterada'] = true;
    header('Location: ../PartStatus.php');
  } else {
    $_SESSION['senha_nao_alterada'] = true;
    header('Location: ../PartStatus.php');
  }
}elseif(strlen($user)<=6){
  // ------------------------------------------ COORDENADOR -------------------------------------------------------

//Mesma coisa que o de cima , trocando apenas a tabela de consulta 

$sql = "SELECT count(*) as total from coordenador where coord_senha = '$Senha_Atual' and coord_matricula = '$user'";

$result = mysqli_query($conexao, $sql);

$row = mysqli_fetch_assoc($result);

if ($row['total'] == 1) {
  $sql = "UPDATE coordenador SET coord_senha = '$Nova_Senha' where coord_matricula = '{$user}' and coord_senha = '{$Senha_Atual}'";
  $conexao->query($sql);
  $_SESSION['cord_senha_alterada'] = true;
  header('Location: ../status.php');
  exit();
} else {
  $_SESSION['cord_senha_nao_alterada'] = true;
  header('Location: ../status.php');
  
}
$conexao->close();

}



?>
