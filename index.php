<?
$tInicial=microtime(true);
?>
<?
define ('SKEL_ROOT_DIR',realpath(__DIR__.'/'.'./').'/');
$module='';
try {
	$X_FORWARDED_HOST=(isset($_SERVER['HTTP_X_FORWARDED_HOST']))?$_SERVER['HTTP_X_FORWARDED_HOST']:'';
	$X_FORWARDED_HOST=(substr($X_FORWARDED_HOST,0,4)=="www.")?substr($X_FORWARDED_HOST,4):$X_FORWARDED_HOST;
	//$X_FORWARDED_FOR=(isset($_SERVER['X_FORWARDED_FOR']))?$_SERVER['X_FORWARDED_FOR']:NULL;
	//$X_FORWARDED_SERVER=(isset($_SERVER['X_FORWARDED_SERVER']))?$_SERVER['X_FORWARDED_SERVER']:NULL;

	$defaultDomain='bebefarma.com';
	$activeDomain=($X_FORWARDED_HOST!='')?$X_FORWARDED_HOST:$defaultDomain;
	if ($X_FORWARDED_HOST!='') {define('BASE_DOMAIN',$activeDomain);}

	require_once SKEL_ROOT_DIR."/includes/server/start.php";

	$arrDomains=unserialize(ARR_DOMAINS);
	$arrTiendas=unserialize(ARR_TIENDAS);
	$keyTienda=$arrDomains[$activeDomain]->keyTienda;
	$GLOBALS['config']=new \stdClass();
	$GLOBALS['config']->tienda=new \stdClass();
	$GLOBALS['config']->tienda=(object) $arrTiendas[$keyTienda];
	$GLOBALS['config']->tienda->key=$keyTienda;
	session_name ($arrDomains[$activeDomain]->session_name);
	$GLOBALS['session_name']=$_REQUEST['session_name']=$arrDomains[$activeDomain]->session_name;


	$module=(isset($_REQUEST['MODULE']))?strtolower($_REQUEST['MODULE']):"render";
	if (isset($_REQUEST['MODULE'])) {unset ($_REQUEST['MODULE']);}
	if (isset($_POST['MODULE'])) {unset ($_POST['MODULE']);}
	if (isset($_GET['MODULE'])) {unset ($_GET['MODULE']);}
	$arrModules=unserialize(MODULES);
	if (array_key_exists($module,$arrModules)) {
		require $arrModules[$module];
	} else {
		throw new Exception("El módulo '".$module."' no se encuentra.", 1);
	}
} catch (Exception $e) {
	$infoExc="CATCH RAIZ: Excepcion de tipo: ".get_class($e).". Mensaje: ".$e->getMessage()." en fichero ".$e->getFile()." en linea ".$e->getLine();
	error_log ($infoExc);
	header('HTTP/1.1 500 Internal Server Error',true,500);
	echo ("CATCH RAIZ: ".$e->getMessage());
}
$tTotal=microtime(true)-$tInicial;
error_log (basename(__FILE__)."?".$module." ejecutado en: ".round($tTotal,3)." segundos.");
?>