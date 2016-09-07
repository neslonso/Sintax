<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class newPedBridge extends Bridge implements IPage {
	public function __construct(User $objUsr) {
		parent::__construct($objUsr);
		if (isset($_REQUEST['newPedBridgeDataValue'])) {
			$newPedBridgeData=json_decode(base64_decode($_REQUEST['newPedBridgeDataValue']));
			$_SESSION['newPedBridgeDataOrigData']=$newPedBridgeData;
		} else {
			if (isset($_SESSION['newPedBridgeDataOrigData'])) {
				$newPedBridgeData=$_SESSION['newPedBridgeDataOrigData'];
			} else {
				throw new \Exception("No es posible procesar el pedido, datos no recibidos.", 1);
			}
		}
	}
	public function pageValida () {
		$usrClass=get_class($this->objUsr);
		if ($usrClass=="Multi_cliente") {
			$_SESSION['arrModosPago']=$this->getArrModosPago();
			$_SESSION['datosCli']=$this->getDatosCli();
			$_SESSION['storeData']=$this->getStoreData();
			return $this->objUsr->pagePermitida($this);
		} else {
			$newPedBridgeData=$_SESSION['newPedBridgeDataOrigData'];
			$loginBridgeData=new \stdClass();
			$loginBridgeData->store=$newPedBridgeData->store;
			$loginBridgeDataValue=base64_encode(json_encode($loginBridgeData));
			$_REQUEST['loginBridgeData']=$loginBridgeDataValue;
			ReturnInfo::add('Es necesario que se identifique como cliente para poder realizar pedidos','Disculpe, no se encuentra identificado');
			return "\\Sintax\\Pages\\loginBridge";
		}
	}
	public function accionValida($metodo) {
		return $this->objUsr->accionPermitida($this,$metodo);
	}
	public function title() {
		return parent::title();
	}
	public function metaTags() {
		return parent::metaTags();
	}
	public function head() {
		parent::head();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/head.php");
	}
	public function js() {
		parent::js();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js.php");
	}
	public function css() {
		parent::css();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css.php");
	}
	public function markup() {
		$newPedBridgeData=$_SESSION['newPedBridgeDataOrigData'];
		$GLOBALS['firephp']->info($newPedBridgeData,"newPedBridgeData");

		$newPedBridgeData=$_SESSION['newPedBridgeDataOrigData'];
		if (!is_array($newPedBridgeData->lineas) || count($newPedBridgeData->lineas)==0) {
			echo '<script type="text/javascript">msgRedirect();</script>';
		}

		$arrModosPago=$_SESSION['arrModosPago'];
		$GLOBALS['firephp']->info($arrModosPago,"arrModosPago");
		$datosCli=$_SESSION['datosCli'];
		$GLOBALS['firephp']->info($datosCli,"datosCli");
		$storeData=$_SESSION['storeData'];
		$GLOBALS['firephp']->info($storeData,"storeData");

		$store=$newPedBridgeData->store;
		$idDirPredeterminada=(isset($datosCli->arrDirecciones[0]))?$datosCli->arrDirecciones[0]->id:NULL;

		$url='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_CLI&cliService=paises';
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST'
		    ),
		);
		$context  = stream_context_create($options);
		$responseApi = file_get_contents($url, false, $context);
		$arrPaises=json_decode($responseApi);

		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}

	public function acGrabar () {
		$newPedBridgeData=$_SESSION['newPedBridgeDataOrigData'];

		//echo "request: <pre>".print_r($_REQUEST,true)."</pre>";
		//echo "Datos recibidos por fed16 desde store: <pre>".print_r($newPedBridgeData,true)."</pre>";

		//POST a la API de V3 para añadir el pedido a la multi
		$arrayMulti=$_REQUEST;
		$arrayMulti['keyTienda']=$newPedBridgeData->store;
		$url='http://farmaciacelorrio.com/api.php?APP=appMulti&service=NEW_PED_BRIDGE&&subService=newPed';
		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($arrayMulti),
		    ),
		);
		$context  = stream_context_create($options);
		$envioMulti = file_get_contents($url, false, $context);
		//echo "envioMulti: <pre>";
		//var_dump($envioMulti);
		//echo "</pre>";

		$result=json_decode($envioMulti);
		if (isset($result->exception)) {
			/*
			$errorUri=BASE_URL."/Error";
			$GLOBALS['acReturnURI']=$errorUri;
			ReturnInfo::add($result->infoExc,'Error durante la realización del pedido.');
			echo '<a href="'.$errorUri.'">'.$errorUri.'</a>';
			die();
			*/
			throw new \ActionException($result->infoExc, 1);
		} else {
			//Falta vaciar la cesta
			echo '
				<script>
					var objMsg= {
						service: "redirect",
						parameters: "url",
						parametersII: "'.$result->returnURI.'"
					}
					parent.postMessage(objMsg, "*");
				</script>
				Redirigiendo...
			';
			die();
			$GLOBALS['acReturnURI']=$result->returnURI;
			echo "result: <pre>".print_r($result,true)."</pre>";
			echo '<hr /><a href="'.$result->returnURI.'">'.$result->returnURI.'</a><hr />';
		}
	}

	public function modoPagoSelectionControl($arrModosPago) {
		$result='
				<div class="form-group">
					<label for="radios" class="control-label sr-only">Modo de pago:</label>
					<div class=" required">
		';
		$i=0;
		foreach ($arrModosPago as $stdObjModoPago) {
			$notas=($stdObjModoPago->tipoDescuento!=0)?$stdObjModoPago->tipoDescuento.'% de descuento':'Sin descuento';
			$denominacion=$stdObjModoPago->nombre.' ('.$notas.')';
			$checked=($i==0)?'checked="checked"':'';
			$result.='
						<div class="radio">
							<label class="radio-custom" data-initialize="radio" id="modoPago-'.$i.'">
								<input class="sr-only" '.$checked.' name="modoPago" type="radio" value="'.$stdObjModoPago->id.'"
									data-tipo-descuento="'.$stdObjModoPago->tipoDescuento.'">
								<span class="radio-label">'.$denominacion.'</span>
							</label>
						</div>
			';
			$i++;
		}
		$result.='
						<p class="help-block">Seleccione el modo de pago de su pedido</p>
					</div>
				</div>
		';
		return $result;
	}

	public function direccionEntregaSelectionControl($datosCli,$checkedId=NULL) {
		$arrDirsCli=$datosCli->arrDirecciones;
		$result='
		<div id="direccionEntregaSelectionControl">
			<div class="row">
		';
		$i=1;
		foreach ($arrDirsCli as $stdObjDirCli) {
			$checked=($checkedId==$stdObjDirCli->id)?'checked="checked"':'';
			$labelClass=($checked)?'checked':'';
			$panelClass=($checked)?'panel-success':'panel-default';
			$result.='
				<div class="col-md-4">
					<div class="panel '.$panelClass.'">
						<div class="panel-heading">
							<div class="form-group" style="margin:0px;">
								<label for="radios" class="control-label sr-only">'.$stdObjDirCli->nombre.'</label>
								<div class="radio" style="margin:0px;">
									<label class="radio-custom '.$labelClass.'" data-initialize="radio" id="dirEntrega-'.$stdObjDirCli->id.'">
										<input class="sr-only" name="idDirEntrega" type="radio" value="'.$stdObjDirCli->id.'" '.$checked.'
											data-id="'.$stdObjDirCli->id.'"
											data-destinatario="'.$stdObjDirCli->destinatario.'"
											data-direccion="'.$stdObjDirCli->direccion.'"
											data-poblacion="'.$stdObjDirCli->poblacion.'"
											data-provincia="'.$stdObjDirCli->provincia.'"
											data-cp="'.$stdObjDirCli->cp.'"
											data-pais="'.$stdObjDirCli->pais.'"
											data-movil="'.$stdObjDirCli->movil.'">
										<span class="radio-label">'.$stdObjDirCli->nombre.'</span>
									</label>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<div>'.$stdObjDirCli->destinatario.' ('.$stdObjDirCli->movil.')</div>
							<div>'.$stdObjDirCli->direccion.'</div>
							<div>'.$stdObjDirCli->cp.' '.$stdObjDirCli->poblacion.'</div>
							<div class="text-right">'.$stdObjDirCli->provincia.'</div>
							<div class="text-right">'.$stdObjDirCli->pais.'</div>
						</div>
					</div>
				</div>
			';
			if($i%3==0){$result.='<div class="clearfix"></div>';}
			$i++;
		}
		$result.='
			</div>
			<div class="row">
				<div class="col-md-12">
		';
		if (count($arrDirsCli)==0) {
			$result.='<p class="help-block">No figura ninguna dirección de entrega en sus datos de cliente, debe añadir una para poder realizar su pedido</p>';
		} else {
			$result.='<p class="help-block">Seleccione la dirección en la que desea recibir su pedido</p>';
		}
		$result.='
				</div>
			</div>
		</div>
		';
		return $result;
	}

	public function cuponSelectionControl($arrCups,$seletedId="") {
		$result='
			<div id="cuponSelectionControl">
				<div class="form-group">
					<label class="control-label" for="cuponInput"></label>
					<div class="input-group input-append dropdown combobox" data-initialize="combobox" id="cuponCombo">
						<input id="cuponInput" name="cuponInput" type="text" aria-label="" class="form-control" placeholder="cupón descuento">
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary dropdown-toggle" aria-label=" autofill suggestions" data-toggle="dropdown"><span class="caret"></span></button>
							<ul class="dropdown-menu dropdown-menu-right" role="menu">
		';
		foreach ($arrCups as $stdObjCupCli) {
			$selected=($stdObjCupCli->id==$seletedId)?'data-selected="true"':'';
			$denominacion=$stdObjCupCli->codigo.'. '.$stdObjCupCli->tipoDescuento.'% de descuento. Válido hasta '.\Fecha::fromMysql($stdObjCupCli->caducidad)->toFechaEs().'';
			$result.='
								<li '.$selected.'
									data-id="'.$stdObjCupCli->id.'"
									data-value="'.$stdObjCupCli->codigo.'"><a href="#">'.$denominacion.'</a></li>';
		}
		$result.='
							</ul>
						</div>
					</div>
					<p class="help-block">Introduzca o seleccione el cupón que desea aplicar al pedido</p>
				</div>
			</div>
		';
		return $result;
	}

	public function acAddDireccion() {
		$newPedBridgeData=$_SESSION['newPedBridgeDataOrigData'];
		//POST a la API de V3 para añadir el pedido a la multi
		$arrayMulti=$_REQUEST;
		$arrayMulti['keyTienda']=$newPedBridgeData->store;
		$arrayMulti['idMulti_cliente']=$_SESSION['usuario']->id;
		$url='http://farmaciacelorrio.com/api.php?APP=appMulti&service=MULTI_CLI&&cliService=cliEditDir';
		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($arrayMulti),
		    ),
		);
		$context  = stream_context_create($options);
		$envioMulti = file_get_contents($url, false, $context);
		/*echo "envioMulti: <pre>";
		var_dump($envioMulti);
		echo "</pre>";*/

		$result=json_decode($envioMulti);
		$GLOBALS['firephp']->info($result,"result acAddDireccion");
		if ($result->resultado->valor) {
			$_SESSION['datosCli']=$this->getDatosCli();
			$result=$this->direccionEntregaSelectionControl($_SESSION['datosCli'],$result->datos->idDireccion);
		} else {
			throw new ActionException("Error añadiendo direccion: ".$result->resultado->msg, 1);
		}
		return $result;
	}

	public function acGetPortes() {
		$newPedBridgeData=$_SESSION['newPedBridgeDataOrigData'];
		$arrayMulti['subService']='portes';
		$arrayMulti['keyTienda']=$newPedBridgeData->store;
		$arrayMulti['hash']='';
		$arrayMulti['importe']=$_REQUEST['importe'];
		$arrayMulti['idDireccion']=$_REQUEST['idDireccion'];
		//$arrayMulti['idMulti_cliente']=$_SESSION['usuario']->id;
		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=NEW_PED_BRIDGE';
		// use key 'http' even if you send the request to https://...
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($arrayMulti),
			),
		);
		$context  = stream_context_create($options);
		$apiResult = file_get_contents($urlAPI, false, $context);
		$GLOBALS['firephp']->info($apiResult,"result acGetPortes");
		$result=json_decode($apiResult);
		return $result;
	}

	public function acValidaCupon() {
		$newPedBridgeData=$_SESSION['newPedBridgeDataOrigData'];
		$datosCli=$_SESSION['datosCli'];
		$arrayMulti['subService']='getCuponByCode';
		$arrayMulti['store']=$newPedBridgeData->store;
		//$sharedSecret="fed16newPedBridge";
		//$salt=hash('sha256', uniqid(mt_rand(), true));
		//$hash=$salt.hash('sha256',$salt.$pass);
		$arrayMulti['hash']='';
		$arrayMulti['cuponCode']=$_REQUEST['codigo'];

		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=NEW_PED_BRIDGE';

		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($arrayMulti),
			),
		);
		$context  = stream_context_create($options);
		$apiResult = file_get_contents($urlAPI, false, $context);
		$GLOBALS['firephp']->info($apiResult,"result acValidaCupon");
		$result=json_decode($apiResult);
		$arrCups=$datosCli->arrCupones;
		array_push($arrCups,$result);
		$result->combo=$this->cuponSelectionControl($arrCups,$result->id);
		return $result;

		/*response.data.existe
		response.data.combo
		stdObjCupCli->codigo
		stdObjCupCli->tipoDescuento
		stdObjCupCli->caducidad
		stdObjCupCli->id*/
	}
