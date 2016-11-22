<?
define ('ARR_CRON_JOBS', serialize(array(
	'log5Minutes' => array (
		'activado' => false,
		'minuto' => '0/5', //(0 - 59)
		'hora' => '*', //(0 - 23)
		'diaMes' => '*', //(1 - 31)
		'mes' => '*', //(1 - 12)
		'diaSemana' => '*', //(0 - 7) (Domingo=0 o 7)
		'comando' => 'log5Minutes();', //argumento para eval
	),
	'logHour' => array (
		'activado' => false,
		'minuto' => '0',
		'hora' => '*',
		'diaMes' => '*',
		'mes' => '*',
		'diaSemana' => '*',
		'comando' => 'logHour();',
	),
	'sitemaps' => array (
		'activado' => true,
		'minuto' => '0',
		'hora' => '6',
		'diaMes' => '*',
		'mes' => '*',
		'diaSemana' => '*',
		'comando' => 'sitemaps();',
	),
	'shopppyDoo' => array (
		'activado' => true,
		'minuto' => '0',
		'hora' => '6',
		'diaMes' => '*',
		'mes' => '*',
		'diaSemana' => '*',
		'comando' => 'ficheroCiao("SB","./zPublic/shoppydoo/encuentraprecios.SB.txt");',
	),
)));
function log5Minutes () {
	error_log('log5Minutes Job');
}
function logHour () {
	error_log('Son las '.date ('H:i:s'));
}

function sitemaps() {
	$arrTiendas=unserialize(ARR_TIENDAS);
	foreach ($arrTiendas as $keyTienda => $config) {
		sitemap($keyTienda, "./sitemap.".$keyTienda.".xml");
	}
}
function sitemap($keyTienda, $file="./sitemap.xml") {
	$arrDomains=unserialize(ARR_DOMAINS);
	foreach ($arrDomains as $domain => $domainData) {
		if ($domainData->keyTienda==$keyTienda) {
			$BASE_DOMAIN=$domain;
			break;
		}
	}
	$db=\cDb::confByKey("celorriov3");
	//define( "ENT_XML1",        16    );//Porque no conoce esto el PHP?????!!!!!
	$sl="\n";
	$sg="\t";
	$fp=fopen ($file,"w");

	$where="visible=1 AND keyTienda='".$keyTienda."'";$order="id asc";$limit="";$tipo="arrKeys";
	$arrIdsProd=\Multi_ofertaVenta::getArray($db,$where,$order,$limit,$tipo);

	$where="visible=1 AND keyTienda='".$keyTienda."'";$order="id asc";$limit="";$tipo="arrKeys";
	$arrIdsCat=\Multi_categoria::getArray($db,$where,$order,$limit,$tipo);

	$contents='<?xml version="1.0" encoding="UTF-8" ?>'.$sl;
	$contents.='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.$sl;
	foreach ($arrIdsCat as $idCat) {
		$objCat=new \Multi_categoria($db,$idCat);
		$contents.=$sg.'<url>'.$sl;

		$contents.=$sg.$sg.'<loc>';
		$contents.=str_replace("&", "&amp;", PROTOCOL.'//'.$BASE_DOMAIN.BASE_DIR.Cadena::toUrlString($objCat->ruta("/",true))."/categoria/".$objCat->GETid()."/" );
		$contents.='</loc>'.$sl;

		$contents.=$sg.$sg.'<lastmod>';
		$contents.=Fecha::fromMysql($objCat->GETupdate())->toW3C();
		$contents.='</lastmod>'.$sl;

		$contents.=$sg.$sg.'<changefreq>';
		$contents.="weekly";
		$contents.='</changefreq>'.$sl;

		$contents.=$sg.$sg.'<priority>';
		$contents.='0.5';
		$contents.='</priority>'.$sl;

		$contents.=$sg.'</url>'.$sl;
	}
	foreach ($arrIdsProd as $idProd) {
		$objProd=new \Multi_ofertaVenta($db,$idProd);
		$contents.=$sg.'<url>'.$sl;

		$contents.=$sg.$sg.'<loc>';
		$contents.=str_replace("&", "&amp;", PROTOCOL.'//'.$BASE_DOMAIN.BASE_DIR.Cadena::toUrlString($objProd->GETnombre())."/prod/".$objProd->GETid()."/" );
		$contents.='</loc>'.$sl;

		$contents.=$sg.$sg.'<lastmod>';
		$contents.=Fecha::fromMysql($objProd->GETupdate())->toW3C();
		$contents.='</lastmod>'.$sl;

		$contents.=$sg.$sg.'<changefreq>';
		$contents.="weekly";
		$contents.='</changefreq>'.$sl;

		$contents.=$sg.$sg.'<priority>';
		$contents.='0.5';
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

function ficheroCiao($keyTienda,$file="./encuentraprecios.txt") {
	if (!is_dir(dirname($file))) {
		mkdir(dirname($file),0777,true);
	}

	$arrDomains=unserialize(ARR_DOMAINS);
	foreach ($arrDomains as $domain => $domainData) {
		if ($domainData->keyTienda==$keyTienda) {
			$BASE_DOMAIN=$domain;
			break;
		}
	}

	$db=\cDb::confByKey("celorriov3");
	//define( "ENT_XML1",        16    );//Porque no conoce esto el PHP?????!!!!!
	$sl="\n";
	$sg="\t";
	$fp=fopen ($file,"w");

	$where="visible=1 AND keyTienda='".$keyTienda."'";$order="id asc";$limit="";$tipo="arrKeys";
	$arrIdsOfer=\Multi_ofertaVenta::getArray($db,$where,$order,$limit,$tipo);

	$header="Nombre del producto".$sg."Deeplink".$sg."Precio".$sg."Categoría".$sg."URL imagen".$sg."Disponibilidad".$sg."Descripción".$sl;
	fwrite ($fp,$header);
	foreach ($arrIdsOfer as $idOfer) {
		$objOfer=new \Multi_ofertaVenta($db,$idOfer);
		if ($objOfer->GETid()=="") { //Si no se consigue cargar el producto nos lo saltamos
			continue;
		}
		$objCat=$objOfer->objMulti_categoriaPrincipal();
		if ($objCat->GETid()=="") { //Si no se consigue cargar una sola categoria principal nos lo saltamos
			continue;
		}
		$linea=$objOfer->GETnombre().$sg;
		$linea.=str_replace("&", "&amp;", PROTOCOL.'//'.$BASE_DOMAIN.BASE_DIR.Cadena::toUrlString($objOfer->GETnombre())."/prod/".$objOfer->GETid()."/" ).$sg;
		$linea.=$objOfer->pvp().$sg;
		$linea.=substr($objCat->ruta(">"),0,254).$sg;
		$linea.=$objOfer->imgSrc().$sg;

		$disponibilidad="en Stock";
		$linea.=$disponibilidad.$sg;

		$descripcion=str_replace("\n","",$objOfer->GETdescripcion());
		$descripcion=str_replace("\r","",$descripcion);
		$linea.=substr($descripcion,0,3999);

		$linea.=$sl;
		fwrite ($fp,$linea);
		unset ($objP);
		unset ($objC);
	}
	fclose ($fp);
}
?>
