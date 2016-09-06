<?
//Listamos todas las aplicaciones del proyecto asociando cada punto de entrada a la ruta y nombre de la APP
define ('APPS', serialize(array(
	'index.php' => array(//Ruta relativa del punto de entrada y SKEL_ROOT_DIR
		'KEY_APP' => 'index.php',//siempre igual que la key correspondiente del array APPS
		'FILE_APP' => 'index.php',
		'RUTA_APP' => SKEL_ROOT_DIR.'appIndex/',
		'NOMBRE_APP' => 'App lanzada mediante /inedx.php',
	),
	'sintax/index.php' => array(//Ruta relativa del punto de entrada y SKEL_ROOT_DIR
		'KEY_APP' => 'sintax/index.php',//siempre igual que la key correspondiente del array APPS
		'FILE_APP' => 'index.php',
		'RUTA_APP' => SKEL_ROOT_DIR.'appZzzMeta/',
		'NOMBRE_APP' => 'Sintax tools',
	),
)));
?>