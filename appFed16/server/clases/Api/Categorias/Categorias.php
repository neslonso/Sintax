<?
namespace Sintax\ApiService;
use Sintax\Core\IApiService;
use Sintax\Core\ApiService;
use Sintax\Core\User;

class Categorias extends ApiService implements IApiService {

	public function __construct (User $objUsr=NULL) {
		parent::__construct($objUsr);
	}

	public static function creaStdObjOferta($objOferta) {
		$obj=new \stdClass();
		$obj->id=$objOferta->GETid();
		//$obj->nombre=$objOferta->GETid().'.- '.$objOferta->GETnombre();
		$obj->referencia=$objOferta->GETreferencia();
		$obj->nombre=$objOferta->GETnombre();
		$obj->categoria=$objOferta->objMulti_categoriaPrincipal()->GETnombre();

		$descripcion = $objOferta->GETdescripcion();
		$descripcion = preg_replace('#^\s*<br />\s*$#m', '', $descripcion);
		$descripcion = preg_replace('#^\s*(<br />)+\s*$#m', '<hr />', $descripcion);
		$descripcion = preg_replace('#\s+([,;.:¿?¡!])#', '$1', $descripcion);
		$obj->descripcion=$descripcion;

		$obj->precio=$objOferta->pvp();
		$obj->precioCatalogo=$objOferta->pvpCatalogo();
		$obj->tipoDtoRespectoCatalogo=floor($objOferta->descuentoOferta());
		$obj->urlFotoPpal=$objOferta->imgSrc();
			$obj->imgSrc=$objOferta->imgSrc();
		$obj->imgId=$objOferta->imgId();
		$obj->rebote=$objOferta->GETtipoDevolucionCredito();
		$obj->vendible=$objOferta->vendible();
		$obj->url=$objOferta->url();
		if ($objOferta->tipoDescuentoGama()>0) {
			$obj->gama=new \stdClass();
			$obj->gama->nombre=$objOferta->objMulti_productoGama()->GETnombre();
			$obj->gama->tipoDescuentoGama=$objOferta->tipoDescuentoGama();
			$obj->gama->momentoFin=\Fecha::fromMysql($objOferta->objMulti_productoGama()->momentoFin($objOferta->GETkeyTienda()))->toFechaEs(true);
		}
		return $obj;
	}

	/**
	 * [arrCatsRootsMenu description]
	 * @param  [type] $keyTienda [description]
	 * @return [type]            [description]
	 */
	public static function arrCatsRootsMenu($keyTienda) {
		//$db=\cDb::confByKey("celorriov3");
		$db=\cDb::gI();
		$arr=array();
		$arrCatsRoot=\Multi_categoria::getRoots($db,"keyTienda='".$keyTienda."' AND visible='1'","orden ASC","","arrClassObjs");
		//$listaIdsFotosMenu='';
		//$listaIdsFotosMenu=self::listaIdsFotosMenu($GLOBALS['config']->tienda->key);
		foreach ($arrCatsRoot as $objCat) {
			$obj=new \stdClass();
			$obj->id=$objCat->GETid();
			$obj->nombre=$objCat->GETnombre();
			$obj->url=$objCat->url();
			//$obj->ico=BASE_URL.FILE_APP.'?MODULE=images&almacen=DB_MPA_JOIN&fichero='.$listaIdsFotosMenu.'&ancho=30&alto=30&formato=jpg';
			$obj->img=$objCat->imgSrc(200,200);
			array_push($arr,$obj);
		}
		return $arr;
	}

