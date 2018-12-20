<?
//NOTA: Considerar que en ciertas ocasiones (por ejemplo cuando tenemos un select y solo necesitamos la id seleccionada,
//	no el texto selected="selected", lo mejor es tratarlo como un cmapo normal
function arrFormFromArrPost ($arrPost, $nonTextFields=NULL, $checkboxCheckedValue=1) {
	//$nonTextFields=array("sexo"=>"select","fnacDia"=>"select","fnacMes"=>"select","fnacAno"=>"select",
	//	"consienteEstadisticas"=>"checkbox","pru"=>"radio");
	$arr=array();
	if (isset($arrPost)) {
		foreach ($arrPost as $key => $value) {
			if (is_array($value)) {
				foreach ($value as $arrKey => $arrValue) {
					if (isset($nonTextFields[$key])) {
						//echo 'nonTextFields['.$key.']=>'.$nonTextFields[$key]."=>".$value."=>".$key.$value."<br>";
						switch ($nonTextFields[$key]) {
							case "select":
								$arr[$key.$arrKey.$arrValue]='selected="selected"';
								$arr[$key][$arrKey][$arrValue]='selected="selected"';
							break;
							case "checkbox":if ($arrValue==$checkboxCheckedValue) {$arr[$key][$arrKey]='checked="checked"';}break;
							case "radio":$arr[$key.$value]='checked="checked"';break;
							case "selectMultiple":
							default:$arr[$key][$arrKey]=$arrValue;
						}
					} else {
						$arr[$key][$arrKey]=$arrValue;
					}
				}
			} else {
				if (isset($nonTextFields[$key])) {
					//echo 'nonTextFields['.$key.']=>'.$nonTextFields[$key]."=>".$value."=>".$key.$value."<br>";
					switch ($nonTextFields[$key]) {
						case "select":
							$arr[$key.$value]='selected="selected"';
							//Cambiamos el paradigma de tratamiento de los select, pero conservamos el anterior $arr[$key.$value] por compatibilidad
							$arr[$key][$value]='selected="selected"';
						break;
						case "checkbox":if ($value==$checkboxCheckedValue) {$arr[$key]='checked="checked"';}break;
						case "radio":$arr[$key.$value]='checked="checked"';break;
						case "selectMultiple":
						default:$arr[$key]=$value;
					}
				} else {
					$arr[$key]=$value;
				}
			}
		}
	}
	//print_r($arr);
	return $arr;
}

function logPageData($titulo="Grupo logPageData") {
	$GLOBALS['firephp']->group($titulo, array('Collapsed' => true, 'Color' => '#FF9933'));
		$GLOBALS['firephp']->group('_SESSION, page y usr', array('Collapsed' => true, 'Color' => '#3399FF'));
			$GLOBALS['firephp']->info($_SESSION,"SESSION");
			//$GLOBALS['firephp->info(htmlspecialchars($_SERVER['HTTP_REFERER']),'_SERVER[HTTP_REFERER]');//hace fallar al validador del w3c
			$GLOBALS['firephp']->info($GLOBALS['page'],'clase de página ($page)');
			$GLOBALS['firephp']->info($GLOBALS['objUsr'],'$objUsr');
		$GLOBALS['firephp']->groupend();
		$GLOBALS['firephp']->group('_GET, POST, FILES', array('Collapsed' => true, 'Color' => '#3399FF'));
			$GLOBALS['firephp']->info($_GET,"GET");
			$GLOBALS['firephp']->info($_POST,"POST");
			$GLOBALS['firephp']->info($_FILES,"FILES");
		$GLOBALS['firephp']->groupend();
	$GLOBALS['firephp']->groupend();
}

