<?php

require_once('MySql.php');

class Estados
{

    private $mysqlModel;

    public function __construct()
    {
        $this->mysqlModel = new MySql('estados');
    }

    public function cadastrarEstados(array $dados)
    {
        return $this->mysqlModel->inserir($dados);
    }

    public function buscarEstadosPorNome(string $nome)
    {
        $where = "nome = '$nome'";
        return $this->mysqlModel->buscar($where);
    }

    public function getEstado($nome){
        $existe = $this->buscarEstadosPorNome($nome);

        if(count($existe) > 0){
            return $existe[0];
        }else{
            $arrayEstado = [
                'nome' => $nome
            ];
            $this->cadastrarEstados($arrayEstado);

            return $this->buscarEstadosPorNome($nome)[0];
        }
    }
}
