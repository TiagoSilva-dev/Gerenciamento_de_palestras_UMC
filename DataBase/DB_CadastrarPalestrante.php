<?php
session_start();
include "DB_Conexao.php";
// Recebendo os dados do palestrante inseridos no formulario
$palest_nome = mysqli_real_escape_string($conexao, trim($_POST['palest_nome']));
$palest_email = mysqli_real_escape_string($conexao, trim($_POST['palest_email']));
$palest_celular = mysqli_real_escape_string($conexao, trim($_POST['palest_celular']));
$palest_sobre = mysqli_real_escape_string($conexao, trim($_POST['palest_sobre']));
$palest_area_atuacao = mysqli_real_escape_string($conexao, trim($_POST['palest_area_atuacao']));
$cpf = mysqli_real_escape_string($conexao, trim($_POST['palest_cpf']));
//Validando o CPF Digitado
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

//Garantindo que nao tenha dois palestrante com mesmo email
$sql = "SELECT count(*) as total from palestrante where palest_email = '$palest_email' or palest_cpf = '$cpf'";

$result = mysqli_query($conexao, $sql);

$row = mysqli_fetch_assoc($result);

if ($row['total'] == 1) {
  $_SESSION['palestrante_existe'] = true;
  header('Location: ../status.php');
  exit();
} else {
	//se o cpf for verdadeiro , o palestrante e cadastrado no banco 
  validaCPF($cpf);
  if (validaCPF($cpf) === true) {
    $sql = "INSERT INTO palestrante (palest_nome,palest_email,palest_cpf,palest_celular,palest_sobre,palest_area_atuacao) VALUES ('$palest_nome','$palest_email','$cpf','$palest_celular','$palest_sobre','$palest_area_atuacao')";
  } else {
    $_SESSION['cpf'] = true;
    header('Location: ../CadastrarPalestrante.php');
    exit();
  }
}
if ($conexao->query($sql) === true) {
  $_SESSION['palestrante_cadastro'] = true;
  header('Location: ../status.php');
}

$conexao->close();

?>
