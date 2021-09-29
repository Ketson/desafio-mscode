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

//Variaveis

$dados = [
    'nomeCompleto' => $_POST['nome'],
    'dataNascimento' => $_POST['dataNascimento'],
    'imagem' => $_POST['foto'],
    'email' => $_POST['email'],
    'cpf' => $_POST['cpf']
];

$arrayEndereco = [
    'rua' => $_POST['rua'],
    'numero' =>  $_POST['numero'],
    'cep' =>  $_POST['cep'],
    'complemento' =>  $_POST['complemento']
];

$id = $_POST['id'];

//validações
$existeEmail = $usuariosModel->buscarPorEmail($_POST['email']);
if(count($existeEmail) > 0){
    $_SESSION['erro'] = 'Email já cadastrado!';
    header('Location: http://localhost/challenge/views/auth/listar.php');
    
}

$existeCPF = $usuariosModel->buscarPorCPF($_POST['cpf']);
if(count($existeCPF) > 0){
    $_SESSION['erro'] = 'CPF já cadastrado!';
    header('Location: http://localhost/challenge/views/auth/listar.php');
}

$estado = $estadosModel->getEstado($_POST['estado']);

$cidade = $cidadesModel->getCidade($_POST['cidade'], $estado['id']);

//quando chega aqui a gente já tem o bairro cadastrado caso n tinha, e caso ja tivesse ja tinha pegado o id
$bairro = $bairrosModel->getBairro($_POST['bairro'], $cidade['id']);

$enderecosModel->update($arrayEndereco,$id);

$usuariosModel->update($dados,$id);


