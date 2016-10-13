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
		$i=0;
		while ($data=$rsl->fetch_object()) {
			if ($asObjectArray) {
				$objOferta=new \Multi_ofertaVenta($db,$data->id);
				$obj=\Sintax\ApiService\Categorias::creaStdObjOferta($objOferta);
				$obj->index=$i;
				array_push($arr,$obj);
				$i++;
			} else {
				array_push($arr,$data->id);
			}
		}
		//error_log(print_r($arr,true));
		return $arr;
	}

/******************************************************************************/
/* FRAGMENTOS *****************************************************************/
	public function btnComprar($stdObjOrClassObjOfer,$cssClasses='',$iconCssClasses='glyphicon glyphicon-shopping-cart',$text='Comprar ahora',$tag='a') {
		if (get_class($stdObjOrClassObjOfer)=='Multi_ofertaVenta') {
			$obj=\Sintax\ApiService\Categorias::creaStdObjOferta($stdObjOrClassObjOfer);
		} else {
			$obj=$stdObjOrClassObjOfer;
		}
		$vendible = (!$obj->vendible) ? 'disabled' : '';
		$jqCst =($obj->vendible)?'jqCst':'';

		$strTemplate='<'.$tag.' '.$vendible.'
			class="btn '.$jqCst.' '.$cssClasses.'"
			data-id="{{id}}"
			data-ttl="{{nombre}}"
			data-unit="1"
			data-prc="{{precio}}"
			data-src="{{imgSrc}}">
				<i class="'.$iconCssClasses.'"></i> '.$text.'
			</'.$tag.'>';
		//$GLOBALS['firephp']->error("Excep: ".$strTemplate);
		if (!is_null($obj)) {
			foreach ($obj as $key => $value) {
				if (!is_object($value)) {
					$strTemplate=str_replace('{{'.$key.'}}', strip_tags($value), $strTemplate);
				}
			}
		}
		//$GLOBALS['firephp']->error("Excep2: ".$strTemplate);
		return $strTemplate;
	}
/**/
	public function fichaProductoResponsive($stdObjOfer) {
		require ( str_replace('//','/',dirname(__FILE__).'/') .'markup/fichaProductoResponsive/markup.php');
	}
	public function fichaProductoResponsiveCss() {
		require_once ( str_replace('//','/',dirname(__FILE__).'/') .'markup/fichaProductoResponsive/css.php');
	}

	public function fichaProductoDto($stdObjOfer) {
		$imgSrc=$stdObjOfer->urlFotoPpal.'&modo='.(\Imagen::OUTPUT_MODE_SCALE | \Imagen::OUTPUT_MODE_ROTATE_H | \Imagen::OUTPUT_MODE_ROTATE_V);
		require ( str_replace('//','/',dirname(__FILE__).'/') .'markup/fichaProductoDto/markup.php');
	}
	public function fichaProductoDtoCss() {
		require_once ( str_replace('//','/',dirname(__FILE__).'/') .'markup/fichaProductoDto/css.php');
	}
/******************************************************************************/
	/*funciones necesarias para prod.php*/
	/**
	 * [arrProductosRelacionados description]
	 * @param  integer $cuantos       [description]
	 * @param  string  $keyTienda     [description]
	 * @param  boolean $asObjectArray [description]
	 * @return [type]                 [description]
	 */
	public static function arrProductosRelacionados($cuantos=10, $keyTienda="", $asObjectArray=true){
		$arr = \Sintax\ApiService\Productos::arrRandomOfertasVenta($cuantos,$keyTienda);
		return $arr;
	}

	/**
	 * [arrProductosGama description]
	 * @param  integer $cuantos       [description]
	 * @param  string  $keyTienda     [description]
	 * @param  boolean $asObjectArray [description]
	 * @return [type]                 [description]
	 */
	public static function arrProductosGama($cuantos=10, $keyTienda="", $asObjectArray=true){
		$arr = \Sintax\ApiService\Productos::arrRandomOfertasVenta($cuantos,$keyTienda);
		return $arr;
	}
}
?>