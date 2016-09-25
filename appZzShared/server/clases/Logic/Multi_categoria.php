<?
class Multi_categoria extends \Sintax\Core\Entity implements \Sintax\Core\IEntity {
	protected static $table="multi_categoria";
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
			"nombre" => NULL,
			"descripcion" => NULL,
			"visible" => NULL,
			"abierto" => NULL,
			"title" => NULL,
			"metaDescription" => NULL,
			"metaKeywords" => NULL,
			"keyTienda" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$sql="SELECT idMulti_categoriaContenida FROM multi_categoriaVARIOSmulti_categoria WHERE idMulti_categoriaContenida='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_categoriaVARIOSmulti_categoria=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idMulti_categoriaContenedora FROM multi_categoriaVARIOSmulti_categoria WHERE idMulti_categoriaContenedora='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_categoriaVARIOSmulti_categoria=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idMulti_categoria FROM multi_categoriaVARIOSmulti_ofertaVenta WHERE idMulti_categoria='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_categoriaVARIOSmulti_ofertaVenta=($this->db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_categoriaVARIOSmulti_categoria && $noReferenciadoEnMulti_categoriaVARIOSmulti_categoria && $noReferenciadoEnMulti_categoriaVARIOSmulti_ofertaVenta)?true:false;
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

	public function GETnombre ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["nombre"],ENT_QUOTES,"UTF-8"):$this->arrDbData["nombre"];}
	public function SETnombre ($nombre,$entity_encode=false) {$this->arrDbData["nombre"]=($entity_encode)?htmlentities($nombre,ENT_QUOTES,"UTF-8"):$nombre;}

	public function GETdescripcion ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["descripcion"],ENT_QUOTES,"UTF-8"):$this->arrDbData["descripcion"];}
	public function SETdescripcion ($descripcion,$entity_encode=false) {$this->arrDbData["descripcion"]=($entity_encode)?htmlentities($descripcion,ENT_QUOTES,"UTF-8"):$descripcion;}

	public function GETvisible ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["visible"],ENT_QUOTES,"UTF-8"):$this->arrDbData["visible"];}
	public function SETvisible ($visible,$entity_encode=false) {$this->arrDbData["visible"]=($entity_encode)?htmlentities($visible,ENT_QUOTES,"UTF-8"):$visible;}

	public function GETabierto ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["abierto"],ENT_QUOTES,"UTF-8"):$this->arrDbData["abierto"];}
	public function SETabierto ($abierto,$entity_encode=false) {$this->arrDbData["abierto"]=($entity_encode)?htmlentities($abierto,ENT_QUOTES,"UTF-8"):$abierto;}

	public function GETtitle ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["title"],ENT_QUOTES,"UTF-8"):$this->arrDbData["title"];}
	public function SETtitle ($title,$entity_encode=false) {$this->arrDbData["title"]=($entity_encode)?htmlentities($title,ENT_QUOTES,"UTF-8"):$title;}

	public function GETmetaDescription ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["metaDescription"],ENT_QUOTES,"UTF-8"):$this->arrDbData["metaDescription"];}
	public function SETmetaDescription ($metaDescription,$entity_encode=false) {$this->arrDbData["metaDescription"]=($entity_encode)?htmlentities($metaDescription,ENT_QUOTES,"UTF-8"):$metaDescription;}

	public function GETmetaKeywords ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["metaKeywords"],ENT_QUOTES,"UTF-8"):$this->arrDbData["metaKeywords"];}
	public function SETmetaKeywords ($metaKeywords,$entity_encode=false) {$this->arrDbData["metaKeywords"]=($entity_encode)?htmlentities($metaKeywords,ENT_QUOTES,"UTF-8"):$metaKeywords;}

	public function GETkeyTienda ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["keyTienda"],ENT_QUOTES,"UTF-8"):$this->arrDbData["keyTienda"];}
	public function SETkeyTienda ($keyTienda,$entity_encode=false) {$this->arrDbData["keyTienda"]=($entity_encode)?htmlentities($keyTienda,ENT_QUOTES,"UTF-8"):$keyTienda;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/


/* Funciones FkTo *************************************************************/

	public function arrMulti_categoriaPadre($where="",$order="",$limit="",$tipo="arrStdObjs") {
		return $this->arrMulti_categoriaByIdMulti_categoriaContenida($where,$order,$limit,$tipo);
	}
	public function arrMulti_categoriaByIdMulti_categoriaContenida($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_categoriaContenida='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_categoriaContenida='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_categoriaVARIOSmulti_categoria f INNER JOIN multi_categoria ff ON f.idMulti_categoriaContenedora=ff.".\Multi_categoria::GETkeyField()." ".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->idMulti_categoriaContenedora);break;
				case "arrClassObjs":
					$obj=new \Multi_categoria($this->db(),$data->idMulti_categoriaContenedora);
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
	public function arrMulti_categoriaHija($where="",$order="",$limit="",$tipo="arrStdObjs") {
		return $this->arrMulti_categoriaByIdMulti_categoriaContenedora($where,$order,$limit,$tipo);
	}
	public function arrMulti_categoriaByIdMulti_categoriaContenedora($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_categoriaContenedora='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_categoriaContenedora='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_categoriaVARIOSmulti_categoria f INNER JOIN multi_categoria ff ON f.idMulti_categoriaContenedora=ff.".\Multi_categoria::GETkeyField()." ".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->idMulti_categoriaContenida);break;
				case "arrClassObjs":
					$obj=new \Multi_categoria($this->db(),$data->idMulti_categoriaContenida);
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
	public function arrMulti_ofertaVenta($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_categoria='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_categoria='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_categoriaVARIOSmulti_ofertaVenta f INNER JOIN multi_ofertaVenta ff ON f.idMulti_ofertaVenta=ff.".\Multi_ofertaVenta::GETkeyField()." ".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_ofertaVenta::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_ofertaVenta($this->db(),$data->{\Multi_ofertaVenta::GETkeyField()});
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
	public static function getRoots(\MysqliDB $db,$where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_categoriaContenedora IS NULL AND ".$where:" WHERE idMulti_categoriaContenedora IS NULL";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_categoria mc LEFT JOIN multi_categoriaVARIOSmulti_categoria mcVmc ON mc.id=mcVmc.idMulti_categoriaContenida ".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$db->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{static::$keyField});break;
				case "arrClassObjs":
					$obj=new static($db,$data->{static::$keyField});
					array_push($arr,$obj);
					unset ($obj);
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
	public static function getRelations(\MysqliDB $db,$where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE ".$where:"";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_categoria mc INNER JOIN multi_categoriaVARIOSmulti_categoria mcVmc ON mc.id=mcVmc.idMulti_categoriaContenedora ".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$db->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{static::$keyField});break;
				case "arrClassObjs":
					$obj=new static($db,$data->{static::$keyField});
					array_push($arr,$obj);
					unset ($obj);
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
	/*
	public function arrDescendientes($where="",$order="",$limit="") {
		$arr=array();
		foreach ($this->arrMulti_categoriaHija($where,$order,$limit,"arrClassObjs") as $objContenida) {
			array_push($arr,$objContenida);
			foreach ($objContenida->arrDescendientes($where,$order,$limit,"arrClassObjs") as $objContenidaEnContenida) {
				array_push($arr,$objContenidaEnContenida);
			}
		}
		return $arr;
	}
	*/
	public function arrDescendientes($where="",$order="",$limit="") {
		$arr=array();
		foreach ($this->arrMulti_categoriaHija($where,$order,$limit,"arrClassObjs") as $objContenida) {
			array_push($arr,$objContenida);
			array_merge($arr,$objContenida->arrDescendientes($where,$order,$limit,"arrClassObjs"));
		}
		return $arr;
	}


	public function distancia($objCatTo) {
		if ($this->GETid()==$objCatTo->GETid()) {
			$distancia=0;
		} else {
			$arrHijas=$this->arrMulti_categoriaHija("","","","arrClassObjs");
			$distancia=false;
			foreach ($arrHijas as $objContenida) {
				$distanciaDesdeHija=$objContenida->distancia($objCatTo);
				if ($distanciaDesdeHija!==false) {
					$distancia=$distanciaDesdeHija+1;
				}
			}
		}
		return $distancia;
	}

	/*************/
	public static function AllToSelect ($db, $idSelectedCat="", $id="", $class="", $multiple=false, $numResults="", $offset="", $maxDepth="", $raiz="",$soloVisibles=true,$incluirRaiz=false) {
		$multiple=($multiple)?'multiple="multiple"':'';
		$name=($multiple)?$id.'[]':$id;
		$result='<select name="'.$name.'" id="'.$id.'" class="'.$class.'" '.$multiple.'>';
		if ($incluirRaiz) {
			$result.='<option value="" style="padding-left:0px;">[NINGUNA]</option>';
		}
		$limit='';
		if (is_numeric($numResults)) {
			$offset=(is_numeric($offset))?$offset:0;
			$limit='LIMIT '.$offset.', '.$numResults;
		}
		$raiz=(is_numeric($raiz))?'='.$raiz:'IS NULL';
		$maxDepth=(is_numeric($maxDepth))?$maxDepth:999;
		$sql='SELECT * FROM multi_categoria mc LEFT JOIN multi_categoriaVARIOSmulti_categoria mcVmc ON mc.id=mcVmc.idMulti_categoriaContenida
			WHERE mcVmc.idMulti_categoriaContenedora '.$raiz.' ORDER BY orden '.$limit;
		$rsl=$GLOBALS['db']->query($sql);
		while ($data=$rsl->fetch_object()) {
			$obj=new Multi_categoria($db,$data->id);
			$result.=$obj->AlltoSelectRecursion($idSelectedCat,0,$maxDepth,$soloVisibles);
		}
		$result.='</select>';
		return $result;
	}

	private function AllToSelectRecursion ($idSelectedCat,$actDepth,$maxDepth="",$soloVisibles=true) {
		if (is_array($idSelectedCat)) {
			$selected=(in_array($this->GETid(),$idSelectedCat))?'selected="selected"':"";
		} else {
			$selected=($idSelectedCat==$this->GETid())?'selected="selected"':"";
		}
		$result='<option '.$selected.' value="'.$this->GETid().'" style="padding-left:'.($actDepth*10).'px;">'.$this->GETnombre().'</option>';
		$where=($soloVisibles)?"visible=1":"";
		$arrHijos=$this->arrMulti_categoriaHija($where,"","","arrClassObjs");
		if (count($arrHijos)>0) {
			//$result.='<ul>';
			foreach ($arrHijos as $objCat) {
				//$GLOBALS['firephp']->info($objCat->GETnombre());
				if ($actDepth<$maxDepth) {
					$result.=$objCat->AlltoSelectRecursion($idSelectedCat,$actDepth+1,$maxDepth,$soloVisibles);
				}
			}
			//$result.='</ul>';
		}
		//$result.='</li>';
		return $result;
	}
	/*************/

	/**
	 * [arrRefsMasVendidas description]
	 * @param  string $tipo "PorPedidos" o "PorUnidades"
	 * @return array       [description]
	 */
	/**
	 * [arrRefsMasVendidas description]
	 * @param  string $tipo "PorPedidos" o "PorUnidades"
	 * @param  boolean $refresh Si se desea refrescar la cache y recalcular las referencias mas vendias
	 * @return [type]           [description]
	 */
	public function arrRefsMasVendidas($tipo="PorPedidos",$refresh=false) {
		$filePath=CACHE_DIR.__CLASS__.DIRECTORY_SEPARATOR.__FUNCTION__.DIRECTORY_SEPARATOR.'refsMasVendidas'.$tipo.'-'.$this->GETid();
		$usarCache=!$refresh && file_exists($filePath) && filemtime($filePath)>time()-(60*60*24);
		if ($usarCache) {
			$str=file_get_contents($filePath);
			$arrRefs=explode('\n',$str);
		} else {
			switch ($tipo) {
				case 'PorPedidos':
					$calculo="count(*)";
					break;
				case 'PorUnidades':
					$calculo="sum(cantidad)";
					break;
			}
			$listaIdsCats='';
			$arrDescendientes=$this->arrDescendientes();
			foreach ($arrDescendientes as $objCatDescendiente) {
				$listaIdsCats.=$objCatDescendiente->GETid().',';
			}
			$listaIdsCats.=$this->GETid();
			$arrRefs=array();
			$sql="
				SELECT referencia, ".$calculo." AS calculo FROM multi_pedidoLinea
				GROUP BY referencia
				HAVING referencia IN (
					SELECT referencia FROM multi_ofertaVenta mov INNER JOIN
						multi_categoriaVARIOSmulti_ofertaVenta mcVmov ON mov.id=mcVmov.idMulti_ofertaVenta
					WHERE idMulti_categoria IN (".$listaIdsCats.")
				)
				ORDER BY calculo DESC;
			";
			$GLOBALS['firephp']->info($sql);
			$arrRefs=$this->db()->get_arrVars($sql);

			if (!is_dir(dirname($filePath))) {
				mkdir(dirname($filePath),0700,true);
			}
			$str=implode('\n', $arrRefs);
			file_put_contents($filePath, $str);
		}
		return $arrRefs;
	}

	public function imgSrc($ancho=150,$alto=150,$filtro=NULL) {
		$arrRefs=array();
	$tArrRefsMasVendidas=microtime(true);
		$arrRefs=$this->arrRefsMasVendidas();
	$tArrRefsMasVendidas=microtime(true)-$tArrRefsMasVendidas;
	//error_log("Tiempo mas vendidas [".$this->GETid()."]: ".$tArrRefsMasVendidas);
		$arrFotos=array();
		if (count($arrRefs)>0) {
			$i=0;
			do {
				$refProd=$arrRefs[$i];
				$i++;
				$id=Multi_producto::refToId($this->db(),$refProd);
				$objMProd=new Multi_producto($this->db(),$id);
				$arrFotos=$objMProd->arrMulti_productoAdjunto("(mimeType LIKE 'image/%')","orden","","arrKeys");
			} while (count($arrFotos)==0 && isset($arrRefs[$i]));
		}
		$idMPA=(isset($arrFotos[0]))?$arrFotos[0]:false;
		$src=BASE_URL.FILE_APP.'?MODULE=images&almacen=DB&fichero=multi_productoAdjunto.id.'.$idMPA.'.data&ancho='.$ancho.'&alto='.$alto.'&filtro='.$filtro.'&modo='.Imagen::OUTPUT_MODE_FILL;
		return $src;
	}

	public function icoSrc() {
		return $this->imgSrc(30,30,"grayscale");
	}
}
?>