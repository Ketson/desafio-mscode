<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();

require_once('../../models/Usuarios.php');
require_once('../../models/Estados.php');
require_once('../../models/Enderecos.php');
require_once('../../models/Cidades.php');
require_once('../../models/Bairros.php');

$usuariosModel = new Usuarios();
$estadosModel = new Estados();
$cidadesModel = new Cidades();
$bairrosModel = new Bairros();
$enderecosModel = new Enderecos();

$estado = $estadosModel->getEstado($_POST['estado']);

$cidade = $cidadesModel->getCidade($_POST['cidade'], $estado['id']);

$bairro = $bairrosModel->getBairro($_POST['bairro'], $cidade['id']);

$arrayEndereco = [
    'rua' => $_POST['rua'],
    'numero' =>  $_POST['numero'],
    'cep' =>  $_POST['cep'],
    'complemento' =>  $_POST['complemento'],
    'bairros_id' => $bairro['id']
    
];
$enderecosModel->cadastrarEnderecos($arrayEndereco);
$endereco = $enderecosModel->buscarPorCompleto($arrayEndereco['rua'],$arrayEndereco['numero'],$arrayEndereco['cep'],$arrayEndereco['complemento'],$bairro['id']);

$arrayUsuario = [
    'nomeCompleto' => $_POST['nome'],
    'dataNascimento' => $_POST['dataNascimento'],
    'imagem' => $_POST['foto'],
    'email' => $_POST['email'],
    'cpf' => $_POST['cpf'],
    'endereco_id' => $endereco['id']
];

