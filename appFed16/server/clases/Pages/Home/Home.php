<?
namespace Sintax\Pages;
use Sintax\Core\IPage;
use Sintax\Core\User;
use Sintax\Core\ReturnInfo;

use \Abraham\TwitterOAuth\TwitterOAuth;

class Home extends Error implements IPage {
	public function __construct(User $objUsr) {
		parent::__construct($objUsr);
		//procesamientos de fragmentos de tienda
		if (isset($GLOBALS['config']->tienda->TEMA->FRAGMENTOS) && is_array($GLOBALS['config']->tienda->TEMA->FRAGMENTOS)) {
			foreach ($GLOBALS['config']->tienda->TEMA->FRAGMENTOS as $keyFragmento => $objData) {
				if (method_exists($this,$objData->hueco) && class_exists($objData->class)) {
					$obj=new $objData->class($this);
					$func=$objData->hueco;
					$this->$func($obj);
				}
			}
		}
	}
	private function hueco1 ($objData=null) {
		static $objHuecoData=null;
		if (is_null($objHuecoData)) {
			$objHuecoData=new \stdClass();
			$objHuecoData->markup='';
			$objHuecoData->style='';
			$objHuecoData->code='';
		}

		if (!is_null($objData)) {
			$objHuecoData->markup=$objData->markup();
			$objHuecoData->style=$objData->style();
			$objHuecoData->code=$objData->code();
		}
		return $objHuecoData;
	}
	public function pageValida () {
		//return $this->objUsr->pagePermitida($this);
		return true;
	}
	public function accionValida($metodo) {
		return $this->objUsr->accionPermitida($this,$metodo);
	}
	public function title() {
		//return parent::title();
		return $GLOBALS['config']->tienda->BIENVENIDA;
	}
	public function metaTags() {
		$sitename=$GLOBALS['config']->tienda->SITE_NAME;
		$metaTags= parent::metaTags();
		/*$idProd = isset($_REQUEST['idProd']) ? $_REQUEST['idProd'] : '23137' ;
		if(\Multi_ofertaVenta::existe (\cDb::confByKey('celorriov3'),$idProd)){
			$objOferta=new \Multi_ofertaVenta(\cDb::confByKey('celorriov3'),$idProd);
			$metaTags .= '<meta name="description" content="'.$objOferta->GETmetaDescription().'">';
		}else{
			throw new \Exception("El producto solicitado no se encuentra disponible en estos momentos. Disculpe las molestias");
		}*/
		$metaTags.='<meta property="og:title" content="'.$sitename.'" />';
		$metaTags.='<meta property="og:description" content="'.$sitename.'" />';
		$metaTags.='<meta name="description" content="'.$sitename.'">';
		$metaTags.='<meta property="og:image" content="'.BASE_URL.'appFed16/binaries/imgs/ogImage.CL.png" />';
		return $metaTags;
	}
	public function head() {
		parent::head();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/head.php");
	}
	public function favIcon() {
		$keyTienda=$GLOBALS['config']->tienda->key;
		$sitename=$GLOBALS['config']->tienda->SITE_NAME;
		$TileColor='#2d89ef';//#00a300//SC:#ffceb4 o mejor #ffffff//FD:008B44
		$themeColor='#ffffff';//SC:#ffceb4//FD:#008B44
		//http://realfavicongenerator.net/
		$sl="\n";
		echo
			'<link rel="apple-touch-icon" sizes="180x180" href="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/apple-touch-icon.png?v=lkgMkggyvj">'.$sl.
			'<link rel="icon" type="image/png" href="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/favicon-32x32.png?v=lkgMkggyvj" sizes="32x32">'.$sl.
			'<link rel="icon" type="image/png" href="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/favicon-16x16.png?v=lkgMkggyvj" sizes="16x16">'.$sl.
			'<link rel="manifest" href="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/manifest.json?v=lkgMkggyvj">'.$sl.
			'<link rel="mask-icon" href="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/safari-pinned-tab.svg?v=lkgMkggyvj" color="#5bbad5">'.$sl.
			'<link rel="shortcut icon" href="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/favicon.ico?v=lkgMkggyvj">'.$sl.
			'<meta name="apple-mobile-web-app-title" content="'.$sitename.'">'.$sl.
			'<meta name="application-name" content="'.$sitename.'">'.$sl.
			'<meta name="msapplication-TileColor" content="'.$TileColor.'">'.$sl.
			'<meta name="msapplication-TileImage" content="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/mstile-144x144.png?v=lkgMkggyvj">'.$sl.
			'<meta name="msapplication-config" content="'.BASE_URL.'appFed16/binaries/imgs/favIcon/'.$keyTienda.'/browserconfig.xml?v=lkgMkggyvj">'.$sl.
			'<meta name="theme-color" content="'.$themeColor.'">'.$sl.
		'';
	}
	public function js() {
		parent::js();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js/jsCesta.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js/jsBuscador.php");

		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js/jsBanner.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/js/jsFB.php");
		\Sintax\ApiService\Categorias::listaFichaProductoResponsiveJs();
		\Sintax\ApiService\Categorias::swiperFichaProductoResponsiveJs();
	}
	public function css() {
		parent::css();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css/cssBanner.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css/cssBuscador.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css/cssMenuCats.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css/cssMenuUsr.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css/cssOferDetalle.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css/cssFooter.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css/cssCesta.php");
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/css/cssMediaQueries.php");
		\Sintax\ApiService\Categorias::listaFichaProductoResponsiveCss();
		\Sintax\ApiService\Productos::fichaProductoDtoCss();
		\Sintax\ApiService\Categorias::swiperFichaProductoResponsiveCss();
	}
	public function markup() {
		$db=\cDb::confByKey('celorriov3');
		$logueado=false;
		if (isset($_SESSION['usuario'])){
			$logueado=true;
			$objCli=$_SESSION['usuario']->objEntity;
			$objCli->SETdb($db);
			$cliente=$objCli->toStdObj();
			$cliente->saldo=$objCli->saldoCredito();
		}
		$activarTW=($GLOBALS['config']->tienda->SOCIAL->TW->CONSUMER_KEY!="")?true:false;
		$activarFB=($GLOBALS['config']->tienda->SOCIAL->FB->APP_ID!="")?true:false;
		$linkTiendaTW=($GLOBALS['config']->tienda->SOCIAL->TW->URL!="")?true:false;
		$linkTiendaFB=($GLOBALS['config']->tienda->SOCIAL->FB->URL!="")?true:false;
	//$GLOBALS['firephp']->error($db->ping(),"pre arrCatsRootsMenu");
	$tInicial=microtime(true);
		$arrCatsRoots=\Sintax\ApiService\Categorias::arrCatsRootsMenu($GLOBALS['config']->tienda->key);
	$tTotal=microtime(true)-$tInicial;
	//error_log('/** Excep. arrCatsRootsMenu: '.round($tTotal,4));
		//$db=\cDb::confByKey("celorriov3");
	//$GLOBALS['firephp']->error($db->ping(),"post arrCatsRootsMenu");
		$objCesta=$this->ensureCesta($db);
		$arrCestaItems=$objCesta->arrItemsJqCesta();
		$jsonArrCestaItems=htmlspecialchars(json_encode($arrCestaItems),ENT_QUOTES,'UTF-8');

		$arrDtosGama=\Multi_productoGamaDescuento::getArray($db,"keyTienda='".$GLOBALS['config']->tienda->key."'","","","arrClassObjs");
		$tickerContent='';
		foreach ($arrDtosGama as $objDtoGama) {
			if ($objDtoGama->enVigor()) {
				$objGama=$objDtoGama->objMulti_productoGama();
				$tickerContent.='
					<li class="tickerBlock"><span>
						<i class="fa fa-info-circle"></i>
						<span class="dto">'.$objDtoGama->GETtipoDescuento().'%</span>
						<span>
							Descuento en gama
							<span class="gama">'.$objGama->GETnombre().'</span>
						</span>
						<span><small>válido hasta '.\Fecha::fromMysql($objDtoGama->GETmomentoFin())->date('d/m H:i').'</small></span>
					</span></li>
				';
			}
		}
		$storeData=\Sintax\ApiService\Pedidos::getStoreData();
		require_once( str_replace("//","/",dirname(__FILE__)."/")."markup/markup.php");
	}

