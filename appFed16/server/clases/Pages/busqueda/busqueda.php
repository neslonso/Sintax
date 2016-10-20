<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class busqueda extends Home implements IPage {
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
		$metaTags= parent::metaTags();
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
	}
	public function cuerpo() {
		$txtBusqueda=$_SERVER['SCRIPT_URL'];
		$txtBusqueda=str_replace("busqueda","",$txtBusqueda);
		$txtBusqueda=str_replace("/"," ",$txtBusqueda);
		$txtBusqueda=str_replace("-"," ",$txtBusqueda);
		$logueado=false;
		$db=\cDb::confByKey('celorriov3');
		$idCliente=NULL;
		if (isset($_SESSION['usuario'])){
			$logueado=true;
			$objCli=$_SESSION['usuario']->objEntity;
			$objCli->SETdb($db);
			$idCliente=$objCli->GETid();
		}
		$objBusqueda=new \Multi_clienteBusqueda($db);
		$objBusqueda->SETidMulti_cliente($idCliente);
		$objBusqueda->SETquery($txtBusqueda);
		$objBusqueda->grabar();
		$busqueda=$this->acSearchOfers($txtBusqueda, 0, 180);
		$arrOfers=$busqueda->arrResults;
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/cuerpo.php");
	}
}
?>
