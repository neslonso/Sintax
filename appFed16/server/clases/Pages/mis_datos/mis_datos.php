<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class mis_datos extends Home implements IPage {
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
		$db=\cDb::confByKey('celorriov3');
		$objCli=$_SESSION['usuario']->objEntity;
		$objCli->SETdb($db);

		$cliente=$objCli->toStdObj();
		$cliente->saldo=$objCli->saldoCredito();
		$cliente->saludo=($objCli->GETsexo()=="HOMBRE")?"Bienvenido":"Bienvenida";

		$direcciones=array();
		foreach ($objCli->arrMulti_clienteDireccion("","","","arrClassObjs") as $objDir) {
			$soDirecion=$objDir->toStdObj();
			$soDirecion->idPais=($objDir->esPaisConocido()>0)?$objDir->esPaisConocido():0;
			array_push($direcciones,$soDirecion);
		}

		$paises=\Multi_pais::getArray($db);

		$paisDefecto=199;

		$cupones=array();
		foreach ($objCli->arrMulti_cupon("","","","arrClassObjs") as $objCupon) {
			$stdObjCupon=new \stdClass();
			$stdObjCupon->id=$objCupon->GETid();
			$stdObjCupon->codigo=$objCupon->GETcodigo();
			$stdObjCupon->tipoDescuento=$objCupon->GETtipoDescuento();
			$stdObjCupon->caducidad=$objCupon->GETcaducidad();
			$stdObjCupon->pedidos=$objCupon->getlistaPedidos();
			array_push($cupones, $stdObjCupon);
		}

		$apuntes=$objCli->arrMulti_apunteCredito();

		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/cuerpo.php");
	}
}
?>
