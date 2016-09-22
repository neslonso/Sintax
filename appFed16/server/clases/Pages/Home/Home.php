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
		$arrParam['keyTienda']=$GLOBALS['config']->keyTienda;
		$obj=new \Sintax\ApiService\Categorias ();
		$arrCatsRoots=$obj->arrCatsRootsMenu($arrParam);
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}
	public function cuerpo() {
		$arrParam['keyTienda']=$GLOBALS['config']->keyTienda;
		$arrParam['results']="12";
		$obj=new \Sintax\ApiService\Categorias ();
		$arrProds=$obj->arrRandomOfertasVenta(17,"BF");
		//$arrProds=cLA("OfertasVenta","arrRandomProds",$arrParam);
		require_once( str_replace('//','/',dirname(__FILE__).'/') .'markup/cuerpo.php');
	}
}
?>