	public function cuerpo() {
		//$objPageCategoria=new categoria($this->objUsr);
		//$objPageCategoria->cuerpo();
		$storeData=\Sintax\ApiService\Pedidos::getStoreData();
		$arrOfersBanner=\Sintax\ApiService\Categorias::arrOfersTag($GLOBALS['config']->tienda->key,$storeData->HOME_BANNER_TAG,36);
		if (count($arrOfersBanner)==0) {
			$arrOfersBanner=\Sintax\ApiService\Categorias::arrOfersMayorDescuento($GLOBALS['config']->tienda->key,13);
		}
		$arrOfersCuerpo=\Sintax\ApiService\Categorias::arrOfersTag($GLOBALS['config']->tienda->key,$storeData->HOME_TAG,36);
		if (count($arrOfersCuerpo)==0) {
			$arrOfersCuerpo=\Sintax\ApiService\Categorias::arrOfersMasVendidas($GLOBALS['config']->tienda->key,24);
		}
		if (isset($_SESSION['usuario'])){
			$objCli=$_SESSION['usuario']->objEntity;
			$arrOfersCustom=\Sintax\ApiService\Categorias::arrOfersCustom($GLOBALS['config']->tienda->key,12,$objCli->GETid());
		}
		require_once( str_replace('//','/',dirname(__FILE__).'/') .'markup/cuerpo.php');
	}
	public function subMenu($idPadre){
		$arrCatsSubMenu=\Sintax\ApiService\Categorias::arrCatsRootsSubMenu($idPadre);
		return $arrCatsSubMenu;
	}

