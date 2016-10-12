<?
class Multi_productoGamaDescuento extends Sintax\Core\Entity implements Sintax\Core\IEntity {
	protected static $table="multi_productoGamaDescuento";
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
			"tipoDescuento" => NULL,
			"momentoInicio" => NULL,
			"momentoFin" => NULL,
			"idMulti_productoGama" => NULL,
			"keyTienda" => NULL,
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

	public function GETtipoDescuento ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["tipoDescuento"],ENT_QUOTES,"UTF-8"):$this->arrDbData["tipoDescuento"];}
	public function SETtipoDescuento ($tipoDescuento,$entity_encode=false) {$this->arrDbData["tipoDescuento"]=($entity_encode)?htmlentities($tipoDescuento,ENT_QUOTES,"UTF-8"):$tipoDescuento;}

	public function GETmomentoInicio ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["momentoInicio"],ENT_QUOTES,"UTF-8"):$this->arrDbData["momentoInicio"];}
	public function SETmomentoInicio ($momentoInicio,$entity_encode=false) {$this->arrDbData["momentoInicio"]=($entity_encode)?htmlentities($momentoInicio,ENT_QUOTES,"UTF-8"):$momentoInicio;}

	public function GETmomentoFin ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["momentoFin"],ENT_QUOTES,"UTF-8"):$this->arrDbData["momentoFin"];}
	public function SETmomentoFin ($momentoFin,$entity_encode=false) {$this->arrDbData["momentoFin"]=($entity_encode)?htmlentities($momentoFin,ENT_QUOTES,"UTF-8"):$momentoFin;}

	public function GETidMulti_productoGama ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idMulti_productoGama"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idMulti_productoGama"];}
	public function SETidMulti_productoGama ($idMulti_productoGama,$entity_encode=false) {$this->arrDbData["idMulti_productoGama"]=($entity_encode)?htmlentities($idMulti_productoGama,ENT_QUOTES,"UTF-8"):$idMulti_productoGama;}

	public function GETkeyTienda ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["keyTienda"],ENT_QUOTES,"UTF-8"):$this->arrDbData["keyTienda"];}
	public function SETkeyTienda ($keyTienda,$entity_encode=false) {$this->arrDbData["keyTienda"]=($entity_encode)?htmlentities($keyTienda,ENT_QUOTES,"UTF-8"):$keyTienda;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/

	public function objMulti_productoGama() {
		return new \Multi_productoGama($this->db(),$this->arrDbData["idMulti_productoGama"]);
	}

/******************************************************************************/
	public function enVigor() {
		return
			time()> \Fecha::fromMysql($this->GETmomentoInicio())->GETdate() &&
			time()< \Fecha::fromMysql($this->GETmomentoFin())->GETdate();
	}
}
?>
