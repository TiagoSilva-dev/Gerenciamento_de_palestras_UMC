<?php
session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Pagina Inicial</title>
        <!--Import Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <link rel="stylesheet" href="css/login.css" />
        <link rel="shortcut icon" href="imagens/favicon.ico" />
    </head>

    <body>
        <form action="DataBase/DB_Login.php" method="POST">
            <center>
                <div class="container-sm">
                    <div class="form-group">
                        <img src="imagens/logo.svg" id="logoumc" /><br />
                        <br />
                        <?php if (isset($_SESSION['nao_autenticado'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            Usuario ou Senha incorreto !! .
                        </div>
                        <?php unset($_SESSION['nao_autenticado']);} ?>
                        
                        <input class="form-control" name="part_rgm_matricula" type="text" placeholder="RGM ou Matrícula" required autofocus minlength="6" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="part_senha" type="password" placeholder="Senha" required />
                        <a class="btn btn-primary" href="CadastrarUsuario.php" style='color:white' >Cadastrar</a>
                    </div>
                    <button type="submit" class="btn btn-success" name="enviar">Entrar</button>
                    <hr />
                    <div>
                        <a class="btn btn-danger" style='color:white' href="recuperarsenha.php">esqueci a senha</a>
                    </div>
                </div>
            </center>
        </form>
    </body>
</html>
