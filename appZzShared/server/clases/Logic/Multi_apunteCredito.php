<?
class Multi_apunteCredito extends \Sintax\Core\Entity implements \Sintax\Core\IEntity {
	protected static $table="multi_apunteCredito";
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
			"monto" => NULL,
			"gasto" => NULL,
			"descripcion" => NULL,
			"caducidad" => NULL,
			"idMulti_cliente" => NULL,
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

	public function GETmonto ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["monto"],ENT_QUOTES,"UTF-8"):$this->arrDbData["monto"];}
	public function SETmonto ($monto,$entity_encode=false) {$this->arrDbData["monto"]=($entity_encode)?htmlentities($monto,ENT_QUOTES,"UTF-8"):$monto;}

	public function GETgasto ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["gasto"],ENT_QUOTES,"UTF-8"):$this->arrDbData["gasto"];}
	public function SETgasto ($gasto,$entity_encode=false) {$this->arrDbData["gasto"]=($entity_encode)?htmlentities($gasto,ENT_QUOTES,"UTF-8"):$gasto;}

	public function GETdescripcion ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["descripcion"],ENT_QUOTES,"UTF-8"):$this->arrDbData["descripcion"];}
	public function SETdescripcion ($descripcion,$entity_encode=false) {$this->arrDbData["descripcion"]=($entity_encode)?htmlentities($descripcion,ENT_QUOTES,"UTF-8"):$descripcion;}

	public function GETcaducidad ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["caducidad"],ENT_QUOTES,"UTF-8"):$this->arrDbData["caducidad"];}
	public function SETcaducidad ($caducidad,$entity_encode=false) {$this->arrDbData["caducidad"]=($entity_encode)?htmlentities($caducidad,ENT_QUOTES,"UTF-8"):$caducidad;}

	public function GETidMulti_cliente ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idMulti_cliente"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idMulti_cliente"];}
	public function SETidMulti_cliente ($idMulti_cliente,$entity_encode=false) {$this->arrDbData["idMulti_cliente"]=($entity_encode)?htmlentities($idMulti_cliente,ENT_QUOTES,"UTF-8"):$idMulti_cliente;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/

	public function objMulti_cliente() {
		return new \Multi_cliente($this->db(),$this->arrDbData["idMulti_cliente"]);
	}

/******************************************************************************/
	public function disponible() {
		return $this->GETmonto()-$this->GETgasto();
	}
	public function caducado() {
		if (!is_null($this->GETcaducidad())) {
				$caducidadUnix=Fecha::fromMysql($this->GETcaducidad())->GETdate();
			if ($caducidadUnix<time()) {
				$result=true;
			} else {
				$result=false;
			}
		} else {
			$result=false;
		}
		return $result;
	}

	public function imputarGasto($gasto) {
		if ($gasto<=($this->disponible()) ) {
			$this->SETgasto($this->GETgasto()+$gasto);
			$resto=0;
		} else {
			$resto=$gasto-$this->disponible();
			$this->SETgasto($this->GETmonto());
		}
		$this->grabar();
		return $resto;
	}
}
?>
