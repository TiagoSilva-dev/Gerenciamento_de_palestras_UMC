<?php
include 'verifica_login.php';
include "DataBase/DB_Conexao.php";
$user = $_SESSION['usuario'];
if (!empty($_GET['idevento'])) {
    $idevento = $_REQUEST['idevento'];
}
if (!empty($_POST)) {
    $idevento = $_POST['id_evento'];

    $sql = "DELETE FROM inscritos where evento_id_evento = '$idevento' and participante_part_rgm_matricula= '$user'";
    $conexao->query($sql);
    $_SESSION['inscricao_removida'] = true;
    header('Location: PartStatus.php');
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

    <title>Excluir Inscricao</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="estilo.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Participante.php">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <?php echo '<div class="sidebar-brand-text mx-3"><span>' . $_SESSION['nome'] . '</span></div>'; ?>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="Participante.php">
                    <i class="fas fa-home" style="font-size: 15px"></i>
                    <span style="font-size: 15px">Inicio</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="MeusEventos.php">
                    <i class="fas fa-award" style="font-size: 15px"></i>
                    <span style="font-size: 15px">Meus Eventos</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="Configuracao.php">
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

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- CONTEUDO AKI -->
                    <div class="shadow p-3 mb-5 bg-white rounded"><center>
                    <div class="container">
                        <div class="span10 offset1">
                            <div class="">
                                <h3 class="well">Remover Inscrição</h3>
                            </div>
                            <form class="form-horizontal" action="ExcluirInscricao.php" method="post">
                                <?php echo '<input type="hidden" name="id_evento" value=' . $idevento . '"/>'; ?>
                                <div class="alert alert-danger"> Deseja Remover sua Inscrição ?
                                </div>
                                <div class="form actions">
                                    <button type="submit" class="btn btn-danger">Sim</button>
                                    <a href="MeusEventos.php" class="btn btn-secondary"><span>Não</span></a>
                                </div>
                            </form>
                        </div>
                    </div>
               

</div>
                    </div>



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