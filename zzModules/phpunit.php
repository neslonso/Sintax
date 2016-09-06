<?
ob_start();
?>
<?
# error reporting
//ini_set('display_errors',1);
//error_reporting(E_ALL|E_STRICT);

header('Content-Type: text/html; charset=utf-8');
session_start();

$arrTests=array();
$test=(isset($_GET['test']))?$_GET['test']:'';
if ($test=='') {
	$fileList=Filesystem::folderSearch(SKEL_ROOT_DIR,'/.*\/clases\/.*\/test[^\/]+\.php$/');
	usort($fileList, function ($a,$b) {
		if (filemtime($a) === filemtime($b)) return 0;
		return filemtime($a) > filemtime($b) ? -1 : 1;
	});
	foreach ($fileList as $filePath) {
		if (file_exists($filePath)) {
			$arrTests[]='Sintax\\Tests\\'.basename($filePath,".php");
		}
	}
} else {
	$arrTests[]='Sintax\\Tests\\'.$test;
}

if (count($arrTests)==0) {throw new Exception("Ninguna clase de test encontrada.", 1);}

$objUsr=new Sintax\Core\AnonymousUser();
if (isset($_SESSION['usuario'])) {
	//$objUsr=$_SESSION['usuario'];
	$usrClass=get_class($_SESSION['usuario']);
	if ($usrClass!="__PHP_Incomplete_Class") {
		$objUsr=$_SESSION['usuario'];
	} else {
		unset ($_SESSION['usuario']);
	}
}

define ('PHPUNIT_TESTSUITE',1);//Para que PHPUnit no nos cierre los buffers
/*//Si tenemos runkit, podemos alterar la funcion blacklist para que no tenga en cuenta la constante anterior
runkit_method_rename('PHPUnit_Util_Blacklist','isBlacklisted','isBlacklisted_Original');
runkit_method_add('PHPUnit_Util_Blacklist','isBlacklisted','$file','
	runkit_constant_remove("PHPUNIT_TESTSUITE");
	$result=$this->isBlacklisted_Original($file);
	runkit_constant_add("PHPUNIT_TESTSUITE",1);
	return $result;
',RUNKIT_ACC_PUBLIC);
*/

foreach ($arrTests as $testClass) {
	if (class_exists($testClass)) {
		$suite = new PHPUnit_Framework_TestSuite($testClass);
		$arguments=array();
		$arguments['coverageHtml']=1; //<- Necesita Xdebug, el php de nx614 no lo tiene.

		$arguments['verbose']=true;
		$arguments['debug']=true;

		//$arguments['testdoxHTMLFile']=TMP_UPLOAD_DIR.'phpunit.testdoxHTMLFile.html';
		//$arguments['testdoxTextFile']=TMP_UPLOAD_DIR.'phpunit.testdoxHTMLFile.txt';
		$buffer='';
		ob_start();
			PHPUnit_TextUI_TestRunner::run($suite,$arguments);
		$buffer=ob_get_clean();

		$lines = explode("\n", $buffer);
		$include = array();
		foreach ($lines as $line) {
			if (strpos($line, 'phar:') !== FALSE) {
				continue;
			}
			$include[] = $line;
		}
		$buffer=implode("\n", $include);
		echo "<h1>Ejecutando PHPUnit para el testCase: <code>".$testClass."</code></h1>";
		echo "<pre>".$buffer."</pre>";
		unset($suite);
	} else {
		throw new Exception("No se encontró la clase de test: ".$testClass, 1);
	}
}
?>