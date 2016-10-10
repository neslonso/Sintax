<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;

use \Abraham\TwitterOAuth\TwitterOAuth;

class Home extends Error implements IPage {
	public function __construct(User $objUsr) {
		parent::__construct($objUsr);
	}
	public function pageValida () {
		//return $this->objUsr->pagePermitida($this);
		return true;
	}
	public function accionValida($metodo) {
		return $this->objUsr->accionPermitida($this,$metodo);
	}
	public function title() {
		//return parent::title();
		return $GLOBALS['config']->tienda->SITE_NAME;
	}
	public function metaTags() {
		$sitename=$GLOBALS['config']->tienda->SITE_NAME;
		$metaTags= parent::metaTags();
		/*$idProd = isset($_REQUEST['idProd']) ? $_REQUEST['idProd'] : '23137' ;
		if(\Multi_ofertaVenta::existe (\cDb::confByKey('celorriov3'),$idProd)){
			$objOferta=new \Multi_ofertaVenta(\cDb::confByKey('celorriov3'),$idProd);
			$metaTags .= '<meta name="description" content="'.$objOferta->GETmetaDescription().'">';
		}else{
			throw new \Exception("El producto solicitado no se encuentra disponible en estos momentos. Disculpe las molestias");
		}*/
		$metaTags.='<meta property="og:title" content="'.$sitename.'" />';
		$metaTags.='<meta property="og:description" content="'.$sitename.'" />';
		$metaTags.='<meta name="description" content="'.$sitename.'">';
		$metaTags.='<meta property="og:image" content="'.BASE_URL.'appFed16/binaries/imgs/ogImage.CL.png" />';
		return $metaTags;
	}
	public function head() {
		parent::head();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/head.php");
	}
	public function favIcon() {
		$keyTienda=$GLOBALS['config']->tienda->key;
		$sitename=$GLOBALS['config']->tienda->SITE_NAME;
		$TileColor='#2d89ef';//#00a300
		//http://realfavicongenerator.net/
		echo '
			<link rel="apple-touch-icon" sizes="180x180" href="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/apple-touch-icon.png?v=lkgMkggyvj">
			<link rel="icon" type="image/png" href="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/favicon-32x32.png?v=lkgMkggyvj" sizes="32x32">
			<link rel="icon" type="image/png" href="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/favicon-16x16.png?v=lkgMkggyvj" sizes="16x16">
			<link rel="manifest" href="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/manifest.json?v=lkgMkggyvj">
			<link rel="mask-icon" href="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/safari-pinned-tab.svg?v=lkgMkggyvj" color="#5bbad5">
			<link rel="shortcut icon" href="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/favicon.ico?v=lkgMkggyvj">
			<meta name="apple-mobile-web-app-title" content="'.$sitename.'">
			<meta name="application-name" content="'.$sitename.'">
			<meta name="msapplication-TileColor" content="'.$TileColor.'">
			<meta name="msapplication-TileImage" content="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/mstile-144x144.png?v=lkgMkggyvj">
			<meta name="msapplication-config" content="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/browserconfig.xml?v=lkgMkggyvj">
			<meta name="theme-color" content="#ffffff">
		';
	}
	public function js() {
		parent::js();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js/jsCesta.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js/jsBuscador.php");

		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js/jsBanner.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js/jsFB.php");
		\Sintax\ApiService\Categorias::listaFichaProductoResponsiveJs();
	}
	public function css() {
		parent::css();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css/cssBanner.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css/cssBuscador.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css/cssMenuCats.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css/cssMenuUsr.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css/cssOferDetalle.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css/cssFooter.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css/cssMediaQueries.php");
		\Sintax\ApiService\Categorias::listaFichaProductoResponsiveCss();
		\Sintax\ApiService\Productos::fichaProductoDtoCss();
	}
	public function markup() {
		$db=\cDb::confByKey('celorriov3');
		$logueado=false;
		if (isset($_SESSION['usuario'])){
			$logueado=true;
			$objCli=$_SESSION['usuario']->objEntity;
			$objCli->SETdb($db);
			$cliente=$objCli->toStdObj();
			$cliente->saldo=$objCli->saldoCredito();
		}
	//$GLOBALS['firephp']->error($db->ping(),"pre arrCatsRootsMenu");
	$tInicial=microtime(true);
		$arrCatsRoots=\Sintax\ApiService\Categorias::arrCatsRootsMenu($GLOBALS['config']->tienda->key);
	$tTotal=microtime(true)-$tInicial;
	error_log('/** Excep. arrCatsRootsMenu: '.round($tTotal,4));
		//$db=\cDb::confByKey("celorriov3");
	//$GLOBALS['firephp']->error($db->ping(),"post arrCatsRootsMenu");
		$objCesta=$this->ensureCesta($db);
		$arrCestaItems=$objCesta->arrItemsJqCesta();
		$jsonArrCestaItems=htmlspecialchars(json_encode($arrCestaItems),ENT_QUOTES,'UTF-8');

		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}

	public function cuerpo() {
		//$objPageCategoria=new categoria($this->objUsr);
		//$objPageCategoria->cuerpo();

		$arrOfersBanner=\Sintax\ApiService\Categorias::arrOfersMayorDescuento($GLOBALS['config']->tienda->key,13);
		$arrOfersCuerpo=\Sintax\ApiService\Categorias::arrOfersMasVendidas($GLOBALS['config']->tienda->key,24);
		if (isset($_SESSION['usuario'])){
			$objCli=$_SESSION['usuario']->objEntity;
			$arrOfersCustom=\Sintax\ApiService\Categorias::arrOfersCustom($GLOBALS['config']->tienda->key,12,$objCli->GETid());
		}
		require_once( str_replace('//','/',dirname(__FILE__).'/') .'markup/cuerpo.php');
	}
	public function subMenu($idPadre){
		$arrCatsSubMenu=\Sintax\ApiService\Categorias::arrCatsRootsSubMenu($idPadre);
		return $arrCatsSubMenu;
	}
	public function acLogout() {
		// Unset all of the session variables.
		$_SESSION = array();
		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
			);
		}
		// Finally, destroy the session.
		session_destroy();
	}

	/**
	 * [acLogin description]
	 * @param  [type] $email [description]
	 * @param  [type] $pass  [description]
	 * @return [type]        [description]
	 */
	public function acLogin($email,$pass,$token) {
		if ($token!="") {//token de FB
			$result=\Sintax\ApiService\Clientes::acLoginClienteFB($email,$token,$GLOBALS['config']->tienda->key);
		} else {
			$result=\Sintax\ApiService\Clientes::acLoginCliente($email,$pass,$GLOBALS['config']->tienda->key);
		}
		return $result;
	}
	public function acSearchOfers ($query) {
		$db=\cDb::confByKey("celorriov3");
		$arr=\Multi_ofertaVenta::textSearch($db,$GLOBALS['config']->tienda->key,$query);
		$arrResults=array();
		foreach ($arr as $objOferta) {
			$std=$objOferta->toStdObj();
			$std->precio=$objOferta->pvp();
			$std->imgId=$objOferta->imgId();
			$std->imgSrc=$objOferta->imgSrc(0,100,100);
			//$std->descripcion=//parsear para quitar brs de mas
			array_push($arrResults, $std);
			$std->nombreHighlight=\Cadena::highlight(explode(' ',$query) ,$std->nombre,'highlight');
		}
		return $arrResults;
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
