<?
ob_start();

//almacen
//fichero
//ancho
//alto
//modo
//formato
try {
	$ancho=(isset($_GET['ancho']) && is_numeric($_GET['ancho']))?$_GET['ancho']:NULL;
	$alto=(isset($_GET['alto']) && is_numeric($_GET['alto']))?$_GET['alto']:NULL;
	$modo=(isset($_GET['modo']) && is_numeric($_GET['modo']))?$_GET['modo']:Imagen::OUTPUT_MODE_SCALE;
	$formato=(isset($_GET['formato']))?$_GET['formato']:"png";
	$cabecera=(isset($_GET['cabecera']))?$_GET['cabecera']:false;
	$calidad=(isset($_GET['calidad']))?$_GET['calidad']:'default';
	$filtro=(isset($_GET['filtro']))?$_GET['filtro']:NULL;

	switch ($_GET["almacen"]) {
		case "DB";
			try {
				$db=\cDb::confByKey('celorriov3');
				list($tabla,$campoId,$valorId,$campoData)=explode('.',$_GET["fichero"]);
				$sql="SELECT ".$campoId.", ".$campoData." FROM ".$tabla." WHERE id='".$db->real_escape_String($valorId)."'";
				$rslSet=$db->query($sql);
				if ($rslSet->num_rows>0) {
					$data=$rslSet->fetch_object();
					$data=$data->$campoData;
					$objImg=Imagen::fromString($data);
					//$objImg->marcaAgua("");
					//$objImg->marcaAgua("",1,1,"center");
				} else {
					throw new Exception("No encontrado registro con ID [".$valorId."]", 1);
				}
			} catch (Exception $e) {
				$firephp->error($e);
				$file=BASE_IMGS_DIR.'imgErr.png';
				$objImg=Imagen::fromFile($file);
			}
		break;
		case "DB_MPA_JOIN";
			try {
				$db=\cDb::confByKey('celorriov3');
				$listaIds=$_GET["fichero"];
				$sql="SELECT id, data FROM multi_productoAdjunto WHERE id IN (".$db->real_escape_String($listaIds).") ORDER BY FIELD(id,".$db->real_escape_String($listaIds).")";
				$rslSet=$db->query($sql);
				$objImg=NULL;
				while ($data=$rslSet->fetch_object()) {
					$data=$data->data;
					if (is_null($objImg)) {
						$objImg=Imagen::fromString($data);
						$objImg->fill($ancho,$alto);
					} else {
						$objImg->join(Imagen::fromString($data),"right");
						$ancho=$objImg->width();
					}
				}
			} catch (Exception $e) {
				$firephp->error($e);
				$file=BASE_IMGS_DIR.'imgErr.png';
				$objImg=Imagen::fromFile($file);
			}
		break;
		default:
			try {
				if (defined($_GET['almacen'])) {
					$file=constant($_GET['almacen']).$_GET['fichero'];
				} else {
					$file=BASE_IMGS_DIR.$_GET['fichero'];
				}
				$objImg=Imagen::fromFile($file);
			} catch (Exception $e) {
				$firephp->error($e);
				$file=BASE_IMGS_DIR.'imgErr.png';
				$objImg=Imagen::fromFile($file);
			}
	}


	ob_clean();//limpiamos el buffer antes de mandar la imagen, no queremos nada más que la imagen

	header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 60*60*24*364));

	$objImg->output($ancho,$alto,$modo,$formato,$cabecera,$calidad,$filtro);
} catch (Exception $e) {
	$firephp->info("Excepcion de tipo: ".get_class($e).". Mensaje: ".$e->getMessage()." en fichero ".$e->getFile()." en linea ".$e->getLine());
	$firephp->info($e->getTraceAsString(),"traceAsString");
	error_log ("Excepcion de tipo: ".get_class($e).". Mensaje: ".$e->getMessage()." en fichero ".$e->getFile()." en linea ".$e->getLine());
	error_log ("TRACE: ".$e->getTraceAsString());
}
?>