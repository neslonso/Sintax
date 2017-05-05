<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;

use Composer\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\Console\Output\BufferedOutput;

class composer extends Error implements IPage {
	public function __construct(User $objUsr=NULL) {
		parent::__construct($objUsr);
	}
	public function pageValida () {
		return $this->objUsr->pagePermitida($this);
		//return parent::pageValida();
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
		$pkgs=(isset($_GET['pkgs']))?$_GET['pkgs']:'';
		$cCmd['install']=$cCmd['update']=$cCmd['require']=$cCmd['remove']=$cCmd['search']=$cCmd['show']='';

		if (isset($_GET['cCmd'])) {
			$cCmd[$_GET['cCmd']]='checked="checked"';
		} else {
			$cCmd['search']='checked="checked"';
		}

		putenv('COMPOSER_HOME=' . SKEL_ROOT_DIR);
		$descriptorspec = array(
			//0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
			1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
			2 => array("pipe", "w"),  // stderr is a pipe that the child will write to
		);
		$cmd='php '.SKEL_ROOT_DIR.'includes/server/vendor/composer.phar --version';
		$process = proc_open($cmd, $descriptorspec, $pipes);
		$stdout = stream_get_contents($pipes[1]);
		fclose($pipes[1]);
		$stderr = stream_get_contents($pipes[2]);
		fclose($pipes[2]);
		unset($pipes);
		$composerVersion=$stdout;

		$arrInstalledLibs=self::getInstalledLibs(COMPOSER_ASSET_PLUGIN_PATH);

		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}

	public static function getInstalledLibs($libDirectoryPath) {
		$arrInstalledLibs=array();
		$arrBowerJsonFiles=\Filesystem::folderSearch($libDirectoryPath, '/.*bower.json|.*composer.json|.*component.json/');
		//echo "<pre>".print_r ($arrBowerJsonFiles,true)."</pre>";
		foreach ($arrBowerJsonFiles as $bowerJsonFilePath) {
			if (!isset($arrInstalledLibs[basename(dirname($bowerJsonFilePath))])) {
				$dotBowerJsonFilePath=dirname($bowerJsonFilePath).'/.'.$bowerJsonFilePath;
				if (file_exists($dotBowerJsonFilePath)) {
					$objBowerInfo=json_decode(file_get_contents($dotBowerJsonFilePath));
				} elseif (file_exists($bowerJsonFilePath)) {
					$objBowerInfo=json_decode(file_get_contents($bowerJsonFilePath));
				}

				$objLibData=new \stdClass();
				$objLibData->name='('.basename(dirname($dotBowerJsonFilePath)).') '.$objBowerInfo->name;
				$objLibData->version=(isset($objBowerInfo->version))?$objBowerInfo->version:'[NO DEFINIDA]';
				$objLibData->dependencies=(isset($objBowerInfo->dependencies))?(array)$objBowerInfo->dependencies:array();
				$objLibData->main=array();
				if (isset($objBowerInfo->main)) {
					$objLibData->main=(is_array($objBowerInfo->main))?$objBowerInfo->main:array(0 => $objBowerInfo->main);
				}

				$arrJsFiles=array();
				$arrCssFiles=array();
				$arrOtherFiles=array();
				$objLibData->js=array();
				$objLibData->css=array();
				$objLibData->less=array();
				$objLibData->otherFiles=array();

				foreach ($objLibData->main as $fileRelPath) {
					$baseURI="./".\Filesystem::find_relative_path(SKEL_ROOT_DIR,$libDirectoryPath)."/";
					$includeFilePath=$baseURI.basename(dirname($bowerJsonFilePath)).DIRECTORY_SEPARATOR.$fileRelPath;
					$fileExt=pathinfo($includeFilePath, PATHINFO_EXTENSION);
					switch ($fileExt) {
						case 'js':
							if (!in_array($includeFilePath,$arrJsFiles)) {
								$objLibData->js[]=$includeFilePath;
							}
							break;
						case 'css':
							if (!in_array($includeFilePath,$arrCssFiles)) {
								$objLibData->css[]=$includeFilePath;
							}
							break;
						case 'less':
							if (!in_array($includeFilePath,$arrCssFiles)) {
								$objLibData->less[]=$includeFilePath;
							}
							break;
						default:
							if (!in_array($includeFilePath,$arrOtherFiles)) {
								$objLibData->otherFiles[]=$includeFilePath;
							}
							break;
					}
				}

				$arrInstalledLibs[basename(dirname($bowerJsonFilePath))]=$objLibData;
				unset($objLibData);
			}
		}
		return $arrInstalledLibs;
	}

