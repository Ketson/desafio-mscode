<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();



//imports
require_once('../../models/Admin.php');

//instancias
$adminsModel = new Admin();


//inputs
$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST,'senha',FILTER_SANITIZE_NUMBER_INT);

$existeAdmin = $adminsModel->buscarPorEmail($_POST['email']);
if(count($existeAdmin) <= 0){
    $_SESSION['erro'] = 'Usuário ou senha inválidos';
    header('Location: http://localhost/challenge/views/auth/login.php');
}

if($_POST['senha'] != base64_decode($existeAdmin[0]['senha'])){
    $_SESSION['erro'] = 'Usuário ou senha inválidos';
    header('Location: http://localhost/challenge/views/auth/login.php');
}else{
    $_SESSION['autentificado'] = true;
    header('Location: http://localhost/challenge/views/auth/listar.php');

}




/*$verificarAdmin = $adminsModel->buscarAdmin($_POST['email'],$_POST['senha']);

if(count($verificarAdmin) <= 0){
    $_SESSION['erro'] = 'Usuário ou senha inválidos';
    header('Location: http://localhost/challenge/views/auth/login.php');
}else{
    $_SESSION['autentificado'] = true;
    header('Location: http://localhost/challenge/views/auth/listar.php');
}
*/






