<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;
class landingOferta extends Error implements IPage {
	public function __construct(User $objUsr) {
		parent::__construct($objUsr);
	}
	public function pageValida () {
		//return $this->objUsr->pagePermitida($this);
		return true;
	}
	public function accionValida($metodo) {
		return $this->objUsr->accionPermitida($this,$metodo);
	}
	public function title() {
		$title="";
		$idOfer = isset($_REQUEST['id']) ? $_REQUEST['id'] : '' ;
		if(\Multi_ofertaVenta::existe (\cDb::confByKey('celorriov3'),$idOfer)){
			$objOferta=new \Multi_ofertaVenta(\cDb::confByKey('celorriov3'),$idOfer);
			$title=str_replace("%NOMBRE%", $objOferta->GETnombre(), $objOferta->GETtitle());
			$title=str_replace("%PRECIO%", $objOferta->pvp(), $title);
		}
		$title.=' &bull; '.$GLOBALS['config']->tienda->SITE_NAME;
		return $title;
	}
	public function metaTags() {
		$metaTags="";
		$idOfer = isset($_REQUEST['id']) ? $_REQUEST['id'] : '' ;
		if(\Multi_ofertaVenta::existe (\cDb::confByKey('celorriov3'),$idOfer)){
			$objOferta=new \Multi_ofertaVenta(\cDb::confByKey('celorriov3'),$idOfer);
			$metaTags .= '<meta name="description" content="'.$objOferta->GETmetaDescription().'">';
			$metaTags .= '<meta name="title" content="'.$objOferta->GETtitle().'">';
			$metaTags .= '<meta name="keywords" content="'.$objOferta->GETmetaKeywords().'">';
		}
		return $metaTags;
	}
	public function head() {
		parent::head();
		$db=\cDb::confByKey('celorriov3');
		$idOfer = isset($_REQUEST['id']) ? $_REQUEST['id'] : '' ;
		$objOferta=new \Multi_ofertaVenta($db,$idOfer);
		if (isset($_REQUEST['c'])){
			$this->acLogin("","","",$_REQUEST['c']);
		}
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/head.php");
	}
	public function js() {
		parent::js();
		if (isset($_SESSION['usuario'])){
			\Sintax\ApiService\Pedidos::detallePedidoJs("landingOferta","callbackLandingOferta");
		}
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js.php");
	}
	public function css() {
		parent::css();
		\Sintax\ApiService\Productos::fichaProductoDtoCss();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css.php");
	}
	public function markup() {
		$db=\cDb::confByKey('celorriov3');
		$idOfer = isset($_REQUEST['id']) ? $_REQUEST['id'] : '' ;
		$objOferta=new \Multi_ofertaVenta($db,$idOfer);
		$logueado=false;
		if (isset($_SESSION['usuario'])){
			if ($idOfer!="" && !$this->existeEnCesta($idOfer)){
				if ($objOferta->vendible()){
					$this->acAddToCesta($idOfer);
				}
			}
			$logueado=true;
			$store=$GLOBALS['config']->tienda->key;
			$objCli=$_SESSION['usuario']->objEntity;
			$objCli->SETdb(\cDb::gI());
			$arrModosPago=\Sintax\ApiService\Pedidos::getArrModosPago();
			$datosCli=\Sintax\ApiService\Pedidos::getDatosCli($objCli);
			$storeData=\Sintax\ApiService\Pedidos::getStoreData();
			$idDirPredeterminada=(isset($datosCli->arrDirecciones[0]))?$datosCli->arrDirecciones[0]->id:NULL;
			$paises=\Sintax\ApiService\Pedidos::arrPaises();
			$paisDefecto=\Sintax\ApiService\Pedidos::idPaisDefecto();
			$jsonArrDtosVolumen=htmlspecialchars(json_encode($storeData->DTOS_VOLUMEN_PEDIDO),ENT_QUOTES,'UTF-8');
			$jsonArrModosPago=htmlspecialchars(json_encode(\Sintax\ApiService\Pedidos::getArrModosPago()),ENT_QUOTES,'UTF-8');
			$idTipoModoPago=\Multi_pedidoModoPago::idModoPagoTipo('tarjeta');

			$jsonArrCupones="";
			$cupones=$objCli->arrMulti_cupon("caducidad>".date("YmdHis"),"tipoDescuento DESC, caducidad ASC","1");
			foreach ($cupones as $stdObjCupon) {
				$validaCupon=\Sintax\ApiService\Pedidos::validaCupon($stdObjCupon->codigo,$objCli->GETid());
				if ($validaCupon==false){
					$jsonArrCupones="";
				} else {
					$jsonArrCupones=htmlspecialchars(json_encode($stdObjCupon),ENT_QUOTES,'UTF-8');
					break;
				}
			}

		}
		$activarTW=($GLOBALS['config']->tienda->SOCIAL->TW->CONSUMER_KEY!="")?true:false;
		$activarFB=($GLOBALS['config']->tienda->SOCIAL->FB->APP_ID!="")?true:false;
		$linkTiendaTW=($GLOBALS['config']->tienda->SOCIAL->TW->URL!="")?true:false;
		$linkTiendaFB=($GLOBALS['config']->tienda->SOCIAL->FB->URL!="")?true:false;
		$storeData=\Sintax\ApiService\Pedidos::getStoreData();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}