	public static function getArrLibsApps($libDirectoryPath,$globalIncludeFilename,$localIncludeFilename) {
		$arrLibsApps=array();
		$arrApps=unserialize(APPS);
		$arrApps['GLOBAL']=array('RUTA_APP' => SKEL_ROOT_DIR);

		$arrInstalledLibs=self::getInstalledLibs($libDirectoryPath);
		foreach ($arrInstalledLibs as $libName => $objLibData) {
			foreach ($arrApps as $entryPoint => $arrAppData) {
				if ($entryPoint=='GLOBAL') {
					$scopeName="GLOBAL";
					$componentsFilePath=$arrAppData['RUTA_APP'].'includes/cliente/'.$globalIncludeFilename;
				} else {
					$scopeName=$entryPoint;
					$componentsFilePath=$arrAppData['RUTA_APP'].'cliente/'.$localIncludeFilename;
				}
				$componentsContent='';
				try {
					$componentsContent=file_get_contents($componentsFilePath);
				} catch (\Exception $e) {
					$fp=\FirePHP::getInstance(true);
					$fp->error('Excepcion en getArrLibsApps. Msg: '.$e->getMessage());
				}
				if (
					strstr($componentsContent, "<!-- ".$libName." -->") ||
					strstr($componentsContent, basename(trim(COMPOSER_ASSET_PLUGIN_PATH,'/'))."/".$libName."") ) {
					$arrLibsApps[$libName][$scopeName]=1;
				} else {
					$arrLibsApps[$libName][$scopeName]=0;
				}
			}
		}
		return $arrLibsApps;
	}

