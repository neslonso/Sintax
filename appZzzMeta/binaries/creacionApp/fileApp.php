<?
$tInicial=microtime(true);
?>
<?
define ('SKEL_ROOT_DIR',realpath(__DIR__.'/'.'./').'/');
$module='';
try {
	require_once SKEL_ROOT_DIR."/includes/server/start.php";
	$module=(isset($_REQUEST['MODULE']))?strtolower($_REQUEST['MODULE']):"render";

	$GLOBALS['logger']->group('Ejecución de Módulo: '.$module, array('Collapsed' => true, 'Color' => '#FF9933'));

	if (isset($_REQUEST['MODULE'])) {unset ($_REQUEST['MODULE']);}
	if (isset($_POST['MODULE'])) {unset ($_POST['MODULE']);}
	if (isset($_GET['MODULE'])) {unset ($_GET['MODULE']);}
	$arrModules=unserialize(MODULES);
	if (array_key_exists($module,$arrModules)) {
		require $arrModules[$module];
	} else {
		throw new Exception("El módulo '".$module."' no se encuentra.", 1);
	}
	$GLOBALS['logger']->groupend();

	$tTotal=microtime(true)-$tInicial;
	$tStr=basename(__FILE__)."?".$module." ejecutado en: ".round($tTotal,3)." segundos.";
	$GLOBALS['logger']->info($tStr);
	error_log ($tStr);
} catch (Exception $e) {
	$infoExc="CATCH RAIZ: Excepcion de tipo: ".get_class($e).". Mensaje: ".$e->getMessage()." en fichero ".$e->getFile()." en linea ".$e->getLine();
	error_log ($infoExc);
	header('HTTP/1.1 500 Internal Server Error',true,500);
	echo ("CATCH RAIZ: ".$e->getMessage());
}
?>