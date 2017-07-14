<?
mb_internal_encoding("UTF-8");
//El UTF-8 para la conexion a la db se establece en el constructor de MysqliDB

date_default_timezone_set('Europe/Madrid');

//No utilizo setlocale, en cuestion de numeros, hace que los floats tengan la , por separador decimal al
//convertirlos a cadena, lo que da problemas al construir sentencias SQL o mandar JSON a JS
//setlocale(LC_ALL,'es_ES');


require_once SKEL_ROOT_DIR."includes/server/IPS_DEV.php";
require_once SKEL_ROOT_DIR."includes/server/APPS.php";
require_once SKEL_ROOT_DIR."includes/server/DBS.php";
//requerimos las bibliotecas de servidor "estaticas" y el autoloader de composer
require_once SKEL_ROOT_DIR."includes/server/serverLibs.php";

/**/
//Inicializamos objeto de manejo de errores
$GLOBALS['ErrorHandler'] = $GLOBALS['firephp'] = \Sintax\Core\ErrorHandler::getInstance(true);

if (!in_array($_SERVER['REMOTE_ADDR'],unserialize(IPS_DEV))) {
	$GLOBALS['ErrorHandler']->setEnabled(false);
}
$GLOBALS['ErrorHandler']->registerErrorHandler($throwErrorExceptions=true);
$GLOBALS['ErrorHandler']->registerExceptionHandler();
/**/

/**/
define('PHP_MIN_VERSION','5.3.0');
define('SKEL_VERSION','1.0.0');

