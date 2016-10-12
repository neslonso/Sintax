<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class aviso_legal extends Home implements IPage {
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
		$URL_TIENDA=BASE_URL;
		$NOMBRE_EMPRESA=$GLOBALS['config']->tienda->EMPRESA->NOMBRE;
		$CIF_EMPRESA=$GLOBALS['config']->tienda->EMPRESA->CIF;
		$DIRECCION_EMPRESA=$GLOBALS['config']->tienda->EMPRESA->DIRECCION;
		$EMAIL_CONTACTO=$GLOBALS['config']->tienda->CONTACTO->EMAIL;
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/cuerpo.php");
	}
}
?>