	public function acSearchOfers ($query,$offset,$limit) {
		$db=\cDb::confByKey("celorriov3");
		$arr=\Multi_ofertaVenta::textSearch($db,$GLOBALS['config']->tienda->key,$query,$offset,$limit);
		$foundRows=$db->get_var("SELECT FOUND_ROWS()");
		$objSearch=new \stdClass();
		$objSearch->foundRows=$foundRows;
		$arrResults=array();
		$idx=0;
		foreach ($arr as $objOferta) {
			if (!$objOferta->algunaCategoriaVisible()) {$foundRows--;continue;}
			$std=\Sintax\ApiService\Categorias::creaStdObjOferta($objOferta);
			$std->imgSrc=$objOferta->imgSrc(0,100,100);
			$std->index=$idx;
			array_push($arrResults, $std);
			$std->nombreHighlight=\Cadena::highlight(explode(' ',$query) ,$std->nombre,'highlight');
			$std->btnComprar=\Sintax\ApiService\Productos::btnComprar($objOferta,'fa fa-shopping-cart','','Comprar');
			$std->btnMasInfo=\Sintax\ApiService\Productos::btnMasInfo($objOferta,'shop-item-btn-info');
			$std->infoDtoCatalogo='';
			if ($std->tipoDtoRespectoCatalogo>0) {
				$std->infoDtoCatalogo='<div class="shop-item-dto-triangle"></div><div class="shop-item-dto">-'.$std->tipoDtoRespectoCatalogo.'%</div>';
			}
			$std->infoDtoGama='';
			if (isset($std->gama)) {
				$std->infoDtoGama='<div class="stamp stampRotate"><div>-'.$std->gama->tipoDescuentoGama.'%</div></div>';
			}
			$std->infoDtoRebote='';
			if ($std->rebote>0) {
				$std->infoDtoRebote='<div class="shop-item-rebote"><div>'.$std->rebote.'%</div></div>';
			}
		}
		$objSearch->arrResults=$arrResults;
		return $objSearch;
	}
}
?>
