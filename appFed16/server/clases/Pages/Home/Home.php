<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class Home extends Error implements IPage {
	public function __construct(User $objUsr) {
		parent::__construct($objUsr);
	}
	public function pageValida () {
		return $this->objUsr->pagePermitida($this);
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
		$obj=new \Sintax\ApiService\Categorias ();
		$arrCatsRoots=$obj->arrCatsRootsMenu($GLOBALS['config']->keyTienda);
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}
	public function cuerpo() {
		$obj=new \Sintax\ApiService\Productos ();
		$arrProds=$obj->arrRandomOfertasVenta(18,$GLOBALS['config']->keyTienda);
		//$arrProds=cLA("OfertasVenta","arrRandomProds",$arrParam);
		require_once( str_replace('//','/',dirname(__FILE__).'/') .'markup/cuerpo.php');
	}
	public function subMenu($idPadre){
		$obj=new \Sintax\ApiService\Categorias ();
		$arrCatsSubMenu=$obj->arrCatsRootsSubMenu($idPadre);
		return $arrCatsSubMenu;
	}
}
?>
