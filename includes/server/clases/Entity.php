<?
namespace Sintax\Core;

interface IEntity {
	public function __construct (\MysqliDB $db=NULL, $keyValue=NULL);
	public function cargar($keyValue);
	public function grabar();
	public function borrar();
	public function toArray();
	public function toJson();

	public static function existe(\MysqliDB $db, $keyValue);
	public static function getArray(\MysqliDB $db,$where="",$order="",$limit="",$tipo="arrStdObjs");

	public function noReferenciado();
}

//implementar interfaz JsonSerializable (PHP 5.4)
abstract class Entity implements IEntity, \IteratorAggregate {
	/**
	 * Conexión a la BD
	 * @var \MysqliDB | NULL: instancia de la clase \MysqliDB que representa una conexion a base de datos o NULL si es una entidad desconectada
	 */
	protected $db=NULL;
	protected $arrDbData=array();
	protected static $table;
	protected static $keyField;
	protected static $insertField;
	protected static $updateField;

	public function __construct (\MysqliDB $db=NULL, $keyValue=NULL) {
		$this->db=$db;
		if (!is_null($keyValue)) {$this->cargar($keyValue);}
	}
	public function getIterator() {
		return new \ArrayIterator($this->arrDbData);
	}
	public function SETdb(\MysqliDB $db) {
		$this->db=$db;
	}
	protected function db() {
		return $this->db;
	}

	public static function GETtable() {return static::$table;}
	public static function GETkeyField () {return static::$keyField;}
	public static function GETinsertField() {return static::$insertField;}
	public static function GETupdateField() {return static::$updateField;}

	public function cargarId ($id) {return $this->cargar($id);}
	public function cargar ($keyValue) {
		$result=false;
		if (!is_object($this->db())) {throw new \UnexpectedValueException(''.get_class($this).'->carga. is_object($this->db()) return false.', 1);}
		$sql="SELECT * FROM ".static::$table." WHERE ".static::$keyField."='".$this->db()->real_escape_string($keyValue)."'";
		$data=$this->db()->get_obj($sql);
		if ($data) {
			foreach ($data as $key => $value) {
				$this->arrDbData[$key]=$value;
			}
			$result=true;
		}
		return $result;
	}
	public function grabar () {
		$result=false;
		if (!is_object($this->db())) {throw new \UnexpectedValueException(''.get_class($this).'->carga. is_object($this->db()) return false.', 1);}
		$update=( !empty($this->arrDbData[static::$keyField]) )?true:false;
		if ($update) {
			$sql="UPDATE ".static::$table." SET ";
			foreach ($this->arrDbData as $key => $value) {
				//$this->update=$sqlValue_update=date("YmdHis");
				if ($key==static::$keyField) {continue;}
				else if ($key==static::$insertField) {continue;}
				else if ($key==static::$updateField) {$this->arrDbData[static::$updateField]=$sqlValue=date('YmdHis');}
				else {$sqlValue=(is_null($value))?"NULL":"'".$this->db()->real_escape_string($value)."'";}
				$sql.="`".$key."`=".$sqlValue.", ";
			}
			$sql=substr($sql,0,-2);
			$sql.=" WHERE ".static::$keyField."='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		} else {
			$sqlLock="LOCK TABLES ".static::$table." WRITE, contador WRITE";
			$this->db()->query ($sqlLock);
			$sql="INSERT INTO ".static::$table." ( ";
			foreach ($this->arrDbData as $key => $value) {
				$sql.="`".$key."`, ";
			}
			$sql=substr($sql,0,-2);
			$sql.=") VALUES (";
			foreach ($this->arrDbData as $key => $value) {
				//$this->insert=$sqlValue_insert=$this->update=$sqlValue_update=date("YmdHis");
				if ($key==static::$keyField) {
					$this->arrDbData[static::$keyField]=$sqlValue=$this->db()->nextId (static::$table,static::$keyField);
				} else if ($key==static::$insertField) {
					$this->arrDbData[static::$insertField]=$sqlValue=date('YmdHis');
				} else if ($key==static::$updateField) {
					$this->arrDbData[static::$updateField]=$sqlValue="NULL";
				} else {
					$sqlValue=(is_null($value))?"NULL":"'".$this->db()->real_escape_string($value)."'";
				}
				$sql.=$sqlValue.", ";
			}
			$sql=substr($sql,0,-2);
			$sql.=")";
		}
		error_log(__FILE__."::".__LINE__."::sql: ".$sql);
		try {
			$result=$this->db()->query ($sql);
			$sqlUnlock="UNLOCK TABLES";
			$this->db()->query ($sqlUnlock);
		} catch (Exception $e) {
			$sqlUnlock="UNLOCK TABLES";
			$this->db()->query ($sqlUnlock);
			throw $e;
		}
		return $result;
	}

	public function borrar() {
		$result=false;
		if ($this->noReferenciado()) {
			$sql="DELETE FROM ".static::$table." WHERE ".static::$keyField."='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
			error_log(__FILE__."::".__LINE__."::sql: ".$sql);
			$this->db()->query($sql);
			$result=true;
		}
		return $result;
	}
	public function toArray() {
 		$arrVars = get_object_vars($this);
		array_walk_recursive($arrVars, function (&$property) {
			if(is_object($property) && method_exists($property,'toArray')){
				$property = $property->toArray();
			}
		});
		return $arrVars;
	}
	public function toStdObj() {
		return (object)$this->arrDbData;
	}
	public function toJson() {
		return json_encode($this->toArray());
	}
/* Funciones estaticas ********************************************************/
	public static function existeId($id) {return static::existe(cDb::gI(),$id);}
	public static function existe(\MysqliDB $db, $keyValue) {
		$sql="SELECT * FROM ".static::$table." WHERE id='".$db->real_escape_string($keyValue)."'";
		$data=$db->get_obj($sql);
		if ($data) {$result=true;} else {$result=false;}
		return $result;
	}
	public static function allToArray($where="",$order="",$limit="",$tipo="arrStdObjs") {return static::getArray(cDb::gI(),$where,$order,$limit,$tipo);}
	public static function getArray(\MysqliDB $db,$where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE ".$where:"";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM ".static::$table." ".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$db->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{static::$keyField});break;
				case "arrClassObjs":
					$obj=new static($db,$data->{static::$keyField});
					array_push($arr,$obj);
					unset ($obj);
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
	public static function allToSelect($nameIdAttrs="id",$selectedValue="",$classAttr="",$where="",$order="",$limit="") {return static::getSelectMarkup(cDb::gI(),$nameIdAttrs,$selectedValue,$classAttr,$where,$order,$limit);}
	public static function getSelectMarkup(\MysqliDB $db, $nameIdAttrs="id",$selectedValue="",$classAttr="",$where="",$order="",$limit="") {
		$arr=static::getArray($db,$where,$order,$limit,"arrClassObjs");
		$htmlSelect='<select name="'.$nameIdAttrs.'" id="'.$nameIdAttrs.'"  class="'.$classAttr.'">';
		foreach ($arr as $obj) {
			$func="GET".static::$keyField;
			$value=$obj->$func();
			$content=get_class($this)." con ".$keyField."=".$obj->$func();
			$selectedOption=($value==$selectedValue)?'selected="selected"':'';
			$htmlSelect.='<option value="'.$value.'" '.$selectedOption.'>'.$content.'</option>';
		}
		$htmlSelect.='</select>';
		return $htmlSelect;
	}


/* Funciones dinamicas ********************************************************/
	public function noReferenciado() {
		throw new \RuntimeException('El metodo noReferenciado debe ser implementado en la clase '.get_class($this));
	}
}
?>