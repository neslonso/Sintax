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
	public static function getStoreData($keyTienda=NULL) {
		//$sharedSecret="fed16newPedBridge";
		//$salt=hash('sha256', uniqid(mt_rand(), true));
		//$hash=$salt.hash('sha256',$salt.$pass);
		$hash='';

		$subService='storeData';
		$store=(!is_null($keyTienda))?$keyTienda:$GLOBALS['config']->tienda->key;
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
}
?>