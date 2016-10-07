<?
class Multi_cliente extends \Sintax\Core\Entity implements \Sintax\Core\IEntity {
	protected static $table="multi_cliente";
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
			"login" => NULL,
			"email" => NULL,
			"passMd5" => NULL,
			"passSha256" => NULL,
			"factura" => NULL,
			"nif" => NULL,
			"razonSocial" => NULL,
			"nombre" => NULL,
			"apellidos" => NULL,
			"movil" => NULL,
			"sexo" => NULL,
			"fnac" => NULL,
			"re" => NULL,
			"tipoDescuento" => NULL,
			"publicidad" => NULL,
			"avisosSms" => NULL,
			"ultimoLogin" => NULL,
			"ultimaActividad" => NULL,
			"keyTienda" => NULL,
			"idEnOrigen" => NULL,
		);
		parent::__construct($db,$keyValue);
	}

	public function noReferenciado() {
		$sql="SELECT idMulti_cliente FROM multi_apunteCredito WHERE idMulti_cliente='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_apunteCredito=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idMulti_cliente FROM multi_cesta WHERE idMulti_cliente='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_cesta=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idMulti_cliente FROM multi_clienteDireccion WHERE idMulti_cliente='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_clienteDireccion=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idMulti_cliente FROM multi_cupon WHERE idMulti_cliente='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_cupon=($this->db()->get_num_rows($sql)==0)?true:false;
		$sql="SELECT idMulti_cliente FROM multi_pedido WHERE idMulti_cliente='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$noReferenciadoEnMulti_pedido=($this->db()->get_num_rows($sql)==0)?true:false;
		$result=($noReferenciadoEnMulti_apunteCredito && $noReferenciadoEnMulti_cesta && $noReferenciadoEnMulti_clienteDireccion && $noReferenciadoEnMulti_cupon && $noReferenciadoEnMulti_pedido)?true:false;
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

	public function GETlogin ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["login"],ENT_QUOTES,"UTF-8"):$this->arrDbData["login"];}
	public function SETlogin ($login,$entity_encode=false) {$this->arrDbData["login"]=($entity_encode)?htmlentities($login,ENT_QUOTES,"UTF-8"):$login;}

	public function GETemail ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["email"],ENT_QUOTES,"UTF-8"):$this->arrDbData["email"];}
	public function SETemail ($email,$entity_encode=false) {$this->arrDbData["email"]=($entity_encode)?htmlentities($email,ENT_QUOTES,"UTF-8"):$email;}

	public function GETpassMd5 ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["passMd5"],ENT_QUOTES,"UTF-8"):$this->arrDbData["passMd5"];}
	public function SETpassMd5 ($passMd5,$entity_encode=false) {$this->arrDbData["passMd5"]=($entity_encode)?htmlentities($passMd5,ENT_QUOTES,"UTF-8"):$passMd5;}

	public function GETpassSha256 ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["passSha256"],ENT_QUOTES,"UTF-8"):$this->arrDbData["passSha256"];}
	public function SETpassSha256 ($passSha256,$entity_encode=false) {
		$salt=hash('sha256', uniqid(mt_rand(), true));
		$hash=$salt.hash('sha256',$salt.$passSha256);
		$this->arrDbData["passSha256"]=$hash;
		$this->arrDbData["passSha256"]=($entity_encode)?htmlentities($this->arrDbData["passSha256"],ENT_QUOTES,"UTF-8"):$this->arrDbData["passSha256"];
		//los primeros 64 caracteres del hash son el salt usado para este pass
		//que deberemos recuperar para juntar con el pass introducido y comprobar
	}

	public function GETfactura ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["factura"],ENT_QUOTES,"UTF-8"):$this->arrDbData["factura"];}
	public function SETfactura ($factura,$entity_encode=false) {$this->arrDbData["factura"]=($entity_encode)?htmlentities($factura,ENT_QUOTES,"UTF-8"):$factura;}

	public function GETnif ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["nif"],ENT_QUOTES,"UTF-8"):$this->arrDbData["nif"];}
	public function SETnif ($nif,$entity_encode=false) {$this->arrDbData["nif"]=($entity_encode)?htmlentities($nif,ENT_QUOTES,"UTF-8"):$nif;}

	public function GETrazonSocial ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["razonSocial"],ENT_QUOTES,"UTF-8"):$this->arrDbData["razonSocial"];}
	public function SETrazonSocial ($razonSocial,$entity_encode=false) {$this->arrDbData["razonSocial"]=($entity_encode)?htmlentities($razonSocial,ENT_QUOTES,"UTF-8"):$razonSocial;}

	public function GETnombre ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["nombre"],ENT_QUOTES,"UTF-8"):$this->arrDbData["nombre"];}
	public function SETnombre ($nombre,$entity_encode=false) {$this->arrDbData["nombre"]=($entity_encode)?htmlentities($nombre,ENT_QUOTES,"UTF-8"):$nombre;}

	public function GETapellidos ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["apellidos"],ENT_QUOTES,"UTF-8"):$this->arrDbData["apellidos"];}
	public function SETapellidos ($apellidos,$entity_encode=false) {$this->arrDbData["apellidos"]=($entity_encode)?htmlentities($apellidos,ENT_QUOTES,"UTF-8"):$apellidos;}

	public function GETmovil ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["movil"],ENT_QUOTES,"UTF-8"):$this->arrDbData["movil"];}
	public function SETmovil ($movil,$entity_encode=false) {$this->arrDbData["movil"]=($entity_encode)?htmlentities($movil,ENT_QUOTES,"UTF-8"):$movil;}

	public function GETsexo ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["sexo"],ENT_QUOTES,"UTF-8"):$this->arrDbData["sexo"];}
	public function SETsexo ($sexo,$entity_encode=false) {$this->arrDbData["sexo"]=($entity_encode)?htmlentities($sexo,ENT_QUOTES,"UTF-8"):$sexo;}

	public function GETfnac ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["fnac"],ENT_QUOTES,"UTF-8"):$this->arrDbData["fnac"];}
	public function SETfnac ($fnac,$entity_encode=false) {$this->arrDbData["fnac"]=($entity_encode)?htmlentities($fnac,ENT_QUOTES,"UTF-8"):$fnac;}

	public function GETre ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["re"],ENT_QUOTES,"UTF-8"):$this->arrDbData["re"];}
	public function SETre ($re,$entity_encode=false) {$this->arrDbData["re"]=($entity_encode)?htmlentities($re,ENT_QUOTES,"UTF-8"):$re;}

	public function GETtipoDescuento ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["tipoDescuento"],ENT_QUOTES,"UTF-8"):$this->arrDbData["tipoDescuento"];}
	public function SETtipoDescuento ($tipoDescuento,$entity_encode=false) {$this->arrDbData["tipoDescuento"]=($entity_encode)?htmlentities($tipoDescuento,ENT_QUOTES,"UTF-8"):$tipoDescuento;}

	public function GETpublicidad ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["publicidad"],ENT_QUOTES,"UTF-8"):$this->arrDbData["publicidad"];}
	public function SETpublicidad ($publicidad,$entity_encode=false) {$this->arrDbData["publicidad"]=($entity_encode)?htmlentities($publicidad,ENT_QUOTES,"UTF-8"):$publicidad;}

	public function GETavisosSms ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["avisosSms"],ENT_QUOTES,"UTF-8"):$this->arrDbData["avisosSms"];}
	public function SETavisosSms ($avisosSms,$entity_encode=false) {$this->arrDbData["avisosSms"]=($entity_encode)?htmlentities($avisosSms,ENT_QUOTES,"UTF-8"):$avisosSms;}

	public function GETultimoLogin ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["ultimoLogin"],ENT_QUOTES,"UTF-8"):$this->arrDbData["ultimoLogin"];}
	public function SETultimoLogin ($ultimoLogin,$entity_encode=false) {
		$this->arrDbData["ultimoLogin"]=($entity_encode)?htmlentities($ultimoLogin,ENT_QUOTES,"UTF-8"):$ultimoLogin;
		$this->arrDbData["ultimaActividad"]=($entity_encode)?htmlentities($ultimoLogin,ENT_QUOTES,"UTF-8"):$ultimoLogin;
	}

	public function GETultimaActividad ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["ultimaActividad"],ENT_QUOTES,"UTF-8"):$this->arrDbData["ultimaActividad"];}
	public function SETultimaActividad ($ultimaActividad,$entity_encode=false) {$this->arrDbData["ultimaActividad"]=($entity_encode)?htmlentities($ultimaActividad,ENT_QUOTES,"UTF-8"):$ultimaActividad;}

	public function GETkeyTienda ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["keyTienda"],ENT_QUOTES,"UTF-8"):$this->arrDbData["keyTienda"];}
	public function SETkeyTienda ($keyTienda,$entity_encode=false) {$this->arrDbData["keyTienda"]=($entity_encode)?htmlentities($keyTienda,ENT_QUOTES,"UTF-8"):$keyTienda;}

	public function GETidEnOrigen ($entity_decode=false) {return ($entity_decode)?html_entity_decode($this->arrDbData["idEnOrigen"],ENT_QUOTES,"UTF-8"):$this->arrDbData["idEnOrigen"];}
	public function SETidEnOrigen ($idEnOrigen,$entity_encode=false) {$this->arrDbData["idEnOrigen"]=($entity_encode)?htmlentities($idEnOrigen,ENT_QUOTES,"UTF-8"):$idEnOrigen;}

