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

	/**
	 * [arrOfersRelacionadas description]
	 * @param  [type]  $idOfer  [description]
	 * @param  integer $cuantos [description]
	 * @return [type]           [description]
	 */
	public static function arrOfersRelacionadas($idOfer,$cuantos=10){
		$db=\cDb::confByKey("celorriov3");
		$objOferta=new \Multi_ofertaVenta($db,$idOfer);
		$arrRefs=array();
		$arrProds = $objOferta->arrMulti_producto("","","","arrClassObjs");
		foreach ($arrProds as $objProd) {
			$arrRefs=array_merge($arrRefs,$objProd->compisDePedido());
		}
		asort ($arrRefs, SORT_NUMERIC);
		$arrRefs=array_reverse ($arrRefs,true);
		$arr=array();
		$i=0;
		foreach ($arrRefs as $ref => $vecesCompi) {
			$objOfertaCompi=\Multi_ofertaVenta::cargarPorRef($db,$objOferta->GETkeyTienda(),$ref);
			if (is_object($objOfertaCompi)) {
				if ($objOfertaCompi->GETvisible()) {
					$obj=\Sintax\ApiService\Categorias::creaStdObjOferta($objOfertaCompi);
					$obj->index=$i;
					array_push($arr,$obj);
					$i++;
				}
			}
			if ($i>$cuantos) {break;}
		}
		return $arr;
	}

	/**
	 * [arrOfersGama description]
	 * @param  [type]  $idOfer  [description]
	 * @param  integer $cuantos [description]
	 * @return [type]           [description]
	 */
	public static function arrOfersGama($idOfer,$cuantos=10) {
		$db=\cDb::confByKey("celorriov3");
		$objOferta=new \Multi_ofertaVenta($db,$idOfer);
		$arrOfersGamas=array();
		$arrGamas=$objOferta->arrMulti_productoGama();
		foreach ($arrGamas as $objGama) {
			$arrProds=$objGama->arrMulti_producto("","","","arrClassObjs");
			foreach ($arrProds as $objProd) {
				$arrOfersGamas=array_merge($arrOfersGamas,$objProd->arrMulti_ofertaVenta("keyTienda='".$objOferta->GETkeyTienda()."' AND visible=1","","","arrClassObjs"));
			}
		}
		$arr=array();
		$i=0;
		foreach ($arrOfersGamas as $objOfertaGama) {
			$obj=\Sintax\ApiService\Categorias::creaStdObjOferta($objOfertaGama);
			$obj->index=$i;
			array_push($arr,$obj);
			$i++;
			if ($i>$cuantos) {break;}
		}
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
			class="btn btn-default '.$jqCst.' '.$cssClasses.'"
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
	public function btnMasInfo($stdObjOrClassObjOfer,$cssClasses='',$iconCssClasses='fa fa-info-circle',$text='+Info',$tag='button') {
		if (get_class($stdObjOrClassObjOfer)=='Multi_ofertaVenta') {
			$obj=\Sintax\ApiService\Categorias::creaStdObjOferta($stdObjOrClassObjOfer);
		} else {
			$obj=$stdObjOrClassObjOfer;
		}
		$strTemplate='<'.$tag.'
			class="btn btn-default '.$cssClasses.'"
			data-id="{{id}}"
			data-ttl="{{nombre}}"
			data-unit="1"
			data-prc="{{precio}}"
			data-src="{{imgSrc}}"
			onclick="window.location=\''.$obj->url.'\'"
			>
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
}
?>