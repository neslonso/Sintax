<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\Page;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;

class Error extends Page implements IPage {

	private $msg;

	public function __construct (User $objUsr=NULL) {
		parent::__construct($objUsr);
		$this->msg="Descripcion no especificada.";
	}

	public function setMsg($msg) {
		$this->msg=$msg;
	}

	//En head y markup no usamos require_once, pq si salta un error durante la ejecución de una Page
	//no se volverá a requerir el fichero, ya que todas las Pagesdeben descender de Error.
	//Esto tambien significa que ninguna de las funciones pueden contener nada que no pueda ser
	//redeclarado (funciones, clases...)
	public function head() {
		require( str_replace('//','/',dirname(__FILE__).'/') .'markup/head.php');
	}

	public function js() {
		require( str_replace('//','/',dirname(__FILE__).'/') .'markup/js.php');
	}

	public function css() {
		require( str_replace('//','/',dirname(__FILE__).'/') .'markup/css.php');
	}

	public function markup() {
		try {
			if ($this->msg=="") {
				if (ReturnInfo::msgsToLis()!="") {
					$this->setMsg('<ul class="sriMsgs">'.ReturnInfo::msgsToLis().'</ul>');
				} else {
					if (!in_array($_SERVER['REMOTE_ADDR'],unserialize(IPS_DEV))) {
						$this->setMsg('Error no especificado, use IPS_DEV');
					} else {
						$this->setMsg('<br />debug_backtrace<pre>'.print_r(debug_backtrace(),true).'</pre>');
					}
				}
			}
			if (in_array($_SERVER['REMOTE_ADDR'],unserialize(IPS_DEV))) {
				//$this->msg.='<br />getallheaders<pre>'.print_r(getallheaders(),true).'</pre>';
				//$this->msg.='<br />debug_backtrace<pre>'.print_r(debug_backtrace(),true).'</pre>'; //<- No sirve, la exception original no esta en esta traza
			}

		} catch (Exception $e) {
			$infoExc="Excepcion de tipo: ".get_class($e).". Mensaje: ".$e->getMessage()." en fichero ".$e->getFile()." en linea ".$e->getLine();
			$this->setMsg('Error mostrando detalles de error:<br />'.$infoExc);
		}
		require( str_replace('//','/',dirname(__FILE__).'/') .'markup/markup.php');
	}

	protected function ensureCesta($db) {
		$objCesta=new \Multi_cesta($db);
		if (isset($_SESSION['cesta'])) {
			$class=get_class($_SESSION['cesta']);
			if ($class=="Multi_cesta") {
				$objCesta=$_SESSION['cesta'];
				$objCesta->SETdb($db);
				if (!\Multi_cesta::existe($db,$objCesta->GETid())) {
					$objCesta->SETid(NULL);
				}
			} else {
				unset ($_SESSION['cesta']);
			}
		}
		if (isset($_SESSION['usuario'])) {
			$objCli=$_SESSION['usuario']->objEntity;
			$objCesta->SETidMulti_cliente($objCli->GETid());
		}
		$objCesta->grabar();
		$_SESSION['cesta']=$objCesta;
		return $objCesta;
	}

	public function acAddToCesta ($idMulti_ofertaVenta) {
		try {
			$db=\cDb::confByKey('celorriov3');
			$objCesta=$this->ensureCesta($db);
			$objLinea=$objCesta->getLineaOfertaOrNew($idMulti_ofertaVenta);
			$objLinea->SETcantidad($objLinea->GETcantidad()+1);
			$objLinea->SETidMulti_cesta($objCesta->GETid());
			$objLinea->SETidMulti_ofertaVenta($idMulti_ofertaVenta);
			$result=$objLinea->grabar();
			$_SESSION['cesta']=$objCesta;
			return $result;
		} catch (Exception $e) {
			throw new ActionException("Error añadiendo producto", 1,$e);
		}
	}

	public function acRemoveFromCesta ($idMulti_ofertaVenta) {
		try {
			$db=\cDb::confByKey('celorriov3');
			$objCesta=$this->ensureCesta($db);
			$objLinea=$objCesta->arrMulti_cestaLinea("idMulti_ofertaVenta='".$idMulti_ofertaVenta."'","","","arrClassObjs");
			$result=$objLinea[0]->borrar();
			$_SESSION['cesta']=$objCesta;
			return $result;
		} catch (Exception $e) {
			throw new ActionException("Error eliminando producto", 1,$e);
		}
	}
	public function acEditCesta($idMulti_ofertaVenta,$cantidad) {
		try {
			$db=\cDb::confByKey('celorriov3');
			$objCesta=$this->ensureCesta($db);
			$objLinea=$objCesta->getLineaOfertaOrNew($idMulti_ofertaVenta);
			$objLinea->SETcantidad($cantidad);
			$objLinea->SETidMulti_cesta($objCesta->GETid());
			$objLinea->SETidMulti_ofertaVenta($idMulti_ofertaVenta);
			$result=$objLinea->grabar();
			$_SESSION['cesta']=$objCesta;
			return $result;
		} catch (Exception $e) {
			throw new ActionException("Error modificando producto", 1,$e);
		}
	}

	public function acTwLogin() {
		error_log("Excep: acTwLogin");
		$TWCK=$GLOBALS['config']->tienda->SOCIAL->TW->CONSUMER_KEY;
		$TWCS=$GLOBALS['config']->tienda->SOCIAL->TW->CONSUMER_SECRET;

		$connection = new TwitterOAuth($TWCK,$TWCS);
		$request_token = $connection->oauth('oauth/request_token',
			array('oauth_callback' => BASE_URL.FILE_APP.'?MODULE=actions&acClase=Home&acMetodo=acTwLoginCallBack&acTipo=std'));
			//array('oauth_callback' => 'obb'));

		$_SESSION['tw_oauth']['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['tw_oauth']['oauth_token_secret'] = $request_token['oauth_token_secret'];

		$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
		return $url;
	}

	public function acTwLoginCallBack() {
		$TWCK=$GLOBALS['config']->tienda->SOCIAL->TW->CONSUMER_KEY;
		$TWCS=$GLOBALS['config']->tienda->SOCIAL->TW->CONSUMER_SECRET;

		if (!isset($_REQUEST['oauth_token']) || $_REQUEST['oauth_token'] !== $_SESSION['tw_oauth']['oauth_token']) {
			// Abort! Something is wrong.
			ReturnInfo::add('Debe conceder permiso a '.$GLOBALS['config']->tienda->SITE_NAME.' bebefarma para acceder a su cuenta de twitter','No fue posible realizar la conexión con twitter');
			$GLOBALS['acReturnURI']=BASE_URL;
			//Eliminar el access_token del user
		} else {
			$connection = new TwitterOAuth($TWCK,$TWCS,$_SESSION['tw_oauth']['oauth_token'],$_SESSION['tw_oauth']['oauth_token_secret']);
			$access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);
			$_SESSION['tw_oauth']['access_token'] = $access_token;
			$connection = new TwitterOAuth($TWCK,$TWCS, $access_token['oauth_token'], $access_token['oauth_token_secret']);
			$verify_credentials = $connection->get("account/verify_credentials");
			var_dump($verify_credentials);
			$GLOBALS['firephp']->info($verify_credentials);
		}
	}

	public function acGrabarCliente($email,$pass=""){
		if (empty($pass)) {$pass=\Cadena::generatePassword();}
		$result=\Sintax\ApiService\Clientes::acNuevoCliente($email,$pass,$GLOBALS['config']->tienda->key);
		$result=json_decode($result);
		return $result;
	}
}
?>