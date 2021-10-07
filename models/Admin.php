<?php

require_once('MySql.php');


class Admin{

    private $mysqlModel;

    public function __construct()
    {
        $this->mysqlModel = new MySql('admins');
    }

    public function cadastrarAdmins(array $dados)
    {
        return $this->mysqlModel->inserir($dados);
    }

    public function buscarPorEmail(string $email)
    {
        $where = "email = '$email'";
        return $this->mysqlModel->buscar($where);
    }

    public function buscarAdmin(string $email, string $senha)
    {
        $where = "email = '$email' AND senha = $senha";
        return $this->mysqlModel->buscar($where);
    }


    
}