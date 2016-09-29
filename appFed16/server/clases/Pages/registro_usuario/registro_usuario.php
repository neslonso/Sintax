<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class registro_usuario extends Home implements IPage {
	public function __construct(User $objUsr) {
		parent::__construct($objUsr);
	}
	public function pageValida () {
		return true;
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
	public function cuerpo() {
		$keyTienda=$GLOBALS['config']->tienda->key;
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/cuerpo.php");
	}
	public function acGrabarCliente(){
		/*
		//POST a la API de V3 para modificar los datos
		$arrayPost=$_REQUEST;
		$url='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_CLI&cliService=cliAdd';
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
		if ($result->resultado->valor){
			$objCli=new \Bridge_Multi_cliente();
			$objCli->id=$result->datos->id;
			$_SESSION['usuario']=$objCli;
		}
		return $result;*/
		$result=\Sintax\ApiService\Clientes::acNuevoCliente($mail,$pass,$keyTienda);
		$result=json_decode($result);
		return $result;
	}
}
?>
