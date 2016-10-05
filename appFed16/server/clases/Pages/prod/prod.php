<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class prod extends Home implements IPage {
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
		//$title= parent::title();
		$title= '';
		$idProd = isset($_REQUEST['id']) ? $_REQUEST['id'] : '' ;
		if(\Multi_ofertaVenta::existe (\cDb::confByKey('celorriov3'),$idProd)){
			$objOferta=new \Multi_ofertaVenta(\cDb::confByKey('celorriov3'),$idProd);
			$title .= $objOferta->GETtitle();
		}else{
			throw new \Exception("El producto solicitado no se encuentra disponible en estos momentos. Disculpe las molestias");
		}
		return $title;
	}
	public function metaTags() {
		$metaTags= parent::metaTags();
		$idProd = isset($_REQUEST['id']) ? $_REQUEST['id'] : '' ;
		$objOferta=new \Multi_ofertaVenta(\cDb::confByKey('celorriov3'),$idProd);
		$metaTags .= '<meta name="description" content="'.$objOferta->GETmetaDescription().'">';
		return $metaTags;
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
		\Sintax\ApiService\Productos::fichaProductoResponsiveCss();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css.php");
	}
	public function cuerpo() {
		$idProd = isset($_REQUEST['id']) ? $_REQUEST['id'] : '' ;
		$objOferta=new \Multi_ofertaVenta(\cDb::gI(),$idProd);
		$objCategoria = isset($objOferta->arrMulti_categoria()[0]) ? $objOferta->arrMulti_categoria()[0] : '';
		$arrOfertasRelacionadas=\Sintax\ApiService\Productos::arrProductosRelacionados(50,$GLOBALS['config']->tienda->key);
		$arrOfertasGama=\Sintax\ApiService\Productos::arrProductosGama(50,$GLOBALS['config']->tienda->key);
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/cuerpo.php");
	}
}
?>
