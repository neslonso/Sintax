<?
$minify=false;//true no funciona del todo bien, debe existir algun problema en la clase JSMin
ob_start();
?>
<?
try {
	header('Content-type: text/javascript; charset=utf-8');
	session_cache_limiter('public');
	$sSession=\Sintax\Core\Session::gI(KEY_APP);
	header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 60*60*24*364));
/*header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");*/

	$page=(isset($_GET['page']))?$_GET['page']:'Home';

	$objUsr=new Sintax\Core\AnonymousUser();
	if (isset($sSession['usuario'])) {
		$usrClass=get_class($sSession['usuario']);
		if ($usrClass!="__PHP_Incomplete_Class") {
			$objUsr=$sSession['usuario'];
		} else {
			unset ($sSession['usuario']);
		}
	}

	/* Js Libs ********************************************************************/
	$arrFilesModTime=array();
	$arrFilesModTime[$_SERVER['SCRIPT_FILENAME']]=getlastmod();//Fecha de modificacion del punto de entrada
	$arrFilesModTime[__FILE__]=filemtime(__FILE__);//Fecha de modificacion de este fichero
	$arrFilesModTime[SKEL_ROOT_DIR."includes/server/start.php"]=filemtime(SKEL_ROOT_DIR."includes/server/start.php");
	ob_start();
		$firephp->group("Incluyendo Libs de ARR_CLIENT_LIBS", array('Collapsed' => true, 'Color' => '#FF6600'));
		foreach ($ARR_CLIENT_LIBS as $libPath) {
			try {
				$firephp->info($libPath,"Incluyendo");
				include $libPath;
				$arrFilesModTime[$libPath]=filemtime($libPath);
			} catch (Exception $e) {
				$infoExc="Excepcion de tipo: ".get_class($e).". Mensaje: ".$e->getMessage()." en fichero ".$e->getFile()." en linea ".$e->getLine();
				$firephp->warn($infoExc);
				$firephp->warn($e->getTraceAsString(),"traceAsString");
			}
		}
		$firephp->groupEnd();
	$jsScriptTags=ob_get_clean();
	//$jsMinFile=CACHE_DIR."jsMin.".md5(serialize($arrFilesModTime)).".js";

	if ($jsScriptTags!="") {
		$srcs = array();
		try {
			$doc = new DOMDocument();
			$doc->loadHTML($jsScriptTags);
			$scriptElements = $doc->getElementsByTagName('script');

			for($i = 0; $i < $scriptElements->length; $i++) {
				$srcs[]=$scriptElements->item($i)->getAttribute('src');
				$src=$scriptElements->item($i)->getAttribute('src');
				if (substr($src,0,1)=='.') {$src=SKEL_ROOT_DIR.$src;}
				try {
					$arrFilesModTime[$src]=filemtime($src);
				} catch (Exception $e) {}
			}
		} catch (Exception $e) {
			$infoExc="Excepcion de tipo: ".get_class($e).". Mensaje: ".$e->getMessage()." en fichero ".$e->getFile()." en linea ".$e->getLine();
			error_log ($infoExc);
			error_log ("TRACE: ".$e->getTraceAsString());
			$firephp->info($infoExc);
		}

		$jsMinFile=CACHE_DIR.
			str_replace(DIRECTORY_SEPARATOR, '', (dirname($_SERVER['SCRIPT_NAME'])==DIRECTORY_SEPARATOR)?'raiz':dirname($_SERVER['SCRIPT_NAME']) ).
				".".md5(serialize($arrFilesModTime)).".js";
		$firephp->info($jsMinFile,'jsFile:');
		$firephp->group('Fechas de ficheros', array('Collapsed' => true, 'Color' => '#FF9933'));
		foreach ($arrFilesModTime as $filePath => $modTimeStamp) {
			$firephp->info(gmdate('D, d M Y H:i:s \G\M\T',$modTimeStamp),$filePath);
		}
		$firephp->groupend();

		if (file_exists($jsMinFile)) {
			$firephp->info($jsMinFile,'jsMinFile existe: Devolviendo JS cacheado:');
			/*
			$firephp->info(array_map(function ($elto) {
				return gmdate('D, d M Y H:i:s \G\M\T',$elto);
			},$arrFilesModTime),'Fechas de modificacion:');
			*/
			echo file_get_contents($jsMinFile);
		} else {
			$jsLibs="// Js Libs \n";
			$firephp->group('Carga de SRCs JS', array('Collapsed' => true, 'Color' => '#FF9933'));
			foreach ($srcs as $src) {
				$origSrc=$src;
				if (substr($src, 0,2)=='./') {
					$src=realpath(SKEL_ROOT_DIR.$src);
					if (!$src) {
						throw new Exception ('realpath ('.SKEL_ROOT_DIR.$origSrc.') devolvió false, ¿existe el fichero?.');
					}
				}
				if (substr($src, 0,2)=='//') {
					$src=PROTOCOL.":".$src;
				}
				$firephp->info($src,'Intentando file_get_contents:');
				try {
					$fileContent=file_get_contents($src)."\n\n";
					$jsLibs.=$fileContent."\n\n";
					//$jsLibs.=JSMin::minify($fileContent);
				} catch (Exception $e) {
					error_log ("js.php:: Imposible cargar '".$src."'");
					$infoExc="Excepcion de tipo: ".get_class($e).". Mensaje: ".$e->getMessage()." en fichero ".$e->getFile()." en linea ".$e->getLine().". origSrc: ".$origSrc;
					error_log ($infoExc);
					$firephp->error($infoExc,'Error cargando src "'.$src.'"');
				}
				//var_dump($http_response_header);
			}
			$firephp->groupend();
			$jsLibs.="\n// Js Libs Fin";
			if ($minify) {
				$jsMin=JSMin::minify($jsLibs);
			} else {
				$jsMin=$jsLibs;
			}
			file_put_contents($jsMinFile, $jsMin);
			echo $jsMin;
		}
	}
	/******************************************************************************/
?>
<?
	//Leemos todo lo que hemos ido volcando al buffer raiz y lo guardamos en el fichero
	$jsLibs=ob_get_clean();
	//$jsLibs="";
?>
<?
	/* js local *******************************************************************/
	ob_start();
		echo "// <![CDATA[ \n";
		$Page=new $page($objUsr);
		$Page->js();
		echo "\n// ]]> ";
	$jsLocal=ob_get_clean();

	if ($minify) {
		$jsLocalMin=JSMin::minify($jsLocal);
	} else {
		$jsLocalMin=$jsLocal;
	}
	$jsLocalMin="// JS LOCAL\n".$jsLocalMin."\n// JS LOCAL FIN\n";
	/* js local *******************************************************************/
?>
<?
ob_start();
//Volcamos todo (Libs + Local) al buffer
echo $jsLibs;
echo $jsLocalMin;
?>
<?
} catch (Exception $e) {
	$msg='Error durante la generación de js.php.';
	$infoExc="Excepcion de tipo: ".get_class($e).". Mensaje: ".$e->getMessage()." en fichero ".$e->getFile()." en linea ".$e->getLine();
	error_log ($infoExc);
	error_log ("TRACE: ".$e->getTraceAsString());
	$firephp->group($msg, array('Collapsed' => false, 'Color' => '#FF6600'));
	$firephp->info($infoExc);
	$firephp->info($e->getTraceAsString(),"traceAsString");
	$firephp->groupEnd();
	ob_clean();
	//echo '<h1>'.date("YmdHis").': '.$msg.'</h1>';
}
?>