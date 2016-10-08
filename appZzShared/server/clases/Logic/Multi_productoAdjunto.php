<?
class Multi_productoAdjunto extends \Sintax\Core\Entity implements \Sintax\Core\IEntity {
	protected static $table="multi_productoAdjunto";
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
			"mimeType" => NULL,
			"filename" => NULL,
			"description" => NULL,
			"data" => NULL,
			"orden" => NULL,
			"idMulti_producto" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$result=true;
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

	public function GETmimeType ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["mimeType"],ENT_QUOTES,"UTF-8"):$this->arrDbData["mimeType"];}
	public function SETmimeType ($mimeType,$entity_encode=false) {$this->arrDbData["mimeType"]=($entity_encode)?htmlentities($mimeType,ENT_QUOTES,"UTF-8"):$mimeType;}

	public function GETfilename ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["filename"],ENT_QUOTES,"UTF-8"):$this->arrDbData["filename"];}
	public function SETfilename ($filename,$entity_encode=false) {$this->arrDbData["filename"]=($entity_encode)?htmlentities($filename,ENT_QUOTES,"UTF-8"):$filename;}

	public function GETdescription ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["description"],ENT_QUOTES,"UTF-8"):$this->arrDbData["description"];}
	public function SETdescription ($description,$entity_encode=false) {$this->arrDbData["description"]=($entity_encode)?htmlentities($description,ENT_QUOTES,"UTF-8"):$description;}

	public function GETdata ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["data"],ENT_QUOTES,"UTF-8"):$this->arrDbData["data"];}
	public function SETdata ($data,$entity_encode=false) {$this->arrDbData["data"]=($entity_encode)?htmlentities($data,ENT_QUOTES,"UTF-8"):$data;}

	public function GETorden ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["orden"],ENT_QUOTES,"UTF-8"):$this->arrDbData["orden"];}
	public function SETorden ($orden,$entity_encode=false) {$this->arrDbData["orden"]=($entity_encode)?htmlentities($orden,ENT_QUOTES,"UTF-8"):$orden;}

	public function GETidMulti_producto ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idMulti_producto"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idMulti_producto"];}
	public function SETidMulti_producto ($idMulti_producto,$entity_encode=false) {$this->arrDbData["idMulti_producto"]=($entity_encode)?htmlentities($idMulti_producto,ENT_QUOTES,"UTF-8"):$idMulti_producto;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/

	public function objMulti_producto() {
		return new \Multi_producto($this->db(),$this->arrDbData["idMulti_producto"]);
	}

/* Funciones FkTo *************************************************************/

}
?>
