<?
namespace Sintax\ApiService;
use Sintax\Core\IApiService;
use Sintax\Core\ApiService;
use Sintax\Core\User;

class Categorias extends ApiService implements IApiService {

	public function __construct (User $objUsr=NULL) {
		parent::__construct($objUsr);
	}

	public function arrCatsRootsMenu($arrParams) {
		$keyTienda=$arrParams['keyTienda'];
		$db=\cDb::confByKey("celorriov3");
		$arr=array();
		$arrCatsRoot=\Multi_categoria::getRoots($db,"keyTienda='".$keyTienda."'","","","arrClassObjs");
		foreach ($arrCatsRoot as $objCat) {
			$obj=new \stdClass();
			$obj->nombre=$objCat->GETnombre();
			array_push($arr,$obj);
		}
		return $arr;
	}

	public function arrRandomOfertasVenta($cuantos=10, $keyTienda="", $asObjectArray=true) {
		$db=\cDb::confByKey("celorriov3");
		$sql="SELECT id FROM multi_ofertaVenta where keyTienda='".$keyTienda."' ORDER BY RAND() LIMIT 0,".$cuantos;
		$arr=array();
		$rsl=$db->query($sql);
		while ($data=$rsl->fetch_object()) {
			if ($asObjectArray) {
				$obj=new \stdClass();
				$objOferta=new \Multi_ofertaVenta($db,$data->id);
				$obj->nombre=$objOferta->GETnombre();
				$obj->precio=$objOferta->pvp();
				$obj->urlFotoPpal=$objOferta->urlFotoPpal();
				array_push($arr,$obj);
			} else {
				array_push($arr,$data->id);
			}
		}
		//error_log(print_r($arr,true));
		return $arr;
	}
}
?>