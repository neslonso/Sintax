<?
/*
Néstor
neslonso@gmail.com
ClaseCreadora 2.0
20110110 - 20141009

/* History
/* v 3.0 (20160506)
	* Añadida clase "ClassEntitySubclaser" para escribir codigo de subclases de Sintax\Core\Entity. Esto deja obsoleta a la clase creadora.
	* Añadida clase "PHPUnitTestcaseClassCreator" para escribir codigo de subclases de PHPUnit_Framework_TestCase

/* v 2.1 (20160503)
	* Actualizado constructor y funcion db() para que la clase reciba la conexion a DB como parámetro.

/* v 2.0 (20141009)
	* Remodelada para su integración en S!nt@x
	* Estrcuturada en varias metodos

/* v 1.3 (20140807)
	* Añadido $arrFksTo para la generación de funciones que devuelven arr de elementos de otras clases que referencian a la clase (e.g. Categoria->arrProdcutos())
	* Añadidas funciones borrar y noReferenciado a la clase
	* Añadido $arrFksFrom para la generación de funciones que devuelven objs de elementos de a otras clases a las que hace referencia esta (e.g. Producto->objCategoria())
/* v 1.2 (20120502)
	* Añadidos los parametros segundo y tercero a htmlentities en la funcion cargarId para que maneje bien las conversiones UTF-8: ENT_QUOTES y "UTF-8"
/* v 1.1 (20120403)
	* Empezamos la history
	* Añadida llamada a htmlentities en cargarId, ya que los valores cargados de la BD serán usados en HTML y
	* los caracteres convertidos a entidades HTML para que no produzcan problemas.

/**************************************************************************************************************/
//Crea un fichero php con el codigo basico que solemos usar para las clases
//El fichero creado tira de las funciones de MysqliDB.php
//Se supone que el primer atributo de arrAtributos es la clave primaria de la tabla
class ClassEntitySubclaser {
	private $ruta;
	private $nombreClase;
	private $arrAtributos;
	private $nombreTabla;
	private $arrFksFrom;
	private $arrFksTo;
	private $sl;//saltoLinea
	private $sg;//sangrado

	function __construct ($ruta,$nombreClase, $arrAtributos, $nombreTabla, $arrFksFrom,$arrFksTo) {
		$this->ruta=$ruta;
		$this->nombreClase=$nombreClase;
		$this->arrAtributos=$arrAtributos;
		$this->nombreTabla=$nombreTabla;
		$this->arrFksFrom=$arrFksFrom;
		$this->arrFksTo=$arrFksTo;
		$this->insertField='insert';
		$this->updateField='update';

		$arrNombresAtributos=array_keys($arrAtributos);
		$this->nombreKeyFIeld=$nombreKeyField=$arrNombresAtributos[0];
		//PHP 5.4+ -> $this->nombreKeyFIeld=$nombreKeyField=array_keys($arrAtributos)[0];
		$this->sl="\n";
		$this->sg="\t";
		$sl=$this->sl;
		$sg=$this->sg;

		$classCode='';
		$classCode.="<?".$sl;
		//Apertura de la clase
		$classCode.="class ".$nombreClase." extends Entity implements IEntity {".$sl;

		//Main
			$classCode.=$this->declaraciones($nombreTabla,$nombreKeyField,$this->insertField,$this->updateField);
			$classCode.=$this->constructor($arrAtributos);
			$classCode.=$this->noReferenciado($arrFksTo);
			$classCode.=$this->setterGetterKeyField();
			//$classCode.=$this->cargarArray();
			//$classCode.=$this->cargarObj();
			$classCode.="/* Getters y Setters **********************************************************/".$sl;
			$classCode.=$this->settersGetters($arrAtributos);
			$classCode.="/******************************************************************************/".$sl;
		//FkFrom
			$classCode.=$sl;
			$classCode.="/* Funciones FkFrom ***********************************************************/".$sl;
			$classCode.=$sl;
			//Inicio funciones FkFrom
			$classCode.=$this->FkFrom($arrFksFrom);
			//Fin funciones FkFrom
		//FkTo
			$classCode.=$sl;
			$classCode.="/* Funciones FkTo *************************************************************/".$sl;
			$classCode.=$sl;
			//Inicio funciones FkTo
			$classCode.=$this->FkTo($arrFksTo);
			//Fin funciones FkTo

		//Llave de cierre de la clase
		$classCode.="}".$sl;
		$classCode.="?>".$sl;
		$file=$ruta."/".$nombreClase.".php";
		$fp=fopen ($file,"w");
		fwrite ($fp,$classCode);
		fclose ($fp);
		chmod ($file,0777);
	}

