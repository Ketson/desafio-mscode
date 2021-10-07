<?php 

function verificaUsuarioLogado(){
	
	if(!isset($_SESSION['autenticado']) or $_SESSION['autenticado'] == false ){
		$_SESSION['erro'] = 'Acesso inválido!';
	
		header('Location: http://localhost/challenge/views/auth/login.php');
	}

}