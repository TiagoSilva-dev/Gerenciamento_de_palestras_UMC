<?php
session_start();
include ("DB_Conexao.php");

$part_rgm = mysqli_real_escape_string($conexao, trim($_POST['part_rgm_matricula']));
$part_senha = mysqli_real_escape_string($conexao, trim(md5($_POST['part_senha'])));
$part_nome = mysqli_real_escape_string($conexao, trim($_POST['part_nome']));
$part_email = mysqli_real_escape_string($conexao, trim($_POST['part_email']));
$cpf = mysqli_real_escape_string($conexao, trim($_POST['part_cpf']));

function validaCPF($cpf = null) {

	// Verifica se um número foi informado
	if(empty($cpf)) {
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
	else if ($cpf == '00000000000' || 
		$cpf == '11111111111' || 
		$cpf == '22222222222' || 
		$cpf == '33333333333' || 
		$cpf == '44444444444' || 
		$cpf == '55555555555' || 
		$cpf == '66666666666' || 
		$cpf == '77777777777' || 
		$cpf == '88888888888' || 
		$cpf == '99999999999') {
		return false;
	 // Calcula os digitos verificadores para verificar se o
	 // CPF é válido
	 } else {   
		
		for ($t = 9; $t < 11; $t++) {
			
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf{$c} != $d) {
				return false;
			}
		}

		return true;
	}
}
$sql = "SELECT count(*) as total from coordenador where coord_matricula = '$part_rgm'";

$result = mysqli_query($conexao, $sql);

$row = mysqli_fetch_assoc($result);

if ($row['total'] == 1)
{
    $_SESSION['usuario_existe'] = true;
    header('Location: /CadastrarUsuario.php');
    exit;
}
else
{
    $sql = "SELECT count(*) as total from participante where part_rgm_matricula = '$part_rgm' or part_email = '$part_email' or part_cpf = '$cpf'";
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($result);
}
if ($row['total'] == 1)
{
    $_SESSION['usuario_existe'] = true;
    header('Location: /CadastrarUsuario.php');
    exit;
}
else
{   
    validaCPF($cpf);
    if(validaCPF($cpf)===true){
    # 0 = admin / 1 = participante
        $sql = "INSERT into participante (part_rgm_matricula,part_senha,part_nome,part_email,part_cpf) values ('$part_rgm','$part_senha','$part_nome','$part_email','$cpf')";
    }else{
        $_SESSION['cpf'] = true;
        header('Location: /CadastrarUsuario.php');
        exit;
    }
}
if ($conexao->query($sql) === true)
{
	$_SESSION['status_cadastro'] = true;
	header('Location: /CadastrarUsuario.php');
    exit;
}

$conexao->close();

exit;
?>
