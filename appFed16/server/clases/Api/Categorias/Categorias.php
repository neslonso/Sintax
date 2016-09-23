<?
namespace Sintax\ApiService;
use Sintax\Core\IApiService;
use Sintax\Core\ApiService;
use Sintax\Core\User;

class Categorias extends ApiService implements IApiService {

	public function __construct (User $objUsr=NULL) {
		parent::__construct($objUsr);
	}

	public function arrCatsRootsMenu($keyTienda) {
		$db=\cDb::confByKey("celorriov3");
		$arr=array();
		$arrCatsRoot=\Multi_categoria::getRoots($db,"keyTienda='".$keyTienda."'","","","arrClassObjs");
		foreach ($arrCatsRoot as $objCat) {
			$obj=new \stdClass();
			$obj->id=$objCat->GETid();
			$obj->nombre=$objCat->GETnombre();
			$obj->ico=$objCat->icoSrc();
			$obj->img=$objCat->imgSrc();
			array_push($arr,$obj);
		}
		return $arr;
	}


	public function arrCatsRootsSubMenu($idPadre){
		$db=\cDb::confByKey("celorriov3");
		$objMCat=new \Multi_categoria($db,$idPadre);
		$arrCatsHijas=$objMCat->arrMultiCategoriaHija("","","","arrClassObjs");
		$arr=array();
		foreach ($arrCatsHijas as $objCat) {
			$obj=new \stdClass();
			$obj->id=$objCat->GETid();
			$obj->nombre=$objCat->GETnombre();
			$obj->img=$objCat->imgSrc();
			$arrCatsNietas=$objCat->arrMultiCategoriaHija("","","","arrClassObjs");
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

}
?>