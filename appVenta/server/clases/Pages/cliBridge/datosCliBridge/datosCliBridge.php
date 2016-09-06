<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class datosCliBridge extends Bridge implements IPage {
	public function __construct(User $objUsr) {
		parent::__construct($objUsr);
	}
	public function pageValida () {
		$usrClass=get_class($this->objUsr);
		if ($usrClass=="Multi_cliente") {
			return $this->objUsr->pagePermitida($this);
		} else {
			return "\\Sintax\\Pages\\newCliBridge";
		}
	}
	public function accionValida($metodo) {
		return $this->objUsr->accionPermitida($this,$metodo);
	}
	public function title() {
		return parent::title();
	}
	public function metaTags() {
		return parent::metaTags();
	}
	public function head() {
		parent::head();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/head.php");
	}
	public function js() {
		parent::js();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js.php");
	}
	public function css() {
		parent::css();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css.php");
	}
	public function markup() {
		/*
		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_CLI&cliService=cliDetalle';
		$result=file_get_contents($urlAPI);
		$arrCliente=json_decode($result);*/
		//MIGRACION CLIENTES : pasar el id multi cliente adecuado, ahora mismo puesto a capón.
		$idUser=$_SESSION['usuario']->id;
		$arrayPost['id']=$idUser;
		$url='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_CLI&cliService=cliDetalle';
		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($arrayPost),
		    ),
		);
		$context  = stream_context_create($options);
		$responseApi = file_get_contents($url, false, $context);
		$arrCliente=json_decode($responseApi);
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}
	public function acGrabarPerfil () {
		//POST a la API de V3 para modificar los datos
		$arrayPost=$_REQUEST;
		$url='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_CLI&cliService=cliEditPerfil';
		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($arrayPost),
		    ),
		);
		$context  = stream_context_create($options);
		$responseApi = file_get_contents($url, false, $context);
		$result=json_decode($responseApi);
		ReturnInfo::add($result->resultado->msg,'Perfil de usuario');
	}
	public function acGrabarDireccion () {
		//POST a la API de V3 para modificar los datos
		$arrayPost=$_REQUEST;
		$url='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_CLI&cliService=cliEditDir';
		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($arrayPost),
		    ),
		);
		$context  = stream_context_create($options);
		$responseApi = file_get_contents($url, false, $context);
		$result=json_decode($responseApi);
		ReturnInfo::add($result->resultado->msg,'Dirección de entrega');
	}
	public function borrarDireccion(){
		//POST a la API de V3 para modificar los datos
		$arrayPost=$_REQUEST;
		$url='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_CLI&cliService=cliDelDir';
		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($arrayPost),
		    ),
		);
		$context  = stream_context_create($options);
		$responseApi = file_get_contents($url, false, $context);
		$result=json_decode($responseApi);
	}
	public function cambiarPass () {
		//POST a la API de V3 para modificar los datos
		$arrayPost=$_REQUEST;
		$url='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_CLI&cliService=cliChangePass';
		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($arrayPost),
		    ),
		);
		$context  = stream_context_create($options);
		$responseApi = file_get_contents($url, false, $context);
		$result=json_decode($responseApi);
		ReturnInfo::add($result->resultado->msg,'Datos de acceso');
	}
	public function acCheckCP(){
		//POST a la API de V3 para modificar los datos
		$arrayPost=$_REQUEST;
		$url='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_CLI&cliService=checkCP';
		$GLOBALS['firephp']->info(http_build_query($arrayPost),"content");
		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($arrayPost),
		    ),
		);
		$context  = stream_context_create($options);
		$responseApi = file_get_contents($url, false, $context);
		$result=json_decode($responseApi);
		return $result;
	}
}
?>
