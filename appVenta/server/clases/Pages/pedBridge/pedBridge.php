<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class pedBridge extends Bridge implements IPage {
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
		$tipoAcceso=(isset($_REQUEST['idEnOrigen'])?"1":"");
		$popup=(isset($_REQUEST['popup'])?true:false);
		if (isset($_REQUEST['hash'])) {//llamada desde una de las tiendas
			$hash=$_REQUEST['hash'];
			$arrHash=explode("@@@", base64_decode($hash));

			$idPedidoOrigen=$_REQUEST['id'];
			$store=$arrHash[1];
			$idMulti_pedido='';
			$idUserOrigen=$arrHash[0];
			$idMulti_cliente='';
		} else {//llamada desde el propio fe16 (incluso cuando esta en iframe de una de las tiendas)
			$idPedidoOrigen='';
			$store='';
			$idMulti_pedido=$_REQUEST['id'];
			$idUserOrigen='';
			if (get_class($this->objUsr)=="Multi_cliente") {
				$idMulti_cliente=$this->objUsr->id;
			} else {
				$idMulti_cliente='';
			}
		}
		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_PEDS&pedService=pedDetalle'.
			'&idPedidoOrigen='.$idPedidoOrigen.
			'&store='.$store.
			'&idMulti_pedido='.$idMulti_pedido.
			'&idUserOrigen='.$idUserOrigen.
			'&idMulti_cliente='.$idMulti_cliente.
			'&tipoAcceso='.$tipoAcceso;
		$result=file_get_contents($urlAPI);
		$arrPedido=json_decode($result);
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}
}
?>
