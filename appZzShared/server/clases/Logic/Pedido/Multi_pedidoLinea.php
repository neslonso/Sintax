<?
class Multi_pedidoLinea extends Sintax\Core\Entity implements Sintax\Core\IEntity {
	protected static $table="multi_pedidoLinea";
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
			"concepto" => NULL,
			"cantidad" => NULL,
			"precio" => NULL,
			"tipoIva" => NULL,
			"tipoRE" => NULL,
			"peso" => NULL,
			"idPedido" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$sql="SELECT idPedidoLinea FROM multi_pedidoLineaCredito WHERE idPedidoLinea='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_pedidoLineaCredito=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idPedidoLinea FROM multi_pedidoLineaDescuento WHERE idPedidoLinea='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_pedidoLineaDescuento=($this->db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_pedidoLineaCredito && $noReferenciadoEnMulti_pedidoLineaDescuento)?true:false;
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

	public function GETconcepto ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["concepto"],ENT_QUOTES,"UTF-8"):$this->arrDbData["concepto"];}
	public function SETconcepto ($concepto,$entity_encode=false) {$this->arrDbData["concepto"]=($entity_encode)?htmlentities($concepto,ENT_QUOTES,"UTF-8"):$concepto;}

	public function GETcantidad ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["cantidad"],ENT_QUOTES,"UTF-8"):$this->arrDbData["cantidad"];}
	public function SETcantidad ($cantidad,$entity_encode=false) {$this->arrDbData["cantidad"]=($entity_encode)?htmlentities($cantidad,ENT_QUOTES,"UTF-8"):$cantidad;}

	public function GETprecio ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["precio"],ENT_QUOTES,"UTF-8"):$this->arrDbData["precio"];}
	public function SETprecio ($precio,$entity_encode=false) {$this->arrDbData["precio"]=($entity_encode)?htmlentities($precio,ENT_QUOTES,"UTF-8"):$precio;}

	public function GETtipoIva ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["tipoIva"],ENT_QUOTES,"UTF-8"):$this->arrDbData["tipoIva"];}
	public function SETtipoIva ($tipoIva,$entity_encode=false) {$this->arrDbData["tipoIva"]=($entity_encode)?htmlentities($tipoIva,ENT_QUOTES,"UTF-8"):$tipoIva;}

	public function GETtipoRE ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["tipoRE"],ENT_QUOTES,"UTF-8"):$this->arrDbData["tipoRE"];}
	public function SETtipoRE ($tipoRE,$entity_encode=false) {$this->arrDbData["tipoRE"]=($entity_encode)?htmlentities($tipoRE,ENT_QUOTES,"UTF-8"):$tipoRE;}

	public function GETpeso ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["peso"],ENT_QUOTES,"UTF-8"):$this->arrDbData["peso"];}
	public function SETpeso ($peso,$entity_encode=false) {$this->arrDbData["peso"]=($entity_encode)?htmlentities($peso,ENT_QUOTES,"UTF-8"):$peso;}

	public function GETidPedido ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idPedido"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idPedido"];}
	public function SETidPedido ($idPedido,$entity_encode=false) {$this->arrDbData["idPedido"]=($entity_encode)?htmlentities($idPedido,ENT_QUOTES,"UTF-8"):$idPedido;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/

	public function objMulti_pedido() {
		return new \Multi_pedido($this->db(),$this->arrDbData["idPedido"]);
	}

/* Funciones FkTo *************************************************************/

	public function arrMulti_pedidoLineaCredito($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idPedidoLinea='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idPedidoLinea='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedidoLineaCredito".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_pedidoLineaCredito::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_pedidoLineaCredito($this->db(),$data->{\Multi_pedidoLineaCredito::GETkeyField()});
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
	public function arrMulti_pedidoLineaDescuento($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idPedidoLinea='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idPedidoLinea='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedidoLineaDescuento".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_pedidoLineaDescuento::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_pedidoLineaDescuento($this->db(),$data->{\Multi_pedidoLineaDescuento::GETkeyField()});
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
