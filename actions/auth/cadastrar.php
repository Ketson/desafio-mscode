<?php

//exibir os erros
ini_set('display_errors', true);
error_reporting(E_ALL);
//inicia sessão da página
session_start();

//importes
require_once('../../models/Usuarios.php');
require_once('../../models/Imagem.php');
require_once('../../models/Estados.php');
require_once('../../models/Enderecos.php');
require_once('../../models/Cidades.php');
require_once('../../models/Bairros.php');

//instâncias das classes
$usuariosModel = new Usuarios();
$imagemModel = new Imagem('../../views/auth/img/','',true,5);
$estadosModel = new Estados();
$cidadesModel = new Cidades();
$bairrosModel = new Bairros();
$enderecosModel = new Enderecos();

//setar a foto
$foto = $usuariosModel->verificaFoto($_FILES['imagem']['name'], $_FILES['imagem']['size'],);

//Validações
    
//Caso o email já esteja cadastrado no banco de dados
$existeEmail = $usuariosModel->buscarPorEmail($_POST['email']);
//vai contar os elementos do array
if(count($existeEmail) > 0){
    $_SESSION['erro'] = 'Email já cadastrado!';
    header('Location: http://localhost/challenge/views/auth/cadastrar.php');
}

//Caso o CPF já esteja cadastrado no banco de dados
$existeCPF = $usuariosModel->buscarPorCPF($_POST['cpf']);
if(count($existeCPF) > 0){
    $_SESSION['erro'] = 'CPF já cadastrado!';
    header('Location: http://localhost/challenge/views/auth/cadastrar.php');
}

/*antes de chegar em endereço, resolvemos estado, cidade, bairro */
$estado = $estadosModel->getEstado($_POST['estado']);

$cidade = $cidadesModel->getCidade($_POST['cidade'], $estado['id']);

//quando chega aqui já tem o bairro cadastrado caso não tinha, e caso ja tivesse ja tinha pegado o id
$bairro = $bairrosModel->getBairro($_POST['bairro'], $cidade['id']);

//array que vai conter os dados de endereço do inscrito
$arrayEndereco = [
    'rua' => htmlspecialchars($_POST['rua']),
    'numero' =>  htmlspecialchars($_POST['numero']),
    'cep' =>  htmlspecialchars($_POST['cep']),
    'complemento' =>  htmlspecialchars($_POST['complemento']),
    'bairros_id' => $bairro['id']
    
];

//realizar o cadastro de endereços
$enderecosModel->cadastrarEnderecos($arrayEndereco);
$endereco = $enderecosModel->buscarPorCompleto($arrayEndereco['rua'],$arrayEndereco['numero'],$arrayEndereco['cep'],$arrayEndereco['complemento'],$bairro['id']);

//cadastrar a foto
$imagem = $imagemModel->cadastrar($_FILES);
$linkImagem = 'http://localhost/challenge/views/auth/img/'.$imagem;

//array que vai conter os dados do inscrito
$arrayUsuario = [
    'nomeCompleto' => htmlspecialchars($_POST['nome']),
    'dataNascimento' => htmlspecialchars($_POST['dataNascimento']),
    'imagem' => $linkImagem,
    'email' => htmlspecialchars($_POST['email']),
    'cpf' => htmlspecialchars($_POST['cpf']),
    'feitoPor' => ($_SESSION['autentificado']) ? 0 : 1,
    'enderecos_id' => $endereco['id']
];

//vai cadastrar o inscrito no banco.
$usuariosModel->cadastrarUsuarios($arrayUsuario);
$_SESSION['success'] = 'Inscrição realizada com sucesso!';
header('Location: http://localhost/challenge/views/auth/cadastrar.php');


