<?
class Multi_pedidoPasoProceso extends Sintax\Core\Entity implements Sintax\Core\IEntity {
	protected static $table="multi_pedidoPasoProceso";
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
			"momento" => NULL,
			"descripción" => NULL,
			"idMulti_pedido" => NULL,
			"idMulti_pedidoEstado" => NULL,
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

	public function GETmomento ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["momento"],ENT_QUOTES,"UTF-8"):$this->arrDbData["momento"];}
	public function SETmomento ($momento,$entity_encode=false) {$this->arrDbData["momento"]=($entity_encode)?htmlentities($momento,ENT_QUOTES,"UTF-8"):$momento;}

	public function GETdescripción ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["descripción"],ENT_QUOTES,"UTF-8"):$this->arrDbData["descripción"];}
	public function SETdescripción ($descripción,$entity_encode=false) {$this->arrDbData["descripción"]=($entity_encode)?htmlentities($descripción,ENT_QUOTES,"UTF-8"):$descripción;}

	public function GETidMulti_pedido ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idMulti_pedido"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idMulti_pedido"];}
	public function SETidMulti_pedido ($idMulti_pedido,$entity_encode=false) {$this->arrDbData["idMulti_pedido"]=($entity_encode)?htmlentities($idMulti_pedido,ENT_QUOTES,"UTF-8"):$idMulti_pedido;}

	public function GETidMulti_pedidoEstado ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idMulti_pedidoEstado"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idMulti_pedidoEstado"];}
	public function SETidMulti_pedidoEstado ($idMulti_pedidoEstado,$entity_encode=false) {$this->arrDbData["idMulti_pedidoEstado"]=($entity_encode)?htmlentities($idMulti_pedidoEstado,ENT_QUOTES,"UTF-8"):$idMulti_pedidoEstado;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/

	public function objMulti_pedido() {
		return new \Multi_pedido($this->db(),$this->arrDbData["idMulti_pedido"]);
	}
	public function objMulti_pedidoEstado() {
		return new \Multi_pedidoEstado($this->db(),$this->arrDbData["idMulti_pedidoEstado"]);
	}

/* Funciones FkTo *************************************************************/

}
?>
