<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class acceso_usuario extends Home implements IPage {
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
		//\Sintax\ApiService\Clientes::formularioAltaClienteJs();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js.php");
	}
	public function css() {
		parent::css();
		\Sintax\ApiService\Clientes::formularioAltaClienteCss();
		\Sintax\ApiService\Clientes::formularioLoginClienteCss();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css.php");
	}
	public function cuerpo() {
		$keyTienda=$GLOBALS['config']->tienda->key;
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/cuerpo.php");
	}
	public function acGrabarCliente(){
		$result=\Sintax\ApiService\Clientes::acNuevoCliente($_REQUEST['email'],$_REQUEST['pass'],$_REQUEST['keyTienda']);
		$result=json_decode($result);
		return $result;
	}
	public function acLoginCliente() {
		if ($_REQUEST['token']!="") {//token de FB
			$result="¿Incluimos el API de FB para comprobar el token?";
		} else {
			$result=\Sintax\ApiService\Clientes::acLoginCliente($_REQUEST['email'],$_REQUEST['pass'],$_REQUEST['keyTienda']);
		}
		return $result;
	}
}
?>
