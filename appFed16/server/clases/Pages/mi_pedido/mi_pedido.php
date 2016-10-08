<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class mi_pedido extends Home implements IPage {
	public function __construct(User $objUsr) {
		parent::__construct($objUsr);
	}
	public function pageValida () {
		$pageSustitucion="\\Sintax\\Pages\\Home";
		//$pageSustitucion="\\Sintax\\Pages\\registro_y_acceso";
		if (is_null($this->objUsr)) {
			$result=$pageSustitucion;
			ReturnInfo::add('Debe identificarse como cliente para poder acceder a su área de datos.','Acceso no permitido.');
		} else {
			$usrPermitido=$this->objUsr->pagePermitida($this);
			$result=($usrPermitido)?true:$pageSustitucion;
			if ($result!==true) {
				ReturnInfo::add('No dispone de permiso para acceder a ['.get_class($this).'].','Acceso no permitido.');
			}
		}
		return $result;
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
		/*
		$objCli=$_SESSION['usuario']->objEntity;
		$idUser=$objCli->GETid();
		$store=$objCli->GETkeyTienda();
		$idPed=$_REQUEST['id'];
		$result=\Sintax\ApiService\Clientes::getDatosRenderPedido($idPed,$idUser);
		*/
		$arr=explode('::', $_REQUEST['id']);
		$idMulti_pedido=$arr[0];
		$popup=(isset($arr[1]))?true:false;
		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_PEDS&pedService=pedDetalle'.
			'&idPedidoOrigen='.
			'&store='.
			'&idMulti_pedido='.$idMulti_pedido.
			'&idUserOrigen='.
			'&idMulti_cliente=';
		$result=file_get_contents($urlAPI);
		$arrPedido=json_decode($result);
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/cuerpo.php");
	}
}
?>
