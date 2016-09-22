<?
class Multi_ofertaVenta extends \Sintax\Core\Entity implements \Sintax\Core\IEntity {
	protected static $table="multi_ofertaVenta";
	protected static $keyField="id";
	protected static $insertField="insert";
	protected static $updateField="update";

	/**
	 * [constructor de la clase]
	 * @param MysqliDB db clase de acceso a datos
	 * @param string keyValue Valor de la clave primaria que identifica el registro asociado a la instancia a construir
	 */
	public function __construct (\MysqliDB $db=NULL, $keyValue=NULL) {
		$this->arrDbData=array(
			"id" => NULL,
			"insert" => NULL,
			"update" => NULL,
			"referencia" => NULL,
			"nombre" => NULL,
			"descripcion" => NULL,
			"precio" => NULL,
			"precioMin" => NULL,
			"precioMax" => NULL,
			"visible" => NULL,
			"title" => NULL,
			"metaDescription" => NULL,
			"metaKeywords" => NULL,
			"agotado" => NULL,
			"agotadoDescripcion" => NULL,
			"keyTienda" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$sql="SELECT idMulti_ofertaVenta FROM multi_productoVARIOSmulti_ofertaVenta WHERE idMulti_ofertaVenta='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_productoVARIOSmulti_ofertaVenta=($this->db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_productoVARIOSmulti_ofertaVenta)?true:false;
		return $result;
	}
	public function GETkeyField () {return static::$keyField;}
	public function GETkeyValue ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData[static::$keyField],ENT_QUOTES,"UTF-8"):$this->arrDbData[static::$keyField];}
	public function SETkeyValue ($keyField,$entity_encode=false) {$this->arrDbData[static::$keyField]=($entity_encode)?htmlentities($keyField,ENT_QUOTES,"UTF-8"):$keyField;}

