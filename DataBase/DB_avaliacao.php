<?php
session_start();
include "DB_Conexao.php";

$evento = $_POST['evento'];
$rgm = $_POST['rgm'];
$estrelas = $_POST['estrela'];
$text = $_POST['textoavaliacao'];

$sql = "SELECT count(*) as total from inscritos where evento_id_evento = '$evento' and participante_part_rgm_matricula = '$rgm' and inscritos_avaliacao >= '1'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['total'] == 1) {
    $_SESSION['ja_availou'] = true;
    header('Location: /status_avaliacao.php');
    exit();
} else {
    $sql = "UPDATE inscritos SET inscritos_avaliacao = '$estrelas',inscritos_textavaliacao = '$text' where evento_id_evento = '$evento' and participante_part_rgm_matricula = '$rgm'";
    $conexao->query($sql);
    $_SESSION['avaliado'] = true;
    header('Location: /status_avaliacao.php');
}
?>
