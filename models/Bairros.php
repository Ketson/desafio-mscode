<?php

require_once('MySql.php');

class Bairros
{

    private $mysqlModel;

    public function __construct()
    {
        $this->mysqlModel = new MySql('bairros');
    }

    public function cadastrarBairros(array $dados)
    {
        return $this->mysqlModel->inserir($dados);
    }

    public function buscarPorNomeCidadeId($nome, $cidadeId)
    {
        $where = "nome = '$nome' AND cidades_id = $cidadeId";
        return $this->mysqlModel->buscar($where);
    }

    public function getBairro($nome, $cidadeId)
    {
        $existe = $this->buscarPorNomeCidadeId($nome,$cidadeId);

        if(count($existe) > 0){
            return $existe[0];
        }else{
            $arrayBairro = [
                'nome' => $nome,
                'cidades_id' => $cidadeId
            ];
            $this->cadastrarBairros($arrayBairro);

            return $this->buscarPorNomeCidadeId($nome, $cidadeId)[0];
        }
    }
}
