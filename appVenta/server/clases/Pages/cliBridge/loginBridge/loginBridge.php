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
		$data=json_decode(base64_decode($_REQUEST['loginBridgeData']));
		$keyTienda=$data->store;
		if (isset($_SESSION['usuario'])) {
			$arrayMulti['id']=$_SESSION['usuario']->id;
			$url='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_CLI&cliService=cliData';
			$options = array(
			    'http' => array(
			        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			        'method'  => 'POST',
			        'content' => http_build_query($arrayMulti),
			    ),
			);
			$context  = stream_context_create($options);
			$envioMulti = file_get_contents($url, false, $context);
			$arrResult=json_decode($envioMulti);
		}
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}

	public function acLogin() {
		//POST a la API de V3 para añadir el pedido a la multi
		$arrayMulti=$_REQUEST;
		$url='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_CLI&cliService=cliLogin';
		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($arrayMulti),
		    ),
		);
		$context  = stream_context_create($options);
		$envioMulti = file_get_contents($url, false, $context);
		$result=json_decode($envioMulti);
		if ($result->resultado->valor){
			$objCli=new \Multi_cliente();
			$objCli->id=$result->datos->id;
			$_SESSION['usuario']=$objCli;
		}
		return $result;
	}

	public function acLogout() {
		unset($_SESSION['usuario']);
		return true;
	}

}
?>
