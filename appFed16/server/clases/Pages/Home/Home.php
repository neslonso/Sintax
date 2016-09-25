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
		$obj=new \Sintax\ApiService\Categorias ();
		$arrCatsRoots=$obj->arrCatsRootsMenu($GLOBALS['config']->tienda->key);
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}
	public function cuerpo() {
		$obj=new \Sintax\ApiService\Productos ();
		$arrProds=$obj->arrRandomOfertasVenta(18,$GLOBALS['config']->tienda->key);
		require_once( str_replace('//','/',dirname(__FILE__).'/') .'markup/cuerpo.php');
	}
	public function subMenu($idPadre){
		$obj=new \Sintax\ApiService\Categorias ();
		$arrCatsSubMenu=$obj->arrCatsRootsSubMenu($idPadre);
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

}
?>
