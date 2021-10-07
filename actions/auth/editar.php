<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();

//impots
require_once('../../models/Usuarios.php');
require_once('../../models/Imagem.php');
require_once('../../models/Estados.php');
require_once('../../models/Enderecos.php');
require_once('../../models/Cidades.php');
require_once('../../models/Bairros.php');

//instancias
$usuariosModel = new Usuarios();
$imagemModel = new Imagem('../../views/auth/img/','',true,5);
$estadosModel = new Estados();
$cidadesModel = new Cidades();
$bairrosModel = new Bairros();
$enderecosModel = new Enderecos();

//Variaveis

$dados = [
    'nomeCompleto' => $_POST['nome'],
    'dataNascimento' => $_POST['dataNascimento'],
    'imagem' => $_POST['imagem'],
    'email' => $_POST['email'],
    'cpf' => $_POST['cpf']
];

$arrayEndereco = [
    'rua' => $_POST['rua'],
    'numero' =>  $_POST['numero'],
    'cep' =>  $_POST['cep'],
    'complemento' =>  $_POST['complemento']
];

$id = intval($_POST['id']);

//validações
/*$existeCPF = $usuariosModel->buscarPorCPF($_POST['cpf']);
if(count($existeCPF) > 0){
    $_SESSION['erro'] = 'CPF já cadastrado!';
    header('Location: http://localhost/challenge/views/auth/listar.php');
}
$existeEmail = $usuariosModel->buscarPorEmail($_POST['email']);
if(count($existeEmail) > 0){
    $_SESSION['erro'] = 'Email já cadastrado!';
    header('Location: http://localhost/challenge/views/auth/listar.php');
    
}
*/


$estado = $estadosModel->getEstado($_POST['estado']);

$cidade = $cidadesModel->getCidade($_POST['cidade'], $estado['id']);

//quando chega aqui a gente já tem o bairro cadastrado caso n tinha, e caso ja tivesse ja tinha pegado o id
$bairro = $bairrosModel->getBairro($_POST['bairro'], $cidade['id']);

$enderecosModel->update($arrayEndereco,$id);



$usuariosModel->update($dados,$id);
$_SESSION['success'] = 'Dados atualizados com sucesso!';
header('Location: http://localhost/challenge/views/auth/listar.php');



