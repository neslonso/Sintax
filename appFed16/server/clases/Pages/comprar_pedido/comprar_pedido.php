<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class comprar_pedido extends Home implements IPage {
	public function __construct(User $objUsr) {
		parent::__construct($objUsr);
	}
	public function pageValida () {
		return $this->objUsr->pagePermitida($this);
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
	public function cuerpo() {
		$store=$GLOBALS['config']->tienda->key;
		$objCli=$_SESSION['usuario']->objEntity;
		$objCli->SETdb(\cDb::gI());

		$arrModosPago=\Sintax\ApiService\Pedidos::getArrModosPago();
		$datosCli=\Sintax\ApiService\Pedidos::getDatosCli($objCli);
		$storeData=\Sintax\ApiService\Pedidos::getStoreData();

		$objCesta=$this->ensureCesta(\cDb::gI());
		$newPedBridgeData=new \stdClass();
		$newPedBridgeData->lineas=\Sintax\ApiService\Pedidos::arrLineasComprarPedido($objCesta);

		$idDirPredeterminada=(isset($datosCli->arrDirecciones[0]))?$datosCli->arrDirecciones[0]->id:NULL;

		$paises=\Sintax\ApiService\Pedidos::arrPaises();
		$paisDefecto=\Sintax\ApiService\Pedidos::idPaisDefecto();

		$jsonArrDtosVolumen=htmlspecialchars(json_encode($storeData->DTOS_VOLUMEN_PEDIDO),ENT_QUOTES,'UTF-8');

		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/cuerpo.php");
	}

	public function acGrabar () {
		\cDb::confByKey('celorriov3');
		$objCli=$_SESSION['usuario']->objEntity;
		$objCli->SETdb(\cDb::gI());

		$arrayMulti=$_REQUEST;
		$arrayMulti['keyTienda']=$GLOBALS['config']->tienda->key;
		$arrayMulti['pedData']['idMulti_cliente']=$objCli->GETid();
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
			//echo "result: <pre>".print_r($result,true)."</pre>";
			//eval('$objPed='."\\".$result->objPed.';');
			$idMulti_pedido=$result->stdObjPed->id;
			$returnURI=BASE_URL.'mi_pedido/'.$idMulti_pedido.'::1';
			$objCesta=$this->ensureCesta(\cDb::gI());
			$objCesta->SETidMulti_pedidoRealizado($idMulti_pedido);
			$objCesta->grabar();
			$GLOBALS['acReturnURI']=$returnURI;
			unset($_SESSION['cesta']);
		}
	}


/* Controles de wizard de pedidos *********************************************/
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
/* Peticion de datos a API ****************************************************/
	/**
	 * [acAddDireccion description]
	 * @param  array $stdObjDatosDir  array con datos de la dirección
	 * @return string                 nuevo html del selector de direcciones
	 */
	public function acAddDireccion($arrDatosDir) {
		\cDb::confByKey('celorriov3');
		$objCli=$_SESSION['usuario']->objEntity;
		$objCli->SETdb(\cDb::gI());
		$arrDatosDir['idMulti_cliente']=$objCli->GETid();

		$result=\Sintax\ApiService\Clientes::acGrabaDireccion($arrDatosDir);
		$result=json_decode($result);
		$GLOBALS['firephp']->info($result,"result acGrabaDireccion");
		if ($result->resultado->valor) {
			$datosCli=\Sintax\ApiService\Pedidos::getDatosCli($objCli);
			$result=$this->direccionEntregaSelectionControl($datosCli,$result->datos->idDireccion);
		} else {
			throw new ActionException("Error añadiendo direccion: ".$result->resultado->msg, 1);
		}
		return $result;
	}

	public function acGetPortes() {
		$arrayMulti['subService']='portes';
		$arrayMulti['keyTienda']=$GLOBALS['config']->tienda->key;
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
		\cDb::confByKey('celorriov3');
		$objCli=$_SESSION['usuario']->objEntity;
		$objCli->SETdb(\cDb::gI());
		$datosCli=\Sintax\ApiService\Pedidos::getDatosCli($objCli);
		$result=\Sintax\ApiService\Pedidos::validaCupon($_REQUEST['codigo'],$objCli->GETid());
		if ($result!==false) {
			$arrCups=$datosCli->arrCupones;
			$encontrado=false;
			foreach ($arrCups as $stdObjCupon) {
				if ($result->codigo==$stdObjCupon->codigo) {$encontrado=true;}
			}
			if (!$encontrado) {array_push($arrCups,$result);}
			$result->combo=$this->cuponSelectionControl($arrCups,$result->id);
		}
		return $result;

		/*response.data.existe
		response.data.combo
		stdObjCupCli->codigo
		stdObjCupCli->tipoDescuento
		stdObjCupCli->caducidad
		stdObjCupCli->id*/
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
