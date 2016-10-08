<?
class Multi_pedidoDescuento extends Sintax\Core\Entity implements Sintax\Core\IEntity {
	protected static $table="multi_pedidoDescuento";
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
			"importe" => NULL,
			"tipoDescuento" => NULL,
			"concepto" => NULL,
			"orden" => NULL,
			"idPedido" => NULL,
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

	public function GETimporte ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["importe"],ENT_QUOTES,"UTF-8"):$this->arrDbData["importe"];}
	public function SETimporte ($importe,$entity_encode=false) {$this->arrDbData["importe"]=($entity_encode)?htmlentities($importe,ENT_QUOTES,"UTF-8"):$importe;}

	public function GETtipoDescuento ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["tipoDescuento"],ENT_QUOTES,"UTF-8"):$this->arrDbData["tipoDescuento"];}
	public function SETtipoDescuento ($tipoDescuento,$entity_encode=false) {$this->arrDbData["tipoDescuento"]=($entity_encode)?htmlentities($tipoDescuento,ENT_QUOTES,"UTF-8"):$tipoDescuento;}

	public function GETconcepto ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["concepto"],ENT_QUOTES,"UTF-8"):$this->arrDbData["concepto"];}
	public function SETconcepto ($concepto,$entity_encode=false) {$this->arrDbData["concepto"]=($entity_encode)?htmlentities($concepto,ENT_QUOTES,"UTF-8"):$concepto;}

	public function GETorden ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["orden"],ENT_QUOTES,"UTF-8"):$this->arrDbData["orden"];}
	public function SETorden ($orden,$entity_encode=false) {$this->arrDbData["orden"]=($entity_encode)?htmlentities($orden,ENT_QUOTES,"UTF-8"):$orden;}

	public function GETidPedido ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idPedido"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idPedido"];}
	public function SETidPedido ($idPedido,$entity_encode=false) {$this->arrDbData["idPedido"]=($entity_encode)?htmlentities($idPedido,ENT_QUOTES,"UTF-8"):$idPedido;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/

	public function objMulti_pedido() {
		return new \Multi_pedido($this->db(),$this->arrDbData["idPedido"]);
	}

/* Funciones FkTo *************************************************************/

}
?>
