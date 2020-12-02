<?php
session_start();
include ("DB_Conexao.php");

$responsavel = $_SESSION['usuario'];
// Recebendo o ID do palestrante Selecionado no formulario
$palest_id = mysqli_real_escape_string($conexao, trim($_POST['palest_id']));

// Recebendo o ID do Local que foi informado no formulario
$local_id = mysqli_real_escape_string($conexao, trim($_POST['sala_id']));

// Trazendo o nome do local , pelo ID informado no formulario
$sql = "SELECT * from sala where sala_id = '$local_id'";
$result = mysqli_query($conexao, $sql);

while ($linha = mysqli_fetch_array($result)) {
  $sala = $linha['sala_local'];
  $lotacao = $linha['sala_capacidade'];
}

// Usando o ID que foi informado no formulario, para trazer do BD  o Nome e Email do palestrante
$sql = "SELECT * from palestrante where palest_id = '$palest_id'";
$resultado = mysqli_query($conexao, $sql);

while ($registro = mysqli_fetch_array($resultado)) {
  $nome = $registro['palest_nome'];
  $email = $registro['palest_email'];
}

// Recebendo os dados do evento inseridos no formulario
$evento_nome = mysqli_real_escape_string($conexao, trim($_POST['evento_nome']));
$evento_descricao = mysqli_real_escape_string($conexao, trim($_POST['evento_descricao']));
$evento_data = mysqli_real_escape_string($conexao, trim($_POST['evento_data']));
$evento_hora_ini = mysqli_real_escape_string($conexao, trim($_POST['evento_hora_ini']));
$evento_hora_ter = mysqli_real_escape_string($conexao, trim($_POST['evento_hora_ter']));

// Verificando se a hora de termino do evento informada no formulario , e menor que o horario de inicio
if ($evento_hora_ter < $evento_hora_ini) {
  $_SESSION['hora_ter_menor_ini'] = true;
  header('Location: /status.php');
  exit();
} else {
  // Essa Query vai verificar se ja existe um evento cadastrado no mesmo dia , hora e local
  $inner = "SELECT count(*) as total from 
    (SELECT evento_nome,evento_palestrante,evento_data,evento_hora_ini,evento_hora_ter,sala_local
        FROM alocados
        INNER JOIN evento 
        ON evento.id_evento = alocados.evento_id_evento
        INNER JOIN sala
        on sala.sala_id = alocados.sala_sala_id) as total_eventos_mesma_data where evento_data = '$evento_data'
        and (evento_hora_ini <= '$evento_hora_ter' && evento_hora_ter >= '$evento_hora_ini') and sala_local = '$sala'";

  $resultInner = mysqli_query($conexao, $inner);

  $rowInner = mysqli_fetch_assoc($resultInner);

  if ($rowInner['total'] == 1) {
    $_SESSION['evento_com_mesmo_nome'] = true;
    header('Location: /status.php');
    exit();
  } else {
    //Enviando ao banco uma query para criar o evento
    $sql = "INSERT INTO evento (sala_id,evento_nome,evento_descricao,evento_data,evento_hora_ini,evento_hora_ter,
            palestrante_palest_id,evento_palestrante,evento_fechado,evento_capacidade)
            values ('$local_id','$evento_nome','$evento_descricao','$evento_data','$evento_hora_ini','$evento_hora_ter','$palest_id','$nome',0,'$lotacao')";

    // Se ocorrer tudo certo , vamos alocar o evento no local informado no formulario
    if ($conexao->query($sql) === true) {
      //Apos inserir o evento no banco , iremos pegar o seu id Selecionando o ultimo registro da tabela evento
      $sql = "SELECT max(id_evento) from evento";
      $result = mysqli_query($conexao, $sql);
      $row = mysqli_fetch_assoc($result);
      // Armazenando o ultimo registro
      $ultimoRegistro = $row['max(id_evento)'];
      // Alocando o evento criado na  sala selecionada
      $sql = "INSERT INTO alocados (sala_sala_id,evento_id_evento) values ('$local_id','$ultimoRegistro')";
      $conexao->query($sql);
      header('Location: /eventos.php');
    }
  }
}
//Fechando a conexao
$conexao->close();
?>
