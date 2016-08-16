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
	/*
	public function usrLogin() {
		$arrSanear=array(
			'email'=> array('type' => 'text', 'subtype' => 'plain', 'minLenght' =>'5', 'msg'=>'Email no parece una dirección válida'),
			'pass'=> array('type' => 'text', 'subtype' => 'plain', 'minLenght' =>'1', 'msg'=>'Debe introducir su contraseña'),
		);

		$arrSaneado=$this->sanitize($arrSanear);

		$GLOBALS['firephp']->info($arrSaneado);
		$algunoNoValido=false;
		$msg='';
		foreach ($arrSaneado as $key => $value) {
			if (!$value[0]['usable']) {
				$algunoNoValido=true;
				$msg.=$arrSaneado[$key][0]['msg'].'<br />';
			}
		}

		if ($algunoNoValido) {
			throw new ActionException($msg);
		}

		$idCliente=Multi_cliente::login($arrSaneado['email'][0]['newValue'],$arrSaneado['pass'][0]['newValue']);
		if (Multi_cliente::existeId($idCliente)) {
			$this->logCliente($idCliente);
		} else {
			throw new ActionException('<div style="text-align:center">Nombre de usuario o contraseña incorrecto.</div>');
		}
	}
	*/
}
?>
