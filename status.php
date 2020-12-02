<?php
include 'verifica_login.php';
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

    <title>Atualizaçoes de STATUS</title>

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
                        <center>
                            <?php
                            if (isset($_SESSION['local_criado'])) { ?>
                            <div class="shadow p-3 mb-5 bg-white rounded">
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Local criado com sucesso!</h4>
                                    <a class="btn btn-primary" href="locais.php"><span>Voltar</span></a>
                                    <hr>
                                </div>
                            </div>

                            <?php }
                            unset($_SESSION['local_criado']);

                            if (isset($_SESSION['local_existe'])) { ?>
                            <div class="shadow p-3 mb-5 bg-white rounded">
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Já existe um local com este nome ou com o mesmo numero !
                                    </h4>
                                    <hr>
                                </div>
                            </div>

                            <?php }
                            unset($_SESSION['local_existe']);
                            ?>
                            <?php
                            if (isset($_SESSION['coord_sucesso'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Coordenador cadastrado com sucesso!</h4>
                                <a class="btn btn-primary" href="CadastrarCoordenador.php"><span>Voltar</span></a>
                                <a class="btn btn-secondary" href="painel.php"><span>Inicio</span></a>
                                <hr>
                                </p>
                            </div>

                            <?php }
                            unset($_SESSION['coord_sucesso']);
                            ?>

                            <?php
                            if (isset($_SESSION['coord_nao_criado'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Já existe um coordenador cadastrado com este e-mail ou
                                    matricula!</h4>
                                <a class="btn btn-primary" href="CadastrarCoordenador.php"><span>Voltar</span></a>
                                <a class="btn btn-secondary" href="painel.php"><span>Inicio</span></a>
                                <hr>
                            </div>

                            <?php }
                            unset($_SESSION['coord_nao_criado']);
                            ?>

                            <?php
                            if (isset($_SESSION['palestrante_cadastro'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Palestrante cadastrado com sucesso!</h4>
                                <a class="btn btn-primary" href="CadastrarPalestrante.php"><span>Voltar</span></a>
                                <a class="btn btn-secondary" href="painel.php"><span>Inicio</span></a>
                                <hr>
                            </div>

                            <?php }
                            unset($_SESSION['palestrante_cadastro']);
                            ?>
                            <?php
                            if (isset($_SESSION['inscrito_evento'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Inscrição realizada com sucesso!</h4>
                                <a class="btn btn-primary" href="Participante.php"><span>Voltar</span></a>
                                <hr>
                            </div>

                            <?php }
                            unset($_SESSION['inscrito_evento']);
                            ?>
                            <?php
                            if (isset($_SESSION['cord_senha_alterada'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Senha Alterada Com Sucesso!</h4>
                                <a class="btn btn-primary" href="logout.php"><span>Fazer Login<span></a>
                                <hr>
                                <p class="mb-0">Agora você precisa realizar login novamente , para validar a nova senha
                                    .</p>
                            </div>

                            <?php }
                            unset($_SESSION['cord_senha_alterada']);
                            ?>

                            <?php
                            if (isset($_SESSION['cord_senha_nao_alterada'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">A senha atual não confere com a senha no banco de dados!</h4>
                                <a class="btn btn-primary" href="ConfiguracaoCord.php"><span>Retornar</span></a>
                                <hr>
                            </div>

                            <?php }
                            unset($_SESSION['cord_senha_nao_alterada']);
                            ?>

                            <?php
                            if (isset($_SESSION['email_enviado'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Certificado enviado Por E-Mail Com Sucesso!</h4>
                                <a class="btn btn-primary" href="TESTEGerarcertificado.php">Retornar</a>
                                <hr>

                            </div>

                            <?php }
                            unset($_SESSION['email_enviado']);
                            ?>

                            <?php
                            if (isset($_SESSION['evento_com_mesmo_nome'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Nao é possivel alocar um evento no mesmo dia , hora e local !
                                </h4>
                                <a class="btn btn-primary" href="eventos.php">Retornar</a>
                                <hr>

                            </div>

                            <?php }
                            unset($_SESSION['evento_com_mesmo_nome']);
                            ?>

                            <?php
                            if (isset($_SESSION['evento_criado'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Evento Criado com Sucesso!</h4>
                                <p>em breve o palestrante , recebera um email com os dados do evento
                                <p>
                                    <a class="btn btn-primary" href="eventos.php">Retornar</a>
                                    <hr>

                            </div>

                            <?php }
                            unset($_SESSION['evento_criado']);
                            ?>
                            <?php
                            if (isset($_SESSION['evento_ja_passou'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Nao e possivel DELETAR um evento que ja ocorreu!</h4>
                                <a class="btn btn-primary" href="eventos.php">Retornar</a>
                                <hr>

                            </div>

                            <?php }
                            unset($_SESSION['evento_ja_passou']);
                            ?>
                            <?php
                            if (isset($_SESSION['palestrante_alterado'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Dados do palestrante alterado com Sucesso!</h4>
                                <a class="btn btn-primary" href="GerenciarPalestrante.php"></span>Retornar</span></a>
                                <hr>

                            </div>

                            <?php }
                            unset($_SESSION['palestrante_alterado']);
                            ?>

                            <?php
                            if (isset($_SESSION['palestrante_existe'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">já existe um palestrante cadastrado com este email ou cpf!</h4>
                                <a class="btn btn-primary" href="CadastrarPalestrante.php"></span>Retornar</span></a>
                                <hr>

                            </div>

                            <?php }
                            unset($_SESSION['palestrante_existe']);
                            ?>
                            <?php if (isset($_SESSION['erro_ao_deletar_palestrante'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                Nao e possivel excluir um palestrante que esteja associado a um evento!! .
                                <br><a class="btn btn-primary" href="GerenciarPalestrante.php">Retornar</a>
                            </div>
                            <?php unset($_SESSION['erro_ao_deletar_palestrante']);} ?>

                            <?php if (isset($_SESSION['hora_ter_menor_ini'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                Nao e possivel criar ou alterar um evento com a hora de termino maior que a hora de
                                inicio!! .
                            </div>
                            <?php unset($_SESSION['hora_ter_menor_ini']);} ?>

                        </center>
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