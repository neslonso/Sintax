<?
class Multi_producto extends \Sintax\Core\Entity implements \Sintax\Core\IEntity {
	protected static $table="multi_producto";
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
			"ean" => NULL,
			"referencia" => NULL,
			"nombre" => NULL,
			"descripcion" => NULL,
			"precio" => NULL,
			"peso" => NULL,
			"spot" => NULL,
			"gama" => NULL,
			"marca" => NULL,
			"idMulti_tipoIva" => NULL,
			"idMulti_productoGama" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$sql="SELECT idMulti_producto FROM multi_productoAdjunto WHERE idMulti_producto='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_productoAdjunto=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idMulti_producto FROM multi_productoVARIOSmulti_ofertaVenta WHERE idMulti_producto='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_productoVARIOSmulti_ofertaVenta=($this->db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_productoAdjunto && $noReferenciadoEnMulti_productoVARIOSmulti_ofertaVenta)?true:false;
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

	public function GETean ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["ean"],ENT_QUOTES,"UTF-8"):$this->arrDbData["ean"];}
	public function SETean ($ean,$entity_encode=false) {$this->arrDbData["ean"]=($entity_encode)?htmlentities($ean,ENT_QUOTES,"UTF-8"):$ean;}

	public function GETreferencia ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["referencia"],ENT_QUOTES,"UTF-8"):$this->arrDbData["referencia"];}
	public function SETreferencia ($referencia,$entity_encode=false) {$this->arrDbData["referencia"]=($entity_encode)?htmlentities($referencia,ENT_QUOTES,"UTF-8"):$referencia;}

	public function GETnombre ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["nombre"],ENT_QUOTES,"UTF-8"):$this->arrDbData["nombre"];}
	public function SETnombre ($nombre,$entity_encode=false) {$this->arrDbData["nombre"]=($entity_encode)?htmlentities($nombre,ENT_QUOTES,"UTF-8"):$nombre;}

	public function GETdescripcion ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["descripcion"],ENT_QUOTES,"UTF-8"):$this->arrDbData["descripcion"];}
	public function SETdescripcion ($descripcion,$entity_encode=false) {$this->arrDbData["descripcion"]=($entity_encode)?htmlentities($descripcion,ENT_QUOTES,"UTF-8"):$descripcion;}

	public function GETprecio ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["precio"],ENT_QUOTES,"UTF-8"):$this->arrDbData["precio"];}
	public function SETprecio ($precio,$entity_encode=false) {$this->arrDbData["precio"]=($entity_encode)?htmlentities($precio,ENT_QUOTES,"UTF-8"):$precio;}

	public function GETpeso ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["peso"],ENT_QUOTES,"UTF-8"):$this->arrDbData["peso"];}
	public function SETpeso ($peso,$entity_encode=false) {$this->arrDbData["peso"]=($entity_encode)?htmlentities($peso,ENT_QUOTES,"UTF-8"):$peso;}

	public function GETspot ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["spot"],ENT_QUOTES,"UTF-8"):$this->arrDbData["spot"];}
	public function SETspot ($spot,$entity_encode=false) {$this->arrDbData["spot"]=($entity_encode)?htmlentities($spot,ENT_QUOTES,"UTF-8"):$spot;}

	public function GETgama ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["gama"],ENT_QUOTES,"UTF-8"):$this->arrDbData["gama"];}
	public function SETgama ($gama,$entity_encode=false) {$this->arrDbData["gama"]=($entity_encode)?htmlentities($gama,ENT_QUOTES,"UTF-8"):$gama;}

	public function GETmarca ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["marca"],ENT_QUOTES,"UTF-8"):$this->arrDbData["marca"];}
	public function SETmarca ($marca,$entity_encode=false) {$this->arrDbData["marca"]=($entity_encode)?htmlentities($marca,ENT_QUOTES,"UTF-8"):$marca;}

	public function GETidMulti_tipoIva ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idMulti_tipoIva"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idMulti_tipoIva"];}
	public function SETidMulti_tipoIva ($idMulti_tipoIva,$entity_encode=false) {$this->arrDbData["idMulti_tipoIva"]=($entity_encode)?htmlentities($idMulti_tipoIva,ENT_QUOTES,"UTF-8"):$idMulti_tipoIva;}

	public function GETidMulti_productoGama ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idMulti_productoGama"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idMulti_productoGama"];}
	public function SETidMulti_productoGama ($idMulti_productoGama,$entity_encode=false) {$this->arrDbData["idMulti_productoGama"]=($entity_encode)?htmlentities($idMulti_productoGama,ENT_QUOTES,"UTF-8"):$idMulti_productoGama;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/

	public function objMulti_productoGama() {
		return new \Multi_productoGama($this->db(),$this->arrDbData["idMulti_productoGama"]);
	}
	public function objMulti_tipoIva() {
		return new \Multi_tipoIva($this->db(),$this->arrDbData["idMulti_tipoIva"]);
	}

/* Funciones FkTo *************************************************************/

	public function arrMulti_productoAdjunto($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_producto='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_producto='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		switch ($tipo) {
			case "arrKeys":
			case "arrClassObjs": $sql="SELECT id FROM multi_productoAdjunto".$sqlWhere.$sqlOrder.$sqlLimit;break;
			case "arrStdObjs": $sql="SELECT * FROM multi_productoAdjunto".$sqlWhere.$sqlOrder.$sqlLimit;break;
		}
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_productoAdjunto::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_productoAdjunto($this->db(),$data->{\Multi_productoAdjunto::GETkeyField()});
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
		$sqlWhere=($where!="")?" WHERE idMulti_producto='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_producto='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_productoVARIOSmulti_ofertaVenta f INNER JOIN multi_ofertaVenta ff ON f.idMulti_ofertaVenta=ff.".\Multi_ofertaVenta::GETkeyField()." ".$sqlWhere.$sqlOrder.$sqlLimit;
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
	public function yaAsociadoOferta (Multi_ofertaVenta $objOfertaVenta) {
		$sql="
			SELECT idMulti_producto FROM multi_productoVARIOSmulti_ofertaVenta
			WHERE
				idMulti_producto='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'
				AND
				idMulti_ofertaVenta='".$this->db()->real_escape_string($objOfertaVenta->GETkeyValue())."'
		";
		$result=($this->db()->get_num_rows($sql)>0)?true:false;
		return $result;
	}
	public function asociarOferta(Multi_ofertaVenta $objOfertaVenta, $cantidad, $precio) {
		if (!$this->yaAsociadoOferta($objOfertaVenta)) {
			$sql="
				INSERT INTO `multi_productoVARIOSmulti_ofertaVenta`
				(
					`idMulti_producto`, `idMulti_ofertaVenta`, `insert`, `update`, `cantidad`, `precio`
				) VALUES (
					'".$this->GETkeyValue()."',
					'".$objOfertaVenta->GETkeyValue()."',
					'".date('YmdHis')."',
					"."NULL".",
					'".$cantidad."',
					'".$precio."'
				);
			";
			$this->db()->query($sql);
		}
	}
	public function ponerEnVenta(
		$keyTienda,
		$precio,
		$title=null,
		$metaDescription=null,
		$metaKeywords=null
	) {
		$objOfertaVenta=new Multi_ofertaVenta($this->db());
		$objOfertaVenta->SETreferencia($this->GETreferencia());
		$objOfertaVenta->SETnombre($this->GETnombre());
		$objOfertaVenta->SETdescripcion($this->GETdescripcion());
		$objOfertaVenta->SETprecio($precio);
		$objOfertaVenta->SETvisible(1);
		$objOfertaVenta->SETtitle($title);
		$objOfertaVenta->SETmetaDescription($metaDescription);
		$objOfertaVenta->SETmetaKeywords($metaKeywords);
		$objOfertaVenta->SETagotado(0);
		//!!!$objOfertaVenta->SETidMulti_tipoIva($idMulti_tipoIva);
		$objOfertaVenta->SETkeyTienda($keyTienda);
		$objOfertaVenta->grabar();
		//$objOfertaVenta->asociar($this);
		$this->asociarOferta($objOfertaVenta,1,$precio);
		return $objOfertaVenta;
	}

	public static function selectTiposIva ($db,$selectedId,$nameId,$classes='',$disabled=false) {
		$sql="SELECT * FROM multi_tipoIva";
		$rsl=$db->query($sql);
		$disabled=($disabled)?'disabled="disabled"':'';
		$select='<select name="'.$nameId.'" id="'.$nameId.'" class="'.$classes.'" '.$disabled.'>';
		while ($data=$rsl->fetch_object()) {
			$selected=($selectedId==$data->id)?'selected="selected"':"";
			$text=$data->descripcion.' ('.$data->tipoIva.'%)';
			$select.='<option '.$selected.' value="'.$data->id.'">'.$text.'</option>';
		}
		$select.='</select>';
		return $select;
	}

	public function fotoRepe(\Imagen $objImagen) {
		$result=false;
		$strUna=$objImagen->toString("png");
		$md5Una=md5($strUna);
		$arrFotos=$this->arrMulti_productoAdjunto("(mimeType LIKE 'image/%' OR true)","","","arrKeys");
		foreach ($arrFotos as $idMProdAdjunto) {
			$objAdjunto=new Multi_productoAdjunto($this->db(),$idMProdAdjunto);
			$objImagenProd=Imagen::fromString($objAdjunto->GETdata());
			$strOtra=$objImagenProd->toString("png");
			$md5Otra=md5($strOtra);
			if ($md5Otra==$md5Una) {
				$result=true;
				/*
				echo '<img src="data:image/png;base64,'.base64_encode($strUna).'" />';
				echo '<------->';
				echo '<img src="data:image/png;base64,'.base64_encode($strOtra).'" />';
				echo '<hr /> - <hr />';
				*/
			}
		}
		return $result;
	}

	public static function existeEan(\MysqliDB $db, $ean) {
		$sql="SELECT * FROM ".static::$table." WHERE ean='".$db->real_escape_string($ean)."'";
		$data=$db->get_obj($sql);
		if ($data) {$result=true;} else {$result=false;}
		return $result;
	}

/******************************************************************************/
	public static function AllToSelect ($db, $idSelected="", $id="", $class="", $multiple=false, $where="", $order="", $limit="") {
		$multiple=($multiple)?'multiple="multiple"':'';
		$name=($multiple)?$id.'[]':$id;
		$result='<select name="'.$name.'" id="'.$id.'" class="'.$class.'" '.$multiple.'>';
		$arrProds=static::getArray($db,$where,$order,$limit,$tipo="arrClassObjs");
		foreach ($arrProds as $objMProd) {
			if (is_array($idSelected)) {
				$selected=(in_array($objMProd->GETid(),$idSelected))?'selected="selected"':"";
			} else {
				$selected=($idSelected==$objMProd->GETid())?'selected="selected"':"";
			}
			$result.='<option '.$selected.' value="'.$objMProd->GETid().'">'.$objMProd->GETnombre().'</option>';
		}
		$result.='</select>';
		return $result;
	}

	public static function arrRandomProds($db, $cuantos=10, $asObjectArray=true) {
		$sql="SELECT id FROM multi_producto ORDER BY RAND() LIMIT 0,".$cuantos;
		$arr=array();
		$rsl=$db->query($sql);
		while ($data=$rsl->fetch_object()) {
			if ($asObjectArray) {
				$obj=new Multi_producto($data->id);
				array_push($arr,$obj);
			} else {
				array_push($arr,$data->id);
			}
		}
		return $arr;
	}

	public static function refToId($db,$refProd) {
		$sql="SELECT id FROM multi_producto WHERE referencia='".$db->real_escape_string($refProd)."'";
		return $db->get_var($sql);
	}
	public function tipoIva() {
		return $this->objMulti_tipoIva()->GETtipoIva();
	}
	public function tipoDescuentoGama($keyTienda) {
		return $this->objMulti_productoGama()->tipoDescuento($keyTienda);
	}
	public function pai(){
		return round($this->GETprecio(),2);
	}

	public function pvp(){
		return round($this->pai()*(1+$this->tipoIVa()/100),2);
	}

	/**
	 * [compisDePedido description]
	 * @return array array asociativo que tiene como clave la una referencia
	 * de producto y como dato el numero de veces que a compartido pedido
	 * con la referencia de $this
	 */
	public function compisDePedido () {
		$arrRefs=Array();
		//seleccionar todos los pedidos en los que este la referencia de este prod
		$rsl=$this->db->query ("SELECT p.id FROM multi_pedido p INNER JOIN multi_pedidoLinea pl ON p.id=pl.idPedido
			WHERE referencia=".$this->db->real_escape_string($this->GETreferencia()));

		$list="";
		while ($pedidoData=$rsl->fetch_object()) {
			$list.=$pedidoData->id.", ";
		}
		$list=substr ($list,0,-2);
		if ($list!="") {
			$rsl2=$this->db->query("SELECT mov.referencia FROM multi_pedidoLinea pl INNER JOIN multi_ofertaVenta mov ON pl.referencia=mov.referencia
				WHERE idPedido IN (".$list.") AND mov.referencia<>'".$this->db->real_escape_string($this->GETreferencia())."' AND mov.visible=1");
			while ($linData=$rsl2->fetch_object()) {
				if (!isset($arrRefs[$linData->referencia])) $arrRefs[$linData->referencia]=0;
				$arrRefs[$linData->referencia]+=1;
			}

			$rsl2->free_result();
			//ordenamos el array
			asort ($arrRefs, SORT_NUMERIC);
			//asort hace orden ascendente, le pegamos la vuelta
			$arrRefs=array_reverse ($arrRefs,true);
		}
		return $arrRefs;
	}

}
?>
