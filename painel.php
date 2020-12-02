<?php
include 'verifica_login.php';
include "DataBase/DB_Conexao.php";
$login = $_SESSION['usuario'];
if (strlen($login) > 6) {
    session_destroy();
    header('Location: index.php');
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

    <title>Painel</title>

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

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- CONTEUDO AKI -->
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <h1>SISTEMA WEB PARA GERENCIAMENTO DE EVENTOS</h1>
                        <h3>Desenvolvido por Tiago , Gabriel , Sergio & Rodney </h3>
                        
                        <hr>
                    </div>
                    <div class="shadow p-3 mb-5 bg-white rounded">
                    <div class="card-deck">
                        <div class="card bg-light mb-3" style="max-width: 13rem;">
                            <img class="card-img-top" src="imagens/coordenador.png" alt="Imagem de capa do card">
                            <div class="card-body">
                                <h5 class="card-title">Cadastrar Coordenadores</h5><hr>
                                <a class="btn btn-primary" href="CadastrarCoordenador.php"><span>Visitar</span></a>
                            </div>

                        </div>
                        <div class="card bg-light mb-3" style="max-width: 13rem;">
                            <img class="card-img-top" src="imagens/gerpalestrante.png" alt="Imagem de capa do card">
                            <div class="card-body">
                                <h5 class="card-title">Gerenciar Palestrantes</h5><hr>
                                <a class="btn btn-primary" href="GerenciarPalestrante.php"><span>Visitar</span></a>
                            </div>

                        </div>
                        <div class="card bg-light mb-3" style="max-width: 13rem;">
                            <img class="card-img-top" src="imagens/eventos.png"
                                alt="Imagem de capa do card">
                            <div class="card-body">
                                <h5 class="card-title">Gerenciar Eventos</h5><hr>
                                <a class="btn btn-primary" href="eventos.php"><span>Visitar</span></a>
                            </div>
                        </div>
                        <div class="card bg-light mb-3" style="max-width: 13rem;">
                            <img class="card-img-top" src="imagens/locais.png" alt="Imagem de capa do card">
                            <div class="card-body">
                                <h5 class="card-title">Eventos Alocados</h5><hr>
                                <a class="btn btn-primary" href="dbAlocarEventos.php"><span>Visitar</span></a>
                            </div>
                        </div>
                        <div class="card bg-light mb-3" style="max-width: 13rem;">
                            <img class="card-img-top" src="imagens/certificado.png" alt="Imagem de capa do card">
                            <div class="card-body">
                                <h5 class="card-title">Emitir Certificados</h5><hr>
                                <a class="btn btn-primary" href="certificado.php"><span>Visitar</span></a>
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