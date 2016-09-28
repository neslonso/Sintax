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
		$db=\cDb::confByKey("celorriov3");
		$arr=array();
		$arrCatsRoot=\Multi_categoria::getRoots($db,"keyTienda='".$keyTienda."' AND visible='1'","","","arrClassObjs");
	$GLOBALS['firephp']->error($db->ping(),"Antes de lista");
		$listaIdsFotosMenu='';
		$listaIdsFotosMenu=self::listaIdsFotosMenu($GLOBALS['config']->tienda->key);
	$GLOBALS['firephp']->error($db->ping(),"Tras lista");
		foreach ($arrCatsRoot as $objCat) {
			$obj=new \stdClass();
			$obj->id=$objCat->GETid();
			$obj->nombre=$objCat->GETnombre();
			//$obj->ico=$objCat->icoSrc();
			$obj->ico=BASE_URL.FILE_APP.'?MODULE=images&almacen=DB_MPA_JOIN&fichero='.$listaIdsFotosMenu.'&ancho=30&alto=30';
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
		$db=\cDb::confByKey("celorriov3");
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
			foreach ($arrCatsNietas as $objCatNieto) {
				$objNieto=new \stdClass();
				$objNieto->id=$objCatNieto->GETid();
				$objNieto->nombre=$objCatNieto->GETnombre();
				array_push($arrNietos,$objNieto);
			}
			$obj->arrNietos=$arrNietos;
			array_push($arr,$obj);
		}
		return $arr;
	}

	public static function listaIdsFotosMenu($keyTienda) {
		//$db=\cDb::confByKey("celorriov3");
		$db=\cDb::gI();
		$arrIdsFotos=array();
		$arrCatsRoot=\Multi_categoria::getRoots($db,"keyTienda='".$keyTienda."' AND visible='1'","","","arrClassObjs");
		foreach ($arrCatsRoot as $objCat) {
			$arrCatsHijas=$objCat->arrMulti_categoriaHija("","","","arrClassObjs");
			$imgId=$objCat->imgId();
			if (!empty($imgId)) array_push($arrIdsFotos, $imgId);
			foreach ($arrCatsHijas as $objCatHija) {
				$imgId=$objCatHija->imgId();
				if (!empty($imgId)) array_push($arrIdsFotos, $imgId);
			}
		}
		$listaIdsFotosMenu=implode(",",$arrIdsFotos);
		$GLOBALS['firephp']->error($listaIdsFotosMenu,"listaIdsFotosMenu");
		$GLOBALS['firephp']->error($db->ping(),"Al final de lista");
		return $listaIdsFotosMenu;
	}
}
?>