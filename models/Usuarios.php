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
}
