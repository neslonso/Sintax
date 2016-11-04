<?
class Multi_productoTag extends \Sintax\Core\Entity implements \Sintax\Core\IEntity {
	protected static $table="multi_productoTag";
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
			"visible" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$sql="SELECT idMulti_productoTag FROM multi_productoTagSinonimo WHERE idMulti_productoTag='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_productoTagSinonimo=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idMulti_productoTag FROM multi_productoVARIOSmulti_productoTag WHERE idMulti_productoTag='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_productoVARIOSmulti_productoTag=($this->db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_productoTagSinonimo && $noReferenciadoEnMulti_productoVARIOSmulti_productoTag)?true:false;
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

	public function GETvisible ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["visible"],ENT_QUOTES,"UTF-8"):$this->arrDbData["visible"];}
	public function SETvisible ($visible,$entity_encode=false) {$this->arrDbData["visible"]=($entity_encode)?htmlentities($visible,ENT_QUOTES,"UTF-8"):$visible;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/


/* Funciones FkTo *************************************************************/

	//OJO!!!!, cuando se cubre una relacion varios a varios, no está en la consulta la tabla del extremo opuesto de la relacion y no se puede flitrar por sus datos.
	public function arrMulti_productoTagSinonimo($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_productoTag='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_productoTag='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_productoTagSinonimo".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_productoTagSinonimo::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_productoTagSinonimo($this->db(),$data->{\Multi_productoTagSinonimo::GETkeyField()});
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
	//OJO!!!!, cuando se cubre una relacion varios a varios, no está en la consulta la tabla del extremo opuesto de la relacion y no se puede flitrar por sus datos.
	public function arrMulti_producto($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_productoTag='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_productoTag='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_productoVARIOSmulti_productoTag f INNER JOIN multi_producto ff ON f.idMulti_producto=ff.".\Multi_producto::GETkeyField()." ".$sqlWhere.$sqlOrder.$sqlLimit;
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
	public static function cargarPorNombre($db,$nombre) {
		$sql="SELECT id FROM multi_productoTag WHERE nombre='".$db->real_escape_string($nombre)."'";
		$id=$db->get_var($sql);
		if (self::existe($db,$id)) {
			$objTag=new self($db,$id);
		} else {
			$objTag=false;
		}
		return $objTag;
	}

}
?>
