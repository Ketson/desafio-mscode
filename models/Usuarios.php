<?php

require_once('MySql.php');

class Usuarios
{

    private $mysqlModel;

    public function __construct()
    {
        $this->mysqlModel = new MySql('usuarios');
    }

    public function cadastrarUsuarios(array $dados)
    {
        return $this->mysqlModel->inserir($dados);
    }

    public function buscarTodos()
    {
        return $this->mysqlModel->buscar();
    }

    public function buscarPorEmail(string $email)
    {
        $where = "email = '$email'";
        return $this->mysqlModel->buscar($where);
    }

    public function buscarPorCPF(string $cpf)
    {
        $where = "cpf = '$cpf'";
        return $this->mysqlModel->buscar($where);
    }

    public function buscarPorId($id)
    {
        $where = "id = $id";
        return $this->mysqlModel->buscar($where)[0];
    }

    public function deletarUsuarioPorId($id)
    {
        $where = "id = $id";
        return $this->mysqlModel->deletar($where);
    }

    public function update(array $dados, $id){
        
      $where = "id = $id";

      return $this->mysqlModel->atualizar($dados,$where);
    }

    public function verificaFoto($postfoto, $tamanhofoto)
    {
        if (!isset($postfoto) OR $postfoto == '') {
            return false;
        }

        if (intval($tamanhofoto) <= 0) {
            return false;
        }
        
        return true;
    }
}
