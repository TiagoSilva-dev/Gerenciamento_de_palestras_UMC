<?php
session_start();
include "DataBase/DB_Conexao.php";

if (isset($_POST['ok'])) {
    $RGM = $_POST['rgm'];
    $email = $_POST['e-mail'];
    $sql = "SELECT * FROM coordenador WHERE coord_email = '$email' and coord_matricula = '$RGM'";
    $resultado = mysqli_query($conexao, $sql);
    $row = mysqli_num_rows($resultado);

    switch ($row) {
        case 0:
            $sql = "SELECT * FROM participante WHERE part_email = '$email' and part_rgm_matricula = '$RGM'"; // procurar o email na tabela participante
            $resultado = mysqli_query($conexao, $sql);
            $row = mysqli_num_rows($resultado); //se o $rowP for 0 e pq n tem email na tabela, se for 1 pq tem

            if ($row == 1) {
                $_SESSION['email_enviado'] = true;
                $novasenha = time();
                $senhacriptografada = md5($novasenha);

                $to = "$email"; // email de destino
                $subject = "NOVA SENHA"; //aqui vai o assunto
                $message = "SUA SENHA NOVA E: $novasenha";
                $header = "MIME-Version: 1.0\n";
                $header = "content-type: text/html; charset=iso-8859-1\n";
                $header = "From: tcctads@task.com.br \n"; //email que vai enviar'
                mail($to, $subject, $message, $header);
               

                /*  if(mail($email, "sua nova senha", "sua nova senha e :",$novasenha)){
                 */ $sql_code = "UPDATE participante SET part_senha= '$senhacriptografada' WHERE part_email = '$email' and part_rgm_matricula = '$RGM'";
                    $conexao->query($sql_code);
                    
            } elseif ($row == 0) {
                $_SESSION['email_nao_cadastrado'] = true;
            }
            break;

        case 1:
            $novasenha = time();
            $senhacriptografada = md5($novasenha);

            $to = "$email"; // email de destino
            $subject = "Redefinição de senha"; //aqui vai o assunto
            $message = "SUA SENHA NOVA E: $novasenha";
            $header = "MIME-Version: 1.0\n";
            $header = "content-type: text/html; charset=iso-8859-1\n";
            $header = "From: tcctads@task.com.br \n"; //email que vai enviar'
            mail($to, $subject, $message, $header);
            $_SESSION['email_enviado'] = true;

            echo "$novasenha";

            /* if(mail($email, "sua nova senha", "sua nova senha e :",$novasenha)){
             */ $sql_code = "UPDATE coordenador SET coord_senha= '$senhacriptografada' WHERE coord_email = '$email' and coord_matricula = '$RGM'";

            $conexao->query($sql_code);

            break;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recuperar Senha</title>
    <!--Import Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="imagens/favicon.ico" />
</head>

<body>
    <form action="recuperarsenha.php" method="POST">

        <div class="container-sm">
            <div class="form-group">
                <img src="imagens/logo.svg" id="logoumc"><br><br>

                <?php if (isset($_SESSION['email_nao_cadastrado'])) { ?>
                <div class="alert alert-danger" role="alert">
                    Email ou RGM nao cadastrado !! .
                </div>
                <?php unset($_SESSION['email_nao_cadastrado']);} ?>

                <?php if (isset($_SESSION['email_enviado'])) { ?>
                <div class="alert alert-success" role="alert">
                    Uma nova senha foi enviada para o seu e-mail!! .
                </div>
                <?php unset($_SESSION['email_enviado']);} ?>


                <label for="">Email:</label>
                <input type="email" name="e-mail" placeholder="Seu email" required autofocus>
                <br>
                <br><label for="">RGM:</label>
                <input type="text" name="rgm" placeholder="Seu RGM" required autofocus inlength="6" maxlength="12">
                <br>
                <hr>
                <input type="submit" name="ok" class="btn btn-warning" value="Recuperar">
                <a href="index.php" class="btn btn-secondary">Voltar</a>

            </div>
        </div>

    </form>
</body>

</html>
