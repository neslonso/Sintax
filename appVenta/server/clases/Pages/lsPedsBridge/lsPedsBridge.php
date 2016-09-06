<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class lsPedsBridge extends Bridge implements IPage {
	public function __construct(User $objUsr) {
		parent::__construct($objUsr);
		/*
		$arrDbs=unserialize(DBS);
		\cDb::conf($arrDbs['celorriov3']['_DB_HOST_'],$arrDbs['celorriov3']['_DB_USER_'],$arrDbs['celorriov3']['_DB_PASSWD_'],$arrDbs['celorriov3']['_DB_NAME_']);
		*/
	}
	public function pageValida () {
		$hash=$_REQUEST['hash'];
		$arrHash=explode("@@@", base64_decode($hash));
		$idUser=$arrHash[0];
		$store=$arrHash[1];
		$usrClass=get_class($this->objUsr);
		if ($usrClass=="Multi_cliente") {
			//esta identificado en fed16
			error_log("Excep: esta identificado en fed16");
			$_SESSION['datosCli']=$this->getDatosCli("",$this->objUsr->id,$hash);
			return $this->objUsr->pagePermitida($this);
		} else {
			if ($idUser) {
				//no esta identificado en fed16 pero hemos recibido un idUser desde el store
				$_SESSION['datosCli']=$this->getDatosCli($store,$idUser,$hash);
			} else {
				$loginBridgeData=new \stdClass();
				$loginBridgeData->store=$store;
				$loginBridgeDataValue=base64_encode(json_encode($loginBridgeData));
				$_REQUEST['loginBridgeData']=$loginBridgeDataValue;
				ReturnInfo::add('Es necesario que se identifique como cliente para poder acceder a sus pedidos','Disculpe, no se encuentra identificado');
				return "\\Sintax\\Pages\\loginBridge";
			}
		}
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
		$hash=$_REQUEST['hash'];
		$datosCli=$_SESSION['datosCli'];
		$idUser=$datosCli->idEnOrigen;
		$store=$datosCli->keyTienda;

		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_PEDS&pedService=storeUserPeds&store='.$store.'&idUser='.$idUser.'&hash='.$_REQUEST['hash'];
		$result=file_get_contents($urlAPI);
		$pedidos=json_decode($result);
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/cuerpo.php");
	}
	public function acDataTables() {
		return dataTablesGenericServerSide($this->objUsr);
	}
	/*
	public function ls() {
		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_PEDS&pedService=allPeds';
		$pedidos=file_get_contents($urlAPI);
		return json_decode($pedidos);
	}*/
	private function getDatosCli($store,$idEnStore,$hash) {
		$subService='datosCli';
		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=NEW_PED_BRIDGE&subService='.$subService.'&store='.$store.'&idCli='.$idEnStore.'&hash='.$hash;
		$result=file_get_contents($urlAPI);
		error_log("Excep: ".$result);
		$datosCli=json_decode($result);
		return $datosCli;
	}
}
?>



