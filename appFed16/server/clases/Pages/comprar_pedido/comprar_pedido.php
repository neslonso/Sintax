<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class comprar_pedido extends Home implements IPage {
	public function __construct(User $objUsr) {
		parent::__construct($objUsr);
		if (isset($_REQUEST['newPedBridgeDataValue'])) {
			$newPedBridgeData=json_decode(base64_decode($_REQUEST['newPedBridgeDataValue']));
			$_SESSION['newPedBridgeDataOrigData']=$newPedBridgeData;
		} else {
			if (isset($_SESSION['newPedBridgeDataOrigData'])) {
				$newPedBridgeData=$_SESSION['newPedBridgeDataOrigData'];
			} else {
				throw new \Exception("No es posible procesar el pedido, datos no recibidos.", 1);
			}
		}
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
	public function cuerpo() {
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/cuerpo.php");
	}
}
?>
