<?
namespace Sintax\ApiService;
use Sintax\Core\IApiService;
use Sintax\Core\ApiService;
use Sintax\Core\User;

class Pedidos extends ApiService implements IApiService {

	public function __construct (User $objUsr=NULL) {
		parent::__construct($objUsr);
	}

	public static function getArrModosPago() {
		return \Multi_pedidoModoPago::getArray(\cDb::gI(),"","orden ASC");
	}
	public static function getDatosCli($objMCli) {
		$stdObjDatosCli=new \stdClass();
		$stdObjDatosCli->id=$objMCli->GETid();
		$stdObjDatosCli->nombre=$objMCli->GETnombre();
		$stdObjDatosCli->apellidos=$objMCli->GETapellidos();
		$stdObjDatosCli->telefono=$objMCli->GETmovil();

		$stdObjDatosCli->email=$objMCli->GETemail();

		$stdObjDatosCli->tipoDescuento=$objMCli->GETtipoDescuento();
		$stdObjDatosCli->saldoCredito=$objMCli->saldoCredito();
		$stdObjDatosCli->keyTienda=$objMCli->GETkeyTienda();
		$stdObjDatosCli->idEnOrigen=$objMCli->GETidEnOrigen();

		$stdObjDatosCli->arrDirecciones=$objMCli->arrMulti_clienteDireccion();
		$stdObjDatosCli->arrCupones=$objMCli->arrMulti_cupon("caducidad>".date("YmdHis"));
		return $stdObjDatosCli;
	}
	public static function getStoreData() {
		//$sharedSecret="fed16newPedBridge";
		//$salt=hash('sha256', uniqid(mt_rand(), true));
		//$hash=$salt.hash('sha256',$salt.$pass);
		$hash='';

		$subService='storeData';
		$store=$GLOBALS['config']->tienda->key;
		$urlAPI='http://multi.farmaciacelorrio.com/api.php?APP=appMulti&service=NEW_PED_BRIDGE&subService='.$subService.'&store='.$store.'&hash='.$hash;
		$result=file_get_contents($urlAPI);
		$storeData=json_decode($result);
		return $storeData;
	}

	public static function arrLineasComprarPedido($objCesta) {
		$arr=array();
		$arrLineas=$objCesta->arrMulti_cestaLinea("","","","arrClassObjs");
		foreach ($arrLineas as $objLinea) {
			$objOferta=$objLinea->objMulti_ofertaVenta();

			$std=new \stdClass();
			$std->referencia=$objOferta->GETreferencia();
			$std->concepto=$objOferta->GETnombre();
			$std->pai=$objOferta->pai();
			$std->tipoIva=$objOferta->tipoIva();
			$std->cantidad=$objLinea->GETcantidad();
			//$std->tipoDevolucionCredito=0;
			$std->tipoDevolucionCredito=$objOferta->GETtipoDevolucionCredito();

			$arrDtosLineas=array();
			$arrProdsEnOferta=$objOferta->arrMulti_producto("","","","arrClassObjs");
			foreach ($arrProdsEnOferta as $objProd) {
				$tipoDescuentoGama=$objProd->tipoDescuentoGama($GLOBALS['config']->tienda->key);
				if ($tipoDescuentoGama>0) {
					$stdObjDto=new \stdClass();
					$stdObjDto->importe=NULL;
					$stdObjDto->tipoDescuento=$tipoDescuentoGama;
					$stdObjDto->concepto='Descuento gama: '.$objProd->objMulti_productoGama()->GETnombre();
					array_push($arrDtosLineas,$stdObjDto);
					unset ($stdObjDto);
				}
			}
			/* Sistema de promociones
			$arrDtosLineas=array();
			foreach ($objOferta->arrPromociones() as $objPromocion) {
				if ($objPromocion->esDtoLinea()) {
					$stdObjDto=new stdClass();
					$stdObjDto->importe=NULL;
					$stdObjDto->tipoDescuento=0;
					$totalTipoDtos+=$stdObjDto->tipoDescuento;
					$stdObjDto->concepto='Descuento gama: '.$gama;
					array_push($arrDtosLineas,$stdObjDto);
					unset ($stdObjDto);
				}
				if ($objPromocion->esCreditoLinea()) {

				}
			}
			*/
			$std->dtos=$arrDtosLineas;
			array_push($arr, $std);
		}
		return $arr;
	}

