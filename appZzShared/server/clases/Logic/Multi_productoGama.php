<?
class Multi_productoGama extends Sintax\Core\Entity implements Sintax\Core\IEntity {
	protected static $table="multi_productoGama";
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
			"nombreTTS" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$sql="SELECT idMulti_productoGama FROM multi_producto WHERE idMulti_productoGama='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_producto=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idMulti_productoGama FROM multi_productoGamaDescuento WHERE idMulti_productoGama='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_productoGamaDescuento=($this->db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_producto && $noReferenciadoEnMulti_productoGamaDescuento)?true:false;
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

	public function GETnombreTTS ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["nombreTTS"],ENT_QUOTES,"UTF-8"):$this->arrDbData["nombreTTS"];}
	public function SETnombreTTS ($nombreTTS,$entity_encode=false) {$this->arrDbData["nombreTTS"]=($entity_encode)?htmlentities($nombreTTS,ENT_QUOTES,"UTF-8"):$nombreTTS;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/


/* Funciones FkTo *************************************************************/

	public function arrMulti_producto($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_productoGama='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_productoGama='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_producto".$sqlWhere.$sqlOrder.$sqlLimit;
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

	public function arrMulti_productoGamaDescuento($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_productoGama='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_productoGama='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_productoGamaDescuento".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_productoGamaDescuento::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_productoGamaDescuento($this->db(),$data->{\Multi_productoGamaDescuento::GETkeyField()});
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
	public function tipoDescuento($keyTienda) {
		$result=0;
		$arrDtos=$this->arrMulti_productoGamaDescuento("keyTienda='".$keyTienda."'","","","arrClassObjs");
		foreach ($arrDtos as $objDto) {
			if ($objDto->enVigor()) {
				$result+=$objDto->GETtipoDescuento();
			}
		}
		return $result;
	}

	public function momentoFin($keyTienda) {
		$result=null;
		$arrDtos=$this->arrMulti_productoGamaDescuento("keyTienda='".$keyTienda."'","","","arrClassObjs");
		if (count($arrDtos)>0) {
			$result=$arrDtos[0]->GETmomentoFin();
		}
		return $result;
	}

}
?>