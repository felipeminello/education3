<?php
header('Content-type: text/html; charset=iso-8859-1');

use Core\Modelo\Dados\BancoDados;
use Core\Modelo\Funcao;

define('DS', DIRECTORY_SEPARATOR);
define('DIR_ROOT', '/var/www/education3/');

require_once(__DIR__.'/../vendor/autoload.php');

$bd = new BancoDados();

$up = new upload();

Twig_Autoloader::register();

$url = Funcao::checkString(Funcao::get('url'));

$arrayArea = array('aluno', 'professor', 'sistema');

$arrayUrl = explode('/', $url);

$area = (isset($arrayUrl[0])) ? $arrayUrl[0] : 'sistema';
$pagina = (isset($arrayUrl[1])) ? $arrayUrl[1] : 'home';

if (empty($area))
	$area = 'sistema';
	
if (empty($pagina))
	$pagina = 'home';

if (in_array($area, $arrayArea)) {
	if (is_file(DIR_ROOT.'src'.DS.'Controle'.DS.'acao/'.$area.'/'.$pagina.'.php'))
		include_once __DIR__.'/../src/Controle/acao/'.$area.'/'.$pagina.'.php';
		
	try {
		// specify where to look for templates
		$loader = new Twig_Loader_Filesystem('../src/Visao');
		
		// initialize Twig environment
		$twig = new Twig_Environment($loader);
		
		// load template
		$template = $twig->loadTemplate($area.'/'.$pagina.'.tpl');
		
		// set template varisables
		// render template
		echo $template->render(array(
		'name' => 'Clark Kents',
		'username' => 'ckent',
		'password' => 'krypt0n1te',
			'produtos' => array(
				1 => 'Teste 1',
				2 => 'Teste 2',
				3 => 'Teste 3'
			)
		));
	
	} catch (Exception $e) {
		die ('ERRO: ' . $e->getMessage());
	}
}
