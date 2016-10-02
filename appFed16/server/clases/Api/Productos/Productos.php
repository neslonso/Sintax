<?
namespace Sintax\ApiService;
use Sintax\Core\IApiService;
use Sintax\Core\ApiService;
use Sintax\Core\User;

class Productos extends ApiService implements IApiService {

	public function __construct (User $objUsr=NULL) {
		parent::__construct($objUsr);
	}

	/**
	 * [arrRandomOfertasVenta description]
	 * @param  integer $cuantos       [description]
	 * @param  string  $keyTienda     [description]
	 * @param  boolean $asObjectArray [description]
	 * @return [type]                 [description]
	 */
	public static function arrRandomOfertasVenta($cuantos=10, $keyTienda="", $asObjectArray=true) {
		$db=\cDb::confByKey("celorriov3");
		$sql="SELECT id FROM multi_ofertaVenta where keyTienda='".$keyTienda."' ORDER BY RAND() LIMIT 0,".$cuantos;
		$arr=array();
		$rsl=$db->query($sql);
		while ($data=$rsl->fetch_object()) {
			if ($asObjectArray) {
				$obj=new \stdClass();
				$objOferta=new \Multi_ofertaVenta($db,$data->id);
				$obj->id=$objOferta->GETid();
				$obj->nombre=$objOferta->GETnombre();
				$obj->precio=$objOferta->pvp();
				$obj->urlFotoPpal=$objOferta->imgSrc();
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