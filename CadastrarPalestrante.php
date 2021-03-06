<?php
include('verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cadastrar Palestrante</title>

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
                <?php echo '<div class="sidebar-brand-text mx-3"><span>'.$_SESSION['nome'].'</span></div>'; ?>
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
                        <form action="DataBase/DB_CadastrarPalestrante.php" method="POST">
                            <div class="container-contact2">
                                <div class="wrap-contact2">
                                    <form class="contact2-form validate-form">
                                        <span class="contact2-form-title">
                                            <h1 class="display-4">Cadastrar Palestrantes</h1>
                                        </span>

                                        <div class="wrap-input2 validate-input">
                                            <input class="input2" type="text" name="palest_nome" required>
                                            <span class="focus-input2" data-placeholder="Nome Palestrante"></span>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01" required>Area
                                                    de
                                                    Atuaçao</label>
                                            </div>
                                            <select class="custom-select" id="inputGroupSelect01"
                                                name="palest_area_atuacao">
                                                <option selected value="Administração, negócios e serviços">Administração,
                                                    negócios e serviços</option>
                                                <option value="Artes e Design">Artes e Design</option>
                                                <option value="Ciências Biológicas e da Terra">Ciências Biológicas e da
                                                    Terra</option>
                                                <option value="Analise e Desenvolvimento de Sistemas">Analise e
                                                    Desenvolvimento de Sistemas</option>
                                                <option value="Ciências Sociais e Humanas">Ciências Sociais e Humanas
                                                </option>
                                                <option value="Saúde e Bem-estar">Saúde e Bem-estar</option>
                                            </select>
                                        </div>

                                        <div class="wrap-input2 validate-input">
                                            <input class="input2" type="email" name="palest_email" required>
                                            <span class="focus-input2" data-placeholder="Email Palestrante"></span>
                                        </div>

                                        <?php
                                            if(isset($_SESSION['cpf'])){
                                        ?>
                                            <div class="alert alert-danger" role="alert">
                                                CPF invalido !!
                                            </div>
                                        <?php
                                            unset($_SESSION['cpf']);
                                            }   
                                        ?>
                                        <div class="wrap-input2 validate-input">
                                            <input class="input2" type="text" name="palest_cpf" minlength="14"
                                                maxlength="14" required onkeypress="formatar('###.###.###-##', this);">
                                            <span class="focus-input2" data-placeholder="CPF Palestrante"></span>
                                        </div>

                                        <div class="wrap-input2 validate-input">
                                            <input class="input2" type="text" name="palest_celular" minlength="13"
                                                maxlength="13" required onkeypress="formatar('##-#####-####', this);">
                                            <span class="focus-input2"
                                                data-placeholder="Entre com o numero de celular"></span>
                                        </div>

                                        <div class="wrap-input2 validate-input">
                                            <textarea class="input2" name="palest_sobre" required></textarea>
                                            <span class="focus-input2" data-placeholder="Sobre"></span>
                                        </div>
                                        <div class="container-contact2-form-btn">
                                            <div class="wrap-contact2-form-btn">
                                                <div class="contact2-form-bgbtn"></div>
                                                <button class="btn btn-primary" type="submit"
                                                    name="DB_CadastrarPalestrante.php">Cadastrar</button>
                                                <a href="painel.php" class="btn btn-secondary"><span>Voltar</span></a>
                                            </div>
                                        </div>
                                    </form>
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

    <!-- ****** Simples função de colocar mascara em javascript ****** -->
    <script>
    function formatar(mascara, documento) {
        var i = documento.value.length;
        var saida = mascara.substring(0, 1);
        var texto = mascara.substring(i);
        if (texto.substring(0, 1) != saida) {
            documento.value += texto.substring(0, 1);
        }
    }
    </script>
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