<?
/**/
define ('ARR_DOMAINS',serialize(array (
	'celorriofarma.com' => (object) array('keyTienda' => 'CL','session_name' => 'clPHPSESSID',),
	'celorriofarma.es' => (object) array('keyTienda' => 'CL','session_name' => 'clPHPSESSID',),
	'subastafarma.com' => (object) array('keyTienda' => 'CL','session_name' => 'clPHPSESSID',),
	'farmadiscount.com' => (object) array('keyTienda' => 'FD','session_name' => 'fdPHPSESSID',),
	'parafarmaciasolobebes.com' => (object) array('keyTienda' => 'SB','session_name' => 'sbPHPSESSID',),
	'psbb.es' => (object) array('keyTienda' => 'SB','session_name' => 'sbPHPSESSID',),
	'parafarmaciasolocosmetica.com' => (object) array('keyTienda' => 'SC','session_name' => 'scPHPSESSID',),
	'afarma.es' => (object) array('keyTienda' => 'SC','session_name' => 'scPHPSESSID',),
	'pscc.es' => (object) array('keyTienda' => 'SC','session_name' => 'scPHPSESSID',),
	'bebefarma.com' => (object) array('keyTienda' => 'BF','session_name' => 'bfPHPSESSID',),
	'parafarmaciabebefarma.com' => (object) array('keyTienda' => 'BF','session_name' => 'bfPHPSESSID',),
	'farmaciacelorrio.com' => (object) array('keyTienda' => 'FC','session_name' => 'fcPHPSESSID',),
	'comprasenfarmacia.com' => (object) array('keyTienda' => 'FC','session_name' => 'fcPHPSESSID',),
)));

define ('ARR_TIENDAS',serialize(array (
	'CL' => array (
		'SITE_NAME' => '',
	),
	'FD' => array (
		'SITE_NAME' => '',
	),
	'SB' => array (
		'SITE_NAME' => '',
	),
	'SC' => array (
		'SITE_NAME' => '',
	),
	'BF' => array (
		'SITE_NAME' => 'Bebefarma',
		'URL_LOGO' => BASE_URL.'appFed16/binaries/imgs/shop-logo.jpg',
		'FB_APP_ID' => '1250359411691249',
		'TW_CONSUMER_KEY' => 'IeCWw2hagRgboE6Q5ughcuP4k',
		'TW_CONSUMER_SECRET' => 'VF9KYlb9gZUlJ8l9Ax5w1LPalN1zr9CP6W5lgy0sbXctDTdE1A',
		//atcioncliente@bebefarma.com
		//pedidos@bebefarma.com
	),
	'FC' => array (
		'SITE_NAME' => '',
	),
)));

define('SITE_NAME','00.skel');
define('TITLE_BASE',SITE_NAME);
define('FROM_EMAIL','noreply@'.BASE_DOMAIN);
/**/
?>