/******************************************************************************/

/* Funciones FkFrom ***********************************************************/


/* Funciones FkTo *************************************************************/

	public function arrMulti_apunteCredito($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_cliente='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_cliente='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_apunteCredito".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_apunteCredito::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_apunteCredito($this->db(),$data->{\Multi_apunteCredito::GETkeyField()});
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
	public function arrMulti_cesta($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_cliente='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_cliente='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_cesta".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_cesta::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_cesta($this->db(),$data->{\Multi_cesta::GETkeyField()});
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
	public function arrMulti_clienteDireccion($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_cliente='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_cliente='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_clienteDireccion".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_clienteDireccion::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_clienteDireccion($this->db(),$data->{\Multi_clienteDireccion::GETkeyField()});
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
	public function arrMulti_cupon($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_cliente='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_cliente='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_cupon".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_cupon::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_cupon($this->db(),$data->{\Multi_cupon::GETkeyField()});
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
	public function arrMulti_pedido($where="",$order="",$limit="",$tipo="arrStdObjs") {
		$sqlWhere=($where!="")?" WHERE idMulti_cliente='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."' AND ".$where:" WHERE idMulti_cliente='".$this->db()->real_escape_string($this->arrDbData[static::$keyField])."'";
		$sqlOrder=($order!="")?" ORDER BY ".$order:"";
		$sqlLimit=($limit!="")?" LIMIT ".$limit:"";
		$sql="SELECT * FROM multi_pedido".$sqlWhere.$sqlOrder.$sqlLimit;
		$arr=array();
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			switch ($tipo) {
				case "arrKeys": array_push($arr,$data->{\Multi_pedido::GETkeyField()});break;
				case "arrClassObjs":
					$obj=new \Multi_pedido($this->db(),$data->{\Multi_pedido::GETkeyField()});
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
/******************************************************************************/
	/**
	 * [login description]
	 * @param  \MysqliDB $db     Instancia de clase de acceso a base de datos
	 * @param  string $email     [description]
	 * @param  string $pass      [description]
	 * @param  string $keyTienda [description]
	 * @return Multi_cliente o boolean false      [description]
	 */
	public function login($db,$email,$pass,$keyTienda) {
		$sql="SELECT id FROM multi_cliente WHERE (email='".$db->real_escape_string($email)."' || login='".$db->real_escape_string($email)."')
			&& keyTienda='".$db->real_escape_string($keyTienda)."'";
		$data=$db->get_row($sql);
		if ($data) {
			$objCli=new static($db,$data->id);
			if ($objCli->GETpassSha256()!="") {
				$salt=substr($objCli->GETpassSha256(),0,64);
				$hash=$salt.hash('sha256',$salt.$pass);
				if ($hash==$objCli->GETpassSha256()) {
					$result=$objCli;
				} else {
					$result=false;
				}
			} else {
				if (md5($pass)==$objCli->GETpassMd5()) {
					$result=$objCli;
				} else {
					$result=false;
				}
			}
		} else {
			$result=false;
		}
		return $result;
	}
	/**
	 * [saldoCredito description]
	 * @return float saldo de credito en euros
	 */
	public function saldoCredito() {
		$saldo=0;
		$sql="SELECT id FROM multi_apunteCredito WHERE idMulti_cliente='".$this->GETid()."'";
		$rsl=$this->db()->query($sql);
		while ($data=$rsl->fetch_object()) {
			$objApunte=new Multi_apunteCredito($data->id);
			if ($objApunte->caducado()) {
				$saldo+=$objApunte->GETgasto();
			} else {
				$saldo+=$objApunte->GETmonto();
			}
		}
		return $saldo;
	}
/******************************************************************************/
	public static function existeEmail ($db, $email, $keyTienda) {
		$sql="SELECT * FROM multi_cliente WHERE email='".$db->real_escape_string($email)."' AND keyTienda='".$keyTienda."'";
		$data=$db->get_row($sql);
		if ($data) {$result=true;} else {$result=false;}
		return $result;
	}
	public static function cargarPorEmail ($db, $email, $keyTienda) {
		$sql="SELECT id FROM multi_cliente WHERE email='".$db->real_escape_string($email)."' AND keyTienda='".$keyTienda."'";
		$data=$db->get_row($sql);
		if ($data) {
			$result=new self($db,$data->id);
		} else {
			$result=false;
		}
		return $result;
	}

}
?>