	private function declaraciones($nombreTabla,$nombreKeyField,$insertField,$updateField) {
		$sl=$this->sl;
		$sg=$this->sg;
		$resultCode='';
		$resultCode.=$sg.'protected static $table="'.$nombreTabla.'";'.$sl;
		$resultCode.=$sg.'protected static $keyField="'.$nombreKeyField.'";'.$sl;
		$resultCode.=$sg.'protected static $insertField="'.$insertField.'";'.$sl;
		$resultCode.=$sg.'protected static $updateField="'.$updateField.'";'.$sl;
		$resultCode.=$sl;
		return $resultCode;
	}
	private function constructor($arrAtributos) {
		$sl=$this->sl;
		$sg=$this->sg;
		$resultCode='';
		$resultCode.=$sg.'/**'.$sl;
		$resultCode.=$sg.' * [constructor de la clase]'.$sl;
		$resultCode.=$sg.' * @param MysqliDB db clase de acceso a datos'.$sl;
		$resultCode.=$sg.' * @param string keyValue Valor de la clave primaria que identifica el registro asociado a la instancia a construir'.$sl;
		$resultCode.=$sg.' */'.$sl;
		$resultCode.=$sg.'public function __construct (\MysqliDB $db=NULL, $keyValue=NULL) {'.$sl;
		$resultCode.=$sg.$sg.'$this->arrDbData=array('.$sl;
		foreach ($arrAtributos as $nombreAtributo => $sqlData) {
			$resultCode.=$sg.$sg.$sg.'"'.$nombreAtributo.'" => NULL,'.$sl;
		}
		$resultCode.=$sg.$sg.");".$sl;
		$resultCode.=$sg.$sg.'parent::__construct($db,$keyValue);'.$sl;
		$resultCode.=$sg."}".$sl;
		$resultCode.=$sl;
		return $resultCode;
	}
	private function noReferenciado($arrFksTo) {
		$sl=$this->sl;
		$sg=$this->sg;
		$resultCode='';
		$resultCode.=$sg.'public function noReferenciado() {'.$sl;
		if (count($arrFksTo)>0) {
			foreach ($arrFksTo as $objFkInfo) {
				$fTable=$objFkInfo->TABLE_NAME;
				$fField=$objFkInfo->COLUMN_NAME;
				$resultCode.=$sg.$sg.'$sql="SELECT '.$fField.' FROM '.$fTable.' WHERE '.$fField.'=\'".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."\'";'.$sl;
				$resultCode.=$sg.$sg.'$noReferenciadoEn'.ucfirst($fTable).'=($this->db()->get_num_rows($sql)==0)?true:false;'.$sl;
			}
			$strConds='';
			foreach ($arrFksTo as $objFkInfo) {
				$fTable=$objFkInfo->TABLE_NAME;
				$fField=$objFkInfo->COLUMN_NAME;
				$strConds.='$noReferenciadoEn'.ucfirst($fTable).' && ';
			}
			$strConds=substr($strConds, 0, -4);
			$resultCode.=$sg.$sg.'$result=('.$strConds.')?true:false;'.$sl;
			$resultCode.=$sg.$sg.'return $result;'.$sl;
		} else {
			$resultCode.=$sg.$sg.'$result=true;'.$sl;
			$resultCode.=$sg.$sg.'return $result;'.$sl;
		}
		$resultCode.=$sg.'}'.$sl;
		return $resultCode;
	}
	private function setterGetterKeyField() {
		$sl=$this->sl;
		$sg=$this->sg;

		$resultCode=$sg.'public function GETkeyField () {';
		$resultCode.='return static::$keyField;';
		$resultCode.='}'.$sl;

		$resultCode.=$sg.'public function GETkeyValue ($entity_decode=false) {';
		$resultCode.='return ($entity_decode)?html_entity_decode($this->arrDbData[static::$keyField],ENT_QUOTES,"UTF-8"):$this->arrDbData[static::$keyField];';
		$resultCode.='}'.$sl;

		$resultCode.=$sg.'public function SETkeyValue ($keyField,$entity_encode=false) {';
		$resultCode.='$this->arrDbData[static::$keyField]=($entity_encode)?htmlentities($keyField,ENT_QUOTES,"UTF-8"):$keyField;';
		$resultCode.='}'.$sl;
		$resultCode.=$sl;
		return $resultCode;
	}
	private function settersGetters($arrAtributos) {
		$sl=$this->sl;
		$sg=$this->sg;
		$resultCode='';
		foreach ($arrAtributos as $nombreAtributo => $sqlData) {
			$resultCode.=$sg.'public function GET'.$nombreAtributo.' ($entity_decode=false) {';
			$resultCode.='return ($entity_decode)?html_entity_decode($this->arrDbData["'.$nombreAtributo.'"],ENT_QUOTES,"UTF-8"):$this->arrDbData["'.$nombreAtributo.'"];';
			$resultCode.='}'.$sl;

			$resultCode.=$sg.'public function SET'.$nombreAtributo.' ($'.$nombreAtributo.',$entity_encode=false) {';
			$resultCode.='$this->arrDbData["'.$nombreAtributo.'"]=($entity_encode)?htmlentities($'.$nombreAtributo.',ENT_QUOTES,"UTF-8"):$'.$nombreAtributo.';';
			$resultCode.='}'.$sl;
			$resultCode.=$sl;
		}
		return $resultCode;
	}
	private function FkFrom($arrFksFrom) {
		$sl=$this->sl;
		$sg=$this->sg;
		$resultCode='';

		$arrTables=array();
		foreach ($arrFksFrom as $objFkInfo) {
			$fTable=$objFkInfo->REFERENCED_TABLE_NAME;
			$fField=$objFkInfo->COLUMN_NAME;
			if (!array_key_exists($fTable, $arrTables)) {
				$arrTables[$fTable]=$fTable;
			} else {
				if (!is_array($arrTables[$fTable])) {
					$tmp=$arrTables[$fTable];
					$arrTables[$fTable]=array();
					$arrTables[$fTable][]=$tmp;
				}
				$arrTables[$fTable][]=$fField;
			}
		}
		foreach ($arrFksFrom as $objFkInfo) {
			$fTable=$objFkInfo->REFERENCED_TABLE_NAME;
			$fField=$objFkInfo->COLUMN_NAME;
			$functionName=$fTable;
			if (is_array($arrTables[$fTable])) {
				$functionName=$fTable.'By'.ucfirst($fField);
			}
			$resultCode.=$sg.'public function obj'.ucfirst($functionName).'() {'.$sl;
			$resultCode.=$sg.$sg.'return new '."\\".ucfirst($fTable).'($this->db(),$this->arrDbData["'.$fField.'"]);'.$sl;
			$resultCode.=$sg.'}'.$sl;
		}
		return $resultCode;
	}
	private function FkTo($arrFksTo) {
		$sl=$this->sl;
		$sg=$this->sg;
		$resultCode='';

		$arrTables=array();
		foreach ($arrFksTo as $objFkInfo) {
			$fTable=$objFkInfo->TABLE_NAME;
			$fField=$objFkInfo->COLUMN_NAME;
			if (!array_key_exists($fTable, $arrTables)) {
				$arrTables[$fTable]=$fTable;
			} else {
				if (!is_array($arrTables[$fTable])) {
					$tmp=$arrTables[$fTable];
					$arrTables[$fTable]=array();
					$arrTables[$fTable][]=$tmp;
				}
				$arrTables[$fTable][]=$fField;
			}
		}
		foreach ($arrFksTo as $objFkInfo) {
			$fTable=$objFkInfo->TABLE_NAME;
			$fField=$objFkInfo->COLUMN_NAME;

			$functionName=$fTable;
			if ($objFkInfo->manyToMany) {
				$ffTable=$objFkInfo->ffTable;
				$ffField=$objFkInfo->ffField;
				$functionName=$ffTable;
			}

			if (is_array($arrTables[$fTable])) {
				$functionName.='By'.ucfirst($fField);
			}
			$resultCode.=$sg.'public function arr'.ucfirst($functionName).'($where="",$order="",$limit="",$tipo="arrStdObjs") {'.$sl;
			$resultCode.=$sg.$sg.'$sqlWhere=($where!="")?" WHERE '.$fField.'=\'".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."\' AND ".$where:" WHERE '.$fField.'=\'".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."\'";'.$sl;
			$resultCode.=$sg.$sg.'$sqlOrder=($order!="")?" ORDER BY ".$order:"";'.$sl;
			$resultCode.=$sg.$sg.'$sqlLimit=($limit!="")?" LIMIT ".$limit:"";'.$sl;
			if (!$objFkInfo->manyToMany) {
				$resultCode.=$sg.$sg.'$sql="SELECT * FROM '.$fTable.'".$sqlWhere.$sqlOrder.$sqlLimit;'.$sl;
			} else {
				$resultCode.=$sg.$sg.'$sql="SELECT * FROM '.$fTable.' f INNER JOIN '.$ffTable.' ff ON f.'.$ffField.'=ff.".'."\\".ucfirst($fTable).'::$keyField." ".$sqlWhere.$sqlOrder.$sqlLimit;'.$sl;
			}
			$resultCode.=$sg.$sg.'$arr=array();'.$sl;
			$resultCode.=$sg.$sg.'$rsl=$this->db()->query($sql);'.$sl;
			$resultCode.=$sg.$sg.'while ($data=$rsl->fetch_object()) {'.$sl;
			$resultCode.=$sg.$sg.$sg.'switch ($tipo) {'.$sl;
			$resultCode.=$sg.$sg.$sg.$sg.'case "arrKeys": array_push($arr,$data->{'."\\".ucfirst($fTable).'::$keyField});break;'.$sl;
			$resultCode.=$sg.$sg.$sg.$sg.'case "arrClassObjs":'.$sl;
			if (!$objFkInfo->manyToMany) {
				$resultCode.=$sg.$sg.$sg.$sg.$sg.'$obj=new '."\\".ucfirst($fTable).'($this->db(),$data->{'."\\".ucfirst($fTable).'::$keyField});'.$sl;
			} else {
				$resultCode.=$sg.$sg.$sg.$sg.$sg.'$obj=new '."\\".ucfirst($ffTable).'($this->db(),$data->{'."\\".ucfirst($ffTable).'::$keyField});'.$sl;
			}
			$resultCode.=$sg.$sg.$sg.$sg.$sg.'array_push($arr,$obj);'.$sl;
			$resultCode.=$sg.$sg.$sg.$sg.$sg.'unset($obj);'.$sl;
			$resultCode.=$sg.$sg.$sg.$sg.'break;'.$sl;
			$resultCode.=$sg.$sg.$sg.$sg.'case "arrStdObjs":'.$sl;
			$resultCode.=$sg.$sg.$sg.$sg.$sg.'$obj=new \stdClass();'.$sl;
			$resultCode.=$sg.$sg.$sg.$sg.$sg.'foreach ($data as $field => $value) {'.$sl;
			$resultCode.=$sg.$sg.$sg.$sg.$sg.$sg.'$obj->$field=$value;'.$sl;
			$resultCode.=$sg.$sg.$sg.$sg.$sg.'}'.$sl;
			$resultCode.=$sg.$sg.$sg.$sg.$sg.'array_push($arr,$obj);'.$sl;
			$resultCode.=$sg.$sg.$sg.$sg.$sg.'unset ($obj);'.$sl;
			$resultCode.=$sg.$sg.$sg.$sg.'break;'.$sl;
			$resultCode.=$sg.$sg.$sg.'}'.$sl;
			$resultCode.=$sg.$sg.'}'.$sl;
			$resultCode.=$sg.$sg.'return $arr;'.$sl;
			$resultCode.=$sg.'}'.$sl;
		}
		return $resultCode;
	}
}

