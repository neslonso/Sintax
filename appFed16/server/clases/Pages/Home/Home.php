<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
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
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js/jsCesta.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js/jsBuscador.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js/jsBanner.php");
	}
	public function css() {
		parent::css();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css.php");
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
		$arrCatsRoots=\Sintax\ApiService\Categorias::arrCatsRootsMenu($GLOBALS['config']->tienda->key);
		//$db=\cDb::confByKey("celorriov3");
	//$GLOBALS['firephp']->error($db->ping(),"post arrCatsRootsMenu");
		$objCesta=$this->ensureCesta($db);
		$arrCestaItems=$objCesta->arrItemsJqCesta();
		$jsonArrCestaItems=htmlspecialchars(json_encode($arrCestaItems),ENT_QUOTES,'UTF-8');

		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}

	public function cuerpo() {
		//$arrProds=\Sintax\ApiService\Productos::arrRandomOfertasVenta(23,$GLOBALS['config']->tienda->key);
		$arrProds=\Sintax\ApiService\Categorias::arrOfersMasVendidas($GLOBALS['config']->tienda->key,23);
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
	 * @return [type] [description]
	 */
	public function acLogin() {
		$result=\Sintax\ApiService\Clientes::acLoginCliente($_REQUEST['email'],$_REQUEST['pass'],$GLOBALS['config']->tienda->key);
		return json_decode($result);
	}
	public function acSearchOfers ($query) {
		$db=\cDb::confByKey("celorriov3");
		$like=implode("%", explode(" ",$query));
		$where="
			keyTienda='".$GLOBALS['config']->tienda->key."'
			AND (
				nombre LIKE '%".$like."%'
			)
		";
		$arr=\Multi_ofertaVenta::getArray($db,$where,"","","arrStdObjs");
		return $arr;
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
}
?>
