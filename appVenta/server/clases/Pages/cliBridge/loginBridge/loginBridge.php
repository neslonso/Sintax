<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class loginBridge extends Bridge implements IPage {
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
		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_CLI&cliService=cliLogin&hash='.$hash;
		$result=file_get_contents($urlAPI);
		$arrResult=json_decode($result);
		//echo "<pre>".print_r($arrResult,true)."</pre>";
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}
}
?>
