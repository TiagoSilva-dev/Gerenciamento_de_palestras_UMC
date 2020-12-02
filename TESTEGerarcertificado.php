<?php
include 'verifica_login.php';
include "DataBase/DB_Conexao.php";

$idevento = $_GET['idevento'];
$_SESSION['retorno_evento'] = $idevento;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Enviar Certificados</title>

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

    <style>
    div#check{
        margin-left: 960px ;
    }
    </style>
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


                    <center>
                        <h1>LISTA DE PARTICIPANTE</h1>
    <form class="form-horizontal" action="gerar_certificado/gerador.php" method="GET"  id="contact_form">
    <div class="shadow p-3 mb-5 bg-white rounded">
                    <div class="table-responsive">
                        <table class="table table-sm">
                          <thead class="thead-dark">
                            <tr>
                                <th scope="col">RGM</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">nome do evento</th>
                                <th scope="col">Data</th>
                                <th scope="col">Status</th>
                                <th scope="col">Certificados</th>
                            </tr>
                           </thead>
<?php
/* adapatar isso para puxar os participantes do evento*/

$sql = "SELECT id_evento,inscritos_presenca,part_rgm_matricula, part_nome, part_email, evento_nome,date_format(`evento_data`,'%d/%m/%Y') as `evento_data` ,hour(evento_hora_ter - evento_hora_ini) 
        FROM inscritos
        INNER JOIN participante ON participante.part_rgm_matricula = inscritos.participante_part_rgm_matricula
        INNER JOIN evento ON evento.id_evento = inscritos.evento_id_evento where evento.id_evento ='$idevento'";
$resultado = mysqli_query($conexao, $sql);

while ($registro = mysqli_fetch_array($resultado)) {
    $registro['hour(evento_hora_ter - evento_hora_ini)'];
    echo '<td>' . $registro['part_rgm_matricula'] . '</td>';
    echo "<td>" . $registro['part_nome'] . "</td>";
    echo "<td>" . $registro['part_email'] . "</td>";
    echo "<td>" . $registro['evento_nome'] . "</td>";
    echo "<td>" . $registro['evento_data'] . "</td>";
    if ($registro['inscritos_presenca'] == 0) {
        echo '<td><span style="color: red;">Nao Enviado</td>';
    } else {
        echo '<td><span style="color: green;">Enviado</td>';
    }
    echo '<td width=200>';
    echo '<a class="btn btn-success" href="GerarCertificado/gerar_certificado/gerador.php?dados=' .
        $registro['part_rgm_matricula'] .
        '|' .
        $registro['part_nome'] .
        '|' .
        $registro['part_email'] .
        '|' .
        $registro['evento_nome'] .
        '|' .
        $registro['evento_data'] .
        '|' .
        $registro['hour(evento_hora_ter - evento_hora_ini)'] .
        '|' .
        $registro['id_evento'] .
        '"><span>Enviar Certificado</span></a>';
    echo ' ';
    echo '</td>';
    echo "</tr>";
}
echo "</table>";
echo "</form>";
?>

            <form action="DataBase/DB_FecharEvento.php" method="POST"> 
            <?php echo '<button  type="submit" name= "fechado" value=' . $idevento . ' class="btn btn-primary" >Concluir Evento</button>'; ?>
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