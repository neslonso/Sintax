<?
class Multi_cupon extends \Sintax\Core\Entity implements \Sintax\Core\IEntity {
	protected static $table="multi_cupon";
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
			"codigo" => NULL,
			"tipoDescuento" => NULL,
			"caducidad" => NULL,
			"idMulti_cliente" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$sql="SELECT idMulti_cupon FROM multi_pedido WHERE idMulti_cupon='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_pedido=($this->db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_pedido)?true:false;
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

	public function GETcodigo ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["codigo"],ENT_QUOTES,"UTF-8"):$this->arrDbData["codigo"];}
	public function SETcodigo ($codigo,$entity_encode=false) {$this->arrDbData["codigo"]=($entity_encode)?htmlentities($codigo,ENT_QUOTES,"UTF-8"):$codigo;}

	public function GETtipoDescuento ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["tipoDescuento"],ENT_QUOTES,"UTF-8"):$this->arrDbData["tipoDescuento"];}
	public function SETtipoDescuento ($tipoDescuento,$entity_encode=false) {$this->arrDbData["tipoDescuento"]=($entity_encode)?htmlentities($tipoDescuento,ENT_QUOTES,"UTF-8"):$tipoDescuento;}

	public function GETcaducidad ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["caducidad"],ENT_QUOTES,"UTF-8"):$this->arrDbData["caducidad"];}
	public function SETcaducidad ($caducidad,$entity_encode=false) {$this->arrDbData["caducidad"]=($entity_encode)?htmlentities($caducidad,ENT_QUOTES,"UTF-8"):$caducidad;}

	public function GETidMulti_cliente ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idMulti_cliente"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idMulti_cliente"];}
	public function SETidMulti_cliente ($idMulti_cliente,$entity_encode=false) {$this->arrDbData["idMulti_cliente"]=($entity_encode)?htmlentities($idMulti_cliente,ENT_QUOTES,"UTF-8"):$idMulti_cliente;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/

	public function objMulti_cliente() {
		return new \Multi_cliente($this->db(),$this->arrDbData["idMulti_cliente"]);
	}

/* Funciones FkTo *************************************************************/

	public function arrMulti_pedido($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_cupon='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_cupon='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
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
/******************************************************************************/
	public function caducado() {
		$caducidadUnix=Fecha::fromMysql($this->GETcaducidad())->GETdate();
		if ($caducidadUnix<time()) {
			$result=true;
		} else {
			$result=false;
		}
		return $result;
	}

	public function getlistaPedidos() {
		$glue=', ';
		$lista='';
		foreach ($this->arrMulti_pedido() as $stdObj) {
			$lista.=$stdObj->keyTienda.'-'.$stdObj->numero.$glue;
		}
		$lista=substr($lista,0,strlen($glue));
		return $lista;
	}

	public static function cargarPorCodigo($db,$codigo) {
		$result=false;
		$codigo=strtoupper($codigo);
		$sql="SELECT * FROM multi_cupon WHERE codigo='".$db->real_escape_string($codigo)."'";
		$data=$db->get_row($sql);
		if ($data) {
			$result=new self($db,$data->id);
		}
		return $result;
	}

	public function yaUtilizadoPor($idMulti_cliente) {
		$sql="SELECT id FROM multi_pedido WHERE idMulti_cupon='".$this->db()->real_escape_string($this->GETid())."' AND idMulti_cliente='".$this->db()->real_escape_string($idMulti_cliente)."'";
		$rsl=$this->db()->query($sql);
		$result=false;
		while ($data=$rsl->fetch_object()) {
			$objPed=new Multi_pedido($this->db(),$data->id);
			$objPedidoEstado=new Multi_pedidoEstado($this->db(),$objPed->estadoPasoProcesoActual());
			if ($objPedidoEstado->GETpagado() || $objPedidoEstado->GETpreparado() || $objPedidoEstado->GETenviado()) {
				$result=true;
			}
		}
		return $result;
	}


}
?>