/* Peticion de datos a API ****************************************************/
	private function getArrModosPago() {
		//$sharedSecret="fed16newPedBridge";
		//$salt=hash('sha256', uniqid(mt_rand(), true));
		//$hash=$salt.hash('sha256',$salt.$pass);
		$hash='';

		$subService='arrModosPago';
		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=NEW_PED_BRIDGE&subService='.$subService.'&hash='.$hash;
		$result=file_get_contents($urlAPI);
		$arrModosPago=json_decode($result);
		return $arrModosPago;
	}
	private function getDatosCli() {
		//$sharedSecret="fed16newPedBridge";
		//$salt=hash('sha256', uniqid(mt_rand(), true));
		//$hash=$salt.hash('sha256',$salt.$pass);
		$hash='';

		$subService='datosCli';
		$idCli=$this->objUsr->id;
		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=NEW_PED_BRIDGE&subService='.$subService.'&store=&idCli='.$idCli.'&hash='.$hash;
		$result=file_get_contents($urlAPI);
		$datosCli=json_decode($result);
		return $datosCli;
	}
	private function getStoreData() {
		//$sharedSecret="fed16newPedBridge";
		//$salt=hash('sha256', uniqid(mt_rand(), true));
		//$hash=$salt.hash('sha256',$salt.$pass);
		$hash='';
		$newPedBridgeData=$_SESSION['newPedBridgeDataOrigData'];

		$subService='storeData';
		$store=$newPedBridgeData->store;
		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=NEW_PED_BRIDGE&subService='.$subService.'&store='.$store.'&hash='.$hash;
		$result=file_get_contents($urlAPI);
		$storeData=json_decode($result);
		return $storeData;
	}
