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
		$idOfer = isset($_REQUEST['id']) ? $_REQUEST['id'] : '' ;
		if(\Multi_ofertaVenta::existe (\cDb::confByKey("celorriov3"),$idOfer)){
			$objOferta=new \Multi_ofertaVenta(\cDb::gI(),$idOfer);
			if ($objOferta->GETvisible()) {
				return $this->objUsr->pagePermitida($this);
			} else {
				ReturnInfo::add('El producto solicitado no se encuentra disponible en estos momentos. Disculpe las molestias','Producto no disponible');
				return "Sintax\Pages\Home";
			}
		}
	}
	public function accionValida($metodo) {
		return $this->objUsr->accionPermitida($this,$metodo);
	}
	public function title() {
		$title="";
		$idOfer = isset($_REQUEST['id']) ? $_REQUEST['id'] : '' ;
		if(\Multi_ofertaVenta::existe (\cDb::confByKey('celorriov3'),$idOfer)){
			$objOferta=new \Multi_ofertaVenta(\cDb::confByKey('celorriov3'),$idOfer);
			$title=str_replace("%NOMBRE%", $objOferta->GETnombre(), $objOferta->GETtitle());
			$title=str_replace("%PRECIO%", $objOferta->pvp(), $title);
		}
		$title.=' &bull; '.$GLOBALS['config']->tienda->SITE_NAME;
		return $title;
	}
	public function metaTags() {
		//$metaTags= parent::metaTags();
		$metaTags="";
		$idOfer = isset($_REQUEST['id']) ? $_REQUEST['id'] : '' ;
		if(\Multi_ofertaVenta::existe (\cDb::confByKey('celorriov3'),$idOfer)){
			$objOferta=new \Multi_ofertaVenta(\cDb::confByKey('celorriov3'),$idOfer);
			$metaTags .= '<meta name="description" content="'.$objOferta->GETmetaDescription().'">';
			$metaTags .= '<meta name="title" content="'.$objOferta->GETtitle().'">';
			$metaTags .= '<meta name="keywords" content="'.$objOferta->GETmetaKeywords().'">';
		}
		return $metaTags;
	}
	public function head() {
		parent::head();
		$idOfer = isset($_REQUEST['id']) ? $_REQUEST['id'] : '' ;
		$objOferta=new \Multi_ofertaVenta(\cDb::gI(),$idOfer);
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
		$idOfer = isset($_REQUEST['id']) ? $_REQUEST['id'] : '' ;
		$objOferta=new \Multi_ofertaVenta(\cDb::gI(),$idOfer);
		$objCategoria = isset($objOferta->arrMulti_categoria()[0]) ? $objOferta->arrMulti_categoria()[0] : '';
		$arrOfertasRelacionadas=\Sintax\ApiService\Productos::arrOfersRelacionadas($idOfer,10);
		$arrOfertasGama=\Sintax\ApiService\Productos::arrOfersGama($idOfer,10);
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/cuerpo.php");
	}
}
?>
