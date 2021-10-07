<?php

//exibir os erros
ini_set('display_errors', true);
error_reporting(E_ALL);
//inicia sessão da página
session_start();

//Importes

require_once('../../../models/Admin.php');


//Instancias
$adminsModel = new Admin();

//validações


//Lóogica
$existeEmail = $adminsModel->buscarPorEmail($_POST['email']);
//vai contar os elementos do array
if(count($existeEmail) > 0){
    $_SESSION['erro'] = 'Email já cadastrado!';
    header('Location: http://localhost/challenge/views/auth/cadastrar.php');
    
}

$arrayAdmin = [
    'nome' => htmlspecialchars($_POST['nome']),
    'email' => htmlspecialchars($_POST['email']),
    'senha' => base64_encode($_POST['senha'])
];

$adminsModel->cadastrarAdmins($arrayAdmin);
$_SESSION['success'] = 'Admin cadastrado com sucesso!';
header('Location: http://localhost/challenge/views/auth/login.php');