/* Getters y Setters **********************************************************/
	public function GETid ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["id"],ENT_QUOTES,"UTF-8"):$this->arrDbData["id"];}
	public function SETid ($id,$entity_encode=false) {$this->arrDbData["id"]=($entity_encode)?htmlentities($id,ENT_QUOTES,"UTF-8"):$id;}

	public function GETinsert ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["insert"],ENT_QUOTES,"UTF-8"):$this->arrDbData["insert"];}
	public function SETinsert ($insert,$entity_encode=false) {$this->arrDbData["insert"]=($entity_encode)?htmlentities($insert,ENT_QUOTES,"UTF-8"):$insert;}

	public function GETupdate ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["update"],ENT_QUOTES,"UTF-8"):$this->arrDbData["update"];}
	public function SETupdate ($update,$entity_encode=false) {$this->arrDbData["update"]=($entity_encode)?htmlentities($update,ENT_QUOTES,"UTF-8"):$update;}

	public function GETreferencia ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["referencia"],ENT_QUOTES,"UTF-8"):$this->arrDbData["referencia"];}
	public function SETreferencia ($referencia,$entity_encode=false) {$this->arrDbData["referencia"]=($entity_encode)?htmlentities($referencia,ENT_QUOTES,"UTF-8"):$referencia;}

	public function GETnombre ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["nombre"],ENT_QUOTES,"UTF-8"):$this->arrDbData["nombre"];}
	public function SETnombre ($nombre,$entity_encode=false) {$this->arrDbData["nombre"]=($entity_encode)?htmlentities($nombre,ENT_QUOTES,"UTF-8"):$nombre;}

	public function GETdescripcion ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["descripcion"],ENT_QUOTES,"UTF-8"):$this->arrDbData["descripcion"];}
	public function SETdescripcion ($descripcion,$entity_encode=false) {$this->arrDbData["descripcion"]=($entity_encode)?htmlentities($descripcion,ENT_QUOTES,"UTF-8"):$descripcion;}

	public function GETprecio ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["precio"],ENT_QUOTES,"UTF-8"):$this->arrDbData["precio"];}
	public function SETprecio ($precio,$entity_encode=false) {$this->arrDbData["precio"]=($entity_encode)?htmlentities($precio,ENT_QUOTES,"UTF-8"):$precio;}

	public function GETprecioMin ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["precioMin"],ENT_QUOTES,"UTF-8"):$this->arrDbData["precioMin"];}
	public function SETprecioMin ($precioMin,$entity_encode=false) {$this->arrDbData["precioMin"]=($entity_encode)?htmlentities($precioMin,ENT_QUOTES,"UTF-8"):$precioMin;}

	public function GETprecioMax ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["precioMax"],ENT_QUOTES,"UTF-8"):$this->arrDbData["precioMax"];}
	public function SETprecioMax ($precioMax,$entity_encode=false) {$this->arrDbData["precioMax"]=($entity_encode)?htmlentities($precioMax,ENT_QUOTES,"UTF-8"):$precioMax;}

	public function GETvisible ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["visible"],ENT_QUOTES,"UTF-8"):$this->arrDbData["visible"];}
	public function SETvisible ($visible,$entity_encode=false) {$this->arrDbData["visible"]=($entity_encode)?htmlentities($visible,ENT_QUOTES,"UTF-8"):$visible;}

	public function GETtitle ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["title"],ENT_QUOTES,"UTF-8"):$this->arrDbData["title"];}
	public function SETtitle ($title,$entity_encode=false) {$this->arrDbData["title"]=($entity_encode)?htmlentities($title,ENT_QUOTES,"UTF-8"):$title;}

	public function GETmetaDescription ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["metaDescription"],ENT_QUOTES,"UTF-8"):$this->arrDbData["metaDescription"];}
	public function SETmetaDescription ($metaDescription,$entity_encode=false) {$this->arrDbData["metaDescription"]=($entity_encode)?htmlentities($metaDescription,ENT_QUOTES,"UTF-8"):$metaDescription;}

	public function GETmetaKeywords ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["metaKeywords"],ENT_QUOTES,"UTF-8"):$this->arrDbData["metaKeywords"];}
	public function SETmetaKeywords ($metaKeywords,$entity_encode=false) {$this->arrDbData["metaKeywords"]=($entity_encode)?htmlentities($metaKeywords,ENT_QUOTES,"UTF-8"):$metaKeywords;}

	public function GETagotado ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["agotado"],ENT_QUOTES,"UTF-8"):$this->arrDbData["agotado"];}
	public function SETagotado ($agotado,$entity_encode=false) {$this->arrDbData["agotado"]=($entity_encode)?htmlentities($agotado,ENT_QUOTES,"UTF-8"):$agotado;}

	public function GETagotadoDescripcion ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["agotadoDescripcion"],ENT_QUOTES,"UTF-8"):$this->arrDbData["agotadoDescripcion"];}
	public function SETagotadoDescripcion ($agotadoDescripcion,$entity_encode=false) {$this->arrDbData["agotadoDescripcion"]=($entity_encode)?htmlentities($agotadoDescripcion,ENT_QUOTES,"UTF-8"):$agotadoDescripcion;}

	public function GETkeyTienda ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["keyTienda"],ENT_QUOTES,"UTF-8"):$this->arrDbData["keyTienda"];}
	public function SETkeyTienda ($keyTienda,$entity_encode=false) {$this->arrDbData["keyTienda"]=($entity_encode)?htmlentities($keyTienda,ENT_QUOTES,"UTF-8"):$keyTienda;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/


/* Funciones FkTo *************************************************************/

	public function arrMulti_producto($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_ofertaVenta='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_ofertaVenta='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		//TODO: OJO!, al escrbir esta consulta no conocemos el nombre de la clave primaria en la tabla del otro extremo de la relaccion manyToMany (multi_producto), se está usando siempre id.
		//TODO: 2016-09-13 Podría utilizar un metodo similar a GETkeyField en la clase del otro extremo (multi_producto) que devolviera el nombre del campo en lugar su valor.
		$sql="SELECT * FROM multi_productoVARIOSmulti_ofertaVenta INNER JOIN multi_producto ON multi_productoVARIOSmulti_ofertaVenta.idMulti_producto=multi_producto.id".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{static::$keyField});break;
				case "arrClassObjs":
					$obj=new \Multi_producto($this->db(),$data->{static::$keyField});
					array_push($arr,$obj);
					unset($obj);
				break;
				case "arrStdObjs":
					$obj=new \stdClass();
					foreach ($data as $field => $value) {
						$obj->$field=$value;
					}
					array_push($arr,$obj);
					unset ($obj);
				break;
			}
		}
		return $arr;
	}
