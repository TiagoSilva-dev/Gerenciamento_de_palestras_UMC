<?php
define('HOST', '127.0.0.1:3308');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'umc');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');

