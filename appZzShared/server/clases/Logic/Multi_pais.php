<?
class Multi_pais extends \Sintax\Core\Entity implements \Sintax\Core\IEntity {
	protected static $table="multi_pais";
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
			"alpha2" => NULL,
			"alpha3" => NULL,
			"numeric" => NULL,
			"nombre_es" => NULL,
			"nombre_en" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$sql="SELECT idMulti_pais FROM multi_paisSinonimo WHERE idMulti_pais='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_paisSinonimo=($this->db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_paisSinonimo)?true:false;
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

	public function GETalpha2 ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["alpha2"],ENT_QUOTES,"UTF-8"):$this->arrDbData["alpha2"];}
	public function SETalpha2 ($alpha2,$entity_encode=false) {$this->arrDbData["alpha2"]=($entity_encode)?htmlentities($alpha2,ENT_QUOTES,"UTF-8"):$alpha2;}

	public function GETalpha3 ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["alpha3"],ENT_QUOTES,"UTF-8"):$this->arrDbData["alpha3"];}
	public function SETalpha3 ($alpha3,$entity_encode=false) {$this->arrDbData["alpha3"]=($entity_encode)?htmlentities($alpha3,ENT_QUOTES,"UTF-8"):$alpha3;}

	public function GETnumeric ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["numeric"],ENT_QUOTES,"UTF-8"):$this->arrDbData["numeric"];}
	public function SETnumeric ($numeric,$entity_encode=false) {$this->arrDbData["numeric"]=($entity_encode)?htmlentities($numeric,ENT_QUOTES,"UTF-8"):$numeric;}

	public function GETnombre_es ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["nombre_es"],ENT_QUOTES,"UTF-8"):$this->arrDbData["nombre_es"];}
	public function SETnombre_es ($nombre_es,$entity_encode=false) {$this->arrDbData["nombre_es"]=($entity_encode)?htmlentities($nombre_es,ENT_QUOTES,"UTF-8"):$nombre_es;}

	public function GETnombre_en ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["nombre_en"],ENT_QUOTES,"UTF-8"):$this->arrDbData["nombre_en"];}
	public function SETnombre_en ($nombre_en,$entity_encode=false) {$this->arrDbData["nombre_en"]=($entity_encode)?htmlentities($nombre_en,ENT_QUOTES,"UTF-8"):$nombre_en;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/


/* Funciones FkTo *************************************************************/

	public function arrMulti_paisSinonimo($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_pais='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_pais='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_paisSinonimo".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_paisSinonimo::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_paisSinonimo($this->db(),$data->{\Multi_paisSinonimo::GETkeyField()});
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
