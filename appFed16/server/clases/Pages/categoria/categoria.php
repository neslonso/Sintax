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
		//$metaTags=parent::metaTags();
		$metaTags="";
		$idCategoria=(isset($_REQUEST['id']))?$_REQUEST['id']:NULL;
		if(\Multi_categoria::existe (\cDb::confByKey('celorriov3'),$idCategoria)){
			$objCategoria=new \Multi_categoria(\cDb::confByKey('celorriov3'),$idCategoria);
			$metaTags .= '<meta name="description" content="'.$objCategoria->GETmetaDescription().'">';
			$metaTags .= '<meta name="title" content="'.$objCategoria->GETtitle().'">';
			$metaTags .= '<meta name="keywords" content="'.$objCategoria->GETmetaKeywords().'">';
		}else{
			throw new \Exception("El producto solicitado no se encuentra disponible en estos momentos. Disculpe las molestias");
		}
		return $metaTags;

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
		$arrCatsHijas=array();
		if ($objCat->GETid() && $objCat->GETkeyTienda()==$GLOBALS['config']->tienda->key) {
			$arrOfersCuerpo=\Sintax\ApiService\Categorias::arrOfersCat($idCategoria);
			$arrOfersBanner=\Sintax\ApiService\Categorias::arrOfersMasVendidas($GLOBALS['config']->tienda->key,min(count($arrOfersCuerpo),13),$idCategoria);
			if (isset($_SESSION['usuario'])){
				$objCli=$_SESSION['usuario']->objEntity;
				$arrOfersCustom=\Sintax\ApiService\Categorias::arrOfersCustom($GLOBALS['config']->tienda->key,12,$objCli->GETid(),$idCategoria);
			}
			$arrCatsHijas=$objCat->arrMulti_categoriaHija("fff.visible='1'","","","arrClassObjs");
		} else {
			//error o redireccion a Home
			throw new \Exception("Categor�a No disponible.");
		}
		require_once( str_replace('//','/',dirname(__FILE__).'/') .'markup/cuerpo.php');
	}
}
?>
