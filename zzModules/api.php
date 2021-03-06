<?
ob_start();
?>
<?
$tInicial=microtime(true);
$uniqueId=uniqid("api.");
error_log ('');
error_log ('----------------------');
error_log ('/********************/');
error_log ('LLAMADA A API.PHP: '.$uniqueId);
?>
<?
try {
	/*$firephp->info($_SESSION,'$_SESSION');
	$firephp->info($_REQUEST,'$_REQUEST');
	$firephp->info($_POST,'$_POST');
	$firephp->info($_FILES,'$_FILES');*/

	$result="";
	//$_REQUEST['service']; <- Compatibilidad!!!!!!!!!!!!!!!!!!!!
	$apiClase=$_REQUEST['apiClase'];
	$apiClase="Sintax\\ApiService\\".$_REQUEST['apiClase'];
	$apiMetodo=$_REQUEST['apiMetodo'];
	$apiTipo=(isset($_REQUEST['apiTipo']))?$_REQUEST['apiTipo']:"noAssoc";
	unset ($_REQUEST['apiClase']);
	unset ($_REQUEST['apiMetodo']);

	$objUsr=new Sintax\Core\AnonymousUser();
	if (isset($_REQUEST['apiToken'])) {
		$sSession=\Sintax\Core\Session::gI(KEY_APP,$_REQUEST['apiToken']);
		if (isset($sSession['usuario'])) {
			$usrClass=get_class($sSession['usuario']);
			if ($usrClass!="__PHP_Incomplete_Class") {
				$objUsr=$sSession['usuario'];
			} else {
				unset ($sSession['usuario']);
			}
		}
	}

	if (class_exists($apiClase)) {
		$obj=new $apiClase($objUsr);
		$serviceValido=$obj->apiServiceValido();
		if ($serviceValido===true) {
			if (method_exists($obj,$apiMetodo)) {
				$metodoValido=$obj->metodoValido($apiMetodo);
				if ($metodoValido===true) {
					$phpSentence="";
					switch ($apiTipo) {
						case "noAssoc"://Los parametros vienen por POST, se pasan al metodo uno por uno
							$args="";
							foreach ($_REQUEST as $value) {
								$args.='"'.$value.'", ';
							}
							$args=substr($args,0,-2);
							$phpSentence='$resultSentence=$obj->'.$apiMetodo.'('.$args.');';
							break;
						case "assoc"://Los parametros vienen POST y se pasan al metodo como un array y despues se redirige el navegador
							$args=$_REQUEST;
							$phpSentence='$resultSentence=$obj->'.$apiMetodo.'($args);';
							break;
					}
					$phpSentence.='return true;';
					$tAccion=microtime(true);
						$resultEval=eval ($phpSentence);
					$tAccion=microtime(true)-$tAccion;

					if ($resultEval===false) {
						$result="ERROR_EN_SENTENCIA";
						throw new ApiException($result);
					} else {
						$result=$resultSentence;
						error_log(print_r($resultSentence,true));
						echo json_encode($resultSentence);
					}
				} else {
					throw new ApiException($apiMetodo." not valid");
				}
			} else {
				throw new ApiException($apiMetodo." not exists");
			}
		} else {
			throw new ApiException($apiClase." not valid");
		}
	} else {
		throw new ApiException($apiClase." not exists");
	}
} catch (Exception $e) {
	echo $e->getMessage();
	$infoExc="Excepcion de tipo: ".get_class($e).". Mensaje: ".$e->getMessage()." en fichero ".$e->getFile()." en linea ".$e->getLine();
	error_log ($infoExc);
	error_log ("TRACE: ".$e->getTraceAsString());

	mail (DEBUG_EMAIL,SITE_NAME.". API.PHP",
		$infoExc."\n\n--\n\n".$e->getTraceAsString()."\n\n--\n\n".print_r($GLOBALS,true));
}
?>
<?
error_log ("FIN LLAMADA A API.PHP: ".$uniqueId);
error_log ('/********************/');
error_log ('----------------------');
error_log ('');
?>
<?
class ApiException extends Exception {}
?>