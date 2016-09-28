<?
class Multi_cesta extends Sintax\Core\Entity implements Sintax\Core\IEntity {
	protected static $table="multi_cesta";
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
			"idMulti_cliente" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$sql="SELECT idMulti_cesta FROM multi_cestaLinea WHERE idMulti_cesta='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_cestaLinea=($this->db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_cestaLinea)?true:false;
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

	public function GETidMulti_cliente ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idMulti_cliente"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idMulti_cliente"];}
	public function SETidMulti_cliente ($idMulti_cliente,$entity_encode=false) {$this->arrDbData["idMulti_cliente"]=($entity_encode)?htmlentities($idMulti_cliente,ENT_QUOTES,"UTF-8"):$idMulti_cliente;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/

	public function objMulti_cliente() {
		return new \Multi_cliente($this->db(),$this->arrDbData["idMulti_cliente"]);
	}

/* Funciones FkTo *************************************************************/

	public function arrMulti_cestaLinea($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_cesta='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_cesta='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
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
/******************************************************************************/
	public function getLineaOfertaOrNew($idMulti_ofertaVenta) {
		$arrLineas=$this->arrMulti_cestaLinea("idMulti_ofertaVenta='".$idMulti_ofertaVenta."'","","","arrClassObjs");
		if (count($arrLineas)==0) {
			$objLinea=new \Multi_cestaLinea($this->db());
		} else if (count($arrLineas)==1) {
			$objLinea=$arrLineas[0];
		} else {
			throw new Exception("Más de una línea para la misma oferta en la misma cesta", 1);
		}
		return $objLinea;
	}
}
?>