/******************************************************************************/
	public function SETfluctuacion($precioMin,$precioMax) {
		$this->SETprecioMin($precioMin);
		$this->SETprecioMax($precioMax);
	}

	public function arrIdsCat() {
		$sql="SELECT idMulti_categoria FROM multi_categoriaVARIOSmulti_ofertaVenta WHERE idMulti_ofertaVenta='".$this->GETid()."'";
		$arr=array();
		$rsl=$GLOBALS['db']->query($sql);
		while ($data=$rsl->fetch_object()) {
			array_push($arr,$data->idMulti_categoria);
		}
		return $arr;
	}
	public function pvp(){
		return $this->GETprecio();
	}
	public function idFotoPpal(){
		return 100;
	}
	public function urlFotoPpal(){
		$idFoto=$this->idFotoPpal();
		return "./appFed16/binaries/imgs/shop-item.jpg";
	}
/******************************************************************************/
	public function lsAsignacionesProds($where="",$order="",$limit="") {
		$tInicial=microtime(true);
		$rsl=$this->lsAsignacionesProdsQuery($where,$order,$limit);
		$arr=$this->lsAsignacionesProdsBucle($rsl);
		$tTotal=microtime(true)-$tInicial;
		error_log ("/* lsAsignacionesProds ejecutado en: ".round($tTotal,3)." segundos.");
		return $arr;
	}

	public function lsAsignacionesProdsQuery($where="",$order="",$limit="") {
		$whereProd="idMulti_ofertaVenta='".$this->GETkeyValue()."'";
		$sqlWhere=($where!="")?" WHERE ".$where.' AND '.$whereProd:' WHERE '.$whereProd;
		$sqlOrder=($order!="")?" ORDER BY ".$order:'';
		$sqlLimit=($limit!="")?" LIMIT ".$limit:'';
		$sql="
			SELECT CONCAT(idMulti_producto,':',idMulti_ofertaVenta) as id, idMulti_producto, idMulti_ofertaVenta, referencia,
				nombre, cantidad, mp.precio as precioCatalogo, mpVmov.precio
			FROM multi_producto mp INNER JOIN multi_productoVARIOSmulti_ofertaVenta mpVmov ON mp.id=mpVmov.idMulti_producto
		".$sqlWhere.$sqlOrder.$sqlLimit;
		$tQuery=microtime(true);
		//error_log ("/*** lsAsignacionesProdsQuery SQL: ".$sql);
		$rsl=$GLOBALS['db']->query($sql);
		$tTotalQuery=microtime(true)-$tQuery;
		error_log ("/*** lsAsignacionesProdsQuery ejecutado en: ".round($tTotalQuery,3)." segundos.");
		return $rsl;
	}

	public function lsAsignacionesProdsBucle($rsl) {
		$tBucle=microtime(true);
		$arr=array();
		while ($data=$rsl->fetch_object()) {
			$obj=new stdClass();
			foreach ($data as $field => $value) {
				$obj->$field=$value;
			}
			array_push($arr,$obj);
			unset ($obj);
		}
		$tTotalBucle=microtime(true)-$tBucle;
		error_log ("/*** lsAsignacionesProdsBucle ejecutado en: ".round($tTotalBucle,3)." segundos.");
		return $arr;
	}

