<?
class Multi_pedido extends Sintax\Core\Entity implements Sintax\Core\IEntity {
	protected static $table="multi_pedido";
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
			"numero" => NULL,
			"expedicion" => NULL,
			"serie" => NULL,
			"nombre" => NULL,
			"apellidos" => NULL,
			"destinatario" => NULL,
			"telefono" => NULL,
			"email" => NULL,
			"direccion" => NULL,
			"cp" => NULL,
			"poblacion" => NULL,
			"provincia" => NULL,
			"pais" => NULL,
			"horario" => NULL,
			"portes" => NULL,
			"credito" => NULL,
			"notas" => NULL,
			"incluidoEnNotificacionTransporte" => NULL,
			"albaranGenerado" => NULL,
			"bultos" => NULL,
			"factura" => NULL,
			"borrado" => NULL,
			"idUsuario" => NULL,
			"idCupon" => NULL,
			"idPedidoModoPago" => NULL,
			"idTransporte" => NULL,
			"keyTienda" => NULL,
			"idEnOrigen" => NULL,
			"idMulti_cliente" => NULL,
			"idMulti_cupon" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$sql="SELECT idPedido FROM multi_pedidoCredito WHERE idPedido='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_pedidoCredito=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idPedido FROM multi_pedidoDescuento WHERE idPedido='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_pedidoDescuento=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idPedido FROM multi_pedidoLinea WHERE idPedido='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_pedidoLinea=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idPedido FROM multi_pedidoMensaje WHERE idPedido='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_pedidoMensaje=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idMulti_pedido FROM multi_pedidoPasoProceso WHERE idMulti_pedido='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_pedidoPasoProceso=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idPedido FROM multi_transporteNotificacionVARIOSpedido WHERE idPedido='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_transporteNotificacionVARIOSpedido=($this->db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_pedidoCredito && $noReferenciadoEnMulti_pedidoDescuento && $noReferenciadoEnMulti_pedidoLinea && $noReferenciadoEnMulti_pedidoMensaje && $noReferenciadoEnMulti_pedidoPasoProceso && $noReferenciadoEnMulti_transporteNotificacionVARIOSpedido)?true:false;
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