/* Calculos sobre líneas ******************************************************/
	private function pvp ($stdObjLinea) {
		return round($stdObjLinea->pai*(1+$stdObjLinea->tipoIva/100),2);
	}

	private function totalDtoTipo ($stdObjLinea) {
		$totalTipoDtoLinea=0;
		foreach ($stdObjLinea->dtos as $stdObjDto) {
			$totalTipoDtoLinea+=$stdObjDto->tipoDescuento;
		}
		return $totalTipoDtoLinea;
	}

	private function totalDtoImporte ($stdObjLinea) {
		$totalImporteDtoLinea=0;
		foreach ($stdObjLinea->dtos as $stdObjDto) {
			$totalImporteDtoLinea+=$stdObjDto->importe;
		}
		return $totalImporteDtoLinea;
	}

	private function totalLinea ($stdObjLinea) {
		return round(
			$this->pvp($stdObjLinea)*
				$stdObjLinea->cantidad*
					(1-$this->totalDtoTipo($stdObjLinea)/100)-
						$this->totalDtoImporte($stdObjLinea),2);
	}

	private function totalLineas ($arrStdObjLinea) {
		$total=0;
		foreach ($arrStdObjLinea as $stdObjLinea) {
			$total+=$this->totalLinea($stdObjLinea);
		}
		return $total;
	}
/******************************************************************************/

}
?>