	private static function includeAppLibs($arrAppData,$arrInstalledLibs,$arrLibsApps,$globalIncludeFilename,$localIncludeFilename) {
		if (is_null($arrAppData)) {
			$scopeName="GLOBAL";
			$componentsFilePath=SKEL_ROOT_DIR.'includes/cliente/'.$globalIncludeFilename;
		} else {
			$scopeName=$arrAppData['KEY_APP'];
			$componentsFilePath=$arrAppData['RUTA_APP'].'cliente/'.$localIncludeFilename;
		}

		if (!file_exists($componentsFilePath)) {if (!touch($componentsFilePath)) {throw new \ActionException('Fichero components no pudo ser creado ('.$componentsFilePath.')', 1);return;}}

		//file_put_contents($componentsFilePath,'');
		$arrComponents=$arrInstalledLibs;
		$arrComponentsProcessed=array();
		$componentsContent='<!-- Fichero generado automaticamente. No editar. -->'.PHP_EOL;
		$i=0;
		while (count($arrComponents)>count($arrComponentsProcessed)) {
			$i++;
			if ($i>1000) {
				file_put_contents($componentsFilePath,$componentsContent);
				throw new \ActionException('No se pudieron satisfacer las dependencias ['.$scopeName.']', 1);
			}
			foreach ($arrComponents as $componentName => $objComponentInfo) {
				$dependenciesSatisfied=true;
				foreach ($objComponentInfo->dependencies as $dependencyName => $dependencyVersion) {
					if (!in_array($dependencyName, $arrComponentsProcessed)) {
						$dependenciesSatisfied=false;
					}
				}
				if ($dependenciesSatisfied) {
					if (!in_array($componentName, $arrComponentsProcessed)) {
						if (isset($arrLibsApps[$componentName])) {
							if (isset($arrLibsApps[$componentName][$scopeName])) {
								if ($arrLibsApps[$componentName][$scopeName]!=1) {
									echo "Excluido: ".$componentName."<br />".PHP_EOL;
									//echo 'C: '.$componentName.' :: S: '.$scopeName.' :: a[c][s]:'.$arrLibsApps[$componentName][$scopeName]."<br />".PHP_EOL;
									$arrComponentsProcessed[]=$componentName;
									continue;
								}
							}
						}
						echo "Incluido: ".$componentName."<br />\n";
						$arrComponentsProcessed[]=$componentName;
						$ningunFile=true;
						foreach ($objComponentInfo->js as $jsFilePath) {
							$componentsContent.='<!-- '.$componentName.' --><script src="'.$jsFilePath.'"></script>'.PHP_EOL;
							echo '<li>Incluido: '.$jsFilePath.'</li>';
							$ningunFile=false;
						}
						foreach ($objComponentInfo->css as $cssFilePath) {
							$componentsContent.='<!-- '.$componentName.' --><link href="'.$cssFilePath.'" rel="stylesheet">'.PHP_EOL;
							echo '<li>Incluido: '.$cssFilePath.'</li>';
							$ningunFile=false;
						}
						foreach ($objComponentInfo->less as $lessFilePath) {
							$componentsContent.='<!-- '.$componentName.' --><link href="'.$lessFilePath.'" rel="stylesheet">'.PHP_EOL;
							echo '<li>Incluido: '.$lessFilePath.'</li>';
							$ningunFile=false;
						}
						foreach ($objComponentInfo->otherFiles as $otherFilesFilePath) {
							//$componentsContent.='<!-- '.$componentName.' --><link href="'.$cssFilePath.'" rel="stylesheet">'.PHP_EOL;
							echo '<li>Fichero de tipo desconocido. NO INCLUIDO: '.$otherFilesFilePath.'</li>';
							$ningunFile=false;
						}
						if ($ningunFile) {
							echo '<li>OJO!!: no se encuentra ningún fichero para '.$componentName.'</li>';
						}
					}
				}
			}
		}
		file_put_contents($componentsFilePath,$componentsContent);
	}

	public static function generateAssetsFiles ($arrLibsApps,$libDirectoryPath,$globalIncludeFilename,$localIncludeFilename) {
		echo "<h2>Generando ".$globalIncludeFilename." / ".$localIncludeFilename."</h2>";
		//Quitamos todo lo que esté en global de las apps
		foreach ($arrLibsApps as $libName => $arrLibData) {
			if ($arrLibData['GLOBAL']==1) {
				foreach ($arrLibData as $scopeName => $siempre1) {
					if ($scopeName!='GLOBAL') {
						$arrLibsApps[$libName][$scopeName]=0;
					}
				}
			}
		}
		//echo "arrLibsApps: <pre>".print_r ($arrLibsApps,true)."</pre>";

		echo "<h3>GLOBAL</h3>";
		try {
			self::includeAppLibs(NULL,self::getInstalledLibs($libDirectoryPath),$arrLibsApps,$globalIncludeFilename,$localIncludeFilename);
		} catch (\Exception $e) {
			echo 'Excepcion incluyendo libs. Msg: '.$e->getMessage();
		}

		$arrApps=unserialize(APPS);
		foreach ($arrApps as $entryPoint => $arrAppData) {
			echo '<h3>'.$entryPoint.' ('.$arrAppData['NOMBRE_APP'].')</h3>';
			try {
				self::includeAppLibs($arrAppData,self::getInstalledLibs($libDirectoryPath),$arrLibsApps,$globalIncludeFilename,$localIncludeFilename);
			} catch (\Exception $e) {
				echo 'Excepcion incluyendo libs. Msg: '.$e->getMessage();
			}
			echo "<hr />";
		}
	}

