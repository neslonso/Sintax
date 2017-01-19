<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class no_encontrado extends Home implements IPage {
	public function __construct(User $objUsr) {
		parent::__construct($objUsr);
	}
	public function pageValida () {
		//return $this->objUsr->pagePermitida($this);
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
		$storeData=\Sintax\ApiService\Pedidos::getStoreData();
		$arrOfersCuerpo=\Sintax\ApiService\Categorias::arrOfersTag($GLOBALS['config']->tienda->key,$storeData->HOME_TAG,36);
		if (count($arrOfersCuerpo)==0) {
			$arrOfersCuerpo=\Sintax\ApiService\Categorias::arrOfersMasVendidas($GLOBALS['config']->tienda->key,24);
		}
		if (isset($_SESSION['usuario'])){
			$objCli=$_SESSION['usuario']->objEntity;
			$arrOfersCustom=\Sintax\ApiService\Categorias::arrOfersCustom($GLOBALS['config']->tienda->key,12,$objCli->GETid());
		}
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/cuerpo.php");
	}
}
?>
