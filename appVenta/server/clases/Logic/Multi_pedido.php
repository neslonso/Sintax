<?
class Multi_pedido {
	private $id;
	private $insert;
	private $update;
	private $numero;
	private $expedicion;
	private $serie;
	private $nombre;
	private $apellidos;
	private $direccion;
	private $cp;
	private $poblacion;
	private $provincia;
	private $horario;
	private $portes;
	private $credito;
	private $notas;
	private $incluidoEnNotificacionTransporte;
	private $albaranGenerado;
	private $bultos;
	private $factura;
	private $idUsuario;
	private $idCupon;
	private $idPedidoModoPago;
	private $idTransporte;
	private $keyTienda;
	private $idEnOrigen;
	public function __construct ($id="") {
		if ($id!="") {
			$this->cargarId ($id);
		}
	}

	private static function db() {
		return cDb::gI();
	}

	public function cargarId ($id) {
		$result=false;
		$sql="SELECT * FROM multi_pedido WHERE id='".self::db()->real_escape_string($id)."'";
		$data=self::db()->get_obj($sql);
		if ($data) {
			$this->id=$data->id;
			$this->insert=$data->insert;
			$this->update=$data->update;
			$this->numero=$data->numero;
			$this->expedicion=$data->expedicion;
			$this->serie=$data->serie;
			$this->nombre=$data->nombre;
			$this->apellidos=$data->apellidos;
			$this->direccion=$data->direccion;
			$this->cp=$data->cp;
			$this->poblacion=$data->poblacion;
			$this->provincia=$data->provincia;
			$this->horario=$data->horario;
			$this->portes=$data->portes;
			$this->credito=$data->credito;
			$this->notas=$data->notas;
			$this->incluidoEnNotificacionTransporte=$data->incluidoEnNotificacionTransporte;
			$this->albaranGenerado=$data->albaranGenerado;
			$this->bultos=$data->bultos;
			$this->factura=$data->factura;
			$this->idUsuario=$data->idUsuario;
			$this->idCupon=$data->idCupon;
			$this->idPedidoModoPago=$data->idPedidoModoPago;
			$this->idTransporte=$data->idTransporte;
			$this->keyTienda=$data->keyTienda;
			$this->idEnOrigen=$data->idEnOrigen;
			$result=true;
		}
		return $result;
	}
	public function grabar () {
		$result=false;
		$sqlValue_id=(is_null($this->id))?"NULL":"'".self::db()->real_escape_string($this->id)."'";
		$sqlValue_insert=(is_null($this->insert))?"NULL":"'".self::db()->real_escape_string($this->insert)."'";
		$sqlValue_update=(is_null($this->update))?"NULL":"'".self::db()->real_escape_string($this->update)."'";
		$sqlValue_numero=(is_null($this->numero))?"NULL":"'".self::db()->real_escape_string($this->numero)."'";
		$sqlValue_expedicion=(is_null($this->expedicion))?"NULL":"'".self::db()->real_escape_string($this->expedicion)."'";
		$sqlValue_serie=(is_null($this->serie))?"NULL":"'".self::db()->real_escape_string($this->serie)."'";
		$sqlValue_nombre=(is_null($this->nombre))?"NULL":"'".self::db()->real_escape_string($this->nombre)."'";
		$sqlValue_apellidos=(is_null($this->apellidos))?"NULL":"'".self::db()->real_escape_string($this->apellidos)."'";
		$sqlValue_direccion=(is_null($this->direccion))?"NULL":"'".self::db()->real_escape_string($this->direccion)."'";
		$sqlValue_cp=(is_null($this->cp))?"NULL":"'".self::db()->real_escape_string($this->cp)."'";
		$sqlValue_poblacion=(is_null($this->poblacion))?"NULL":"'".self::db()->real_escape_string($this->poblacion)."'";
		$sqlValue_provincia=(is_null($this->provincia))?"NULL":"'".self::db()->real_escape_string($this->provincia)."'";
		$sqlValue_horario=(is_null($this->horario))?"NULL":"'".self::db()->real_escape_string($this->horario)."'";
		$sqlValue_portes=(is_null($this->portes))?"NULL":"'".self::db()->real_escape_string($this->portes)."'";
		$sqlValue_credito=(is_null($this->credito))?"NULL":"'".self::db()->real_escape_string($this->credito)."'";
		$sqlValue_notas=(is_null($this->notas))?"NULL":"'".self::db()->real_escape_string($this->notas)."'";
		$sqlValue_incluidoEnNotificacionTransporte=(is_null($this->incluidoEnNotificacionTransporte))?"NULL":"'".self::db()->real_escape_string($this->incluidoEnNotificacionTransporte)."'";
		$sqlValue_albaranGenerado=(is_null($this->albaranGenerado))?"NULL":"'".self::db()->real_escape_string($this->albaranGenerado)."'";
		$sqlValue_bultos=(is_null($this->bultos))?"NULL":"'".self::db()->real_escape_string($this->bultos)."'";
		$sqlValue_factura=(is_null($this->factura))?"NULL":"'".self::db()->real_escape_string($this->factura)."'";
		$sqlValue_idUsuario=(is_null($this->idUsuario))?"NULL":"'".self::db()->real_escape_string($this->idUsuario)."'";
		$sqlValue_idCupon=(is_null($this->idCupon))?"NULL":"'".self::db()->real_escape_string($this->idCupon)."'";
		$sqlValue_idPedidoModoPago=(is_null($this->idPedidoModoPago))?"NULL":"'".self::db()->real_escape_string($this->idPedidoModoPago)."'";
		$sqlValue_idTransporte=(is_null($this->idTransporte))?"NULL":"'".self::db()->real_escape_string($this->idTransporte)."'";
		$sqlValue_keyTienda=(is_null($this->keyTienda))?"NULL":"'".self::db()->real_escape_string($this->keyTienda)."'";
		$sqlValue_idEnOrigen=(is_null($this->idEnOrigen))?"NULL":"'".self::db()->real_escape_string($this->idEnOrigen)."'";
		if ($this->id!="") { //UPDATE
			$this->update=$sqlValue_update=date("YmdHis");
			$sql="UPDATE multi_pedido SET ".
				"`id`=".$sqlValue_id.", ".
				"`insert`=".$sqlValue_insert.", ".
				"`update`=".$sqlValue_update.", ".
				"`numero`=".$sqlValue_numero.", ".
				"`expedicion`=".$sqlValue_expedicion.", ".
				"`serie`=".$sqlValue_serie.", ".
				"`nombre`=".$sqlValue_nombre.", ".
				"`apellidos`=".$sqlValue_apellidos.", ".
				"`direccion`=".$sqlValue_direccion.", ".
				"`cp`=".$sqlValue_cp.", ".
				"`poblacion`=".$sqlValue_poblacion.", ".
				"`provincia`=".$sqlValue_provincia.", ".
				"`horario`=".$sqlValue_horario.", ".
				"`portes`=".$sqlValue_portes.", ".
				"`credito`=".$sqlValue_credito.", ".
				"`notas`=".$sqlValue_notas.", ".
				"`incluidoEnNotificacionTransporte`=".$sqlValue_incluidoEnNotificacionTransporte.", ".
				"`albaranGenerado`=".$sqlValue_albaranGenerado.", ".
				"`bultos`=".$sqlValue_bultos.", ".
				"`factura`=".$sqlValue_factura.", ".
				"`idUsuario`=".$sqlValue_idUsuario.", ".
				"`idCupon`=".$sqlValue_idCupon.", ".
				"`idPedidoModoPago`=".$sqlValue_idPedidoModoPago.", ".
				"`idTransporte`=".$sqlValue_idTransporte.", ".
				"`keyTienda`=".$sqlValue_keyTienda.", ".
				"`idEnOrigen`=".$sqlValue_idEnOrigen." ".
				"WHERE id='".$this->id."'";
		} else { //INSERT
			$this->id=$sqlValue_id=self::db()->nextId ("multi_pedido","id");
			$this->insert=$sqlValue_insert=$this->update=$sqlValue_update=date("YmdHis");
			$sql="INSERT INTO multi_pedido ( ".
				"`id`, ".
				"`insert`, ".
				"`update`, ".
				"`numero`, ".
				"`expedicion`, ".
				"`serie`, ".
				"`nombre`, ".
				"`apellidos`, ".
				"`direccion`, ".
				"`cp`, ".
				"`poblacion`, ".
				"`provincia`, ".
				"`horario`, ".
				"`portes`, ".
				"`credito`, ".
				"`notas`, ".
				"`incluidoEnNotificacionTransporte`, ".
				"`albaranGenerado`, ".
				"`bultos`, ".
				"`factura`, ".
				"`idUsuario`, ".
				"`idCupon`, ".
				"`idPedidoModoPago`, ".
				"`idTransporte`, ".
				"`keyTienda`, ".
				"`idEnOrigen`) VALUES (".
				$sqlValue_id.", ".
				$sqlValue_insert.", ".
				$sqlValue_update.", ".
				$sqlValue_numero.", ".
				$sqlValue_expedicion.", ".
				$sqlValue_serie.", ".
				$sqlValue_nombre.", ".
				$sqlValue_apellidos.", ".
				$sqlValue_direccion.", ".
				$sqlValue_cp.", ".
				$sqlValue_poblacion.", ".
				$sqlValue_provincia.", ".
				$sqlValue_horario.", ".
				$sqlValue_portes.", ".
				$sqlValue_credito.", ".
				$sqlValue_notas.", ".
				$sqlValue_incluidoEnNotificacionTransporte.", ".
				$sqlValue_albaranGenerado.", ".
				$sqlValue_bultos.", ".
				$sqlValue_factura.", ".
				$sqlValue_idUsuario.", ".
				$sqlValue_idCupon.", ".
				$sqlValue_idPedidoModoPago.", ".
				$sqlValue_idTransporte.", ".
				$sqlValue_keyTienda.", ".
				$sqlValue_idEnOrigen.")";
		}
		$result=self::db()->query ($sql);
		return $result;
	}
	public function borrar() {
		$result=false;
		if ($this->noReferenciado()) {
			$sql="DELETE FROM multi_pedido WHERE id='".self::db()->real_escape_string($this->id)."'";
			self::db()->query($sql);
			$result=true;
		}
		return $result;
	}
	public function cargarArray ($array,$usingSetters=true) {
		foreach($this as $key => $value) {
			if (isset($array[$key])) {
				if ($usingSetters) {
					$func="SET".$key;
					$this->$func($array[$key]);
				} else {
					$this->$key=$array[$key];
				}
			}
		}
	}
	public function cargarObj ($obj,$usingSetters=true) {
		foreach($this as $key => $value) {
			if (isset($obj->$key)) {
				if ($usingSetters) {
					$func="SET".$key;
					$this->$func($obj->$key);
				} else {
					$this->$key=$obj->$key;
				}
			}
		}
	}
	public function toJson(){
		$var = get_object_vars($this);
		foreach($var as &$value){
			if(is_object($value) && method_exists($value,'toJson')){
				$value = $value->toJson();
			}
			if (is_array($value)) {
				foreach ($value as &$item) {
					if(is_object($item) && method_exists($item,'toJson')){
						$item = $item->toJson();
					}
				}
			}
		}
		return $var;
	}
	public function toArray () {
		$result=get_object_vars($this);
		return $result;
	}
	public function GETid ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->id,ENT_QUOTES,"UTF-8"):$this->id;}
	public function SETid ($id,$entity_encode=false) {$this->id=($entity_encode)?htmlentities($id,ENT_QUOTES,"UTF-8"):$id;}

	public function GETinsert ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->insert,ENT_QUOTES,"UTF-8"):$this->insert;}
	public function SETinsert ($insert,$entity_encode=false) {$this->insert=($entity_encode)?htmlentities($insert,ENT_QUOTES,"UTF-8"):$insert;}

	public function GETupdate ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->update,ENT_QUOTES,"UTF-8"):$this->update;}
	public function SETupdate ($update,$entity_encode=false) {$this->update=($entity_encode)?htmlentities($update,ENT_QUOTES,"UTF-8"):$update;}

	public function GETnumero ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->numero,ENT_QUOTES,"UTF-8"):$this->numero;}
	public function SETnumero ($numero,$entity_encode=false) {$this->numero=($entity_encode)?htmlentities($numero,ENT_QUOTES,"UTF-8"):$numero;}

	public function GETexpedicion ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->expedicion,ENT_QUOTES,"UTF-8"):$this->expedicion;}
	public function SETexpedicion ($expedicion,$entity_encode=false) {$this->expedicion=($entity_encode)?htmlentities($expedicion,ENT_QUOTES,"UTF-8"):$expedicion;}

	public function GETserie ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->serie,ENT_QUOTES,"UTF-8"):$this->serie;}
	public function SETserie ($serie,$entity_encode=false) {$this->serie=($entity_encode)?htmlentities($serie,ENT_QUOTES,"UTF-8"):$serie;}

	public function GETnombre ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->nombre,ENT_QUOTES,"UTF-8"):$this->nombre;}
	public function SETnombre ($nombre,$entity_encode=false) {$this->nombre=($entity_encode)?htmlentities($nombre,ENT_QUOTES,"UTF-8"):$nombre;}

	public function GETapellidos ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->apellidos,ENT_QUOTES,"UTF-8"):$this->apellidos;}
	public function SETapellidos ($apellidos,$entity_encode=false) {$this->apellidos=($entity_encode)?htmlentities($apellidos,ENT_QUOTES,"UTF-8"):$apellidos;}

	public function GETdireccion ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->direccion,ENT_QUOTES,"UTF-8"):$this->direccion;}
	public function SETdireccion ($direccion,$entity_encode=false) {$this->direccion=($entity_encode)?htmlentities($direccion,ENT_QUOTES,"UTF-8"):$direccion;}

	public function GETcp ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->cp,ENT_QUOTES,"UTF-8"):$this->cp;}
	public function SETcp ($cp,$entity_encode=false) {$this->cp=($entity_encode)?htmlentities($cp,ENT_QUOTES,"UTF-8"):$cp;}

	public function GETpoblacion ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->poblacion,ENT_QUOTES,"UTF-8"):$this->poblacion;}
	public function SETpoblacion ($poblacion,$entity_encode=false) {$this->poblacion=($entity_encode)?htmlentities($poblacion,ENT_QUOTES,"UTF-8"):$poblacion;}

	public function GETprovincia ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->provincia,ENT_QUOTES,"UTF-8"):$this->provincia;}
	public function SETprovincia ($provincia,$entity_encode=false) {$this->provincia=($entity_encode)?htmlentities($provincia,ENT_QUOTES,"UTF-8"):$provincia;}

	public function GEThorario ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->horario,ENT_QUOTES,"UTF-8"):$this->horario;}
	public function SEThorario ($horario,$entity_encode=false) {$this->horario=($entity_encode)?htmlentities($horario,ENT_QUOTES,"UTF-8"):$horario;}

	public function GETportes ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->portes,ENT_QUOTES,"UTF-8"):$this->portes;}
	public function SETportes ($portes,$entity_encode=false) {$this->portes=($entity_encode)?htmlentities($portes,ENT_QUOTES,"UTF-8"):$portes;}

	public function GETcredito ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->credito,ENT_QUOTES,"UTF-8"):$this->credito;}
	public function SETcredito ($credito,$entity_encode=false) {$this->credito=($entity_encode)?htmlentities($credito,ENT_QUOTES,"UTF-8"):$credito;}

	public function GETnotas ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->notas,ENT_QUOTES,"UTF-8"):$this->notas;}
	public function SETnotas ($notas,$entity_encode=false) {$this->notas=($entity_encode)?htmlentities($notas,ENT_QUOTES,"UTF-8"):$notas;}

	public function GETincluidoEnNotificacionTransporte ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->incluidoEnNotificacionTransporte,ENT_QUOTES,"UTF-8"):$this->incluidoEnNotificacionTransporte;}
	public function SETincluidoEnNotificacionTransporte ($incluidoEnNotificacionTransporte,$entity_encode=false) {$this->incluidoEnNotificacionTransporte=($entity_encode)?htmlentities($incluidoEnNotificacionTransporte,ENT_QUOTES,"UTF-8"):$incluidoEnNotificacionTransporte;}

	public function GETalbaranGenerado ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->albaranGenerado,ENT_QUOTES,"UTF-8"):$this->albaranGenerado;}
	public function SETalbaranGenerado ($albaranGenerado,$entity_encode=false) {$this->albaranGenerado=($entity_encode)?htmlentities($albaranGenerado,ENT_QUOTES,"UTF-8"):$albaranGenerado;}

	public function GETbultos ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->bultos,ENT_QUOTES,"UTF-8"):$this->bultos;}
	public function SETbultos ($bultos,$entity_encode=false) {$this->bultos=($entity_encode)?htmlentities($bultos,ENT_QUOTES,"UTF-8"):$bultos;}

	public function GETfactura ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->factura,ENT_QUOTES,"UTF-8"):$this->factura;}
	public function SETfactura ($factura,$entity_encode=false) {$this->factura=($entity_encode)?htmlentities($factura,ENT_QUOTES,"UTF-8"):$factura;}

	public function GETidUsuario ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->idUsuario,ENT_QUOTES,"UTF-8"):$this->idUsuario;}
	public function SETidUsuario ($idUsuario,$entity_encode=false) {$this->idUsuario=($entity_encode)?htmlentities($idUsuario,ENT_QUOTES,"UTF-8"):$idUsuario;}

	public function GETidCupon ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->idCupon,ENT_QUOTES,"UTF-8"):$this->idCupon;}
	public function SETidCupon ($idCupon,$entity_encode=false) {$this->idCupon=($entity_encode)?htmlentities($idCupon,ENT_QUOTES,"UTF-8"):$idCupon;}

	public function GETidPedidoModoPago ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->idPedidoModoPago,ENT_QUOTES,"UTF-8"):$this->idPedidoModoPago;}
	public function SETidPedidoModoPago ($idPedidoModoPago,$entity_encode=false) {$this->idPedidoModoPago=($entity_encode)?htmlentities($idPedidoModoPago,ENT_QUOTES,"UTF-8"):$idPedidoModoPago;}

	public function GETidTransporte ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->idTransporte,ENT_QUOTES,"UTF-8"):$this->idTransporte;}
	public function SETidTransporte ($idTransporte,$entity_encode=false) {$this->idTransporte=($entity_encode)?htmlentities($idTransporte,ENT_QUOTES,"UTF-8"):$idTransporte;}

	public function GETkeyTienda ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->keyTienda,ENT_QUOTES,"UTF-8"):$this->keyTienda;}
	public function SETkeyTienda ($keyTienda,$entity_encode=false) {$this->keyTienda=($entity_encode)?htmlentities($keyTienda,ENT_QUOTES,"UTF-8"):$keyTienda;}

	public function GETidEnOrigen ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->idEnOrigen,ENT_QUOTES,"UTF-8"):$this->idEnOrigen;}
	public function SETidEnOrigen ($idEnOrigen,$entity_encode=false) {$this->idEnOrigen=($entity_encode)?htmlentities($idEnOrigen,ENT_QUOTES,"UTF-8"):$idEnOrigen;}


