<?
define ('ARR_API_SERVICES', serialize(array(
	'LOG' => array (
		'active' => true,
		'keys' => array(
			'neslonso@gmail.com' => '' //Nombre de la key (sin uso por el momento) => valor que tiene que llegar en $_REQUEST['key']
			),
		'comando' => 'error_log("LOG API.");', //argumento para eval
	),
	'arrRandomProds' => array (
		'active' => true,
		'keys' => array(
			'neslonso@gmail.com' => '' //Nombre de la key (sin uso por el momento) => valor que tiene que llegar en $_REQUEST['key']
			),
		'comando' => 'Multi_ofertaVenta::arrRandomOfertasVenta(\cDb::confByKey("celorriov3"),$_REQUEST["results"],$_REQUEST["keyTienda"]);', //argumento para eval
	),
	'arrCatsRoots' => array (
		'active' => true,
		'keys' => array(
			'neslonso@gmail.com' => '' //Nombre de la key (sin uso por el momento) => valor que tiene que llegar en $_REQUEST['key']
			),
		'comando' => 'Multi_categoria::arrCatsRootsMenu(\cDb::confByKey("celorriov3"),$_REQUEST["keyTienda"]);', //argumento para eval
	),
)));
?>
