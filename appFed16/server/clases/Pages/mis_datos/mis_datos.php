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
		$objCli=$_SESSION['usuario']->objEntity;
		$objDatosRender=\Sintax\ApiService\Clientes::getDatosRenderAreaCliente($objCli);
		$cliente=$objDatosRender->cliente;
		$direcciones=$objDatosRender->direcciones;
		$paises=$objDatosRender->paises;
		$paisDefecto=$objDatosRender->paisDefecto;
		$cupones=$objDatosRender->cupones;
		$apuntes=$objDatosRender->apuntes;
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/cuerpo.php");
	}
	public function acGrabarPerfil () {
		$result=\Sintax\ApiService\Clientes::acGrabaPerfil($_REQUEST);
		ReturnInfo::add($result->msg,'Perfil de usuario');
	}
	public function acGrabarDireccion () {
		$result=\Sintax\ApiService\Clientes::acGrabaDireccion($_REQUEST);
		$result=json_decode($result);
		ReturnInfo::add($result->resultado->msg,'Dirección de entrega');
	}
	public function acCheckCP(){
		$result=\Sintax\ApiService\Clientes::acCheckCP($_REQUEST['cp'],$_REQUEST['pais']);
		return json_decode($result);
	}
	public function acBorrarDireccion(){
		$result=\Sintax\ApiService\Clientes::acBorraDireccion($_REQUEST['id']);
		return json_decode($result);
	}
	public function acCambiarPass () {
		$result=\Sintax\ApiService\Clientes::acCambiaPass($_REQUEST);
		$result=json_decode($result);
		ReturnInfo::add($result->resultado->msg,'Datos de acceso');
	}

}
?>