/* Funciones estaticas ********************************************************/

	public static function existeId($id) {
		$sql="SELECT * FROM multi_pedido WHERE id='".self::db()->real_escape_string($id)."'";
		$data=self::db()->get_obj($sql);
		if ($data) {$result=true;} else {$result=false;}
		return $result;
	}
	public static function allToArray($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE ".$where:"";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedido".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=self::db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrIds": array_push($arr,$data->id);break;
				case "arrClassObjs":
					$obj=new self($data->id);
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
	public static function ls($where="",$order="",$limit="") {
		$sqlView="CREATE OR REPLACE VIEW `lsMulti_pedido` AS
			SELECT * FROM multi_pedido;
		";
		self::db()->query($sqlView);
		$sqlWhere=($where!="")?" WHERE ".$where:"";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM lsMulti_pedido".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=self::db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			$objSeg=new self($data->id);
			$obj=new \stdClass();
			foreach ($data as $field => $value) {
				$obj->$field=$value;
			}
			array_push($arr,$obj);
			unset ($obj);
		}
		return $arr;
	}

/* Funciones dinamicas ********************************************************/

	public function noReferenciado() {
		$sql="SELECT idPedido FROM multi_pedidoCredito WHERE idPedido='".self::db()->real_escape_string($this->id)."'";
		$noReferenciadoEnMulti_pedidoCredito=(self::db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idPedido FROM multi_pedidoDescuento WHERE idPedido='".self::db()->real_escape_string($this->id)."'";
		$noReferenciadoEnMulti_pedidoDescuento=(self::db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idPedido FROM multi_pedidoLinea WHERE idPedido='".self::db()->real_escape_string($this->id)."'";
		$noReferenciadoEnMulti_pedidoLinea=(self::db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idPedido FROM multi_pedidoMensaje WHERE idPedido='".self::db()->real_escape_string($this->id)."'";
		$noReferenciadoEnMulti_pedidoMensaje=(self::db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idMulti_pedido FROM multi_pedidoPasoProceso WHERE idMulti_pedido='".self::db()->real_escape_string($this->id)."'";
		$noReferenciadoEnMulti_pedidoPasoProceso=(self::db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idPedido FROM multi_transporteNotificacionVARIOSpedido WHERE idPedido='".self::db()->real_escape_string($this->id)."'";
		$noReferenciadoEnMulti_transporteNotificacionVARIOSpedido=(self::db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_pedidoCredito && $noReferenciadoEnMulti_pedidoDescuento && $noReferenciadoEnMulti_pedidoLinea && $noReferenciadoEnMulti_pedidoMensaje && $noReferenciadoEnMulti_pedidoPasoProceso && $noReferenciadoEnMulti_transporteNotificacionVARIOSpedido)?true:false;
		return $result;
	}

/* Funciones FkFrom ***********************************************************/

	public function objMulti_pedidoModoPago() {
		return new Multi_pedidoModoPago($this->idPedidoModoPago);
	}
	public function objMulti_transporte() {
		return new Multi_transporte($this->idTransporte);
	}

/* Funciones FkTo *************************************************************/

	public function arrMulti_pedidoCredito($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idPedido='".self::db()->real_escape_string($this->id)."' AND ".$where:" WHERE idPedido='".self::db()->real_escape_string($this->id)."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedidoCredito".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=self::db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrIds": array_push($arr,$data->id);break;
				case "arrClassObjs":
					$obj=new Multi_pedidoCredito($data->id);
					array_push($arr,$obj);
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
	public function arrMulti_pedidoDescuento($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idPedido='".self::db()->real_escape_string($this->id)."' AND ".$where:" WHERE idPedido='".self::db()->real_escape_string($this->id)."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedidoDescuento".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=self::db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrIds": array_push($arr,$data->id);break;
				case "arrClassObjs":
					$obj=new Multi_pedidoDescuento($data->id);
					array_push($arr,$obj);
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
	public function arrMulti_pedidoLinea($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idPedido='".self::db()->real_escape_string($this->id)."' AND ".$where:" WHERE idPedido='".self::db()->real_escape_string($this->id)."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedidoLinea".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=self::db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrIds": array_push($arr,$data->id);break;
				case "arrClassObjs":
					$obj=new Multi_pedidoLinea($data->id);
					array_push($arr,$obj);
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
	public function arrMulti_pedidoMensaje($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idPedido='".self::db()->real_escape_string($this->id)."' AND ".$where:" WHERE idPedido='".self::db()->real_escape_string($this->id)."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedidoMensaje".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=self::db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrIds": array_push($arr,$data->id);break;
				case "arrClassObjs":
					$obj=new Multi_pedidoMensaje($data->id);
					array_push($arr,$obj);
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
	public function arrMulti_pedidoPasoProceso($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_pedido='".self::db()->real_escape_string($this->id)."' AND ".$where:" WHERE idMulti_pedido='".self::db()->real_escape_string($this->id)."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedidoPasoProceso".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=self::db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrIds": array_push($arr,$data->id);break;
				case "arrClassObjs":
					$obj=new Multi_pedidoPasoProceso($data->id);
					array_push($arr,$obj);
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
	public function arrMulti_transporteNotificacion($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idPedido='".self::db()->real_escape_string($this->id)."' AND ".$where:" WHERE idPedido='".self::db()->real_escape_string($this->id)."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_transporteNotificacionVARIOSpedido INNER JOIN multi_transporteNotificacion ON multi_transporteNotificacionVARIOSpedido.idTransporteNotificacion=multi_transporteNotificacion.id".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=self::db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrIds": array_push($arr,$data->id);break;
				case "arrClassObjs":
					$obj=new Multi_transporteNotificacion($data->id);
					array_push($arr,$obj);
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
}
?>
