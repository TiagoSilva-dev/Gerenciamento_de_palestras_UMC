<?php
session_start();
include "DataBase/DB_Conexao.php";

$part = $_SESSION['usuario'];

$idevento = $_GET['idevento'];

$sql = "SELECT count(*) as total from inscritos where participante_part_rgm_matricula = '$part' and evento_id_evento = '$idevento'";

$result = mysqli_query($conexao, $sql);

$row = mysqli_fetch_assoc($result);

if ($row['total'] == 1) {
    $_SESSION['participante_inscreveu'] = true;
    header('Location: PartStatus.php');
    exit();
} else {
    $sql = "INSERT into inscritos (evento_id_evento,participante_part_rgm_matricula)values('$idevento','$part')";
    if ($conexao->query($sql) === true) {
        $_SESSION['inscrito_evento'] = true;

        /*************  ENVIANDO EMAIL DE CONFIRMAÇAO PARA O PARTICIPANTE *************/

        // Extraindo os dados do evento e do participante
        $sql = "SELECT  evento_nome,evento_data,part_rgm_matricula,part_email,part_nome
                FROM inscritos
                INNER JOIN evento 
                    ON evento.id_evento = inscritos.evento_id_evento
                INNER JOIN participante 
                    ON participante.part_rgm_matricula = inscritos.participante_part_rgm_matricula 
                where inscritos.participante_part_rgm_matricula = '$part'";

        $resultado = mysqli_query($conexao, $sql);

        while ($registro = mysqli_fetch_array($resultado)) {
            $email = $registro['part_email'];
            $nome = $registro['part_nome'];
            $evento = $registro['evento_nome'];
            $data = $registro['evento_data'];
        }

        $to = "$email"; // email de destino
        $subject = "Confirmaçao de inscriçao "; //aqui vai o assunto
        $message = "Olá $nome \n Sua inscriçao no evento $evento \n que acontecera no dia $data \n Foi confirmada , Contamos com sua presença ";
        $header = "MIME-Version: 1.0\n";
        $header = "content-type: text/html; charset=iso-8859-1\n";
        $header = "From: tcctads@task.com.br \n"; //email que vai enviar'
        mail($to, $subject, $message, $header);

        header('Location: PartStatus.php');
    }
}
?>
