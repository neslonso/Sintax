<?
class Multi_cestaLinea extends Sintax\Core\Entity implements Sintax\Core\IEntity {
	protected static $table="multi_cestaLinea";
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
			"cantidad" => NULL,
			"idMulti_cesta" => NULL,
			"idMulti_ofertaVenta" => NULL,
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

	public function GETcantidad ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["cantidad"],ENT_QUOTES,"UTF-8"):$this->arrDbData["cantidad"];}
	public function SETcantidad ($cantidad,$entity_encode=false) {$this->arrDbData["cantidad"]=($entity_encode)?htmlentities($cantidad,ENT_QUOTES,"UTF-8"):$cantidad;}

	public function GETidMulti_cesta ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idMulti_cesta"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idMulti_cesta"];}
	public function SETidMulti_cesta ($idMulti_cesta,$entity_encode=false) {$this->arrDbData["idMulti_cesta"]=($entity_encode)?htmlentities($idMulti_cesta,ENT_QUOTES,"UTF-8"):$idMulti_cesta;}

	public function GETidMulti_ofertaVenta ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idMulti_ofertaVenta"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idMulti_ofertaVenta"];}
	public function SETidMulti_ofertaVenta ($idMulti_ofertaVenta,$entity_encode=false) {$this->arrDbData["idMulti_ofertaVenta"]=($entity_encode)?htmlentities($idMulti_ofertaVenta,ENT_QUOTES,"UTF-8"):$idMulti_ofertaVenta;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/

	public function objMulti_cesta() {
		return new \Multi_cesta($this->db(),$this->arrDbData["idMulti_cesta"]);
	}
	public function objMulti_ofertaVenta() {
		return new \Multi_ofertaVenta($this->db(),$this->arrDbData["idMulti_ofertaVenta"]);
	}

/* Funciones FkTo *************************************************************/

}
?>
