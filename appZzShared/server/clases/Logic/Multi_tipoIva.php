<?
class Multi_tipoIva extends \Sintax\Core\Entity implements \Sintax\Core\IEntity {
	protected static $table="multi_tipoIva";
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
			"descripcion" => NULL,
			"tipoIva" => NULL,
			"tipoRe" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$sql="SELECT idMulti_tipoIva FROM multi_producto WHERE idMulti_tipoIva='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_producto=($this->db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_producto)?true:false;
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

	public function GETdescripcion ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["descripcion"],ENT_QUOTES,"UTF-8"):$this->arrDbData["descripcion"];}
	public function SETdescripcion ($descripcion,$entity_encode=false) {$this->arrDbData["descripcion"]=($entity_encode)?htmlentities($descripcion,ENT_QUOTES,"UTF-8"):$descripcion;}

	public function GETtipoIva ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["tipoIva"],ENT_QUOTES,"UTF-8"):$this->arrDbData["tipoIva"];}
	public function SETtipoIva ($tipoIva,$entity_encode=false) {$this->arrDbData["tipoIva"]=($entity_encode)?htmlentities($tipoIva,ENT_QUOTES,"UTF-8"):$tipoIva;}

	public function GETtipoRe ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["tipoRe"],ENT_QUOTES,"UTF-8"):$this->arrDbData["tipoRe"];}
	public function SETtipoRe ($tipoRe,$entity_encode=false) {$this->arrDbData["tipoRe"]=($entity_encode)?htmlentities($tipoRe,ENT_QUOTES,"UTF-8"):$tipoRe;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/


/* Funciones FkTo *************************************************************/

	public function arrMulti_producto($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_tipoIva='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_tipoIva='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_producto".$sqlWhere.$sqlOrder.$sqlLimit;
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
	public static function idTipo($db, $tipo) {
		$sql='SELECT id FROM multi_tipoIva WHERE tipoIva="'.$db->real_escape_String($tipo).'"';
		$rsl=$db->query($sql);
		if ($rsl->num_rows>0) {
			$data=$rsl->fetch_object();
			$result=$data->id;
		} else {
			throw new Exception("Tipo de IVA [".$tipo."] no encontrado con consulta [".$sql."].");
		}
		return $result;
	}
}
?>
