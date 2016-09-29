<?
class Multi_pedidoEstadoAccion extends Sintax\Core\Entity implements Sintax\Core\IEntity {
	protected static $table="multi_pedidoEstadoAccion";
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
			"keyTienda" => NULL,
			"metodo" => NULL,
			"jsonArray" => NULL,
			"activa" => NULL,
			"orden" => NULL,
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

	public function GETkeyTienda ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["keyTienda"],ENT_QUOTES,"UTF-8"):$this->arrDbData["keyTienda"];}
	public function SETkeyTienda ($keyTienda,$entity_encode=false) {$this->arrDbData["keyTienda"]=($entity_encode)?htmlentities($keyTienda,ENT_QUOTES,"UTF-8"):$keyTienda;}

	public function GETmetodo ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["metodo"],ENT_QUOTES,"UTF-8"):$this->arrDbData["metodo"];}
	public function SETmetodo ($metodo,$entity_encode=false) {$this->arrDbData["metodo"]=($entity_encode)?htmlentities($metodo,ENT_QUOTES,"UTF-8"):$metodo;}

	public function GETjsonArray ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["jsonArray"],ENT_QUOTES,"UTF-8"):$this->arrDbData["jsonArray"];}
	public function SETjsonArray ($jsonArray,$entity_encode=false) {$this->arrDbData["jsonArray"]=($entity_encode)?htmlentities($jsonArray,ENT_QUOTES,"UTF-8"):$jsonArray;}

	public function GETactiva ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["activa"],ENT_QUOTES,"UTF-8"):$this->arrDbData["activa"];}
	public function SETactiva ($activa,$entity_encode=false) {$this->arrDbData["activa"]=($entity_encode)?htmlentities($activa,ENT_QUOTES,"UTF-8"):$activa;}

	public function GETorden ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["orden"],ENT_QUOTES,"UTF-8"):$this->arrDbData["orden"];}
	public function SETorden ($orden,$entity_encode=false) {$this->arrDbData["orden"]=($entity_encode)?htmlentities($orden,ENT_QUOTES,"UTF-8"):$orden;}

	public function GETidMulti_pedidoEstado ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idMulti_pedidoEstado"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idMulti_pedidoEstado"];}
	public function SETidMulti_pedidoEstado ($idMulti_pedidoEstado,$entity_encode=false) {$this->arrDbData["idMulti_pedidoEstado"]=($entity_encode)?htmlentities($idMulti_pedidoEstado,ENT_QUOTES,"UTF-8"):$idMulti_pedidoEstado;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/

	public function objMulti_pedidoEstado() {
		return new \Multi_pedidoEstado($this->db(),$this->arrDbData["idMulti_pedidoEstado"]);
	}

/* Funciones FkTo *************************************************************/

}
?>