	public function GETnumero ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["numero"],ENT_QUOTES,"UTF-8"):$this->arrDbData["numero"];}
	public function SETnumero ($numero,$entity_encode=false) {$this->arrDbData["numero"]=($entity_encode)?htmlentities($numero,ENT_QUOTES,"UTF-8"):$numero;}

	public function GETexpedicion ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["expedicion"],ENT_QUOTES,"UTF-8"):$this->arrDbData["expedicion"];}
	public function SETexpedicion ($expedicion,$entity_encode=false) {$this->arrDbData["expedicion"]=($entity_encode)?htmlentities($expedicion,ENT_QUOTES,"UTF-8"):$expedicion;}

	public function GETserie ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["serie"],ENT_QUOTES,"UTF-8"):$this->arrDbData["serie"];}
	public function SETserie ($serie,$entity_encode=false) {$this->arrDbData["serie"]=($entity_encode)?htmlentities($serie,ENT_QUOTES,"UTF-8"):$serie;}

	public function GETnombre ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["nombre"],ENT_QUOTES,"UTF-8"):$this->arrDbData["nombre"];}
	public function SETnombre ($nombre,$entity_encode=false) {$this->arrDbData["nombre"]=($entity_encode)?htmlentities($nombre,ENT_QUOTES,"UTF-8"):$nombre;}

	public function GETapellidos ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["apellidos"],ENT_QUOTES,"UTF-8"):$this->arrDbData["apellidos"];}
	public function SETapellidos ($apellidos,$entity_encode=false) {$this->arrDbData["apellidos"]=($entity_encode)?htmlentities($apellidos,ENT_QUOTES,"UTF-8"):$apellidos;}

	public function GETdestinatario ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["destinatario"],ENT_QUOTES,"UTF-8"):$this->arrDbData["destinatario"];}
	public function SETdestinatario ($destinatario,$entity_encode=false) {$this->arrDbData["destinatario"]=($entity_encode)?htmlentities($destinatario,ENT_QUOTES,"UTF-8"):$destinatario;}

	public function GETtelefono ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["telefono"],ENT_QUOTES,"UTF-8"):$this->arrDbData["telefono"];}
	public function SETtelefono ($telefono,$entity_encode=false) {$this->arrDbData["telefono"]=($entity_encode)?htmlentities($telefono,ENT_QUOTES,"UTF-8"):$telefono;}

	public function GETemail ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["email"],ENT_QUOTES,"UTF-8"):$this->arrDbData["email"];}
	public function SETemail ($email,$entity_encode=false) {$this->arrDbData["email"]=($entity_encode)?htmlentities($email,ENT_QUOTES,"UTF-8"):$email;}

	public function GETdireccion ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["direccion"],ENT_QUOTES,"UTF-8"):$this->arrDbData["direccion"];}
	public function SETdireccion ($direccion,$entity_encode=false) {$this->arrDbData["direccion"]=($entity_encode)?htmlentities($direccion,ENT_QUOTES,"UTF-8"):$direccion;}

	public function GETcp ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["cp"],ENT_QUOTES,"UTF-8"):$this->arrDbData["cp"];}
	public function SETcp ($cp,$entity_encode=false) {$this->arrDbData["cp"]=($entity_encode)?htmlentities($cp,ENT_QUOTES,"UTF-8"):$cp;}

	public function GETpoblacion ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["poblacion"],ENT_QUOTES,"UTF-8"):$this->arrDbData["poblacion"];}
	public function SETpoblacion ($poblacion,$entity_encode=false) {$this->arrDbData["poblacion"]=($entity_encode)?htmlentities($poblacion,ENT_QUOTES,"UTF-8"):$poblacion;}

	public function GETprovincia ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["provincia"],ENT_QUOTES,"UTF-8"):$this->arrDbData["provincia"];}
	public function SETprovincia ($provincia,$entity_encode=false) {$this->arrDbData["provincia"]=($entity_encode)?htmlentities($provincia,ENT_QUOTES,"UTF-8"):$provincia;}

	public function GETpais ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["pais"],ENT_QUOTES,"UTF-8"):$this->arrDbData["pais"];}
	public function SETpais ($pais,$entity_encode=false) {$this->arrDbData["pais"]=($entity_encode)?htmlentities($pais,ENT_QUOTES,"UTF-8"):$pais;}

	public function GEThorario ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["horario"],ENT_QUOTES,"UTF-8"):$this->arrDbData["horario"];}
	public function SEThorario ($horario,$entity_encode=false) {$this->arrDbData["horario"]=($entity_encode)?htmlentities($horario,ENT_QUOTES,"UTF-8"):$horario;}

	public function GETportes ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["portes"],ENT_QUOTES,"UTF-8"):$this->arrDbData["portes"];}
	public function SETportes ($portes,$entity_encode=false) {$this->arrDbData["portes"]=($entity_encode)?htmlentities($portes,ENT_QUOTES,"UTF-8"):$portes;}

	public function GETcredito ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["credito"],ENT_QUOTES,"UTF-8"):$this->arrDbData["credito"];}
	public function SETcredito ($credito,$entity_encode=false) {$this->arrDbData["credito"]=($entity_encode)?htmlentities($credito,ENT_QUOTES,"UTF-8"):$credito;}

	public function GETnotas ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["notas"],ENT_QUOTES,"UTF-8"):$this->arrDbData["notas"];}
	public function SETnotas ($notas,$entity_encode=false) {$this->arrDbData["notas"]=($entity_encode)?htmlentities($notas,ENT_QUOTES,"UTF-8"):$notas;}

	public function GETincluidoEnNotificacionTransporte ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["incluidoEnNotificacionTransporte"],ENT_QUOTES,"UTF-8"):$this->arrDbData["incluidoEnNotificacionTransporte"];}
	public function SETincluidoEnNotificacionTransporte ($incluidoEnNotificacionTransporte,$entity_encode=false) {$this->arrDbData["incluidoEnNotificacionTransporte"]=($entity_encode)?htmlentities($incluidoEnNotificacionTransporte,ENT_QUOTES,"UTF-8"):$incluidoEnNotificacionTransporte;}

	public function GETalbaranGenerado ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["albaranGenerado"],ENT_QUOTES,"UTF-8"):$this->arrDbData["albaranGenerado"];}
	public function SETalbaranGenerado ($albaranGenerado,$entity_encode=false) {$this->arrDbData["albaranGenerado"]=($entity_encode)?htmlentities($albaranGenerado,ENT_QUOTES,"UTF-8"):$albaranGenerado;}

	public function GETbultos ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["bultos"],ENT_QUOTES,"UTF-8"):$this->arrDbData["bultos"];}
	public function SETbultos ($bultos,$entity_encode=false) {$this->arrDbData["bultos"]=($entity_encode)?htmlentities($bultos,ENT_QUOTES,"UTF-8"):$bultos;}

	public function GETfactura ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["factura"],ENT_QUOTES,"UTF-8"):$this->arrDbData["factura"];}
	public function SETfactura ($factura,$entity_encode=false) {$this->arrDbData["factura"]=($entity_encode)?htmlentities($factura,ENT_QUOTES,"UTF-8"):$factura;}

	public function GETborrado ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["borrado"],ENT_QUOTES,"UTF-8"):$this->arrDbData["borrado"];}
	public function SETborrado ($borrado,$entity_encode=false) {$this->arrDbData["borrado"]=($entity_encode)?htmlentities($borrado,ENT_QUOTES,"UTF-8"):$borrado;}

	public function GETidUsuario ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idUsuario"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idUsuario"];}
	public function SETidUsuario ($idUsuario,$entity_encode=false) {$this->arrDbData["idUsuario"]=($entity_encode)?htmlentities($idUsuario,ENT_QUOTES,"UTF-8"):$idUsuario;}

	public function GETidCupon ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idCupon"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idCupon"];}
	public function SETidCupon ($idCupon,$entity_encode=false) {$this->arrDbData["idCupon"]=($entity_encode)?htmlentities($idCupon,ENT_QUOTES,"UTF-8"):$idCupon;}

	public function GETidPedidoModoPago ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idPedidoModoPago"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idPedidoModoPago"];}
	public function SETidPedidoModoPago ($idPedidoModoPago,$entity_encode=false) {$this->arrDbData["idPedidoModoPago"]=($entity_encode)?htmlentities($idPedidoModoPago,ENT_QUOTES,"UTF-8"):$idPedidoModoPago;}

	public function GETidTransporte ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idTransporte"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idTransporte"];}
	public function SETidTransporte ($idTransporte,$entity_encode=false) {$this->arrDbData["idTransporte"]=($entity_encode)?htmlentities($idTransporte,ENT_QUOTES,"UTF-8"):$idTransporte;}

	public function GETkeyTienda ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["keyTienda"],ENT_QUOTES,"UTF-8"):$this->arrDbData["keyTienda"];}
	public function SETkeyTienda ($keyTienda,$entity_encode=false) {$this->arrDbData["keyTienda"]=($entity_encode)?htmlentities($keyTienda,ENT_QUOTES,"UTF-8"):$keyTienda;}

	public function GETidEnOrigen ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idEnOrigen"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idEnOrigen"];}
	public function SETidEnOrigen ($idEnOrigen,$entity_encode=false) {$this->arrDbData["idEnOrigen"]=($entity_encode)?htmlentities($idEnOrigen,ENT_QUOTES,"UTF-8"):$idEnOrigen;}

	public function GETidMulti_cliente ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idMulti_cliente"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idMulti_cliente"];}
	public function SETidMulti_cliente ($idMulti_cliente,$entity_encode=false) {$this->arrDbData["idMulti_cliente"]=($entity_encode)?htmlentities($idMulti_cliente,ENT_QUOTES,"UTF-8"):$idMulti_cliente;}

	public function GETidMulti_cupon ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idMulti_cupon"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idMulti_cupon"];}
	public function SETidMulti_cupon ($idMulti_cupon,$entity_encode=false) {$this->arrDbData["idMulti_cupon"]=($entity_encode)?htmlentities($idMulti_cupon,ENT_QUOTES,"UTF-8"):$idMulti_cupon;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/

	public function objMulti_cliente() {
		return new \Multi_cliente($this->db(),$this->arrDbData["idMulti_cliente"]);
	}
	public function objMulti_cupon() {
		return new \Multi_cupon($this->db(),$this->arrDbData["idMulti_cupon"]);
	}
	public function objMulti_pedidoModoPago() {
		return new \Multi_pedidoModoPago($this->db(),$this->arrDbData["idPedidoModoPago"]);
	}
	public function objMulti_transporte() {
		return new \Multi_transporte($this->db(),$this->arrDbData["idTransporte"]);
	}

/* Funciones FkTo *************************************************************/

	public function arrMulti_pedidoCredito($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idPedido='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idPedido='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedidoCredito".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_pedidoCredito::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_pedidoCredito($this->db(),$data->{\Multi_pedidoCredito::GETkeyField()});
					array_push($arr,$obj);
					unset($obj);
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
		$sqlWhere=($where!="")?" WHERE idPedido='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idPedido='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedidoDescuento".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_pedidoDescuento::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_pedidoDescuento($this->db(),$data->{\Multi_pedidoDescuento::GETkeyField()});
					array_push($arr,$obj);
					unset($obj);
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
		$sqlWhere=($where!="")?" WHERE idPedido='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idPedido='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedidoLinea".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_pedidoLinea::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_pedidoLinea($this->db(),$data->{\Multi_pedidoLinea::GETkeyField()});
					array_push($arr,$obj);
					unset($obj);
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
		$sqlWhere=($where!="")?" WHERE idPedido='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idPedido='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedidoMensaje".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_pedidoMensaje::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_pedidoMensaje($this->db(),$data->{\Multi_pedidoMensaje::GETkeyField()});
					array_push($arr,$obj);
					unset($obj);
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
		$sqlWhere=($where!="")?" WHERE idMulti_pedido='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_pedido='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedidoPasoProceso".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_pedidoPasoProceso::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_pedidoPasoProceso($this->db(),$data->{\Multi_pedidoPasoProceso::GETkeyField()});
					array_push($arr,$obj);
					unset($obj);
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
		$sqlWhere=($where!="")?" WHERE idPedido='".$this->db()->real_escape_String($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idPedido='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_transporteNotificacionVARIOSpedido f INNER JOIN multi_transporteNotificacion ff ON f.idTransporteNotificacion=ff.".\Multi_transporteNotificacion::GETkeyField()." ".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_transporteNotificacion::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_transporteNotificacion($this->db(),$data->{\Multi_transporteNotificacion::GETkeyField()});
					array_push($arr,$obj);
					unset($obj);
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
