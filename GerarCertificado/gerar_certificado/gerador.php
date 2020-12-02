<?php
include("DB_Conexao.php");
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
date_default_timezone_set( 'America/Sao_Paulo' );
require('fpdf/alphapdf.php');
require('PHPMailer/class.phpmailer.php');
$dados = $_GET['dados'];
$x = explode("|",$dados);


for($i=0;$i<=count($x);$i++)
{
    $rgm = $x[0];
    $nome = $x[1];
    $email = $x[2];
    $evento = $x[3];
    $data = $x[4];
    $carga_h=$x[5];
    $idevento = $x[6];
   
}
$sql = "UPDATE inscritos SET inscritos_presenca = '1' where participante_part_rgm_matricula = '$rgm' and evento_id_evento = '$idevento'";
$conexao->query($sql);




$texto2 = utf8_decode("CERTIFICAMOS Que O Aluno $nome Portador do RGM : $rgm \n Participou Do Evento $evento \n Realizado Em ".$data." Com Carga Horária Total De ".$carga_h." Horas .");
$texto3 = utf8_decode("São Paulo, ".utf8_encode(strftime( '%d de %B de %Y', strtotime( date( 'Y-m-d' ) ) )));


$pdf = new AlphaPDF();

// Orientação Landing Page ///
$pdf->AddPage('L');

$pdf->SetLineWidth(1.5);


// desenha a imagem do certificado
$pdf->Image('certificado.jpg',0,0,295);

// opacidade total
$pdf->SetAlpha(1);



// Mostrar o corpo
$pdf->SetFont('Arial', '', 20); // Tipo de fonte e tamanho
$pdf->SetXY(20,110); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(265, 10, $texto2, '', 'C', 0); // Tamanho width e height e posição

// Mostrar a data no final
$pdf->SetFont('Arial', '', 20); // Tipo de fonte e tamanho
$pdf->SetXY(32,172); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(165, 10, $texto3, '', 'L', 0); // Tamanho width e height e posição

$pdfdoc = $pdf->Output('', 'S');



// ******** Agora vai enviar o e-mail pro usuário contendo o anexo
// ******** e também mostrar na tela para caso o e-mail não chegar

$subject = 'Parabens , Chegou seu Certificado!';
$messageBody = "Olá $nome <br><br>
                É com grande prazer que entregamos o seu certificado.<br>
                Tem um tempinho ? gostaria de avaliar o evento que voce participou ? Segue o link para avaliaçao<br>
                tcctads.ga/avaliacao.php?evento=$idevento|$rgm<br>Ele está em anexo nesse e-mail.<br><br>Atenciosamente,<br>UMC<br>";


$mail = new PHPMailer();
$mail->SetFrom("tcctads@task.com.br", "Certificado");
$mail->Subject    = $subject;
$mail->MsgHTML(utf8_decode($messageBody));
$mail->AddAddress($email); 
$mail->addStringAttachment($pdfdoc, 'certificado.pdf');
$mail->Send();
header('Location: /../TESTEGerarcertificado.php?idevento='.$idevento.'');



/*
$certificado="arquivos/$rgm.pdf"; //atribui a variável $certificado com o caminho e o nome do arquivo que será salvo (vai usar o CPF digitado pelo usuário como nome de arquivo)
$pdf->Output($certificado,'F'); //Salva o certificado no servidor (verifique se a pasta "arquivos" tem a permissão necessária)
// Utilizando esse script provavelmente o certificado ficara salvo em www.seusite.com.br/gerar_certificado/arquivos/999.999.999-99.pdf (o 999 representa o CPF digitado pelo usuário)
//header('Location: ../status.php');
$pdf->Output(); // Mostrar o certificado na tela do navegador
*/
?>
