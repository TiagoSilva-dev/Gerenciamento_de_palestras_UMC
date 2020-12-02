<?php
session_start();
include "DataBase/DB_Conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agendamento</title>

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
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <form action="DataBase/DB_Agendamento.php" method="POST" id="palestrante">
                            <div class="container-contact2">
                                <div class="wrap-contact2">
                                    <span class="contact2-form-title">
                                        Cadastrar Eventos
                                    </span>

                                    <!-- Modal extra grande -->
                                    <button class="btn btn-primary" data-toggle="modal"
                                        data-target=".bd-example-modal-xl">Selecionar Palestrante</button>

                            <?php 
                                    echo'<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">';
                                        echo '<div class="modal-dialog modal-xl">';
                                           echo'<div class="modal-content">';
                                                echo'<table class=" table-responsive-sm table-hover">';
                                                    echo '<tbody>';
                                                        echo '<tr>';
                                                            echo '<th scope="col">Nome</th>';
                                                            echo '<th scope="col">Email</th>';
                                                            echo '<th scope="col">Area</th>';
                                                            echo '<th scope="col">Selecionar</th>';
                                                        echo '</tr>';
                                                    
                                                        $sql = "SELECT * from palestrante order by palest_nome";

                                                        $resultado = mysqli_query($conexao, $sql);

                                                        while ($registro = mysqli_fetch_array($resultado)) {
                                                            $id = $registro['palest_id'];
                                                            $nome = $registro['palest_nome'];
                                                            $email = $registro['palest_email'];
                                                            $area = $registro['palest_area_atuacao'];

                                                            
                                                            echo '<td>' . $nome . '</td>';
                                                            echo '<td>' . $email . '</td>';
                                                            echo "<td>" . $area . "</td>";
                                                            echo '<td><div class="input-group-text"><input type="radio"  required name="palest_id" value=' . $id . '></div></td>';
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
                                        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <table class=" table-responsive-md table-hover">
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
                                                            echo '<td><div class="input-group-text"><input type="radio" required name="sala_id" value=' . $registro['sala_id'] . '></td>';
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

                                    <div class="container-contact2-form-btn">
                                        <div class="wrap-contact2-form-btn">
                                            <div class="contact2-form-bgbtn"></div>
                                            <button class="btn btn-primary" type="submit"
                                                name="DB_Agendamento">Cadastrar
                                                Evento</button>
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