<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();

//Imports
require_once('../../models/Usuarios.php');
require_once('../../models/Enderecos.php');
require_once('../../models/Bairros.php');
require_once('../../models/Cidades.php');
require_once('../../models/Estados.php');

//Instâncias

$usuariosModel = new Usuarios();
$enderecosModel = new Enderecos();
$bairrosModel = new Bairros();
$cidadesModel = new Cidades();
$estadosModel = new Estados();

$usuarios = $usuariosModel->buscarTodos();



//Variaveis


//Lógica

//mascara cpf
function mask($val, $mask)
{
    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
        if ($mask[$i] == '#') {
            if (isset($val[$k])) {
                $maskared .= $val[$k++];
            }
        } else {
            if (isset($mask[$i])) {
                $maskared .= $mask[$i];
            }
        }
    }

    return $maskared;
}


?>
<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    <title>MS </title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="listar.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="usuarios/listar.php">Gerenciar Usuarios </a>
                </li>

            </ul>
            <a class="btn btn-outline-danger my-2 my-sm-0" href="../../actions/auth/logout.php">Sair</a>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12 pt-5">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-9">
                                <h3>Listagem de inscritos</h3>
                            </div>
                            <div class="col-3">
                                <a class="btn btn-success btn-block" href="cadastrar.php">Cadastrar</a>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Nascimento</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">CPF</th>
                                    <th scope="col">Endereço</th>
                                    <th scope="col">ADM</th>
                                    <th scope="col">Ações</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($usuarios as $usuario) { ?>
                                    <?php
                                    //busca o endereço daquele usuario
                                        $endereco = $enderecosModel->buscarPorId($usuario['enderecos_id']);
                                        $bairro = $bairrosModel->buscarPorId($endereco['bairros_id']);
                                        $cidade = $cidadesModel->buscarPorId($bairro['cidades_id']);
                                        $estado = $estadosModel->buscarPorId($cidade['estados_id']);
                                    ?>
                                    <tr> 
                                        <td><?php echo $usuario['id']; ?></td>
                                        <td><?php echo $usuario['nomeCompleto']; ?></td>
                                        <td><?php echo date("d/m/Y", strtotime($usuario['dataNascimento'])); ?></td>
                                        <td><?php echo $usuario['email']; ?></td>
                                        <td><?php echo mask($usuario['cpf'], '###.###.###-##'); ?></td>
                                        <td>
                                           Rua: <?php echo ($endereco['rua'])?>,
                                            N°: <?php echo ($endereco['numero'])?><br>
                                            CEP: <?php echo ($endereco['cep'])?><br>
                                            Complemento: <?php echo ($endereco['complemento'])?>
                                            Bairro: <?php echo ($bairro['nome'])?><br>
                                            Cidade: <?php echo ($cidade['nome'])?><br>
                                            Estado: <?php echo ($estado['nome'])?><br>
                                        </td>

                                        </td>
                                        <td>
                                            <span class="badge badge-pill badge-success">Sim</span>
                                            <span class="badge badge-pill badge-danger">Não</span>
                                        </td>
                                        <td>
                                            
                                            <div class="btn-group" role="group" aria-label="Exemplo básico">
                                            <a class="btn btn-primary btn-sm" href="">Editar</a>
                                            <a href="../../actions/auth/deletar.php?id=<?php echo $usuario['id']?>" class="btn btn-danger btn-sm " onclick="return confirm('Deseja excluir esse usuário?');">Excluir</a>
                                            
                                            </div>

                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>

</html>