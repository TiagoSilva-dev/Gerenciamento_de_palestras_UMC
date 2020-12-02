<?php
session_start();
include "DataBase/DB_Conexao.php";

ini_set('display_errors', 0);
error_reporting(0);

$idevento = $_GET['idevento'];

if (!empty($_GET['idevento'])) {
    $idevento = $_REQUEST['idevento'];
}

if (!empty($_POST)) {
    $palest_id = mysqli_real_escape_string($conexao, trim($_POST['palest_id']));
    $id = mysqli_real_escape_string($conexao, trim($_POST['id']));
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
            on sala.sala_id = alocados.sala_sala_id) as total_eventos_mesma_data where evento_data = '$evento_data' and evento_hora_ini ='$evento_hora_ini' and evento_hora_ter = '$evento_hora_ter' and sala_local = '$sala'";

        $resultInner = mysqli_query($conexao, $inner);

        $rowInner = mysqli_fetch_assoc($resultInner);

        if ($rowInner['total'] == 1) {
            $_SESSION['evento_com_mesmo_nome'] = true;
            header('Location: /status.php');
            exit();
        } else {
            //Enviando ao banco uma query para criar o evento
            $sql = "UPDATE evento SET evento_nome='$evento_nome',
                            evento_descricao='$evento_descricao',
                            evento_data='$evento_data',
                            evento_hora_ini='$evento_hora_ini',
                            evento_hora_ter='$evento_hora_ter',
                            palestrante_palest_id='$palest_id',
                            evento_palestrante='$nome',
                            evento_fechado= 0 ,
                            evento_capacidade = '$lotacao' where id_evento = '$id'";

            // Se ocorrer tudo certo , vamos alocar o evento no local informado no formulario
            if ($conexao->query($sql) === true) {
                // Alocando o evento criado na  sala selecionada
                $sql = "UPDATE  alocados SET sala_sala_id='$local_id',evento_id_evento='$idevento' WHERE sala_local = '$sala'";
                $conexao->query($sql);
                header('Location: /eventos.php');
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Altera Palestras</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="estilo.css" rel="stylesheet">
    <!--===============================================================================================-->
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="painel.php">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <?php echo '<div class="sidebar-brand-text mx-3"><span>' . $_SESSION['nome'] . '</span></div>'; ?>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="painel.php">
                    <i class="fas fa-home" style="font-size: 15px"></i>
                    <span style="font-size: 15px">Inicio</span></a>
            </li>


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="CadastrarCoordenador.php">
                    <i class="fas fa-user-tie" style="font-size: 15px"></i>
                    <span style="font-size: 15px">Cadastrar Coordenadores</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="CadastrarPalestrante.php">
                    <i class="fas fa-address-card" style="font-size: 15px"></i>
                    <span style="font-size: 15px">Cadastrar Palestrantes</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="eventos.php">
                    <i class="fas fa-calendar-alt" style="font-size: 15px"></i>
                    <span style="font-size: 15px">Gerenciar Eventos</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="certificado.php">
                    <i class="fas fa-award" style="font-size: 15px"></i>
                    <span style="font-size: 15px">Certificados</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="locais.php">
                    <i class="fas fa-fw fa-table" style="font-size: 15px"></i>
                    <span style="font-size: 15px">Locais</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="ConfiguracaoCord.php">
                <i class="fas fa-users-cog"style="font-size: 15px"></i>
                    <span style="font-size: 15px">Configuraçao</span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i style="font-size: 15px" class="fas fa-sign-out-alt"></i>
                    <span style="font-size: 15px">Sair</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                </nav>
                <!-- End of Topbar -->
                <div class="container-fluid">
                <!-- CONTEUDO AKI -->
                <div class="shadow p-3 mb-5 bg-white rounded">
                        <form action="AlterarPalestras.php" method="POST">
                            <div class="container-contact2">
                                <div class="wrap-contact2">
                                    <span class="contact2-form-title">
                                        Alterar Eventos
                                    </span>

                                    <!-- Modal extra grande -->
                                    <button class="btn btn-primary" data-toggle="modal"
                                        data-target=".bd-example-modal-xl">Selecionar Palestrante</button>

                                    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
                                        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <table class=" table-responsive-sm table-hover">
                                                    <tbody>
                                                        <tr>
                                                           
                                                            <th scope="col">Nome</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Area</th>
                                                            <th scope="col">Selecionar</th>
                                                        </tr>
                                                        <?php
                                                        $sql = "SELECT * from palestrante order by palest_nome";

                                                        $resultado = mysqli_query($conexao, $sql);

                                                        while ($registro = mysqli_fetch_array($resultado)) {
                                                            $nome = $registro['palest_nome'];
                                                            $email = $registro['palest_email'];
                                                            $area = $registro['palest_area_atuacao'];

                                                            echo "<td>" . $nome . "</td>";
                                                            echo "<td>" . $email . "</td>";
                                                            echo "<td>" . $area . "</td>";
                                                            echo '<td><div class="input-group-text"><input type="radio" name="palest_id" value=' . $registro['palest_id'] . '></td>';
                                                            echo "</tr>";
                                                        }
                                                        echo "</tbody>";
                                                        echo "</table>";

                                                        echo '<div class="modal-footer">';
                                                        echo '<button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">Salvar e Fechar</button>';
                                                        echo '</div>';
                                                        ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal grande -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target=".bd2-example-modal-xl">Selecionar Local</button>

                                    <div class="modal fade bd2-example-modal-xl" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <table class=" table-responsive-sm table-hover">
                                                    <tbody>
                                                        <tr>
                                                        
                                                            <th scope="col">Numero</th>
                                                            <th scope="col">Local</th>
                                                            <th scope="col">Capacidade</th>
                                                            <th scope="col">Selecionar</th>
                                                        </tr>
                                                        <?php
                                                        $sql = "SELECT * from sala order by sala_numero";

                                                        $resultado = mysqli_query($conexao, $sql);

                                                        while ($registro = mysqli_fetch_array($resultado)) {
                                                            echo "<td>" . $registro['sala_numero'] . "</td>";
                                                            echo "<td>" . $registro['sala_local'] . "</td>";
                                                            echo "<td>" . $registro['sala_capacidade'] . "</td>";
                                                            echo '<td><div class="input-group-text"><input type="radio" name="sala_id" value=' . $registro['sala_id'] . '></td>';
                                                            echo ' ';
                                                            echo '</td>';
                                                            echo "</tr>";
                                                        }
                                                        echo "</table>";

                                                        echo '<div class="modal-footer">';
                                                        echo '<button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">Salvar e Fechar</button>';
                                                        echo '</div>';
                                                        ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="wrap-input2 validate-input">
                                        <input class="input2" type="text" name="evento_nome" required>
                                        <span class="focus-input2" data-placeholder="nome evento"></span>
                                    </div>

                                    <div class="wrap-input2 validate-input">
                                        <?php echo '<input class="input2" type="date" name="evento_data" min=' . date("Y-m-d") . ' required>'; ?>
                                        <span class="focus-input2" data-placeholder="Data"></span>
                                    </div>

                                    <div class="wrap-input2 validate-input">
                                        <input class="input2" type="Time" name="evento_hora_ini" min="06:00" max="23:00"
                                            required>
                                        <span class="focus-input2" data-placeholder="Hora de inicio"></span>
                                    </div>

                                    <div class="wrap-input2 validate-input">
                                        <input class="input2" type="Time" name="evento_hora_ter" min="06:00" max="23:00"
                                            required>
                                        <span class="focus-input2" data-placeholder="Hora de Termino"></span>
                                    </div>

                                    <div class="wrap-input2 validate-input">
                                        <textarea class="input2" name="evento_descricao" required></textarea>
                                        <span class="focus-input2" data-placeholder="Descricao"></span>
                                    </div>

                                    <div class="">
                                       <?php echo ' <input  type="hidden" name="id" value=' .$idevento .'required>'; ?>
                                      
                                    </div>
                                    <div class="container-contact2-form-btn">
                                        <div class="wrap-contact2-form-btn">
                                            <div class="contact2-form-bgbtn"></div>
                                            <button class="btn btn-primary" type="submit"
                                                name="DB_Agendamento">Atualizar informaçoes
                                                </button>
                                            <a href="eventos.php" class="btn btn-secondary">Voltar</a>
                                        </div>
                                    </div>

                        </form>
                    </div>
                </div>

            </div>
            <!-- Fim do conteudo -->
        

    </div>



    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
</body>

</html>