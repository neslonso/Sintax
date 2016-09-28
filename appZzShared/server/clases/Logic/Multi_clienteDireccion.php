<?
class Multi_clienteDireccion extends \Sintax\Core\Entity implements \Sintax\Core\IEntity {
	protected static $table="multi_clienteDireccion";
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
			"destinatario" => NULL,
			"direccion" => NULL,
			"poblacion" => NULL,
			"provincia" => NULL,
			"cp" => NULL,
			"pais" => NULL,
			"movil" => NULL,
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

	public function GETnombre ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["nombre"],ENT_QUOTES,"UTF-8"):$this->arrDbData["nombre"];}
	public function SETnombre ($nombre,$entity_encode=false) {$this->arrDbData["nombre"]=($entity_encode)?htmlentities($nombre,ENT_QUOTES,"UTF-8"):$nombre;}

	public function GETdestinatario ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["destinatario"],ENT_QUOTES,"UTF-8"):$this->arrDbData["destinatario"];}
	public function SETdestinatario ($destinatario,$entity_encode=false) {$this->arrDbData["destinatario"]=($entity_encode)?htmlentities($destinatario,ENT_QUOTES,"UTF-8"):$destinatario;}

	public function GETdireccion ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["direccion"],ENT_QUOTES,"UTF-8"):$this->arrDbData["direccion"];}
	public function SETdireccion ($direccion,$entity_encode=false) {$this->arrDbData["direccion"]=($entity_encode)?htmlentities($direccion,ENT_QUOTES,"UTF-8"):$direccion;}

	public function GETpoblacion ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["poblacion"],ENT_QUOTES,"UTF-8"):$this->arrDbData["poblacion"];}
	public function SETpoblacion ($poblacion,$entity_encode=false) {$this->arrDbData["poblacion"]=($entity_encode)?htmlentities($poblacion,ENT_QUOTES,"UTF-8"):$poblacion;}

	public function GETprovincia ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["provincia"],ENT_QUOTES,"UTF-8"):$this->arrDbData["provincia"];}
	public function SETprovincia ($provincia,$entity_encode=false) {$this->arrDbData["provincia"]=($entity_encode)?htmlentities($provincia,ENT_QUOTES,"UTF-8"):$provincia;}

	public function GETcp ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["cp"],ENT_QUOTES,"UTF-8"):$this->arrDbData["cp"];}
	public function SETcp ($cp,$entity_encode=false) {$this->arrDbData["cp"]=($entity_encode)?htmlentities($cp,ENT_QUOTES,"UTF-8"):$cp;}

	public function GETpais ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["pais"],ENT_QUOTES,"UTF-8"):$this->arrDbData["pais"];}
	public function SETpais ($pais,$entity_encode=false) {$this->arrDbData["pais"]=($entity_encode)?htmlentities($pais,ENT_QUOTES,"UTF-8"):$pais;}

	public function GETmovil ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["movil"],ENT_QUOTES,"UTF-8"):$this->arrDbData["movil"];}
	public function SETmovil ($movil,$entity_encode=false) {$this->arrDbData["movil"]=($entity_encode)?htmlentities($movil,ENT_QUOTES,"UTF-8"):$movil;}

	public function GETidMulti_cliente ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idMulti_cliente"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idMulti_cliente"];}
	public function SETidMulti_cliente ($idMulti_cliente,$entity_encode=false) {$this->arrDbData["idMulti_cliente"]=($entity_encode)?htmlentities($idMulti_cliente,ENT_QUOTES,"UTF-8"):$idMulti_cliente;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/

	public function objMulti_cliente() {
		return new \Multi_cliente($this->db(),$this->arrDbData["idMulti_cliente"]);
	}

/* Funciones FkTo *************************************************************/

/******************************************************************************/
	public static function sqlComprobacionPais(\MysqliDB $db,$nombrePais) {
		return
			"SELECT * FROM multi_pais mp LEFT JOIN multi_paisSinonimo mps ON mp.id=mps.idMulti_pais
			WHERE nombre_es='".$db->real_escape_string($nombrePais)."'
				OR nombre_en='".$db->real_escape_string($nombrePais)."'
				OR sinonimo='".$db->real_escape_string($nombrePais)."'";
	}
	public function esPaisConocido(){
		$result=false;
		$sql=static::sqlComprobacionPais($this->db(),$this->GETpais());
		$data=$this->db()->get_row($sql);
		if ($data) {$result=true;}
		return $result;
	}


}
?>
