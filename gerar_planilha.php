 <?php
 include 'verifica_login.php';
 include "DataBase/DB_Conexao.php";

 $idevento = $_GET['idevento'];
 ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Contato</title>
	<head>
	<body>
		<?php
  // Definimos o nome do arquivo que será exportado
  $arquivo = 'Lista_de_Presença.xls';

  // Criamos uma tabela HTML com o formato da planilha
  $html = '';
  $html .= '<table border="1">';
  $html .= '<tr>';
  $html .= '<td colspan="5"><center>Lista de participantes</center></tr>';
  $html .= '</tr>';

  $html .= '<tr>';
  $html .= '<td><b>RGM</b></td>';
  $html .= '<td><b>Nome</b></td>';
  $html .= '<td><b>E-mail</b></td>';
  $html .= '<td><b>ID</b></td>';
  $html .= '<td><b>Nome do Evento</b></td>';
  $html .= '<td><b>Data</b></td>';
  $html .= '<td><b>Presença</b></td>';
  $html .= '</tr>';

  //Selecionar todos os itens da tabela

  $sql = "SELECT part_rgm_matricula, part_nome, part_email, id_evento,evento_nome, evento_data ,inscritos_presenca,hour(evento_hora_ter - evento_hora_ini) 
        FROM inscritos
        INNER JOIN participante ON participante.part_rgm_matricula = inscritos.participante_part_rgm_matricula
        INNER JOIN evento ON evento.id_evento = inscritos.evento_id_evento where evento.id_evento ='$idevento'";

  $resultado = mysqli_query($conexao, $sql);

  while ($registro = mysqli_fetch_array($resultado)) {
      $html .= '<td>' . $registro['part_rgm_matricula'] . '</td>';
      $html .= "<td>" . $registro['part_nome'] . "</td>";
      $html .= "<td>" . $registro['part_email'] . "</td>";
      $html .= "<td>" . $registro['id_evento'] . "</td>";
      $html .= "<td>" . $registro['evento_nome'] . "</td>";
      $html .= "<td>" . $registro['evento_data'] . "</td>";
      $html .= "<td></td>";
      $html .= '</td>';
      $html .= "</tr>";
  }
  echo "</table>";
  // Configurações header para forçar o download
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Content-type: application/x-msexcel");
  header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
  header("Content-Description: PHP Generated Data");
  // Envia o conteúdo do arquivo
  echo $html;
  exit();
  ?>
	</body>
</html>