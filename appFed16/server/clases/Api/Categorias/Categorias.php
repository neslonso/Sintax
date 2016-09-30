<?
namespace Sintax\ApiService;
use Sintax\Core\IApiService;
use Sintax\Core\ApiService;
use Sintax\Core\User;

class Categorias extends ApiService implements IApiService {

	public function __construct (User $objUsr=NULL) {
		parent::__construct($objUsr);
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
		$arrCatsRoot=\Multi_categoria::getRoots($db,"keyTienda='".$keyTienda."' AND visible='1'","","","arrClassObjs");
		$listaIdsFotosMenu='';
		$listaIdsFotosMenu=self::listaIdsFotosMenu($GLOBALS['config']->tienda->key);
		foreach ($arrCatsRoot as $objCat) {
			$obj=new \stdClass();
			$obj->id=$objCat->GETid();
			$obj->nombre=$objCat->GETnombre();
			//$obj->ico=$objCat->icoSrc();
			$obj->ico=BASE_URL.FILE_APP.'?MODULE=images&almacen=DB_MPA_JOIN&fichero='.$listaIdsFotosMenu.'&ancho=30&alto=30&formato=jpg';
			$obj->img=$objCat->imgSrc();
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
		$arrCatsHijas=$objMCat->arrMulti_categoriaHija("visible='1'","","","arrClassObjs");
		$arr=array();
		foreach ($arrCatsHijas as $objCat) {
			$obj=new \stdClass();
			$obj->id=$objCat->GETid();
			$obj->nombre=$objCat->GETnombre();
			$obj->img='';
			$arrCatsNietas=$objCat->arrMulti_categoriaHija("visible='1'","","","arrClassObjs");
			$arrNietos=array();
			if (!empty($arrCatsNietas)) {
				foreach ($arrCatsNietas as $objCatNieto) {
					$objNieto=new \stdClass();
					$objNieto->id=$objCatNieto->GETid();
					$objNieto->nombre=$objCatNieto->GETnombre();
					array_push($arrNietos,$objNieto);
				}
			} else {
				//$obj->arrOfersMasVendidas=array();
				$obj->arrOfersMasVendidas=self::arrOfersMasVendidas($objCat->GETkeyTienda(), 6, $objCat->GETid());
			}
			$obj->arrNietos=$arrNietos;
			array_push($arr,$obj);
		}
	$tTotal=microtime(true)-$tInicial;
	error_log('/** Excep. arrCatsRootsSubMenu: '.round($tTotal,4));
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
				if (!empty($imgId)) array_push($arrIdsFotos, base_convert($imgId,10,36));
				if (!$objCatHija->contieneCategorias()) {
					$arrOfersMasVendidas=self::arrOfersMasVendidas($keyTienda, 6, $objCatHija->GETid());
					foreach ($arrOfersMasVendidas as $ofer) {
						if (!empty($ofer->imgId)) array_push($arrIdsFotos, base_convert($ofer->imgId,10,36));
					}
				}
				$arrCatsNietas=$objCatHija->arrMulti_categoriaHija("visible='1'","","","arrClassObjs");
				if (empty($arrCatsNietas)) {
					$arrOfersMasVendidas=self::arrOfersMasVendidas($keyTienda, 6, $objCatHija->GETid());
					foreach ($arrOfersMasVendidas as $ofer) {
						if (!empty($ofer->imgId)) array_push($arrIdsFotos, $ofer->imgId);
					}
				}
			}
		}
		$listaIdsFotosMenu=implode(",",$arrIdsFotos);
	//$GLOBALS['firephp']->error($listaIdsFotosMenu,"listaIdsFotosMenu");
	//$GLOBALS['firephp']->error($db->ping(),"Al final de lista");
		return $listaIdsFotosMenu;
	}

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
				if ($totalInsertados>=$cuantos) {break;}
				if ($insertadosEstaCat>=$cuantosPorCat) {break;}
				$obj=new \stdClass();
				$objOferta=\Multi_ofertaVenta::cargarPorRef($db,$ref);
				if ($objOferta!==false) {
					$obj->id=$objOferta->GETid();
					$obj->nombre=$objOferta->GETid().'.- '.$objOferta->GETnombre();
					$obj->precio=$objOferta->pvp();
					$obj->urlFotoPpal=$objOferta->imgSrc();
					$obj->imgId=$objOferta->imgId();
					$obj->popupProd=\Sintax\ApiService\Productos::popupProd($objOferta);
					array_push($arr,$obj);
					$insertadosEstaCat++;
					$totalInsertados++;
				}
			}
		}
		return $arr;
	}
}
?>