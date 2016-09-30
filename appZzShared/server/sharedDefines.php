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
		'FROM_EMAIL' => '',
	),
	'FD' => array (
		'SITE_NAME' => '',
		'FROM_EMAIL' => '',
	),
	'SB' => array (
		'SITE_NAME' => '',
		'FROM_EMAIL' => '',
	),
	'SC' => array (
		'SITE_NAME' => '',
		'FROM_EMAIL' => '',
	),
	'BF' => array (
		'SITE_NAME' => 'Bebefarma',
		'FROM_EMAIL' => 'atcioncliente@bebefarma.com',
		'REPLY_TO_EMAIL' => 'pedidos@bebefarma.com',
		'URL_LOGO' => BASE_URL.'appFed16/binaries/imgs/shop-logo.jpg',
	),
	'FC' => array (
		'SITE_NAME' => '',
		'FROM_EMAIL' => '',
	),
)));

define('SITE_NAME','00.skel');
define('TITLE_BASE',SITE_NAME);
define('FROM_EMAIL','noreply@'.BASE_DOMAIN);
/**/
?>
