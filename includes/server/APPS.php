<?
//Listamos todas las aplicaciones del proyecto asociando cada punto de entrada a la ruta y nombre de la APP
define ('APPS', serialize(array(
	'index.php' => array(
		'KEY_APP' => 'index.php',
		'FILE_APP' => 'index.php',
		'RUTA_APP' => SKEL_ROOT_DIR.'appFed16/',
		'NOMBRE_APP' => 'E-commerce Front End',
	),
	'sintax/index.php' => array(
		'KEY_APP' => 'sintax/index.php',//siempre igual que la key correspondiente del array APPS
		'FILE_APP' => 'index.php',
		'RUTA_APP' => SKEL_ROOT_DIR.'appZzzMeta/',
		'NOMBRE_APP' => 'Sintax tools',
	),
	'bridge.php' => array(
		'KEY_APP' => 'bridge.php',
		'FILE_APP' => 'bridge.php',
		'RUTA_APP' => SKEL_ROOT_DIR.'appVenta/',
		'NOMBRE_APP' => 'appVenta',
	),
)));
/*

define ('SKEL_ROOT_DIR',realpath(__DIR__.'/'.'/').'/');

	'bridge.php' => array(
		'KEY_APP' => 'bridge.php',
		'FILE_APP' => 'bridge.php',
		'RUTA_APP' => SKEL_ROOT_DIR.'appVenta/',
		'RUTA_APP' => SKEL_ROOT_DIR.'appFed16/',
		'NOMBRE_APP' => 'Sitio web',
	),
 */
?>