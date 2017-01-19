<?
namespace Sintax\ApiService;
use Sintax\Core\IApiService;
use Sintax\Core\ApiService;
use Sintax\Core\User;

class Clientes extends ApiService implements IApiService {

	public function __construct (User $objUsr=NULL) {
		parent::__construct($objUsr);
	}
	public static function acLoginClienteFB($email,$token,$keyTienda) {
		\cDb::confByKey("celorriov3");
		$result=false;
		//¿Incluimos el API de FB para comprobar el token?
		$objCli=\Multi_cliente::cargarPorEmail(\cDb::gI(),$email,$GLOBALS['config']->tienda->key);
		if ($objCli!==false) {
			//Ya conocemos al cliente, lo logeamos
			$result=false;
			$objCliUser=new \Multi_clienteUser(\cDb::gI());
			$objCliUser->objEntity=$objCli;
			$_SESSION['usuario']=$objCliUser;
			$result=true;
		} else {
			//Está logeado en FB y APP autorizada, pero no está en la tienda
			$siteName=$GLOBALS['config']->tienda->SITE_NAME;
			\Sintax\Core\ReturnInfo::add('Su email ('.$email.') no se encuentra regisatrado como cliente de '.$siteName.'. Por favor introduzca una contraseña para registrarse como cliente.','Bienvenido a '.$siteName);
			$result='FBLogin';
		}
		return $result;
	}
	/**
	 * [acLoginCliente description]
	 * @param  [type] $email      [description]
	 * @param  [type] $pass       [description]
	 * @param  [type] $keyTienda  [description]
	 * @param  [type] $tokenEmail [Para autologin desde newsletter]
	 * @return [type]             [description]
	 */
	public static function acLoginCliente($email,$pass,$keyTienda,$tokenEmail) {
		$db=\cDb::confByKey("celorriov3");
		//$arrReturn=array();
		$result=false;
		$objCliUser=\Multi_clienteUser::login($db,$email,$pass,$keyTienda,$tokenEmail);
		if ($objCliUser!==false) {
			$_SESSION['usuario']=$objCliUser;
			$result=true;
		} else {
			throw new \ActionException("Dirección de correo o contraseña incorrecta.", 1);
		}
		return $result;
	}
	/**
	 * [acNuevoCliente description]
	 * @param  [type] $email     [description]
	 * @param  [type] $pass      [description]
	 * @param  [type] $keyTienda [description]
	 * @return [type]            [description]
	 */
	public static function acNuevoCliente($email,$pass,$keyTienda){
		$db=\cDb::confByKey("celorriov3");
		$arrReturn=array();
		$email=trim($email);
		if ($email==""){
			$arrAccion=array(
				"valor" => false,
				"msg" => "El correo electrónico no es correcto"
			);
		} else {
			error_log("Excep email: ".$email);
			if (\Multi_cliente::existeEmail($db,$email,$keyTienda)){
				$arrAccion=array(
					"valor" => false,
					"msg" => "El correo electrónico ya se encuentra registrado"
				);
			} else {
				$objCli=new \Multi_cliente($db);
				$objCli->SETemail($email);
				$objCli->SETpassSha256($pass);
				$objCli->SETkeyTienda($keyTienda);
				$objCli->grabar();
				$arrDatos=array(
					"id" => $objCli->GETid()
				);
				$arrReturn['datos']=$arrDatos;
				$arrAccion=array(
					"valor" => true,
					"msg" => "Alta de usuario correcta"
				);
				self::acLoginCliente($email,$pass,$keyTienda,NULL);
			}
		}
		$arrReturn['resultado']=$arrAccion;
		return json_encode($arrReturn);
	}
	/**
	 * [getDatosRenderAreaCliente description]
	 * @param  [type] $objCli [description]
	 * @return [type]         [description]
	 */
	public static function getDatosRenderAreaCliente($objCli){
		$db=\cDb::confByKey('celorriov3');
		$objDatosRender= new \stdClass();
		$objCli->SETdb($db);
		$cliente=$objCli->toStdObj();
		$cliente->saldo=$objCli->saldoCredito();
		$cliente->saludo=($objCli->GETsexo()=="HOMBRE")?"Bienvenido":"Bienvenida";
		$objDatosRender->cliente=$cliente;
		$direcciones=array();
		foreach ($objCli->arrMulti_clienteDireccion("","","","arrClassObjs") as $objDir) {
			$soDirecion=$objDir->toStdObj();
			$soDirecion->esPaisConocido=$objDir->esPaisConocido();
			$soDirecion->idPais=($objDir->esPaisConocido()>0)?$objDir->paisToIdPais():199;
			error_log("direccion espaisconocido:".$soDirecion->esPaisConocido." idPais:".$soDirecion->idPais);
			array_push($direcciones,$soDirecion);
		}
		$objDatosRender->direcciones=$direcciones;
		$paises=\Multi_pais::getArray($db);
		$objDatosRender->paises=$paises;
		$objDatosRender->paisDefecto=199;
		$cupones=array();
		foreach ($objCli->arrMulti_cupon("","","","arrClassObjs") as $objCupon) {
			$stdObjCupon=new \stdClass();
			$stdObjCupon->id=$objCupon->GETid();
			$stdObjCupon->codigo=$objCupon->GETcodigo();
			$stdObjCupon->tipoDescuento=$objCupon->GETtipoDescuento();
			$stdObjCupon->caducidad=$objCupon->GETcaducidad();
			$stdObjCupon->pedidos=$objCupon->getlistaPedidos();
			array_push($cupones, $stdObjCupon);
		}
		$objDatosRender->cupones=$cupones;
		$objDatosRender->apuntes=$objCli->arrMulti_apunteCredito();
		return $objDatosRender;
	}
	/**
	 * [getDatosRenderPedidos description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 *
	public static function getDatosRenderPedidos($id){
		$db=\cDb::confByKey('celorriov3');
		$objMulti_cliente=new \Multi_cliente($db,$id);
		$objDatosRender= new \stdClass();
		$objDatosRender->pedidos=$objMulti_cliente->arrMulti_pedido();
		return $objDatosRender;
	}
	*/
	/**
	 * [getDatosRenderPedido description]
	 * @param  [type] $idPed  [description]
	 * @param  [type] $idUser [description]
	 * @return [type]         [description]
	 *
	public static function getDatosRenderPedido($idPed,$idUser){
		$db=\cDb::confByKey('celorriov3');
		$arrReturn=array();
		//tratamos el id pedido
		$objPed=new \Multi_pedido($db,$idPed);
		$objClienteLogeado=new \Multi_cliente($db,$idUser);
		//instanciamos clases necesarias
		$objPedidoEstado=new \Multi_pedidoEstado($db,$objPed->estadoPasoProcesoActual());
		$objPedidoPasoProceso=new \Multi_pedidoPasoProceso($db,$objPed->pasoProcesoActual());
		if (!is_null($objClienteLogeado) && $objPed->GETidUsuario()!=$idPed && $objPed->GETidMulti_cliente()!=$idPed) {
			//el usuario que accede no es el dueño del pedido
			throw new ApiException(
				"Service '".$arrRequest['pedService']."' acceso no permitido.".
				"objPed->GETidUsuario()=".$objPed->GETidUsuario().".".
				"recibido idUserOrigen=".$idUser.".".
				"recibido idMulti_cliente=".$idUser.".".
				"objPed->GETidMulti_cliente()=".$objPed->GETidMulti_cliente().".".
				"Multi_cliente::idEnOrigenToId(".$idUser.",".$objPed->GETkeyTienda().")=".\Multi_cliente::idEnOrigenToId($idUser,$objPed->GETkeyTienda()));
		}
		$cuponPercent="";
		$cuponCodigo="";
		$objCupon=new \Multi_cupon($db,$objPed->GETidCupon());
		$objClienteCupon=new \Multi_Cupon($db,$objCupon->GETidCliente());
		$cuponPercent=$objCupon->GETtipoDescuento();
		$cuponCodigo=$objCupon->GETcodigo();
		//Vemos si el pedido puede ser pagado/repagado
		$caducado=false;
		if (time()-Fecha::fromMysql($objPedidoPasoProceso->GETmomento())>constant($objPed->GETkeyTienda().'_CADUCIDAD_PAGO_PEDIDO')) {
			$caducado=true;
			$infoContinuacionPedido='No es posible continuar con el pedido debido a que su antiguedad es mayor de '.floor(constant($objPed->GETkeyTienda().'_CADUCIDAD_PAGO_PEDIDO')/60/60/24).' días';
		} else {
			$infoContinuacionPedido=$objPed->descripcionEstadoActual();
		}
		$sacarPanelRePagar=0;
		if (!$objPedidoEstado->GETpagado() && !$objPedidoEstado->GETpreparable() && !$objPedidoEstado->GETenviado()) {
			$sacarPanelRePagar=1;
		}
		//construimos datos del pedido
		$arrTmp=array(
			"id" => $objPed->GETid(),
			"numero" => $objPed->GETnumero(),
			"fecha" => Fecha::toFechaES(Fecha::fromMysql($objPedidoPasoProceso->GETmomento())),
			"base" => $objPed->base(),
			"iva" => $objPed->iva(),
			"descuentoPercent" => $objPed->totalTipoDescuentoPed(),
			"descuento" => $objPed->totalDescuentoPvp(),
			"totalImporteDescuentoPed" => $objPed->totalImporteDescuentoPed(),
			//"credito" => $objPed->GETcredito(),
			"portes" => $objPed->totalPortes(),
			"totalLineas" => $objPed->base()+$objPed->iva(),
			"total" => $objPed->total(),
			"idEstado" => $objPed->estadoPasoProcesoActual(),
			"estado" => $objPedidoEstado->GETnombre(),
			"entregaNombre" => $objPed->GETnombre(),
			"entregaApellidos" => $objPed->GETapellidos(),
			"entregaDireccion" => $objPed->GETdireccion(),
			"entregaCP" => $objPed->GETcp(),
			"entregaPoblacion" => $objPed->GETpoblacion(),
			"entregaProvincia" => $objPed->GETprovincia(),
			"entregaHorario" => $objPed->GEThorario(),
			"cuponCodigo" => $cuponCodigo,
			"cuponPercent" => $cuponPercent,
			"sacarPanelRePagar" => $sacarPanelRePagar,
			"infoContinuacionPedido" => $infoContinuacionPedido
		);
		$arrReturn['pedido']=$arrTmp;
		//lineas del pedido
		$arrTmpLineas=array();
		foreach ($objPed->arrIdLineas() as $idPedLinea) {
			$objPedLinea=new \Multi_pedidoLinea($db,$idPedLinea);
			$arrTmpLinea=array(
				"id" => $objPedLinea->GETid(),
				"referencia" => $objPedLinea->GETreferencia(),
				"concepto" => $objPedLinea->GETconcepto(),
				"pvp" => $objPedLinea->pvp(),
				"cantidad" => $objPedLinea->GETcantidad(),
				"descuentoPercent" => $objPedLinea->totalTipoDescuentoLinPed(),
				"descuento" => $objPedLinea->totalDescuentoPvp(),
				"total" => $objPedLinea->total()
			);
			array_push($arrTmpLineas, $arrTmpLinea);
		}
		$arrReturn['lineas']=$arrTmpLineas;
		//mensajes del pedido
		$arrTmpMsgs=array();
		foreach ($objPed->arrIdsMensajes() as $idPedMsg) {
			$objPedMsg=new \Multi_pedidoMensaje($db,$idPedMsg);
			if (!is_null($objClienteLogeado)) {
				$userRemitente=$objClienteLogeado->GETnombre().' '.$objClienteLogeado->GETapellidos();
			} else {
				$userRemitente="[SIN DATOS]";
			}
			$arrTmpMsg=array(
				"id" => $objPedMsg->GETid(),
				"fecha" => Fecha::toFechaES(Fecha::fromMysql($objPedMsg->GETinsert())),
				"mensaje" => $objPedMsg->GETmensaje(),
				"leido" => $objPedMsg->GETleido(),
				"remitente" => ($objPedMsg->GETdeCliente())?$userRemitente:constant($objPed->GETkeyTienda().'_SITE_NAME'),
				"marcableComoLeido" => (!$objPedMsg->GETdeCliente() && !$objPedMsg->GETleido())?'marcableComoLeido':''
			);
			array_push($arrTmpMsgs, $arrTmpMsg);
		}
		$arrReturn['mensajes']=$arrTmpMsgs;
		return json_encode($arrReturn);
	}
	*/
	/**
	 * [acGrabaPerfil description]
	 * @param  [type] $arrRequest [description]
	 * @return [type]             [description]
	 */
	public static function acGrabaPerfil($arrRequest){
		$db=\cDb::confByKey("celorriov3");
		$objCli=new \Multi_cliente($db,$arrRequest['id']);
		$objCli->SETnombre($arrRequest['nombre']);
		$objCli->SETapellidos($arrRequest['apellidos']);
		$objCli->SETmovil($arrRequest['movil']);
		$objCli->SETpublicidad($arrRequest['publicidad']);
		$objCli->SETnif($arrRequest['nif']);
		$objCli->SETrazonSocial($arrRequest['razonSocial']);
		$objCli->SETfactura($arrRequest['factura']);
		$objCli->SETavisosSms($arrRequest['avisosSms']);
		$objCli->grabar();
		$objResult=new \stdClass();
		$objResult->resultado=true;
		$objResult->msg="Se han actualizado correctamente sus datos";
		$_SESSION['usuario']->objEntity=$objCli;
		return $objResult;
	}
	/**
	 * [acGrabaDireccion description]
	 * @param  [type] $arrRequest [description]
	 * @return [type]             [description]
	 */
	public static function acGrabaDireccion($arrRequest){
		$db=\cDb::confByKey("celorriov3");
		$arrReturn=array();
		//si id=0 => nueva direccion
		$idDir=($arrRequest['id']>0)?$arrRequest['id']:'';
		$objDir=new \Multi_clienteDireccion($db,$idDir);
		$objDir->SETidMulti_cliente($arrRequest['idMulti_cliente']);
		$objDir->SETnombre($arrRequest['nombre']);
		$objDir->SETdestinatario($arrRequest['destinatario']);
		$objDir->SETdireccion($arrRequest['direccion']);
		$objDir->SETpoblacion($arrRequest['poblacion']);
		$objDir->SETprovincia($arrRequest['provincia']);
		$objDir->SETcp($arrRequest['cp']);
		$objDir->SETpais($arrRequest['pais']);
		$objDir->SETmovil($arrRequest['movil']);
		$objDir->grabar();
		$arrAccion=array(
			"valor" => true,
			"msg" => "Se han actualizado correctamente los datos"
		);
		$arrReturn['resultado']=$arrAccion;
		$arrDatos=array(
			"id" => $arrRequest['idMulti_cliente'],
			"nombre" => $objDir->GETnombre(),
			"destinatario" => $objDir->GETdestinatario(),
			"movil" => $objDir->GETmovil(),
			"direccion" => $objDir->GETdireccion(),
			"poblacion" => $objDir->GETpoblacion(),
			"provincia" => $objDir->GETprovincia(),
			"cp" => $objDir->GETcp(),
			"pais" => $objDir->GETpais(),
			"idDireccion" => $objDir->GETid()
		);
		$arrReturn['datos']=$arrDatos;
		return json_encode($arrReturn);
	}
	/**
	 * [acCheckCP description]
	 * @param  [type] $cp   [description]
	 * @param  [type] $pais [description]
	 * @return [type]       [description]
	 */
	public static function acCheckCP($cp,$pais){
		$db=\cDb::confByKey("celorriov3");
		$objDir=new \Multi_clienteDireccion($db);
		$objDir->SETpais($pais);
		$objDir->SETcp($cp);
		$arrReturn=array();
		if ($objDir->esCeutaMelilla() || $objDir->esCanarias()){
			$arrAccion=array(
				"valor" => false,
				"msg" => "Disculpe las molestias. No enviamos a su ciudad."
			);
		} else {
			$arrAccion=array(
				"valor" => true,
				"msg" => "CP dentro del rango de envios"
			);
		}
		$arrReturn['resultado']=$arrAccion;
		return json_encode($arrReturn);
	}
	/**
	 * [acBorraDireccion description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public static function acBorraDireccion($id){
		$db=\cDb::confByKey("celorriov3");
		$arrReturn=array();
		$objDir=new \Multi_clienteDireccion($db,$id);
		$objDir->borrar();
		$arrAccion=array(
			"resultado" => true,
			"msg" => "Se han actualizado correctamente los datos"
		);
		$arrReturn['resultado']=$arrAccion;
		return json_encode($arrReturn);
	}
	/**
	 * [acCambiaPass description]
	 * @param  [type] $arrRequest [description]
	 * @return [type]             [description]
	 */
	public static function acCambiaPass($arrRequest){
		$db=\cDb::confByKey("celorriov3");
		$arrReturn=array();
		$idUser=$arrRequest['id'];
		$objCli=new \Multi_cliente($db,$idUser);
		if ($objCli->GETemail()==$arrRequest['email']) {
			$objCli->SETpassSha256($arrRequest['pass']);
			$objCli->SETpassMd5('');
			$objCli->grabar();
			$arrAccion=array(
				"resultado" => true,
				"msg" => "Se han actualizado correctamente los datos"
			);
		} else {
			$arrAccion=array(
				"resultado" => false,
				"msg" => "Se ha producido un error al procesar la solicitud. Contacte con la tienda. Gracias."
			);
		}
		$arrReturn['resultado']=$arrAccion;
		return json_encode($arrReturn);
	}
/******************************************************************************/
/* FRAGMENTOS *****************************************************************/
	public function formularioAltaCliente() {
		require ( str_replace('//','/',dirname(__FILE__).'/') .'markup/formularioAltaCliente/markup.php');
	}
	public function formularioAltaClienteCss() {
		require_once ( str_replace('//','/',dirname(__FILE__).'/') .'markup/formularioAltaCliente/css.php');
	}
	public function formularioAltaClienteJs() {
		require_once ( str_replace('//','/',dirname(__FILE__).'/') .'markup/formularioAltaCliente/js.php');
	}
	public function formularioLoginCliente() {
		require ( str_replace('//','/',dirname(__FILE__).'/') .'markup/formularioLoginCliente/markup.php');
	}
	public function formularioLoginClienteCss() {
		require_once ( str_replace('//','/',dirname(__FILE__).'/') .'markup/formularioLoginCliente/css.php');
	}
	public function formularioLoginClienteJs() {
		require_once ( str_replace('//','/',dirname(__FILE__).'/') .'markup/formularioLoginCliente/js.php');
	}
/******************************************************************************/
}
?>