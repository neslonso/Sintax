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
	}
	public function css() {
		parent::css();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css.php");
	}
	public function markup() {
		$this->acLoginCliente('soporte','bfSupp');
		//$this->acLogout();
		$db=\cDb::confByKey('celorriov3');
		$objCli=$_SESSION['usuario']->objEntity;
		$objCli->SETdb($db);
		$cliente=$objCli->toStdObj();
		$cliente->saldo=$objCli->saldoCredito();
		$GLOBALS['firephp']->info($cliente,"objCli");
		$arrCatsRoots=\Sintax\ApiService\Categorias::arrCatsRootsMenu($GLOBALS['config']->tienda->key);
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}
	public function cuerpo() {
		$arrProds=\Sintax\ApiService\Productos::arrRandomOfertasVenta(18,$GLOBALS['config']->tienda->key);
		require_once( str_replace('//','/',dirname(__FILE__).'/') .'markup/cuerpo.php');
	}
	public function subMenu($idPadre){
		$arrCatsSubMenu=\Sintax\ApiService\Categorias::arrCatsRootsSubMenu($idPadre);
		return $arrCatsSubMenu;
	}
	/**
	 * [acLoginCliente description]
	 * @param  string $email [description]
	 * @param  string $pass  [description]
	 * @return void
	 */
	public function acLoginCliente($email,$pass) {
		$db=\cDb::confByKey("celorriov3");
		$objCliUser=\Multi_clienteUser::login($db,$email,$pass,$GLOBALS['config']->tienda->key);
		if ($objCliUser!==false) {
			$_SESSION['usuario']=$objCliUser;
		} else {
			throw new \Exception("Dirección de email o contraseña incorrecta.", 1);
		}
	}
	/**
	 * Destruye la variables de sesion, la cookie y la sesion actual
	 * @return void
	 */
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

	public function acAddToCesta ($idMulti_ofertaVenta) {
		$db=\cDb::confByKey('celorriov3');
		$objCesta=new \Multi_cesta($db);
		if (isset($_SESSION['cesta'])) {
			$class=get_class($_SESSION['cesta']);
			if ($class=="Multi_cesta") {
				$objCesta=$_SESSION['cesta'];
				$objCesta->SETdb($db);
			} else {
				unset ($_SESSION['cesta']);
			}
		}
		if (isset($_SESSION['usuario'])) {
			$objCli=$_SESSION['usuario']->objEntity;
			$objCesta->SETidMulti_cliente($objCli->GETid());
			$objCesta->grabar();
		}
		$objLinea=$objCesta->getLineaOfertaOrNew($idMulti_ofertaVenta);
		$objLinea->SETcantidad($objLinea->GETcantidad()+1);
		$objLinea->SETidMulti_cesta($objCesta->GETid());
		$objLinea->SETidMulti_ofertaVenta($idMulti_ofertaVenta);
		$objLinea->grabar();
		$_SESSION['cesta']=$objCesta;
		return true;
	}
}
?>
