<?
class Multi_pedidoModoPago extends Sintax\Core\Entity implements Sintax\Core\IEntity {
	protected static $table="multi_pedidoModoPago";
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
			"tipoDescuento" => NULL,
			"orden" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$sql="SELECT idPedidoModoPago FROM multi_pedido WHERE idPedidoModoPago='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_pedido=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idPedidoModoPago FROM multi_pedidoEstado WHERE idPedidoModoPago='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_pedidoEstado=($this->db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_pedido && $noReferenciadoEnMulti_pedidoEstado)?true:false;
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

	public function GETtipoDescuento ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["tipoDescuento"],ENT_QUOTES,"UTF-8"):$this->arrDbData["tipoDescuento"];}
	public function SETtipoDescuento ($tipoDescuento,$entity_encode=false) {$this->arrDbData["tipoDescuento"]=($entity_encode)?htmlentities($tipoDescuento,ENT_QUOTES,"UTF-8"):$tipoDescuento;}

	public function GETorden ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["orden"],ENT_QUOTES,"UTF-8"):$this->arrDbData["orden"];}
	public function SETorden ($orden,$entity_encode=false) {$this->arrDbData["orden"]=($entity_encode)?htmlentities($orden,ENT_QUOTES,"UTF-8"):$orden;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/


/* Funciones FkTo *************************************************************/

	public function arrMulti_pedido($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idPedidoModoPago='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idPedidoModoPago='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedido".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_pedido::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_pedido($this->db(),$data->{\Multi_pedido::GETkeyField()});
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
	public function arrMulti_pedidoEstado($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idPedidoModoPago='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idPedidoModoPago='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedidoEstado".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_pedidoEstado::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_pedidoEstado($this->db(),$data->{\Multi_pedidoEstado::GETkeyField()});
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
