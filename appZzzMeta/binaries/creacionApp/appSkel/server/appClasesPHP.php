<?
spl_autoload_register(function ($clase) {
	//$claseSinNameSpace=explode('\\',$clase);
	//$clase = end($claseSinNameSpace);
	$clase = basename(str_replace('\\', '/', $clase));
	$fileList=Filesystem::folderSearch(dirname(__FILE__).DIRECTORY_SEPARATOR.'clases'.DIRECTORY_SEPARATOR,'/.*\/'.$clase.'.php$/');
	foreach ($fileList as $filePath) {
		if (file_exists($filePath)) {
			require_once($filePath);
			return;
		}
	}
	$fileList=Filesystem::folderSearch(dirname(__FILE__).DIRECTORY_SEPARATOR.
		'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'appZzShared'.DIRECTORY_SEPARATOR.'server'.DIRECTORY_SEPARATOR.'clases'.DIRECTORY_SEPARATOR,
		'/.*\/'.$clase.'.php$/');
	foreach ($fileList as $filePath) {
		if (file_exists($filePath)) {
			require_once($filePath);
			return;
		}
	}
});
?>
