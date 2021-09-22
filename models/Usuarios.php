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

    public function buscarPorEmail(string $email){
        $where = "email = '$email'";
        return $this->mysqlModel->buscar($where);
    }

    public function buscarPorCPF(string $cpf){
        $where = "cpf = '$cpf'";
        return $this->mysqlModel->buscar($where);
    }
}
