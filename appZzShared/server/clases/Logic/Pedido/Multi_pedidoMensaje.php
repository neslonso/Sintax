<?
class Multi_pedidoMensaje extends Sintax\Core\Entity implements Sintax\Core\IEntity {
	protected static $table="multi_pedidoMensaje";
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
			"mensaje" => NULL,
			"deCliente" => NULL,
			"leido" => NULL,
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

	public function GETmensaje ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["mensaje"],ENT_QUOTES,"UTF-8"):$this->arrDbData["mensaje"];}
	public function SETmensaje ($mensaje,$entity_encode=false) {$this->arrDbData["mensaje"]=($entity_encode)?htmlentities($mensaje,ENT_QUOTES,"UTF-8"):$mensaje;}

	public function GETdeCliente ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["deCliente"],ENT_QUOTES,"UTF-8"):$this->arrDbData["deCliente"];}
	public function SETdeCliente ($deCliente,$entity_encode=false) {$this->arrDbData["deCliente"]=($entity_encode)?htmlentities($deCliente,ENT_QUOTES,"UTF-8"):$deCliente;}

	public function GETleido ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["leido"],ENT_QUOTES,"UTF-8"):$this->arrDbData["leido"];}
	public function SETleido ($leido,$entity_encode=false) {$this->arrDbData["leido"]=($entity_encode)?htmlentities($leido,ENT_QUOTES,"UTF-8"):$leido;}

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