define('PROTOCOL',((isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']))?'https':'http'));
define('BASE_DOMAIN',(substr($_SERVER['HTTP_HOST'],0,4)=="www.")?substr($_SERVER['HTTP_HOST'],4):$_SERVER['HTTP_HOST']);
define('BASE_DIR',
	(dirname($_SERVER['SCRIPT_NAME'])=='/')?
		dirname($_SERVER['SCRIPT_NAME']):
		dirname($_SERVER['SCRIPT_NAME']).'/'
);//Directorio del punto de entrada. Tiene que terminar en / obligatoriamente
define('BASE_URL',PROTOCOL.'://'.BASE_DOMAIN.BASE_DIR);//URL hasta el directorio del punto de entrada
define('SKEL_ROOT_URL',
	PROTOCOL.'://'.(
		(dirname(SKEL_ROOT_DIR)!=dirname($_SERVER['DOCUMENT_ROOT']))?
			BASE_DOMAIN.\Filesystem::find_relative_path(SKEL_ROOT_DIR,$_SERVER['DOCUMENT_ROOT'])."/":BASE_DOMAIN
	).'/'
);//URL Correspondoiente a SKEL_ROOT_DIR. Tiene que terminar en / obligatoriamente

define('CACHE_DIR',SKEL_ROOT_DIR.'zCache/');
define('TMP_UPLOAD_DIR',SKEL_ROOT_DIR.'zCache/tmpUpload/');
define('BASE_IMGS_DIR',SKEL_ROOT_DIR.'binaries/imgs/');

define ('DEBUG_EMAIL','nestor@parqueweb.com');

define ('MODULES', serialize(array(
	'actions' => SKEL_ROOT_DIR.'zzModules/actions.php',
	'api' => SKEL_ROOT_DIR.'zzModules/api.php',
	'auto' => SKEL_ROOT_DIR.'zzModules/auto.php',
	'css' => SKEL_ROOT_DIR.'zzModules/css.php',
	'images' => SKEL_ROOT_DIR.'zzModules/images.php',
	'js' => SKEL_ROOT_DIR.'zzModules/js.php',
	'render' => SKEL_ROOT_DIR.'zzModules/render.php',
	'phpunit' => SKEL_ROOT_DIR.'zzModules/phpunit.php',
)));

/* Comprobamos versión suficiente de PHP **************************************/
if (version_compare(PHP_VERSION, PHP_MIN_VERSION, '<')) {
	die ('Sintax '.SKEL_VERSION.' requiere al menos PHP '.PHP_MIN_VERSION.'. Detectado PHP ' . PHP_VERSION . ". Proceso abortado.");
}

/* Instalamos componentes de composer *****************************************/
	if (!class_exists('\\Less_Parser')) {
		switch (PHP_SAPI) {
			case 'cgi-fcgi':
			case 'fpm-fcgi':
				$sapiOk=true;
				break;
			default:
				$sapiOk=false;
				break;
		}
		$gitOk=(`git --version`)?true:false;

		header('Content-Type: text/html; charset=utf-8');
		echo '<style type="text/css">pre {border:inset black 3px; background-color:#c0c0c0; font-family:monospace; max-height:300px; overflow:auto;}</style>';
		echo '<h1>Detectada primera ejecución</h1>';
		echo '<h2>';
		echo "Fichero ejecutado: ".$_SERVER["SCRIPT_FILENAME"];;
		echo '<br />';
		echo "Propietario del fichero (get_current_user): ".get_current_user();
		echo '<br />';
		echo "Usuario bajo el que corre el script (whoami): ".exec('whoami');
		echo '</h2>';
		echo '
		<h3>Prerequisitos:
			<ul>
				<li>PHP SAPI ('.PHP_SAPI.')...'.( ($sapiOk)?'OK':'NOOK' ).'</li>
				<li>Git disponible (version: ['.`git --version`.'])...'.( ($gitOk)?'OK':'NOOK' ).'</li>
			</ul>
		</h3>';

		if ($sapiOk && $gitOk) {
			putenv('COMPOSER_HOME=' . SKEL_ROOT_DIR);
			$descriptorspec = array(
				//0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
				1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
				2 => array("pipe", "w"),  // stderr is a pipe that the child will write to
			);
			$cmd='php -c '.php_ini_loaded_file().' '.SKEL_ROOT_DIR.'includes/server/vendor/composer.phar install --optimize-autoloader --no-interaction -d "'.SKEL_ROOT_DIR.'" --profile';
			echo "<h2>Ejecutando: [".$cmd."] en getcwd: [".getcwd()."]</h2>";
			die("Parada mediante die, suele compensar ejecutar el comando desde consola en lugar de hacerlo a traves de apache");
			ob_flush();

			$process = proc_open($cmd, $descriptorspec, $pipes);
			$stdout = stream_get_contents($pipes[1]);
			fclose($pipes[1]);
			$stderr = stream_get_contents($pipes[2]);
			fclose($pipes[2]);
			echo '<h3>STDOUT</h3>';
			echo '<pre>'.$stdout.'</pre>';
			echo '<h3>STDERR</h3>';
			echo '<pre>'.$stderr.'</pre>';

			if (file_exists(SKEL_ROOT_DIR.'cache')) {
				echo '<h4>Composer ha creado el directorio "'.SKEL_ROOT_DIR.'cache", eliminado directorio</h4>';
				\Filesystem::delTree(SKEL_ROOT_DIR.'cache');
			}

			/*echo
				'DOCUMENT_ROOT: '.$_SERVER['DOCUMENT_ROOT'].'<br />'.
				'SCRIPT_FILENAME: '.$_SERVER['SCRIPT_FILENAME'].'<br />'.
				'SKEL_ROOT_DIR: '.SKEL_ROOT_DIR.'<br />'.
				'BASE_DIR: '.BASE_DIR.'<br />'.
				'BASE_URL: '.BASE_URL.'<br />';*/

			echo '
				<hr />
					Continuar:
					<ul>
						<li>Editar .htaccess de las apps definidas:
							<ul>';
			$arrApps=unserialize(APPS);
			foreach ($arrApps as $appkey => $appData) {
				echo '
								<li>
								'.$appData['NOMBRE_APP'].': '.dirname(SKEL_ROOT_DIR.$appkey).'/.htaccess ->
								</li>';
			}
			echo '
							</ul>
						</li>
						<li><a href="'.BASE_URL.'sintax/">Página principal de S!nt@x</a></li>
						<li><a href="'.BASE_URL.'sintax/creacion/">Herramienta de creación</a></li>
						<li>Bibliotecas de cliente: <a href="'.BASE_URL.'sintax/composer/">Composer</a></li>
					</ul>
			';
		} else {
			echo '
				<h4>Requisitos no satifechos...proceso abortado</h4>
			';
		}
		die();
	}
/******************************************************************************/

//Definimos todas las constantes de la aplicacion correspondiente al punto de entrada
$arrApps=unserialize(APPS);
$appKey=\Filesystem::find_relative_path(SKEL_ROOT_DIR,$_SERVER['SCRIPT_FILENAME']);
if (isset($arrApps[$appKey])) {
	foreach ($arrApps[$appKey] as $key => $value) {
		define ($key,$value);
	}
} else {
	throw new \Exception("No encontrada APP con clave: ".$appKey,1);
}

require_once SKEL_ROOT_DIR."includes/server/clientLibs.php";

if (defined('RUTA_APP')) {
	if (file_exists(RUTA_APP."server/appDefines.php")) {
		require_once RUTA_APP."server/appDefines.php";
		if (file_exists(RUTA_APP."server/appClasesPHP.php")) {
			require_once RUTA_APP."server/appClasesPHP.php";
		}
		if (file_exists(RUTA_APP."server/appAuto.php")) {
			require_once RUTA_APP."server/appAuto.php";
		}
		if (file_exists(RUTA_APP."server/appApi.php")) {
			require_once RUTA_APP."server/appApi.php";
		}
	} else {
		error_log("/**/");
		error_log("/*".__FILE__.":".__LINE__."*/");
		error_log("URI: ".$_SERVER['REQUEST_URI']);
		error_log("RUTA_APP: ".RUTA_APP);
		error_log("/**/");
		error_log("/**/");
		throw new Exception("Parametro RUTA_APP no contiene una APP valida (no existe ".RUTA_APP."server/appDefines.php)");
	}
} else {
	error_log("/**/");
	error_log("/*".__FILE__.":".__LINE__."*/");
	error_log("URI: ".$_SERVER['REQUEST_URI']);
	error_log("/**/");
	error_log("/**/");
	//throw new Exception("RUTA_APP no definida. La App a utilizar debe estar asociada al nombre del script (index.php, admin.php...) o ser suministrada en el parametro APP ");
	throw new Exception("RUTA_APP no definida. SCRIPT_NAME: ".$_SERVER['SCRIPT_NAME']." :-: Basename: ".basename($_SERVER['SCRIPT_NAME']));
}
?>