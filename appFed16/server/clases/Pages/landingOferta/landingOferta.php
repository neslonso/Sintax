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
				$this->acAddToCesta($idOfer);
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
			$jsonArrCupones=htmlspecialchars(json_encode($objCli->arrMulti_cupon("caducidad>".date("YmdHis"),"tipoDescuento DESC, caducidad ASC","1")),ENT_QUOTES,'UTF-8');
		}
		$activarTW=($GLOBALS['config']->tienda->SOCIAL->TW->CONSUMER_KEY!="")?true:false;
		$activarFB=($GLOBALS['config']->tienda->SOCIAL->FB->APP_ID!="")?true:false;
		$linkTiendaTW=($GLOBALS['config']->tienda->SOCIAL->TW->URL!="")?true:false;
		$linkTiendaFB=($GLOBALS['config']->tienda->SOCIAL->FB->URL!="")?true:false;
		$storeData=\Sintax\ApiService\Pedidos::getStoreData();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
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
			$result.='<hr><p class="help-block">No figura ninguna dirección de entrega en sus datos de cliente, debe añadir una para poder realizar su pedido:</p>';
		} else {
			$result.='<hr><p class="help-block">Añada una nueva dirección a su pedido:</p>';
		}
		$result.='
				</div>
			</div>
		</div>
		';
		return $result;
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
}
?>
