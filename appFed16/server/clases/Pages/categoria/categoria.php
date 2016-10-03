<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class categoria extends Home implements IPage {
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
		\Sintax\ApiService\Categorias::listaFichaProductoResponsiveJs();
	}
	public function css() {
		parent::css();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css.php");
		\Sintax\ApiService\Categorias::listaFichaProductoResponsiveCss();
		\Sintax\ApiService\Productos::fichaProductoDtoCss();
	}

	public function cuerpo() {
		$idCategoria=(isset($_REQUEST['id']))?$_REQUEST['id']:NULL;
		$objCat=new \Multi_categoria(\cDb::gI(),$idCategoria);
		if ($objCat->GETid() && $objCat->GETkeyTienda()==$GLOBALS['config']->tienda->key) {
			$arrOfersBanner=\Sintax\ApiService\Categorias::arrOfersMasVendidas($GLOBALS['config']->tienda->key,13,$idCategoria);
			$arrOfersCuerpo=\Sintax\ApiService\Categorias::arrOfersCat($idCategoria);
		} else {
			//error o redireccion a Home
			throw new Exception("Categoría No disponible.");
		}
		require_once( str_replace('//','/',dirname(__FILE__).'/') .'markup/cuerpo.php');
	}
}
?>