	public static function arrPaises() {
		return \Multi_pais::getArray(\cdb::gI());
	}
	public static function idPaisDefecto() {
		return 199;
	}

	public static function validaCupon($cuponCode,$idMulti_cliente) {
		$objCupon=\Multi_cupon::cargarPorCodigo(\cDb::gI(),$cuponCode);
		if ($objCupon && $objCupon->objMulti_cliente()->GETkeyTienda()==$GLOBALS['config']->tienda->key) {
			$stdObjCupon=new \stdClass();
			$stdObjCupon->id=$objCupon->GETid();
			$stdObjCupon->codigo=$objCupon->GETcodigo();
			$stdObjCupon->tipoDescuento=$objCupon->GETtipoDescuento();
			$stdObjCupon->caducidad=$objCupon->GETcaducidad();
			$stdObjCupon->caducado=$objCupon->caducado();
			//comprobamos si ya ha sido usado
			if($objCupon->yaUtilizadoPor($idMulti_cliente)){
				$stdObjCupon->utilizado=true;
			} else {
				$stdObjCupon->utilizado=false;
			}
			/*
			if (count($objCupon->arrIdsProdsAplicable())>0) {
				$stdObjCupon->restringido=true;
			} else {
				$stdObjCupon->restringido=false;
			}
			*/
			$result=$stdObjCupon;
		} else {
			$result=false;
		}
		return $result;
	}

/* Calculos sobre líneas y portes ******************************************************/
	public function acGetLineas() {
		\cDb::confByKey('celorriov3');
		$objCli=$_SESSION['usuario']->objEntity;
		$objCli->SETdb(\cDb::gI());
		$datosCli=\Sintax\ApiService\Pedidos::getDatosCli($objCli);
		$objCesta=$this->ensureCesta(\cDb::gI());
		$arrLineas=\Sintax\ApiService\Pedidos::arrLineasComprarPedido($objCesta);

		$arrLineasProcesado=array();
		$totalRebotes=0;
		$totalRebotesDesc='<table>';
		foreach ($arrLineas as $stdObjLinea) {
			$stdObjLinea->pvp=round($stdObjLinea->pai*(1+$stdObjLinea->tipoIva/100),2);
			$stdObjLinea->totalLinea=\Sintax\ApiService\Pedidos::totalLinea($stdObjLinea);

			$stdObjLinea->dtoTooltip='';
			$totalTipoDtoLinea=\Sintax\ApiService\Pedidos::totalDtoTipo($stdObjLinea);
			$totalImporteDtoLinea=\Sintax\ApiService\Pedidos::totalDtoImporte($stdObjLinea);
			foreach ($stdObjLinea->dtos as $stdObjDto) {
				$stdObjLinea->dtoTooltip.='<li>'.$stdObjDto->concepto.'</li>';
			}
			$dtoDesc='';
			if ($totalTipoDtoLinea>0) {$dtoDesc.=$totalTipoDtoLinea.'%';}
			if ($totalTipoDtoLinea>0 && $totalImporteDtoLinea>0) {$dtoDesc.=' + ';}
			if ($totalImporteDtoLinea>0) {$dtoDesc.=$totalImporteDtoLinea.'€';}
			if ($dtoDesc=='') {$dtoDesc='--';}
			$stdObjLinea->dtoDesc=$dtoDesc;

			if ($stdObjLinea->tipoDevolucionCredito>0) {
				$totalLinea=\Sintax\ApiService\Pedidos::totalLinea($stdObjLinea);
				$totalRebote=round(($stdObjLinea->tipoDevolucionCredito/100)*$totalLinea,2);
				$totalRebotes+=$totalRebote;
				$totalRebotesDesc.='<tr><td>'.$stdObjLinea->concepto.'</td><td>'.$totalLinea.'€ x'.$stdObjLinea->tipoDevolucionCredito.'%</td><td>=</td><td>'.$totalRebote.'€</td></tr>';
			}
			$stdObjLinea->precioLineaTooltip='';
			if (in_array($_SERVER['REMOTE_ADDR'],unserialize(IPS_DEV))) {
				$stdObjLinea->precioLineaTooltip='data-toggle="tooltip" data-placement="left" data-html="true" title="Este tooltip sale porque IP está en IPS_DEV<br />'.$stdObjLinea->pai.'€ + '.$stdObjLinea->tipoIva.'% IVA"';
			}

			array_push($arrLineasProcesado, $stdObjLinea);
		}
		$totalRebotesDesc.='</table>';
		//$totalRebotesDesc=htmlspecialchars($totalRebotesDesc,ENT_QUOTES,'UTF-8');

		$totalLineas=\Sintax\ApiService\Pedidos::totalLineas($arrLineas);
		$storeData=\Sintax\ApiService\Pedidos::getStoreData();
		if (\Sintax\ApiService\Pedidos::totalLineas($arrLineas) >= $storeData->IMPORTE_MINIMO_APLICACION_CREDITO) {
			$creditoMaximoAplicable=
				(\Sintax\ApiService\Pedidos::totalLineas($arrLineas)>$datosCli->saldoCredito)
				?$datosCli->saldoCredito
				:\Sintax\ApiService\Pedidos::totalLineas($arrLineas);
		} else {
			$creditoMaximoAplicable=0;
		}

		$result=array();
		$result['arrLineas']=$arrLineasProcesado;
		$result['totalLineas']=$totalLineas;
		$result['totalRebotes']=$totalRebotes;
		$result['totalRebotesDesc']=$totalRebotesDesc;
		$result['creditoMaximoAplicable']=$creditoMaximoAplicable;

		return $result;

		/*
		foreach ($arrLineas as $stdObjLinea) {
		}
		*/

	}

