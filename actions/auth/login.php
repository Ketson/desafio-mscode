<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();

//imports
require_once('../../models/Usuarios.php');

//instancias
$usuariosModel = new Usuarios();


//inputs
$email = $_POST['email'];
$senha = $_POST['senha'];

//lógica
if($email == 'admin@admin.com' AND $senha == '123456'){
    $_SESSION['autentificado'] = true;
    header('Location: http://localhost/challenge/views/auth/listar.php');
}

$_SESSION['erro'] = 'Usuário ou senha inválidos';
header('Location: http://localhost/challenge/views/auth/login.php');