	public function acUpdate ($args) {
		putenv('COMPOSER_HOME=' . SKEL_ROOT_DIR);
		$descriptorspec = array(
			//0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
			1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
			2 => array("pipe", "w"),  // stderr is a pipe that the child will write to
		);
		$cmd='php '.SKEL_ROOT_DIR.'includes/server/vendor/composer.phar self-update';
		echo "<h2>Ejecutando: ".$cmd."</h2>";
		$process = proc_open($cmd, $descriptorspec, $pipes);
		$stdout = stream_get_contents($pipes[1]);
		fclose($pipes[1]);
		$stderr = stream_get_contents($pipes[2]);
		fclose($pipes[2]);

		echo "<h3>STDOUT</h3>";
		echo "<pre>".$stdout."</pre>";
		echo "<h3>STDERR</h3>";
		echo "<pre>".$stderr."</pre>";
	}

	public function acExec ($args) {
		$pkgs=$args['composerPkgs'];
		$cCmd=$args['cCmd'];
		$dryRun=($args['dryRun']==1)?' --dry-run ':'';
		$verbose=($args['verbose']==1)?' --verbose ':'';
		$opts=' --no-interaction -d "'.SKEL_ROOT_DIR.'" '.$verbose;
		switch ($cCmd) {
			case "install":$opts.='--optimize-autoloader '.$dryRun;break;
			case "update":$opts.='--with-dependencies '.$dryRun;break;
			break;
			case "require":
			case "remove":
				$opts.='--update-with-dependencies ';break;
			case "search":
				if ($pkgs=='') {
					throw new \ActionException('Debe introducir el paquete.', 1);
				}
				break;
			case "show":
				$opts.='--all ';break;
			default:
				throw new \ActionException('Comando "'.htmlspecialchars($cCmd).'" no válido o no implementado', 1);
			break;
		}
		putenv('COMPOSER_HOME=' . SKEL_ROOT_DIR);
		$descriptorspec = array(
			//0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
			1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
			2 => array("pipe", "w"),  // stderr is a pipe that the child will write to
		);
		$cmd='php -c '.php_ini_loaded_file().' '.SKEL_ROOT_DIR.'includes/server/vendor/composer.phar '.$cCmd.' '.$pkgs.' '.$opts;
		echo "<h2>Ejecutando: [".$cmd."] en getcwd: [".getcwd()."]</h2>";
		$process = proc_open($cmd, $descriptorspec, $pipes);
		$stdout = stream_get_contents($pipes[1]);
		fclose($pipes[1]);
		$stderr = stream_get_contents($pipes[2]);
		fclose($pipes[2]);


		echo "<h3>STDOUT</h3>";
		echo "<pre>".$stdout."</pre>";
		echo "<h3>STDERR</h3>";
		echo "<pre>".$stderr."</pre>";
		/**/

		if (file_exists(SKEL_ROOT_DIR.'cache')) {
			echo '<h4>Composer ha creado el directorio "'.SKEL_ROOT_DIR.'cache", eliminado directorio</h4>';
			\Filesystem::delTree(SKEL_ROOT_DIR.'cache');
		}

		/*if (is_resource($process)) {
			// $pipes now looks like this:
			// 0 => writeable handle connected to child stdin
			// 1 => readable handle connected to child stdout
			// Any error output will be appended to /tmp/error-output.txt

			fwrite($pipes[0], '<?php print_r($_ENV); ?>');
			fclose($pipes[0]);

			echo stream_get_contents($pipes[1]);
			fclose($pipes[1]);

			// It is important that you close any pipes before calling
			// proc_close in order to avoid a deadlock
			$return_value = proc_close($process);

			echo "command returned $return_value\n";
		}*/
	}

	public function acGenerateComposerAssetPluginComponentsFiles($args) {
		$arrLibsApps=$args['arrLibsApps'];
		self::generateAssetsFiles($arrLibsApps,COMPOSER_ASSET_PLUGIN_PATH,'composerAssetPluginComponents.php','appComposerAssetPluginComponents.php');
	}
}
?>