	/**
	 * [arrCatsRootsSubMenu description]
	 * @param  [type] $idPadre [description]
	 * @return [type]          [description]
	 */
	public static function arrCatsRootsSubMenu($idPadre){
	$tInicial=microtime(true);
		//$db=\cDb::confByKey("celorriov3");
		$db=\cDb::gI();
		$objMCat=new \Multi_categoria($db,$idPadre);
		$arrCatsHijas=$objMCat->arrMulti_categoriaHija("fff.visible='1'","orden ASC","","arrClassObjs");
		$arr=array();
		foreach ($arrCatsHijas as $objCat) {
			$obj=new \stdClass();
			$obj->id=$objCat->GETid();
			$obj->nombre=$objCat->GETnombre();
			$obj->img='';
			$obj->url=$objCat->url();
			$arrCatsNietas=$objCat->arrMulti_categoriaHija("fff.visible='1'","orden ASC","","arrClassObjs");
			$arrNietos=array();
			if (!empty($arrCatsNietas)) {
				foreach ($arrCatsNietas as $objCatNieto) {
					$objNieto=new \stdClass();
					$objNieto->id=$objCatNieto->GETid();
					$objNieto->nombre=$objCatNieto->GETnombre();
					$objNieto->url=$objCatNieto->url();
					array_push($arrNietos,$objNieto);
				}
			} else {
				//$obj->arrOfersMasVendidas=array();
				$obj->arrOfersMasVendidas=self::arrOfersMasVendidas($objCat->GETkeyTienda(), 0, $objCat->GETid());
			}
			$obj->arrNietos=$arrNietos;
			array_push($arr,$obj);
		}
	$tTotal=microtime(true)-$tInicial;
	//error_log('/** Excep. arrCatsRootsSubMenu: '.round($tTotal,4));
		return $arr;
	}
	/**
	 * [listaIdsFotosMenu description]
	 * @param  [type] $keyTienda [description]
	 * @return [type]            [description]
	 */
	public static function listaIdsFotosMenu($keyTienda) {
		//$db=\cDb::confByKey("celorriov3");
		$db=\cDb::gI();
		$arrIdsFotos=array();
		$arrCatsRoot=\Multi_categoria::getRoots($db,"keyTienda='".$keyTienda."' AND visible='1'","","","arrClassObjs");
		foreach ($arrCatsRoot as $objCat) {
			$arrCatsHijas=$objCat->arrMulti_categoriaHija("","","","arrClassObjs");
			$imgId=$objCat->imgId();
			if (!empty($imgId)) array_push($arrIdsFotos, base_convert($imgId,10,36));
			foreach ($arrCatsHijas as $objCatHija) {
				$imgId=$objCatHija->imgId();
				if (!empty($imgId) && false) array_push($arrIdsFotos, base_convert($imgId,10,36));
				if (!$objCatHija->contieneCategorias()) {
					$arrOfersMasVendidas=self::arrOfersMasVendidas($keyTienda, 0, $objCatHija->GETid());
					foreach ($arrOfersMasVendidas as $ofer) {
						if (!empty($ofer->imgId)) array_push($arrIdsFotos, base_convert($ofer->imgId,10,36));
					}
				}
			}
		}
		$listaIdsFotosMenu=implode(",",$arrIdsFotos);
	//$GLOBALS['firephp']->error($listaIdsFotosMenu,"listaIdsFotosMenu");
	//$GLOBALS['firephp']->error($db->ping(),"Al final de lista");
		return $listaIdsFotosMenu;
	}

	/**
	 * [arrOfersMasVendidas description]
	 * @param  [type]  $keyTienda         [description]
	 * @param  integer $cuantos           [description]
	 * @param  [type]  $idMulti_categoria [description]
	 * @return [type]                     [description]
	 */
	public static function arrOfersMasVendidas($keyTienda, $cuantos=10, $idMulti_categoria=NULL) {
		$db=\cDb::gI();
		$arr=array();
		if (!is_null($idMulti_categoria) && \Multi_categoria::existe($db,$idMulti_categoria)) {
			$arrCats=array(new \Multi_categoria($db,$idMulti_categoria));
		} else {
			$arrCats=\Multi_categoria::getRoots($db,"keyTienda='".$keyTienda."' AND visible='1'","","","arrClassObjs");
		}
		$cuantosPorCat=ceil($cuantos/count($arrCats));
		$totalInsertados=0;
		foreach ($arrCats as $objCat) {
			$insertadosEstaCat=0;
			$arrRefs=$objCat->arrRefsMasVendidas();
			foreach ($arrRefs as $ref) {
				if ($totalInsertados>=$cuantos) {break 2;}
				if ($insertadosEstaCat>=$cuantosPorCat) {break;}
				$objOferta=\Multi_ofertaVenta::cargarPorRef($db,$keyTienda,$ref);
				if ($objOferta!==false && $objOferta->vendible()) {
					$obj=self::creaStdObjOferta($objOferta);
					$obj->index=$totalInsertados;
					array_push($arr,$obj);
					$insertadosEstaCat++;
					$totalInsertados++;
				}
			}
		}
		return $arr;
	}

	/**
	 * [arrOfersTag description]
	 * @param  [type]  $keyTienda [description]
	 * @param  [type]  $nombreTag [description]
	 * @param  integer $cuantos   [description]
	 * @return [type]             [description]
	 */
	public static function arrOfersTag($keyTienda, $nombreTag, $cuantos=10) {
		$db=\cDb::gI();
		$arr=array();
		$objTag=\Multi_productoTag::cargarPorNombre($db,$nombreTag);
		if (is_object($objTag)) {
			$arrOfersTag=\Multi_ofertaVenta::ofertasTag($db,$objTag->GETid(),"keyTienda='".$keyTienda."' AND visible='1'","","0,".$cuantos,"arrClassObjs");
			$totalInsertados=0;
			foreach ($arrOfersTag as $objOferta) {
				if ($objOferta->vendible()) {
					$obj=self::creaStdObjOferta($objOferta);
					$obj->index=$totalInsertados;
					array_push($arr,$obj);
					$totalInsertados++;
				}
			}
		}
		return $arr;
	}

	/**
	 * [arrOfersCat description]
	 * @param  [type] $idMulti_categoria [description]
	 * @return [type]                    [description]
	 */
	public static function arrOfersCat($idMulti_categoria=NULL) {
		$db=\cDb::gI();
		$arr=array();
		$objCat=new \Multi_categoria($db,$idMulti_categoria);

		$arrOfers=$objCat->arrMulti_ofertaVenta("","orden ASC","","arrClassObjs");
		$i=0;
		foreach ($arrOfers as $objOferta) {
			if ($objOferta->GETvisible()) {
			//if ($objOferta->GETvisible() && $objOferta->GETkeyTienda()==$objCat->GETkeyTienda()) {
				$obj=self::creaStdObjOferta($objOferta);
				$obj->index=$i;
				array_push($arr,$obj);
				$i++;
			}
		}
		return $arr;
	}

