<?php
session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Cadastrar Usuários </title>
        <link rel="stylesheet" href="css/login.css" />
        <link rel="shortcut icon" href="imagens/favicon.ico" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js"></script>
        <link rel="stylesheet" href="../dist/css/bootstrapValidator.css" />
        
    </head>

    <body>
        <form action="DataBase/DB_CadastrarUsuario.php" method="POST" id="contact_form">
            <center>
                <div class="container-sm">
                    <div class="form-group">
                        <img src="imagens/logo.svg" id="logoumc" /><br />
                        <br />
                        <?php
                        if (isset($_SESSION['usuario_existe'])) { ?>
                        <div class="alert alert-danger" role="alert">
                             Usuário Já Cadastrado , Tente Outro !!
                        </div>
                        <?php unset($_SESSION['usuario_existe']);}

                        if (isset($_SESSION['cpf'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            O CPF Digitado,não é um CPF Valido !!
                        </div>
                        <?php unset($_SESSION['cpf']);} elseif (isset($_SESSION['status_cadastro'])) { ?>
                        <div class="alert alert-success" role="alert">
                            Usuário Cadastrado Com Sucesso !!
                        </div>
                        <?php unset($_SESSION['status_cadastro']);}
                        ?>
                        <input class="form-control" type="text" name="part_rgm_matricula" placeholder="RGM" required autocomplete="off" minlength="11" maxlength="11" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="part_senha" placeholder="Senha" required maxlength="8" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="part_nome" placeholder="Nome Completo" required autocomplete="off" minlength="5" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="part_email" placeholder="E-mail" required autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <input class="form-control cpf-mask" type="text" name="part_cpf" placeholder="CPF" maxlength="14" autocomplete="off" required onkeypress="formatar('###.###.###-##', this);" />
                    </div>

                    <div class="form-group">
                        <button class="btn btn-info" type="submit" name="DB_CadastrarUsuario">Cadastrar</button>
                        <a class="btn btn-danger" href="index.php" id="voltar"><span>Voltar</span></a><br/>
                        
                    </div>
                </div>
            </center>
        </form>

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
    </body>
</html>
