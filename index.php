<?
$tInicial=microtime(true);
?>
<?
define ('SKEL_ROOT_DIR',realpath(__DIR__.'/'.'./').'/');
$module='';
try {
	require_once SKEL_ROOT_DIR."/includes/server/start.php";

	$X_FORWARDED_HOST=(isset($_SERVER['HTTP_X_FORWARDED_HOST']))?$_SERVER['HTTP_X_FORWARDED_HOST']:'';
	//$X_FORWARDED_FOR=(isset($_SERVER['X_FORWARDED_FOR']))?$_SERVER['X_FORWARDED_FOR']:NULL;
	//$X_FORWARDED_SERVER=(isset($_SERVER['X_FORWARDED_SERVER']))?$_SERVER['X_FORWARDED_SERVER']:NULL;
	$_REQUEST['session_name']=$X_FORWARDED_HOST;


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