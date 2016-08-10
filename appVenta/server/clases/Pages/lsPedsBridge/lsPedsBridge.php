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
		return $this->objUsr->pagePermitida($this);
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
		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_PEDS&pedService=storeUserPeds&hash='.$_REQUEST['hash'];
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
}
?>


