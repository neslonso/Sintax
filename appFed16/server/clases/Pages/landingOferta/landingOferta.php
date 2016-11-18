<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class landingOferta extends Error implements IPage {
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
		\Sintax\ApiService\Productos::fichaProductoDtoCss();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css.php");
	}
	public function markup() {
		$db=\cDb::confByKey('celorriov3');
		$idOfer = isset($_REQUEST['id']) ? $_REQUEST['id'] : '' ;
		$objOferta=new \Multi_ofertaVenta($db,$idOfer);
		$logueado=false;
		if (isset($_SESSION['usuario'])){
			$logueado=true;
			$store=$GLOBALS['config']->tienda->key;
			$objCli=$_SESSION['usuario']->objEntity;
			$objCli->SETdb(\cDb::gI());

			$arrModosPago=\Sintax\ApiService\Pedidos::getArrModosPago();
			$datosCli=\Sintax\ApiService\Pedidos::getDatosCli($objCli);
			$storeData=\Sintax\ApiService\Pedidos::getStoreData();

			//$objCesta=$this->ensureCesta(\cDb::gI());
			//$newPedBridgeData=new \stdClass();
			//$newPedBridgeData->lineas=\Sintax\ApiService\Pedidos::arrLineasComprarPedido($objCesta);

			$idDirPredeterminada=(isset($datosCli->arrDirecciones[0]))?$datosCli->arrDirecciones[0]->id:NULL;

			$paises=\Sintax\ApiService\Pedidos::arrPaises();
			$paisDefecto=\Sintax\ApiService\Pedidos::idPaisDefecto();

			$jsonArrDtosVolumen=htmlspecialchars(json_encode($storeData->DTOS_VOLUMEN_PEDIDO),ENT_QUOTES,'UTF-8');
		}
		$activarTW=($GLOBALS['config']->tienda->SOCIAL->TW->CONSUMER_KEY!="")?true:false;
		$activarFB=($GLOBALS['config']->tienda->SOCIAL->FB->APP_ID!="")?true:false;
		$linkTiendaTW=($GLOBALS['config']->tienda->SOCIAL->TW->URL!="")?true:false;
		$linkTiendaFB=($GLOBALS['config']->tienda->SOCIAL->FB->URL!="")?true:false;

		//$objCesta=$this->ensureCesta($db);
		//$arrCestaItems=$objCesta->arrItemsJqCesta();
		//$jsonArrCestaItems=htmlspecialchars(json_encode($arrCestaItems),ENT_QUOTES,'UTF-8');
		$storeData=\Sintax\ApiService\Pedidos::getStoreData();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}
}
?>
