<?php

require_once('MySql.php');

class Cidades
{

    private $mysqlModel;

    public function __construct()
    {
        $this->mysqlModel = new MySql('cidades');
    }

    public function cadastrarCidades(array $dados)
    {
        return $this->mysqlModel->inserir($dados);
    }

    public function buscarPorNomeEstadoId($nome, $estadoId)
    {
        $where = "nome = '$nome' AND estados_id = $estadoId";
        return $this->mysqlModel->buscar($where);
    }

    public function getCidade($nome, $estadoId)
    {
        $existe = $this->buscarPorNomeEstadoId($nome, $estadoId);

        if(count($existe) > 0){
            return $existe[0];
        }else{
            $arrayCidade = [
                'nome'=> $nome,
                'estados_id'=> $estadoId
            ];

            $this->cadastrarCidades($arrayCidade);

            return $this->buscarPorNomeEstadoId($nome, $estadoId)[0];
        }
    }
}
