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
	'soloproteccionsolar.com' => (object) array('keyTienda' => 'SPS','session_name' => 'spsPHPSESSID',),
)));

define ('ARR_TIENDAS',serialize(array (
	'CL' => array (
		'SITE_NAME' => 'Celorriofarma',
		'BIENVENIDA' => 'Bienvenido a Celorriofarma, parafarmacia online.',
		'CONTACTO' => (object) array(
			'EMAIL' => 'atcioncliente@'.BASE_DOMAIN,
			'TLF' => '982 20 30 08',
		),
		'URL_LOGO' => BASE_URL.'appFed16/binaries/imgs/logo.CL.jpg',
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
				'CONSUMER_KEY' => 'AKKLOEgbx8i3TAUnZODi2Tsk1 ',
				'CONSUMER_SECRET' => 'EX7zFkah5DN0mH0b4WrEWvRb3QQjG1Xx3O4VhsL7jUApoQ2Ry6',
			),
		),
		'ANALYTICS' => 'UA-36657351-2',
		'TEMA' => (object) array (
			'ARMONIA' => 'analogous+complementary', //3 colores: analogous, triadic, split. 4 Colores: tetradic, analogous+complementary. 5 colores: analogous+split
			'COLOR_PRIMARIO' => '#345995',
			'COLOR_SECUNDARIO' => '#EAC435',
			'COLOR_HEADER' => '#FFF',
			'COLOR_FOOTER' => '#FFF',
			'EFECTO_BANNER' => "loop:true,spaceBetween: 100,effect: 'coverflow',coverflow: {rotate: 0,stretch: 0,depth: 300,modifier: 1,slideShadows : false},slideToClickedSlide:true,",
		),
	),
	'FD' => array (
		'SITE_NAME' => 'Farmadiscount',
		'BIENVENIDA' => 'Bienvenido a Farmadiscount.com, parafarmacia al descuento. Venta al descuento de farmacia y parafarmacia.',
		'CONTACTO' => (object) array(
			'EMAIL' => 'atcioncliente@'.BASE_DOMAIN,
			'TLF' => '982 215 630',
		),
		'URL_LOGO' => BASE_URL.'appFed16/binaries/imgs/logo.FD.png',
		'EMPRESA' => (object) array (
			'NOMBRE' => 'Farmamas S.L.',
			'DIRECCION' => 'Axel López Pérez, nº10, 4ºB, 27003 Lugo',
			'CIF' => 'B27275841',
			'REGISTRO' => 'tomo 257 libro 0 folio 192 hoja LU5912 inscripción 3',
		),
		'SOCIAL' => (object) array (
			'FB' => (object) array (
				'URL' => 'https://www.facebook.com/Farmadiscount-107814645941409',
				'APP_ID' => '103205986428008',
			),
			'TW' => (object) array (
				'URL' => '',
				'CONSUMER_KEY' => '',
				'CONSUMER_SECRET' => '',
			),
		),
		'ANALYTICS' => 'UA-36657351-6',
		'TEMA' => (object) array (
			'ARMONIA' => 'analogous+complementary',
			'COLOR_PRIMARIO' => '#008B44',
			'COLOR_SECUNDARIO' => '#FFBD7B',
			'COLOR_HEADER' => '#FFF',
			'COLOR_FOOTER' => '#FFF',
			'EFECTO_BANNER' => "",
			'FRAGMENTOS' => array (
				'INFO_DTOS_VOLUMEN' => (object) array (
					'class' => '\InfoDtosVolumen',
					'hueco' => 'hueco1',
				),
			),
		),
	),
	'SB' => array (
		'SITE_NAME' => 'Solo bebés',
		'BIENVENIDA' => 'Bienvenido a Parafarmacia Solo Bebés. Distribución de farmacia y parafarmacia.',
		'CONTACTO' => (object) array(
			'EMAIL' => 'atcioncliente@'.BASE_DOMAIN,
			'TLF' => '982 20 30 08',
		),
		'URL_LOGO' => BASE_URL.'appFed16/binaries/imgs/logo.SB.png',
		'EMPRESA' => (object) array (
			'NOMBRE' => 'Celorriofarma S.L.',
			'DIRECCION' => 'Avada. A Coruña 195, 27003 Lugo',
			'CIF' => 'B27232859',
			'REGISTRO' => 'tomo 257 libro 0 folio 192 hoja LU5912 inscripción 3',
		),
		'SOCIAL' => (object) array (
			'FB' => (object) array (
				'URL' => '',
				'APP_ID' => '',
			),
			'TW' => (object) array (
				'URL' => '',
				'CONSUMER_KEY' => '',
				'CONSUMER_SECRET' => '',
			),
		),
		'ANALYTICS' => 'UA-36657351-3',
		'TEMA' => (object) array (
			'ARMONIA' => 'analogous+complementary',
			'COLOR_PRIMARIO' => '#F87A8B',
			'COLOR_SECUNDARIO' => '#df9aa3',
			'COLOR_HEADER' => '#FFF',
			'COLOR_FOOTER' => '#FFF',
			'EFECTO_BANNER' => "loop:true,spaceBetween: 100, slideToClickedSlide:true,freeMode:true,speed:1000,autoplay: 4000,",
		),
	),
	'SC' => array (
		'SITE_NAME' => 'Solo cosmética',
		'BIENVENIDA' => 'Parafarmacia Solo cosmética. Las mejores marcas al mejor precio.',
		'CONTACTO' => (object) array(
			'EMAIL' => 'atcioncliente@'.BASE_DOMAIN,
			'TLF' => '982 20 30 08',
		),
		'URL_LOGO' => BASE_URL.'appFed16/binaries/imgs/logo.SC.png',
		'EMPRESA' => (object) array (
			'NOMBRE' => 'Celorriofarma S.L.',
			'DIRECCION' => 'Avada. A Coruña 195, 27003 Lugo',
			'CIF' => 'B27232859',
			'REGISTRO' => 'tomo 257 libro 0 folio 192 hoja LU5912 inscripción 3',
		),
		'SOCIAL' => (object) array (
			'FB' => (object) array (
				'URL' => '',
				'APP_ID' => '',
			),
			'TW' => (object) array (
				'URL' => '',
				'CONSUMER_KEY' => '',
				'CONSUMER_SECRET' => '',
			),
		),
		'ANALYTICS' => 'UA-36657351-4',
		'TEMA' => (object) array (
			'ARMONIA' => 'analogous+complementary',
			'COLOR_PRIMARIO' => '#FFCEB4',
			'COLOR_SECUNDARIO' => '#AB9DCB',
			'COLOR_HEADER' => '#FFF',
			'COLOR_FOOTER' => '#FFF',
			'EFECTO_BANNER' => "loop:true,spaceBetween: 100, slideToClickedSlide:true,freeMode:false,speed:4000,autoplay: 4000,",
			'FRAGMENTOS' => array (
			),
		),
	),
	'BF' => array (
		'SITE_NAME' => 'Bebefarma',
		'BIENVENIDA' => 'Bienvenido a Bebefarma, parafarmacia online. Distribución y venta online de las mejores marcas de laboratorios de farmacia y parafarmacia.',
		'CONTACTO' => (object) array(
			'EMAIL' => 'atcioncliente@'.BASE_DOMAIN,
			'TLF' => '982 215 630',
		),
		'URL_LOGO' => BASE_URL.'appFed16/binaries/imgs/logo.BF.jpg',
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
			'ARMONIA' => 'analogous+complementary',
			'COLOR_PRIMARIO' => '#CD5A91',
			'COLOR_SECUNDARIO' => '#6c94be',
			'COLOR_HEADER' => '#FFF',
			'COLOR_FOOTER' => '#FFF',
			'EFECTO_BANNER' => "",
		),
	),
	'FC' => array (
		'SITE_NAME' => 'Farmacia Celorrio',
		'BIENVENIDA' => 'Bienvenido a farmaciacelorrio.com. Las mejores marcas de laboratorios de farmacia y parafarmacia.',
		'CONTACTO' => (object) array(
			'EMAIL' => 'atcioncliente@'.BASE_DOMAIN,
			'TLF' => '982 20 30 08',
		),
		'URL_LOGO' => BASE_URL.'appFed16/binaries/imgs/logo.FC.png',
		'EMPRESA' => (object) array (
			'NOMBRE' => 'Celorriofarma S.L.',
			'DIRECCION' => 'Avada. A Coruña 195, 27003 Lugo',
			'CIF' => 'B27232859',
			'REGISTRO' => 'tomo 257 libro 0 folio 192 hoja LU5912 inscripción 3',
		),
		'SOCIAL' => (object) array (
			'FB' => (object) array (
				'URL' => '',
				'APP_ID' => '395892783792521',
			),
			'TW' => (object) array (
				'URL' => '',
				'CONSUMER_KEY' => '',
				'CONSUMER_SECRET' => '',
			),
		),
		'ANALYTICS' => 'UA-36657351-1',
		'TEMA' => (object) array (
			'ARMONIA' => 'analogous+complementary',
			'COLOR_PRIMARIO' => '#FF9933',
			'COLOR_SECUNDARIO' => '#9933ff',
			'COLOR_HEADER' => '#FFF',
			'COLOR_FOOTER' => '#FFF',
			'EFECTO_BANNER' => "loop:true,spaceBetween: 100,effect: 'coverflow',coverflow: {rotate: 50,stretch: 0,depth: 100,modifier: 1,slideShadows : false},slideToClickedSlide:true,freeMode:false,speed:4000,autoplay: 1000,",
		),
	),
	'SPS' => array (
		'SITE_NAME' => 'Soloproteccionsolar',
		'BIENVENIDA' => 'Soloproteccionsolar, el sol más seguro al mejor precio.',
		'CONTACTO' => (object) array(
			'EMAIL' => 'atcioncliente@'.BASE_DOMAIN,
			'TLF' => '982 20 30 08',
		),
		'URL_LOGO' => BASE_URL.'appFed16/binaries/imgs/logo.SPS.png',
		'EMPRESA' => (object) array (
			'NOMBRE' => 'Celorriofarma S.L.',
			'DIRECCION' => 'Avada. A Coruña 195, 27003 Lugo',
			'CIF' => 'B27232859',
			'REGISTRO' => 'tomo 257 libro 0 folio 192 hoja LU5912 inscripción 3',
		),
		'SOCIAL' => (object) array (
			'FB' => (object) array (
				'URL' => '',
				'APP_ID' => '',
			),
			'TW' => (object) array (
				'URL' => '',
				'CONSUMER_KEY' => '',
				'CONSUMER_SECRET' => '',
			),
		),
		'ANALYTICS' => '',
		'TEMA' => (object) array (
			'ARMONIA' => 'analogous+complementary', //3 colores: analogous, triadic, split. 4 Colores: tetradic, analogous+complementary. 5 colores: analogous+split
			'COLOR_PRIMARIO' => '#ffd203',
			'COLOR_HEADER' => '#FFF',
			'COLOR_FOOTER' => '#FFF',
			'EFECTO_BANNER' => "loop:true,spaceBetween: 100,slideToClickedSlide:true,",
		),
	),
)));

define('SITE_NAME','00.skel');
define('TITLE_BASE',SITE_NAME);
define('FROM_EMAIL','noreply@'.BASE_DOMAIN);
/**/
?>