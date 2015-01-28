<?php
namespace Core\Controle;

class Usuario {
	public function rota($arrayUrl) {
		if (isset($arrayUrl[0]))
			unset($arrayUrl[0]);
		if (isset($arrayUrl[1]))
			unset($arrayUrl[1]);
			
		$pagina = (!empty($arrayUrl[1])) ? $arrayUrl[1] : 'home';
		
		if (self::autenticadoAdmin() and self::autenticado()) {
			if(is_file(DIR_ACAO_ADMIN.$pagina.'.php')) {
				if ($pagina == 'login')
					include(DIR_ACAO_ADMIN.'home.php');
				else
					include(DIR_ACAO_ADMIN.$pagina.'.php');
			} else
				include(DIR_ACAO_ADMIN.'404.php');
		} else {
			if ($pagina == 'ajax_submit_login') {
				include(DIR_ACAO_ADMIN.$pagina.'.php');
			} elseif ($pagina == 'logout') {
				header('Location: '.DIR_ROOT_ADMIN);
			} else {
				include(DIR_ACAO_ADMIN.'login.php');
			}
		}
	}
	
	public function autenticadoAdmin() {
		
		if (isset($_SESSION['admin']) and is_array($_SESSION['admin'])) {
			if (!empty($_SESSION['admin']['id'])) {
				return true;
			}
		} else
			return false;
	}
}