class PHPUnitTestcaseClassCreator {
	private $sl;//saltoLinea
	private $sg;//sangrado

	function __construct ($ruta,$nombreClase) {
		$this->ruta=$ruta;
		$this->nombreClase=$nombreClase;

		$this->sl="\n";
		$this->sg="\t";
		$sl=$this->sl;
		$sg=$this->sg;

		$classCode='<?'.$sl;
		$classCode.='namespace Sintax\Tests;'.$sl;
		$classCode.=''.$sl;
		$classCode.='/**'.$sl;
		$classCode.=' * @coversDefaultClass Sintax\Pages\crudPrueba //Sirve para no tener que poner toda la ruta de la clase en los covers de los test'.$sl;
		$classCode.=' */'.$sl;
		$classCode.='class '.$this->nombreClase.' extends \PHPUnit_Framework_TestCase {'.$sl;
		$classCode.=$sg.'protected $backupGlobals = FALSE;//PHPUnit hace copia de seguridad de las variables globales y las restaura al acabar cada test, esto es para que no lo haga'.$sl;
		$classCode.=''.$sl;
		$classCode.=$sg.'public function setUp() {parent::setUp();}'.$sl;
		$classCode.=$sg.'public function tearDown() {parent::tearDown();}'.$sl;
		$classCode.=''.$sl;

		$classCode.=$sg.'/**'.$sl;
		$classCode.=$sg.' * @covers Nothing'.$sl;
		$classCode.=$sg.' */'.$sl;
		$classCode.=$sg.'public function testEmpty () {'.$sl;
		$classCode.=$sg.$sg.'$this->assertTrue(true);'.$sl;
		$classCode.=$sg.'}'.$sl;

		$classCode.=$sg.'/**'.$sl;
		$classCode.=$sg.' * @covers Nothing'.$sl;
		$classCode.=$sg.' */'.$sl;
		$classCode.=$sg.'public function testClassEntityExists () {'.$sl;
		$classCode.=$sg.$sg.'$this->assertTrue(class_exists("\Sintax\Core\Entity"));'.$sl;
		$classCode.=$sg.'}'.$sl;

		$classCode.='}'.$sl;
		$classCode.='?>'.$sl;

		$file=$ruta."/".$nombreClase.".php";
		$fp=fopen ($file,"w");
		fwrite ($fp,$classCode);
		fclose ($fp);
		chmod ($file,0777);
	}
}
?>