function dataTablesGenericServerSide($objCliente=NULL, $where=NULL) {
	$db=cDb::gI();
	$sOrder = "";
	if ( isset( $_REQUEST['iSortCol_0'] ) ) {
		for ( $i=0 ; $i<intval( $_REQUEST['iSortingCols'] ) ; $i++ ) {
			if ( $_REQUEST[ 'bSortable_'.intval($_REQUEST['iSortCol_'.$i]) ] == "true" ) {
				$sOrder .= "`"
					.$db->real_escape_string($_REQUEST['mDataProp_'.intval( $_REQUEST['iSortCol_'.$i])])
					."` ".$db->real_escape_string($_REQUEST['sSortDir_'.$i]).", ";
			}
		}
		$sOrder = substr_replace( $sOrder, "", -2 );
	}
	$GLOBALS['firephp']->info ($sOrder);

	//TODO: Mejora: Realizar el filtro mediante indices FULLTEXT
	/*
	* Filtering
	* NOTE this does not match the built-in DataTables filtering which does it
	* word by word on any field. It's possible to do here, but concerned about efficiency
	* on very large tables, and MySQL's regex functionality is very limited
	*/
	$sWhere = "";
	if (isset($_REQUEST['sSearch']) && $_REQUEST['sSearch']!="") {
		$sWhere = "(";
		for ($i=0; $i<$_REQUEST['iColumns'];$i++) {
			if ( isset($_REQUEST['bSearchable_'.$i]) && $_REQUEST['bSearchable_'.$i] == "true" ) {
				$sWhere .= "`"
					.$db->real_escape_string($_REQUEST['mDataProp_'.$i])
					."` LIKE '%".$db->real_escape_string($_REQUEST['sSearch'])."%' OR ";
			}
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	// Individual column filtering
	/* TODO: Mejora: Implementar filtro individual por columnas
	for ($i=0;$i<$_REQUEST['iColumns'];$i++) {
		if ( isset($_REQUEST['bSearchable_'.$i]) && $_REQUEST['bSearchable_'.$i] == "true" && $_REQUEST['sSearch_'.$i] != '' ) {
			if ( $sWhere == "" ) {
				$sWhere = "";
			} else {
				$sWhere .= " AND ";
			}
			$sWhere .= "`".$db->real_escape_string($_REQUEST['mDataProp_'.$i])."` LIKE '%".$db->real_escape_string($_REQUEST['sSearch_'.$i])."%' ";
		}
	}
	*/
	$sWhere=($sWhere=="")?$sWhere.$where:$sWhere." AND ".$where;
	$GLOBALS['firephp']->info ($sWhere);

	$sLimit="";
	if ($_REQUEST['iDisplayLength']!=-1) {
		$sLimit=intval($_REQUEST['iDisplayStart']).",".intval($_REQUEST['iDisplayLength']);
	}
	$GLOBALS['firephp']->info ($sLimit);


	//La clase pasada debe contener el dataMetodo, que debe aceptar 3 parametros, sWhere, sOrder y sLimit  (busqueda, orden y paginacion)
	//El valor especial 'thisUsr' siginfica que la clase es el objeto usuario de la session y la llamada no es estatica
	if (!(isset($_REQUEST['clase']) && $_REQUEST['clase']=='thisUsr')) {
		if (isset($_REQUEST['clase'])) {
			if (class_exists($_REQUEST['clase'])) {$clase=$_REQUEST['clase'];}
				else {throw new Exception('Clase '.$_REQUEST['clase'].' no existe');}
		} else {throw new Exception('Parametro clase requerido');}
		if (isset($_REQUEST['metodo'])) {
			if (method_exists($clase,$_REQUEST['metodo'])) {$metodo=$_REQUEST['metodo'];}
				else {throw new Exception('Metodo '.$_REQUEST['metodo'].' no existe');}
		} else {throw new Exception('Parametro metodo requerido');}

		$arrStdObjs=$clase::$metodo($db);
		$total=count($arrStdObjs);
		$arrStdObjs=$clase::$metodo($db,$sWhere);
		$totalDisplay=count($arrStdObjs);
		$arrStdObjs=$clase::$metodo($db,$sWhere,$sOrder,$sLimit);
		$arrDataTables=$arrStdObjs;
	} else {
		//$clase=new Cliente($idCliente);
		$clase=$objCliente;
		if (isset($_REQUEST['metodo'])) {
			if (method_exists($clase,$_REQUEST['metodo'])) {$metodo=$_REQUEST['metodo'];}
				else {throw new Exception('Metodo '.$_REQUEST['metodo'].' no existe');}
		} else {throw new Exception('Parametro metodo requerido');}
		$arrStdObjs=$clase->$metodo($db);
		$total=count($arrStdObjs);
		$arrStdObjs=$clase->$metodo($db,$sWhere);
		$totalDisplay=count($arrStdObjs);
		$arrStdObjs=$clase->$metodo($db,$sWhere,$sOrder,$sLimit);
		$arrDataTables=$arrStdObjs;
	}

	for ($i=0; $i<count($arrDataTables); $i++) {
		$arrDataTables[$i]->DT_RowId=$arrDataTables[$i]->id;
	}

	$objDT=new \stdClass();
	$objDT->sEcho=$_REQUEST['sEcho'];
	$objDT->iTotalRecords=$total;
	$objDT->iTotalDisplayRecords=$totalDisplay;
	$objDT->data=$arrDataTables;
	return $objDT;
}

function sitemap($file="./sitemap.xml") {
	//define( "ENT_XML1",        16    );//Porque no conoce esto el PHP?????!!!
	$sl="\n";
	$sg="\t";
	$fp=fopen ($file,"w");

	$where="visible=1";$order="id asc";$limit="";$tipo="arrIds";
	$arrIdsProd=Producto::AllToArray($where,$order,$limit,$tipo);

	$where="visible=1";$order="id asc";$limit="";$tipo="arrIds";
	$arrIdsCat=Categoria::AllToArray($where,$order,$limit,$tipo);

	$contents='<?xml version="1.0" encoding="UTF-8" ?>'.$sl;
	$contents.='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.$sl;
	foreach ($arrIdsCat as $idCat) {
		$objCat=new Categoria($idCat);
		$contents.=$sg.'<url>'.$sl;

		$contents.=$sg.$sg.'<loc>';
		$contents.=str_replace("&", "&amp;", $objCat->url(false));
		$contents.='</loc>'.$sl;

		$contents.=$sg.$sg.'<lastmod>';
		$contents.=Fecha::toW3C(Fecha::fromMysql($objCat->GETupdate()));
		$contents.='</lastmod>'.$sl;

		$contents.=$sg.$sg.'<changefreq>';
		$contents.="weekly";
		$contents.='</changefreq>'.$sl;

		$contents.=$sg.$sg.'<priority>';
		$contents.='0.5';//TODO: mejora: establecer este valor en base a las valoraciones de los usuarios
		$contents.='</priority>'.$sl;

		$contents.=$sg.'</url>'.$sl;
	}
	foreach ($arrIdsProd as $idProd) {
		$objProd=new Producto($idProd);
		$contents.=$sg.'<url>'.$sl;

		$contents.=$sg.$sg.'<loc>';
		$contents.=str_replace("&", "&amp;", $objProd->url(false));
		$contents.='</loc>'.$sl;

		$contents.=$sg.$sg.'<lastmod>';
		$contents.=Fecha::toW3C(Fecha::fromMysql($objProd->GETupdate()));
		$contents.='</lastmod>'.$sl;

		$contents.=$sg.$sg.'<changefreq>';
		$contents.="weekly";
		$contents.='</changefreq>'.$sl;

		$contents.=$sg.$sg.'<priority>';
		$contents.='0.5';//TODO: mejora: establecer este valor en base a las valoraciones de los usuarios
		$contents.='</priority>'.$sl;

		$contents.=$sg.'</url>'.$sl;
	}
	$contents.='</urlset>'.$sl;
	fwrite ($fp,$contents);
	fclose ($fp);
	chmod ($file,0666);
	//comprimirlo
	$gzfile = $file.".gz";
	// Open the gz file (w9 is the highest compression)
	$fp = gzopen ($gzfile, 'w9');
	// Compress the file
	gzwrite ($fp, file_get_contents($file));
	// Close the gz file and we are done
	gzclose($fp);
	chmod ($gzfile,0666);
	unlink($file);
}

/* getRemoteIPAddress **********************************************************
*******************************************************************************/
function getRemoteIPAddress() {
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		return $_SERVER['HTTP_CLIENT_IP'];
	} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	return $_SERVER['REMOTE_ADDR'];
}

/* r_var_dump ******************************************************************
*******************************************************************************/
function ob_var_dump() {
	return call_user_func_array("r_var_dump", func_get_args());
}
function r_var_dump() {
	$argc = func_num_args();
	$argv = func_get_args();

	$result='';
	if ($argc > 0) {
		ob_start();
		call_user_func_array('var_dump', $argv);
		$result = ob_get_contents();
		ob_end_clean();
	}
	return $result;
}
/**
 * Generate a build number based on Git commit count and current branch.
 * @return string Format: "{$branch}.{$commitCount}"
 */
function buildNumber() {
	$gitCmd="git --git-dir='".SKEL_ROOT_DIR."/../git/".$_SERVER['SERVER_NAME']."'";
	$branch = exec($gitCmd." rev-parse --abbrev-ref HEAD");
	$commitCount = exec($gitCmd." rev-list HEAD --count");

	//$result=$gitCmd.".{$branch}.{$commitCount}";
	$result="{$branch}.{$commitCount}";

	return $result;
}
?>