	/**
	 * [arrOfersMayorDescuento description]
	 * @param  [type]  $keyTienda [description]
	 * @param  integer $cuantos   [description]
	 * @return [type]             [description]
	 */
	public static function arrOfersMayorDescuento($keyTienda, $cuantos=10) {
		$db=\cDb::gI();
		$arr=array();
		$arrIdsOfer=\Multi_ofertaVenta::arrIdsMayorDescuento($db,$keyTienda,$cuantos);

		$totalInsertados=0;
		foreach ($arrIdsOfer as $idOfer) {
			if ($totalInsertados>=$cuantos) {break;}
			$objOferta=new \Multi_ofertaVenta($db,$idOfer);
			if ($objOferta->vendible()) {
				$obj=self::creaStdObjOferta($objOferta);
				$obj->index=$totalInsertados;
				array_push($arr,$obj);
				$totalInsertados++;
			}
		}
		return $arr;
	}

	/**
	 * [arrOfersCustom description]
	 * @param  [type]  $keyTienda         [description]
	 * @param  integer $cuantos           [description]
	 * @param  [type]  $idMulti_cliente   [description]
	 * @param  [type]  $idMulti_categoria [description]
	 * @return [type]                     [description]
	 */
	public static function arrOfersCustom($keyTienda, $cuantos=10, $idMulti_cliente, $idMulti_categoria=NULL) {
		$db=\cDb::gI();
		$arr=array();
		$arrCats=array();
		if (\Multi_cliente::existe($db,$idMulti_cliente)) {
			$objCliente=new \Multi_cliente($db,$idMulti_cliente);
		} else {
			throw new \Exception("arrOfersCustom idMulti_cliente [".$idMulti_cliente."] not exists", 1);
		}
		if (\Multi_categoria::existe($db,$idMulti_categoria)) {
			$objCat=new \Multi_categoria($db,$idMulti_categoria);
			$arrOfers=$objCat->arrMulti_ofertaVenta("","RAND()","","arrKeys");
		} else {
			$arrOfers=\Multi_ofertaVenta::getArray($db,"keyTienda='".$keyTienda."'","RAND()","","arrKeys");
			//throw new \Exception("arrOfersCustom idMulti_categoria [".$idMulti_categoria."] not exists", 1);
		}
		//$cuantosPorCat=ceil($cuantos/count($arrCats));
		$totalInsertados=0;
		$index=0;
		foreach ($arrOfers as $idMulti_ofertaVenta) {
			$objOferta=new \Multi_ofertaVenta ($db,$idMulti_ofertaVenta);
			if ($objOferta->vendible()) {
				$arrInteres=$objCliente->arrInteres($objOferta);
				if ($arrInteres!==false) {
					$reason="";
					$interesTotal=0;
					//$reason="<ul class='ulReasons'>";
					foreach ($arrInteres as $soPesoReason) {
						//$reason.='<li>';
						$reason.=$soPesoReason->reason."<br />";
						$interesTotal+=$soPesoReason->peso;
						//$reason.='</li>';
					}
					//$reason.='</ul>';
					$obj=self::creaStdObjOferta($objOferta);
					$obj->index=$index;
					//$obj->tooltip=$interesTotal.".-".$reason;
					$obj->tooltip=$reason;
					$obj->interesTotal=$interesTotal;
					if (count($arrInteres)>1) {
						$GLOBALS['firephp']->error($arrInteres);
						$GLOBALS['firephp']->error($obj);
					}
					array_push($arr,$obj);
					$totalInsertados++;
					$index++;
				}
			}
		}

		usort($arr, function ($a, $b) {
			$result=($a->interesTotal > $b->interesTotal)?-1:1;
			$result=($a->interesTotal == $b->interesTotal)?0:$result;
			return $result;
		});

		$arr=array_slice($arr, 0,$cuantos);

		//Ordenar $arrInteresantes
		//totalizar el peso de las razones
		//ordenar las ofertas por la suma de los pesos de las razones
		//devolver las $cuantos primeras
		return $arr;
	}
/******************************************************************************/
/* FRAGMENTOS *****************************************************************/
	public function listaFichaProductoResponsive($arrOfers,$nombreLista='') {
		require ( str_replace('//','/',dirname(__FILE__).'/') .'markup/listaFichaProductoResponsive/markup.php');
	}
	public function listaFichaProductoResponsiveJs() {
		require_once ( str_replace('//','/',dirname(__FILE__).'/') .'markup/listaFichaProductoResponsive/js.php');
	}
	public function listaFichaProductoResponsiveCss() {
		require_once ( str_replace('//','/',dirname(__FILE__).'/') .'markup/listaFichaProductoResponsive/css.php');
	}
/******************************************************************************/
}
?>