	public function acGetPortes() {
		$arrayMulti['subService']='portes';
		$arrayMulti['keyTienda']=$GLOBALS['config']->tienda->key;
		$arrayMulti['hash']='';
		$arrayMulti['importe']=$_REQUEST['importe'];
		$arrayMulti['idDireccion']=$_REQUEST['idDireccion'];
		//$arrayMulti['idMulti_cliente']=$_SESSION['usuario']->id;
		$urlAPI='http://multi.farmaciacelorrio.com/api.php?APP=appMulti&service=NEW_PED_BRIDGE';
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
			\Sintax\ApiService\Pedidos::pvp($stdObjLinea)*
				$stdObjLinea->cantidad*
					(1-\Sintax\ApiService\Pedidos::totalDtoTipo($stdObjLinea)/100)-
						\Sintax\ApiService\Pedidos::totalDtoImporte($stdObjLinea),2);
	}

	public function totalLineas ($arrStdObjLinea) {
		$total=0;
		foreach ($arrStdObjLinea as $stdObjLinea) {
			$total+=\Sintax\ApiService\Pedidos::totalLinea($stdObjLinea);
		}
		return $total;
	}
/******************************************************************************/


/******************************************************************************/
/* FRAGMENTOS *****************************************************************/
	public function detallePedido() {
		require ( str_replace('//','/',dirname(__FILE__).'/') .'markup/detallePedido/markup.php');
	}
	public function detallePedidoJs($page,$callbackPage="") {
		if ($callbackPage!=""){$callbackPage=$callbackPage."();";}
		require ( str_replace('//','/',dirname(__FILE__).'/') .'markup/detallePedido/js.php');
	}
/******************************************************************************/

}
?>