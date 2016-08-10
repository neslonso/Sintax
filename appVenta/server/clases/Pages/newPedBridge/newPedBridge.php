<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class newPedBridge extends Bridge implements IPage {
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
	public function markup() {
		//$sharedSecret="fed16newPedBridge";
		//$salt=hash('sha256', uniqid(mt_rand(), true));
		//$hash=$salt.hash('sha256',$salt.$pass);
		$hash='';

		$newPedBridgeData=json_decode(base64_decode($_REQUEST['newPedBridgeDataValue']));
		$_SESSION['newPedBridgeDataOrigData']=$newPedBridgeData;

		$subService='arrModosPago';
		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=NEW_PED_BRIDGE&subService='.$subService.'&hash='.$hash;
		$result=file_get_contents($urlAPI);
		$arrModosPago=json_decode($result);

		$subService='datosCli';
		$idCli=$newPedBridgeData->idCli;
		$store=$newPedBridgeData->store;
		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=NEW_PED_BRIDGE&subService='.$subService.'&store='.$store.'&idCli='.$idCli.'&hash='.$hash;
		$result=file_get_contents($urlAPI);
		$datosCli=json_decode($result);

		$subService='storeData';
		$urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=NEW_PED_BRIDGE&subService='.$subService.'&store='.$store.'&hash='.$hash;
		$result=file_get_contents($urlAPI);
		$storeData=json_decode($result);
		//$storeData=new \stdClass();
		//$storeData->IMPORTE_MINIMO_APLICACION_CREDITO=100;

		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}

	public function acGrabar () {
		$newPedBridgeData=$_SESSION['newPedBridgeDataOrigData'];
		echo "request: <pre>".print_r($_REQUEST,true)."</pre>";
		echo "Datos recibidos por fed16 desde store: <pre>".print_r($newPedBridgeData,true)."</pre>";

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
		echo "envioMulti: <pre>";
		var_dump($envioMulti);
		echo "</pre>";

		$result=json_decode($envioMulti);
		//$GLOBALS['acReturnURI']=$result->returnURI;
		echo "result: <pre>".print_r($result,true)."</pre>";
		echo '<a href="'.$result->returnURI.'">'.$result->returnURI.'</a>';
		die();
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
		/* Con selectList
		$result='
				<div class="btn-group selectlist" data-resize="auto" data-initialize="selectlist" id="slModosPago">
					<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">
						<span class="selected-label">&nbsp;</span>
						<span class="caret"></span>
						<span class="sr-only">Desplegar lista de modos de pago</span>
					</button>
					<ul class="dropdown-menu" role="menu">
		';
		foreach ($arrModosPago as $stdObjModoPago) {
			$notas=($stdObjModoPago->tipoDescuento!=0)?$stdObjModoPago->tipoDescuento.'% de descuento':'Sin descuento';
			$denominacion=$stdObjModoPago->nombre.' ('.$notas.')';
			$result.='<li data-value="'.$stdObjModoPago->id.'"><a href="#">'.$denominacion.'</a></li>';

		}
		$result.='
					</ul>
					<input class="hidden hidden-field" name="slModosPago" readonly="readonly" aria-hidden="true" type="text"/>
				</div>
		';
		*/
		return $result;
	}

	public function direccionEntregaSelectionControl($datosCli) {
		$arrDirsCli=$datosCli->arrDirecciones;
		$result='
				<div class="form-group">
					<label class="control-label sr-only" for="slDirEntrega">Dirección de entrega:</label>
					<div class="controls">
						<div class="btn-group selectlist" data-resize="auto" data-initialize="selectlist" id="slDirEntrega">
							<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">
								<span class="selected-label">&nbsp;</span>
								<span class="caret"></span>
								<span class="sr-only">Desplegar lista de direcciones de entrega</span>
							</button>
							<ul class="dropdown-menu" role="menu">
		';
		foreach ($arrDirsCli as $stdObjDirCli) {
			$denominacion=$stdObjDirCli->nombre.' ('.$stdObjDirCli->direccion.', '.$stdObjDirCli->cp.', '.$stdObjDirCli->poblacion.', '.$stdObjDirCli->provincia.')';
			$result.='<li
				data-id="'.$datosCli->id.'"
				data-nombre="'.$datosCli->nombre.'"
				data-apellidos="'.$datosCli->apellidos.'"
				data-telefono="'.$datosCli->telefono.'"
				data-direccion="'.$stdObjDirCli->direccion.'"
				data-cp="'.$stdObjDirCli->cp.'"
				data-poblacion="'.$stdObjDirCli->poblacion.'"
				data-provincia="'.$stdObjDirCli->provincia.'"
				data-id-direccion="'.$stdObjDirCli->id.'"><a href="#">'.$denominacion.'</a></li>';

		}
		$result.='
							</ul>
							<input class="hidden hidden-field" name="slDirEntrega" readonly="readonly" aria-hidden="true" type="text"/>
						</div>
						<p class="help-block">Seleccione la dirección en la que desea recibir su pedido</p>
					</div>
				</div>

		';
		return $result;
	}

	public function cuponSelectionControl($arrCupsCli) {
		$result='
			<div class="form-group">
				<label class="control-label" for="cuponInput"></label>
				<div class="input-group input-append dropdown combobox" data-initialize="combobox" id="cuponCombo">
					<input id="cuponInput" name="cuponInput" type="text" aria-label="" class="form-control" placeholder="cupón descuento">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary dropdown-toggle" aria-label=" autofill suggestions" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right" role="menu">
		';
		foreach ($arrCupsCli as $stdObjCupCli) {
			$denominacion=$stdObjCupCli->codigo.'. '.$stdObjCupCli->tipoDescuento.'% de descuento. Válido hasta '.\Fecha::fromMysql($stdObjCupCli->caducidad)->toFechaEs().'';
			$result.='<li
				data-id="'.$stdObjCupCli->id.'"
				data-value="'.$stdObjCupCli->codigo.'"><a href="#">'.$denominacion.'</a></li>';
		}
		$result.='
						</ul>
					</div>
				</div>
				<p class="help-block">Introduzca o seleccione el cupón que desea aplicar al pedido</p>
			</div>
		';
		return $result;
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
