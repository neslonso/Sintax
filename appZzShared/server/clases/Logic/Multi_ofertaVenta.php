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
			"tipoDevolucionCredito" => NULL,
			"keyTienda" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$sql="SELECT idMulti_ofertaVenta FROM multi_categoriaVARIOSmulti_ofertaVenta WHERE idMulti_ofertaVenta='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_categoriaVARIOSmulti_ofertaVenta=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idMulti_ofertaVenta FROM multi_cestaLinea WHERE idMulti_ofertaVenta='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_cestaLinea=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idMulti_ofertaVenta FROM multi_productoVARIOSmulti_ofertaVenta WHERE idMulti_ofertaVenta='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_productoVARIOSmulti_ofertaVenta=($this->db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_categoriaVARIOSmulti_ofertaVenta && $noReferenciadoEnMulti_cestaLinea && $noReferenciadoEnMulti_productoVARIOSmulti_ofertaVenta)?true:false;
		return $result;
	}
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

	public function GETtipoDevolucionCredito ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["tipoDevolucionCredito"],ENT_QUOTES,"UTF-8"):$this->arrDbData["tipoDevolucionCredito"];}
	public function SETtipoDevolucionCredito ($tipoDevolucionCredito,$entity_encode=false) {$this->arrDbData["tipoDevolucionCredito"]=($entity_encode)?htmlentities($tipoDevolucionCredito,ENT_QUOTES,"UTF-8"):$tipoDevolucionCredito;}

	public function GETkeyTienda ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["keyTienda"],ENT_QUOTES,"UTF-8"):$this->arrDbData["keyTienda"];}
	public function SETkeyTienda ($keyTienda,$entity_encode=false) {$this->arrDbData["keyTienda"]=($entity_encode)?htmlentities($keyTienda,ENT_QUOTES,"UTF-8"):$keyTienda;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/


/* Funciones FkTo *************************************************************/

	public function arrMulti_categoria($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_ofertaVenta='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_ofertaVenta='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_categoriaVARIOSmulti_ofertaVenta f INNER JOIN multi_categoria ff ON f.idMulti_categoria=ff.".\Multi_categoria::GETkeyField()." ".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_categoria::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_categoria($this->db(),$data->{\Multi_categoria::GETkeyField()});
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
	public function arrMulti_cestaLinea($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_ofertaVenta='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_ofertaVenta='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_cestaLinea".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_cestaLinea::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_cestaLinea($this->db(),$data->{\Multi_cestaLinea::GETkeyField()});
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
	public function arrMulti_producto($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_ofertaVenta='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_ofertaVenta='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_productoVARIOSmulti_ofertaVenta f INNER JOIN multi_producto ff ON f.idMulti_producto=ff.".\Multi_producto::GETkeyField()." ".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_producto::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_producto($this->db(),$data->{\Multi_producto::GETkeyField()});
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
	public static function cargarPorRef($db,$keyTienda,$ref) {
		$result=false;
		$sql="SELECT id FROM multi_ofertaVenta WHERE keyTienda='".$db->real_escape_string($keyTienda)."' AND referencia='".$db->real_escape_string($ref)."'";
		$data=$db->get_row($sql);
		if ($data) {
			$result=new self($db,$data->id);
		}
		return $result;
	}
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
	public function tipoIva() {
		$arrProds=$this->arrMulti_producto("","","","arrClassObjs");
		$tipoIva=0;
		if (count($arrProds)==1) {
			$tipoIva=$arrProds[0]->tipoIva();
		} else {
			//TODO: Imprescindible, saber que hacer aquí
			throw new Exception("No sabemos que hacer con los packs de productos", 1);
			$tipoIva=$arrProds[0]->tipoIva();
		}
		return $tipoIva;
	}
	public function pai(){
		return round($this->GETprecio(),2);
	}
	public function paiCatalogo() {
		$arrProds=$this->arrMulti_producto("","","","arrClassObjs");
		$pvpCatalogo=0;
		if (count($arrProds)==1) {
			$pvpCatalogo=$arrProds[0]->pai();
		} else {
			//TODO: Imprescindible, saber que hacer aquí, tendremos q sumar los precios de los pai de catalogo
			throw new Exception("No sabemos que hacer con los packs de productos", 1);
			$pvpCatalogo=$arrProds[0]->pai();
		}
		return $pvpCatalogo;
	}
	public function pvp(){
		return round($this->pai()*(1+$this->tipoIVa()/100),2);
	}
	public function pvpCatalogo(){
		return round($this->paiCatalogo()*(1+$this->tipoIVa()/100),2);
	}
	public function descuentoOferta(){
		$pvpCatalogo=$this->pvpCatalogo();
		$dif=$pvpCatalogo-$this->pvp();
		return round(($dif/$pvpCatalogo)*100,2);
	}
	/**
	 * [imgSrc description]
	 * @param  integer $i [description]
	 * @return [type]     [description]
	 */
	public function imgId($i=0) {
		$arrFotosPpalesOferta=array();
		$arrProds=$this->arrMulti_producto("","","","arrClassObjs");
		foreach ($arrProds as $objMProd) {
			$arrFotos=$objMProd->arrMulti_productoAdjunto("(mimeType LIKE 'image/%')","orden","0,1","arrKeys");
			array_push($arrFotosPpalesOferta,$arrFotos[$i]);
		}
		$idMPA=$arrFotosPpalesOferta[$i];
		return $idMPA;
	}
	/**
	 * Devuelve la url de la imagen de indice $i de un array compuesto por la primera imagen de cada producto de la foto
	 * @param  int $i indice
	 * @return string url de la imagen
	 */
	public function imgSrc($i=0,$ancho=150,$alto=150) {
		$idMPA=$this->imgId($i);
		$src=BASE_URL.FILE_APP.'?MODULE=images&almacen=DB&fichero=multi_productoAdjunto.id.'.$idMPA.'.data&ancho='.$ancho.'&alto='.$alto.'&modo='.Imagen::OUTPUT_MODE_FILL;
		return $src;
	}

	public static function arrIdsMayorDescuento($db,$keyTienda,$limit=10) {
		$sql="
			SELECT mov.id, (1-mov.precio/mp.precio)*100 AS dto FROM multi_producto mp
				INNER JOIN multi_productoVARIOSmulti_ofertaVenta mpVmov ON mp.id=mpVmov.idMulti_producto
				INNER JOIN multi_ofertaVenta mov ON mpVmov.idMulti_ofertaVenta=mov.id
			WHERE keyTienda='".$keyTienda."' AND visible=1 AND agotado=0 ORDER BY dto DESC
			LIMIT 0,".$limit;
		$rsl=$db->query($sql);
		$arrIds=array();
		while ($data=$rsl->fetch_object()) {
			$arrIds[]=$data->id;
		}
		return $arrIds;
	}

/******************************************************************************/
}
?>