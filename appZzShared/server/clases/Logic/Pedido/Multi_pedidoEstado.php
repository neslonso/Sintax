<?
class Multi_pedidoEstado extends Sintax\Core\Entity implements Sintax\Core\IEntity {
	protected static $table="multi_pedidoEstado";
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
			"orden" => NULL,
			"pagado" => NULL,
			"preparable" => NULL,
			"preparado" => NULL,
			"enviado" => NULL,
			"plantillaCorreo" => NULL,
			"idPedidoModoPago" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$sql="SELECT idMulti_pedidoEstado FROM multi_pedidoEstadoAccion WHERE idMulti_pedidoEstado='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_pedidoEstadoAccion=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idMulti_pedidoEstado FROM multi_pedidoPasoProceso WHERE idMulti_pedidoEstado='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_pedidoPasoProceso=($this->db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_pedidoEstadoAccion && $noReferenciadoEnMulti_pedidoPasoProceso)?true:false;
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

	public function GETorden ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["orden"],ENT_QUOTES,"UTF-8"):$this->arrDbData["orden"];}
	public function SETorden ($orden,$entity_encode=false) {$this->arrDbData["orden"]=($entity_encode)?htmlentities($orden,ENT_QUOTES,"UTF-8"):$orden;}

	public function GETpagado ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["pagado"],ENT_QUOTES,"UTF-8"):$this->arrDbData["pagado"];}
	public function SETpagado ($pagado,$entity_encode=false) {$this->arrDbData["pagado"]=($entity_encode)?htmlentities($pagado,ENT_QUOTES,"UTF-8"):$pagado;}

	public function GETpreparable ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["preparable"],ENT_QUOTES,"UTF-8"):$this->arrDbData["preparable"];}
	public function SETpreparable ($preparable,$entity_encode=false) {$this->arrDbData["preparable"]=($entity_encode)?htmlentities($preparable,ENT_QUOTES,"UTF-8"):$preparable;}

	public function GETpreparado ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["preparado"],ENT_QUOTES,"UTF-8"):$this->arrDbData["preparado"];}
	public function SETpreparado ($preparado,$entity_encode=false) {$this->arrDbData["preparado"]=($entity_encode)?htmlentities($preparado,ENT_QUOTES,"UTF-8"):$preparado;}

	public function GETenviado ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["enviado"],ENT_QUOTES,"UTF-8"):$this->arrDbData["enviado"];}
	public function SETenviado ($enviado,$entity_encode=false) {$this->arrDbData["enviado"]=($entity_encode)?htmlentities($enviado,ENT_QUOTES,"UTF-8"):$enviado;}

	public function GETplantillaCorreo ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["plantillaCorreo"],ENT_QUOTES,"UTF-8"):$this->arrDbData["plantillaCorreo"];}
	public function SETplantillaCorreo ($plantillaCorreo,$entity_encode=false) {$this->arrDbData["plantillaCorreo"]=($entity_encode)?htmlentities($plantillaCorreo,ENT_QUOTES,"UTF-8"):$plantillaCorreo;}

	public function GETidPedidoModoPago ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idPedidoModoPago"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idPedidoModoPago"];}
	public function SETidPedidoModoPago ($idPedidoModoPago,$entity_encode=false) {$this->arrDbData["idPedidoModoPago"]=($entity_encode)?htmlentities($idPedidoModoPago,ENT_QUOTES,"UTF-8"):$idPedidoModoPago;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/

	public function objMulti_pedidoModoPago() {
		return new \Multi_pedidoModoPago($this->db(),$this->arrDbData["idPedidoModoPago"]);
	}

/* Funciones FkTo *************************************************************/

	public function arrMulti_pedidoEstadoAccion($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_pedidoEstado='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_pedidoEstado='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedidoEstadoAccion".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_pedidoEstadoAccion::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_pedidoEstadoAccion($this->db(),$data->{\Multi_pedidoEstadoAccion::GETkeyField()});
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
	public function arrMulti_pedidoPasoProceso($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_pedidoEstado='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_pedidoEstado='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedidoPasoProceso".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_pedidoPasoProceso::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_pedidoPasoProceso($this->db(),$data->{\Multi_pedidoPasoProceso::GETkeyField()});
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
}
?>
