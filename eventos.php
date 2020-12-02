<?php
include 'verifica_login.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gerenciar Eventos</title>

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
    
    <!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    
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
                    <i class="fas fa-users-cog" style="font-size: 15px"></i>
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

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- CONTEUDO AKI -->


                    <center>
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <h1 class="display-4">LISTA DE EVENTOS </h1><hr>
                        </div>

                        <a class="btn btn-success" href="Agendamento.php"><i class="fas fa-plus"><span> Cadastrar</span></i></a></br><hr>
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">N° inscritos</th>
                                            <th scope="col">Palestrante</th>
                                            <th scope="col">Nome do evento</th>
                                            <th scope="col">Data</th>
                                            <th scope="col">Horário </th>
                                            <th scope="col">Ações</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    include "DataBase/DB_Conexao.php";

                                    $sql =
                                        "SELECT * ,date_format(`evento_data`,'%d/%m/%Y') as 'data_formatada',date_format(`evento_hora_ini`,'%H:%i')as'evento_hora_ini',date_format(`evento_hora_ter`,'%H:%i')as'evento_hora_ter' from evento order by id_evento";

                                    $resultado = mysqli_query($conexao, $sql);

                                    while ($registro = mysqli_fetch_array($resultado)) {
                                        echo '<td>' . $registro['id_evento'] . '</td>';
                                        $inner = "SELECT count(part_rgm_matricula)
            FROM inscritos
            INNER JOIN participante ON participante.part_rgm_matricula = inscritos.participante_part_rgm_matricula
            INNER JOIN evento ON evento.id_evento = inscritos.evento_id_evento where evento.id_evento = {$registro['id_evento']}";
                                        $result = mysqli_query($conexao, $inner);
                                        while ($newreg = mysqli_fetch_array($result)) {
                                            echo '<td><span style="color: red;">' . $newreg['count(part_rgm_matricula)'] . '</td>';

                                            echo "<td>" . $registro['evento_palestrante'] . "</td>";
                                            echo "<td>" . $registro['evento_nome'] . "</td>";
                                            echo "<td>" . $registro['data_formatada'] . "</td>";
                                            echo "<td>" . $registro['evento_hora_ini'] . " AS " . $registro['evento_hora_ter'] . "</td>";
                                            echo '<td width=200>';
                                            echo '<a title="Alterar" href="AlterarPalestras.php?idevento=' . $registro['id_evento'] . '"><span style="color: blue;"><i class="fas fa-edit" style="font-size:20px"></i></a>';
                                            echo ' | ';
                                            echo '<a title="Excluir" href="ExcluirAgendamento.php?idevento=' . $registro['id_evento'] . '"><span style="color: red;"><i class="fas fa-trash-alt" style=" font-size: 20px"></i></a>';
                                            echo ' ';
                                            echo '<a title="Gerar Lista de Participantes"class="btn btn-success" href="gerar_planilha.php?idevento=' . $registro['id_evento'] . '"><span>Participantes</span></a>';
                                            echo '</td>';
                                            echo "</tr>";
                                        }
                                    }
                                    echo "</table>";
                                    ?>
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