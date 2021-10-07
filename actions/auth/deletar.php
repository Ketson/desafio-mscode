<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();

//imports
require_once('../../models/Usuarios.php');
require_once('../../models/Enderecos.php');
require_once('../../helpers/middleware.php');

//instancias
$usuariosModel = new Usuarios();
$enderecosModel = new Enderecos();

//validações

//logica
//antes de deletar o usuario precisa buscar o usuario no banco de dados
//e deletar o usuario para depois deletar o endereço, mas antes de deletar, vai registar o id em uma variaevel
$usuario = $usuariosModel->buscarPorId($_GET['id']);
$usuariosModel->deletarUsuarioPorId($_GET['id']);
$enderecosModel->deletarEnderecoPorId($usuario['enderecos_id']);



header('Location: http://localhost/challenge/views/auth/listar.php');