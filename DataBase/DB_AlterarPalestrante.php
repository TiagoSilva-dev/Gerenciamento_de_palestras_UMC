<?php
session_start();
include ("DB_Conexao.php");

$id = mysqli_real_escape_string($conexao, trim($_POST['palest_id']));
$palest_nome = mysqli_real_escape_string($conexao, trim($_POST['palest_nome']));
$palest_area_atuacao = mysqli_real_escape_string($conexao, trim($_POST['palest_area_atuacao']));
$cpf = mysqli_real_escape_string($conexao, trim($_POST['palest_cpf']));
$palest_email = mysqli_real_escape_string($conexao, trim($_POST['palest_email']));
$palest_sobre = mysqli_real_escape_string($conexao, trim($_POST['palest_sobre']));
$palest_celular = mysqli_real_escape_string($conexao, trim($_POST['palest_celular']));
// Recebendo os dados do evento inseridos no formulario

//Validando o CPF
function validaCPF($cpf = null)
{
  // Verifica se um número foi informado
  if (empty($cpf)) {
    return false;
  }

  // Elimina possivel mascara
  $cpf = preg_replace("/[^0-9]/", "", $cpf);
  $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

  // Verifica se o numero de digitos informados é igual a 11
  if (strlen($cpf) != 11) {
    return false;
  }
  // Verifica se nenhuma das sequências invalidas abaixo
  // foi digitada. Caso afirmativo, retorna falso
  elseif (
    $cpf == '00000000000' ||
    $cpf == '11111111111' ||
    $cpf == '22222222222' ||
    $cpf == '33333333333' ||
    $cpf == '44444444444' ||
    $cpf == '55555555555' ||
    $cpf == '66666666666' ||
    $cpf == '77777777777' ||
    $cpf == '88888888888' ||
    $cpf == '99999999999'
  ) {
    return false;
    // Calcula os digitos verificadores para verificar se o
    // CPF é válido
  } else {
    for ($t = 9; $t < 11; $t++) {
      for ($d = 0, $c = 0; $c < $t; $c++) {
        $d += $cpf[$c] * ($t + 1 - $c);
      }
      $d = ((10 * $d) % 11) % 10;
      if ($cpf[$c] != $d) {
        return false;
      }
    }

    return true;
  }
}
validaCPF($cpf);
if (validaCPF($cpf) === true) {
  //Atualizando os dados do palestrante com as novas informaçoes
  $sql = "UPDATE palestrante SET palest_nome ='$palest_nome',
                palest_area_atuacao = '$palest_area_atuacao',
                palest_cpf = '$cpf',
                palest_email = '$palest_email',
                palest_sobre = '$palest_sobre',
                palest_celular = '$palest_celular' where palest_id = '$id'";

  $conexao->query($sql);
  $_SESSION['palestrante_alterado'] = true;
  header('Location: ../status.php');
}

$conexao->close();
?>
