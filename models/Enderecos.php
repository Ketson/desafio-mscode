<?php

require_once('MySql.php');

class Enderecos
{

    private $mysqlModel;

    public function __construct()
    {
        $this->mysqlModel = new MySql('enderecos');
    }

    public function cadastrarEnderecos(array $dados)
    {
        return $this->mysqlModel->inserir($dados);
    }

    public function buscarPorCompleto($rua, $numero, $cep, $complemento, $bairroId){
        $where = "rua = '$rua' AND numero = '$numero' AND cep = '$cep' AND complemento = '$complemento' AND bairros_id = $bairroId";
        return $this->mysqlModel->buscar($where)[0];
    }
}
