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
		'SITE_NAME' => 'Celorriofarma',
		'CONTACTO' => (object) array(
			'EMAIL' => 'atcioncliente@'.BASE_DOMAIN,
			'TLF' => '982 20 30 08',
		),
		'URL_LOGO' => BASE_URL.'appFed16/binaries/imgs/logo.CL.jpg',
		'MENU' => (object) array (
			'FOTO_CATS_SEGUNDO_NIVEL' => false,//Si las cats de segundo nivel con hijos llevan foto
			'NUM_OFERS_MAS_VENDIDAS' => 0,//Numero de ofertas que salen bajo las categorias de 2ºnivel sin hijos
		),
		'EMPRESA' => (object) array (
			'NOMBRE' => 'Celorriofarma S.L.',
			'DIRECCION' => 'Avada. A Coruña 195, 27003 Lugo',
			'CIF' => 'B27232859',
			'REGISTRO' => 'tomo 257 libro 0 folio 192 hoja LU5912 inscripción 3',
		),
		'SOCIAL' => (object) array (
			'FB' => (object) array (
				'URL' => 'https://www.facebook.com/celorriofarmalugo/',
				'APP_ID' => '1785793438334904',
			),
			'TW' => (object) array (
				'URL' => 'https://twitter.com/celorriofarma',
				'CONSUMER_KEY' => 'IeCWw2hagRgboE6Q5ughcuP4k',
				'CONSUMER_SECRET' => 'VF9KYlb9gZUlJ8l9Ax5w1LPalN1zr9CP6W5lgy0sbXctDTdE1A',
			),
		),
		'ANALYTICS' => 'UA-36657351-2',
		'TEMA' => (object) array (
			'COLOR_PRIMARIO' => '#345995',
			'COLOR_SECUNDARIO' => '#EAC435',
			'EFECTO_BANNER' => "loop:true,spaceBetween: 100,effect: 'coverflow',coverflow: {rotate: 0,stretch: 0,depth: 300,modifier: 1,slideShadows : false},slideToClickedSlide:true,",
		),
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
		'CONTACTO' => (object) array(
			'EMAIL' => 'atcioncliente@'.BASE_DOMAIN,
			'TLF' => '982 215 630',
		),
		'URL_LOGO' => BASE_URL.'appFed16/binaries/imgs/logo.BF.jpg',
		'MENU' => (object) array (
			'FOTO_CATS_SEGUNDO_NIVEL' => false,//Si las cats de segundo nivel con hijos llevan foto
			'NUM_OFERS_MAS_VENDIDAS' => 0,//Numero de ofertas que salen bajo las categorias de 2ºnivel sin hijos
		),
		'EMPRESA' => (object) array (
			'NOMBRE' => 'Farmamas S.L.',
			'DIRECCION' => 'Axel López Pérez, nº10, 4ºB, 27003 Lugo',
			'CIF' => 'B27275841',
			'REGISTRO' => 'tomo 257 libro 0 folio 192 hoja LU5912 inscripción 3',
		),
		'SOCIAL' => (object) array (
			'FB' => (object) array (
				'URL' => 'javascript:void(null);',
				'APP_ID' => '1250359411691249',
			),
			'TW' => (object) array (
				'URL' => 'https://twitter.com/pedrogimeno1201',
				'CONSUMER_KEY' => 'IeCWw2hagRgboE6Q5ughcuP4k',
				'CONSUMER_SECRET' => 'VF9KYlb9gZUlJ8l9Ax5w1LPalN1zr9CP6W5lgy0sbXctDTdE1A',
			),
		),
		'ANALYTICS' => 'UA-36657351-5',
		'TEMA' => (object) array (
			'COLOR_PRIMARIO' => '#CD5A91',
			'COLOR_SECUNDARIO' => '#6c94be',
			'EFECTO_BANNER' => "",
		),
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