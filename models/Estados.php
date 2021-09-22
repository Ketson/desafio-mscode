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

    /*recebe o nome do estado como parametro, busca ele no banco
    */

    public function getEstado($nome){
        $existe = $this->buscarEstadosPorNome($nome);
        //se existir alguma coisa no array, se retornou, vai retonarnar o primeiro
        if(count($existe) > 0){
            return $existe[0];

            //se não existir cadastra
        }else{
            $arrayEstado = [
                'nome' => $nome
            ];

            //e ja busca de novo retornando
            $this->cadastrarEstados($arrayEstado);

            return $this->buscarEstadosPorNome($nome)[0];
        }
    }
}