	/* Calculos sobre líneas y portes**********************************************/
	public function acGetLineas() {
		return \Sintax\ApiService\Pedidos::acGetLineas();
	}
	public function acGetPortes() {
		return \Sintax\ApiService\Pedidos::acGetPortes();
	}
	/******************************************************************************/

	public function acGrabar () {
		\cDb::confByKey('celorriov3');
		$objCli=$_SESSION['usuario']->objEntity;
		$objCli->SETdb(\cDb::gI());

		$arrayMulti=$_REQUEST;
		$arrayMulti['keyTienda']=$GLOBALS['config']->tienda->key;
		$arrayMulti['pedData']['idMulti_cliente']=$objCli->GETid();
		$url='http://multi.farmaciacelorrio.com/api.php?APP=appMulti&service=NEW_PED_BRIDGE&&subService=newPed';
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
			throw new \ActionException($result->infoExc, 1);
		} else {
			//echo "result: <pre>".print_r($result,true)."</pre>";
			//eval('$objPed='."\\".$result->objPed.';');
			$idMulti_pedido=$result->stdObjPed->id;
			unset($_SESSION['cesta']);
			return $idMulti_pedido;
		}
	}

	public function acAddToCestaOferta () {
		$arrayMulti=$_REQUEST;
		$idOfer=$arrayMulti['idOfer'];
		if ($idOfer!="" && !$this->existeEnCesta($idOfer)){
			$this->acAddToCesta($idOfer);
		}
		return true;
	}

	public function acGetFormTpvv () {
		\cDb::confByKey('celorriov3');
		$objCli=$_SESSION['usuario']->objEntity;
		$objCli->SETdb(\cDb::gI());
		$arrayMulti=$_REQUEST;
		$url='http://multi.farmaciacelorrio.com/api.php?APP=appMulti&service=NEW_PED_BRIDGE&&subService=formTpvv';
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
			//$idMulti_pedido=$result->stdObjPed->id;
			//unset($_SESSION['cesta']);
			return $result;
		}
	}
	public function acValidaCupon() {
		\cDb::confByKey('celorriov3');
		$objCli=$_SESSION['usuario']->objEntity;
		$objCli->SETdb(\cDb::gI());
		$datosCli=\Sintax\ApiService\Pedidos::getDatosCli($objCli);
		$result=\Sintax\ApiService\Pedidos::validaCupon($_REQUEST['codigo'],$objCli->GETid());
		return $result;
	}
}
?>
