<?php
include 'verifica_login.php';
include "DataBase/DB_Conexao.php";
$login = $_SESSION['usuario'];
if (strlen($login) < 6) {
    session_destroy();
    header('Location: logout.php');
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

    <title>Pagina Inicial</title>

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
<center>
                    <?php
                    if (isset($_SESSION['inscrito_evento'])) { ?>                
                    <center><div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Inscrição Realizada Com Sucesso!</h4>
                    <p>Em breve você receberá um email de confirmação!</p>
                    <a class="btn btn-primary" href="Participante.php">Voltar</a>
                    <hr>
                 </div>
                                    
                <?php }
                    unset($_SESSION['inscrito_evento']);
                    ?>
                
                <?php
                if (isset($_SESSION['senha_alterada'])) { ?>                
                    <center><div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Senha Alterada Com Sucesso!</h4>
                    <a class="btn btn-primary" href="logout.php">Fazer Login </a>
                    <hr>
                    <p class="mb-0">Agora Você precisa realizar login novamente , para validar a nova senha .</p>
                    </div>
                                    
                <?php }
                unset($_SESSION['senha_alterada']);
                ?>
                
                <?php
                if (isset($_SESSION['senha_nao_alterada'])) { ?>                
                    <center><div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Senha atual inválida!</h4>
                    <a class="btn btn-primary" href="Configuracao.php">Retornar</a>
                    <hr>
                    <p class="mb-0">Retorne e tente novamente !.</p>
                    </div>
                                    
                <?php }
                unset($_SESSION['senha_nao_alterada']);
                ?>

                <?php
                if (isset($_SESSION['participante_inscreveu'])) { ?>                
                    <center><div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Você ja se inscreveu neste evento!</h4>
                    <a class="btn btn-primary" href="Participante.php">Voltar</a>
                    <hr>
                    <p class="mb-0">Retorne e escolha outro .</p>
                    </div>
                                    
                <?php }
                unset($_SESSION['participante_inscreveu']);
                ?>
                 <?php
                 if (isset($_SESSION['inscricao_removida'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Inscrição Removida com sucesso!</h4>
                        <a class="btn btn-primary" href="MeusEventos.php">Voltar</a>

                        <hr>
                      </p>
                    </div>

                    <?php }
                 unset($_SESSION['inscricao_removida']);
                 ?>
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