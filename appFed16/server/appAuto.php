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
	'shopppyDooSB' => array (
		'activado' => true,
		'minuto' => '0',
		'hora' => '6',
		'diaMes' => '*',
		'mes' => '*',
		'diaSemana' => '*',
		'comando' => 'ficheroCiao("SB","./zPublic/shoppydoo/encuentraprecios.SB.txt");',
	),
	'gmFeeds' => array (
		'activado' => true,
		'minuto' => '0',
		'hora' => '6',
		'diaMes' => '*',
		'mes' => '*',
		'diaSemana' => '*',
		'comando' => 'gmFeeds();',
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
		sitemap($keyTienda, "./zPublic/sitemaps/sitemap.".$keyTienda.".xml");
	}
}
function sitemap($keyTienda, $file="./sitemap.xml") {
	if (!is_dir(dirname($file))) {
		mkdir(dirname($file),0755,true);
	}

	$arrDomains=unserialize(ARR_DOMAINS);
	foreach ($arrDomains as $domain => $domainData) {
		if ($domainData->keyTienda==$keyTienda) {
			$BASE_DOMAIN=$domain;
			break;
		}
	}
	$db=\cDb::confByKey("celorriov3");
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
		mkdir(dirname($file),0755,true);
	}

	$arrDomains=unserialize(ARR_DOMAINS);
	foreach ($arrDomains as $domain => $domainData) {
		if ($domainData->keyTienda==$keyTienda) {
			$BASE_DOMAIN=$domain;
			break;
		}
	}

	$db=\cDb::confByKey("celorriov3");
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
		$linea.=str_replace(BASE_DOMAIN,$BASE_DOMAIN,$objOfer->imgSrc()).$sg;

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

function gmFeeds() {
	$arrTiendas=unserialize(ARR_TIENDAS);
	foreach ($arrTiendas as $keyTienda => $config) {
		error_log('FEED: '.$keyTienda);
		gmFeed($keyTienda, "./zPublic/gmFeeds/gmFeed.".$keyTienda.".xml");
		error_log('FIN FEED: '.$keyTienda);
	}
}
function gmFeed($keyTienda, $file="./gmFeed.xml") {
	if (!is_dir(dirname($file))) {
		mkdir(dirname($file),0755,true);
	}

	$arrDomains=unserialize(ARR_DOMAINS);
	foreach ($arrDomains as $domain => $domainData) {
		if ($domainData->keyTienda==$keyTienda) {
			$BASE_DOMAIN=$domain;
			break;
		}
	}
	$db=\cDb::confByKey("celorriov3");
	$sl="\n";
	$sg="\t";
	$fp=fopen ($file,"w");

	$where="visible=1 AND keyTienda='".$keyTienda."'";$order="id asc";$limit="";$tipo="arrKeys";
	$arrIdsOfer=\Multi_ofertaVenta::getArray($db,$where,$order,$limit,$tipo);

	$contents='<?xml version="1.0" encoding="UTF-8" ?>'.$sl;
	$contents.='<feed xmlns="http://www.w3.org/2005/Atom" xmlns:g="http://base.google.com/ns/1.0">'.$sl;
	$contents.='<title>'.$keyTienda.' data feed'.'</title>'.$sl;
	$contents.='<link href="" rel="" type=""/>'.$sl;
	$contents.='<updated>'.date('c').'</updated>'.$sl;
	$contents.='<author><name>'.'Parqueweb S.L.'.'</name></author>'.$sl;
	$contents.='<id>'.'</id>'.$sl;
	foreach ($arrIdsOfer as $idOfer) {
		$objOfer=new \Multi_ofertaVenta($db,$idOfer);

		//nos saltamos los packs
		if (count($objOfer->arrMulti_producto())>1) {continue;}
		//nos saltamos los EANs no válidos
		if (strlen($objOfer->codigoEAN())!=13) {continue;}
		if (!isValidGtin($objOfer->codigoEAN())) {error_log('gtin no valido');continue;}

		$contents.=$sg.'<entry>'.$sl;

		$contents.=$sg.$sg.'<g:id>'.$objOfer->GETid().'</g:id>'.$sl;
		$contents.=$sg.$sg.'<g:title>'.str_replace("&", "&amp;",html_entity_decode(strip_tags($objOfer->GETnombre()))).'</g:title>'.$sl;
		$contents.=$sg.$sg.'<g:description>'.str_replace("&", "&amp;",html_entity_decode(strip_tags($objOfer->GETdescripcion()))).'</g:description>'.$sl;
		$contents.=$sg.$sg.'<g:link>'.str_replace("&", "&amp;", str_replace(BASE_DOMAIN,$BASE_DOMAIN,$objOfer->url())).'</g:link>'.$sl;
		$contents.=$sg.$sg.'<g:image_link>'.str_replace("&", "&amp;",str_replace(BASE_DOMAIN,$BASE_DOMAIN,$objOfer->imgSrc())).'</g:image_link>'.$sl;
		$contents.=$sg.$sg.'<g:condition>new</g:condition>'.$sl;
		$contents.=$sg.$sg.'<g:availability>'.(($objOfer->GETagotado())?'out of stock':'in stock').'</g:availability>'.$sl;
		$contents.=$sg.$sg.'<g:price>'.$objOfer->pvp().' EUR</g:price>'.$sl;

		//$contents.=$sg.$sg.'<g:sale_price>25.49 EUR</g:sale_price>'.$sl;
		//$contents.=$sg.$sg.'<g:sale_price_effective_date>2011-09-01T16:00-08:00/2011-09-03T16:00-08:00</g:sale_price_effective_date>'.$sl;

		//<!-- 2 of the following 3 attributes are required fot this item according to the Unique Product Identifier Rules -->
		$contents.=$sg.$sg.'<g:gtin>'.$objOfer->codigoEAN().'</g:gtin>'.$sl;
		//$contents.=$sg.$sg.'<g:brand>LG</g:brand>'.$sl;
		//$contents.=$sg.$sg.'<g:mpn>22LB4510/US</g:mpn>'.$sl;

		//$contents.=$sg.$sg.'<g:product_type>'.$objOfer->objMulti_categoria()->ruta().'</g:product_type>'.$sl;
		//$contents.=$sg.$sg.'<g:google_product_category>Health &amp; Beauty &gt; Personal Care &gt; Cosmetics &gt; Skin Care &gt; Anti-Aging Skin Care Kits</g:google_product_category>'.$sl;

		$contents.=$sg.'</entry>'.$sl;
	}
	$contents.='</feed>'.$sl;
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

function isValidGtin ($code) {
//http://www.gs1.org/how-calculate-check-digit-manually
	$i=0;
	$sum=0;
	$checkDigit=substr($code,-1);
	$code=substr($code,0,-1);
	foreach (str_split($code) as $char) {
		$i++;
		if ($i % 2 == 0) {
			$sum+=$char*3;
		} else {
			$sum+=$char*1;
		}
	}
	$nextTen = (ceil($sum / 10)) * 10;
	$calculatedCheckDigit = $nextTen - $sum;
	return ($checkDigit==$calculatedCheckDigit)?true:false;
}
?>