/******************************************************************************/
	public function eliminarCategorias() {
		$sql="DELETE FROM multi_categoriaVARIOSmulti_ofertaVenta WHERE idMulti_ofertaVenta='".$this->GETid()."'";
		$result=$GLOBALS['db']->query($sql);
		return $result;
	}

	public function asignarCategoria($idMulti_categoria,$principal=0,$orden=0) {
		$sqlValue_idMulti_categoria="'".$GLOBALS['db']->real_escape_string($idMulti_categoria)."'";
		$sqlValue_idMulti_ofertaVenta="'".$GLOBALS['db']->real_escape_string($this->GETid())."'";
		$sqlValue_principal="'".$GLOBALS['db']->real_escape_string($principal)."'";
		$sqlValue_orden="'".$GLOBALS['db']->real_escape_string($orden)."'";
		$sqlValue_insert=date("YmdHis");
		$sqlValue_update="NULL";
		$sql="INSERT INTO multi_categoriaVARIOSmulti_ofertaVenta (".
			"`idMulti_categoria`, ".
			"`idMulti_ofertaVenta`, ".
			"`insert`, ".
			"`update`, ".
			"`principal`, ".
			"`orden`".
			") VALUES (".
			$sqlValue_idMulti_categoria.", ".
			$sqlValue_idMulti_ofertaVenta.", ".
			$sqlValue_insert.", ".
			$sqlValue_update.", ".
			$sqlValue_principal.", ".
			$sqlValue_orden.
			")";
		$GLOBALS['db']->query($sql);
	}
/******************************************************************************/
	public function deletePackData($idMulti_producto) {
		$sql="DELETE FROM multi_productoVARIOSmulti_ofertaVenta WHERE idMulti_producto='".$idMulti_producto."' AND idMulti_ofertaVenta='".$this->GETid()."'";
		$GLOBALS['db']->query($sql);
	}

	public function setPackData($idMulti_producto,$attr,$value) {
		$sql="UPDATE multi_productoVARIOSmulti_ofertaVenta SET `".$attr."`='".$value."' WHERE idMulti_producto='".$idMulti_producto."' AND idMulti_ofertaVenta='".$this->GETid()."'";
		$GLOBALS['db']->query($sql);
	}
	public function insertPackData($idMulti_producto,$cantidad,$precio) {
		$sql="
			INSERT INTO `multi_productoVARIOSmulti_ofertaVenta` (
				`idMulti_producto`,
				`idMulti_ofertaVenta`,
				`insert`,
				`update`,
				`cantidad`,
				`precio`
			) VALUES (
				'".$idMulti_producto."',
				'".$this->GETid()."',
				'".date('YmdHis')."',
				NULL,
				'".$cantidad."',
				'".$precio."'
			);
		";
		$GLOBALS['db']->query($sql);
	}

	public function calculaArrImputacionesPrecio() {
		$result=array();
		$arrAsignacionesProds=$this->lsAsignacionesProds();
		$totalPreciosCatalogo=0;
		$totalProdsEnPack=0;
		foreach ($arrAsignacionesProds as $stdObj) {
			$totalProdsEnPack++;
			$totalPreciosCatalogo+=$stdObj->precioCatalogo;
		}
		$ratioOferta=$this->GETprecio()/$totalPreciosCatalogo;
		error_log("ratioOferta: ".$ratioOferta."=".$this->GETprecio()."/".$totalPreciosCatalogo);

		foreach ($arrAsignacionesProds as $stdObj) {
			$result[$stdObj->idMulti_producto]=$stdObj->precio*$ratioOferta;
			error_log($stdObj->referencia."=".$stdObj->precio."*".$ratioOferta);
		}
	}
/******************************************************************************/
	public static function arrRandomOfertasVenta($db,$cuantos=10, $keyTienda="", $asObjectArray=true) {
		$sql="SELECT id FROM multi_ofertaVenta where keyTienda='".$keyTienda."' ORDER BY RAND() LIMIT 0,".$cuantos;
		$arr=array();
		$rsl=$db->query($sql);
		while ($data=$rsl->fetch_object()) {
			if ($asObjectArray) {
				$objOferta=new Multi_ofertaVenta($db,$data->id);
				$obj['nombre']=$objOferta->GETnombre();
				$obj['precio']=$objOferta->pvp();
				$obj['urlFotoPpal']=$objOferta->urlFotoPpal();
				array_push($arr,$obj);
			} else {
				array_push($arr,$data->id);
			}
		}
		return $arr;
	}

}
?>
