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
	public function arrRandomOfertasVenta($cuantos=10, $keyTienda="", $asObjectArray=true) {
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
				$obj->popupProd=$this->popupProd($objOferta);
				array_push($arr,$obj);
			} else {
				array_push($arr,$data->id);
			}
		}
		//error_log(print_r($arr,true));
		return $arr;
	}

	/**
	 * [popupProd description]
	 * @param  [type] $obj [description]
	 * @return [type]      [description]
	 */
	public function popupProd($obj){
		$html='
			<div id="itemPopup'.$obj->GETid().'" class="item vertical-align">
				<div class="col-xs-12 col-sm-6 col-md-6"> <!-- Grid -->
					<div class="rbm_sldr_sc_content rbm_sldr_sc_content_col_2">
						<div class="row shop-item-modal">
							<div class="col-xs-12 col-sm-6">
								<img src="'.$obj->imgSrc().'" class="img-responsive" alt="rbm_slider_showcase_01">
							</div>
							<div class="col-xs-12 col-sm-6">
								<h1>'.$obj->GETnombre().'</h1>
								<span class="shop-item-modal-price">'.$obj->pvp().'€</span>
								<div>
									<a class="btn btn-default" href="#">Comprar</a>
								</div>
							</div>
							<div class="col-xs-12">
								'.$obj->GETdescripcion().'
							</div>
						</div>
						<!-- Button -->
						<a href="'.BASE_URL.FILE_APP.'?page=prod&id='.$obj->GETid().'" class="rbm_btn_x_out_shtr rbm_sldr_sc_btn rbm_sldr_sc_btn">más info</a>
					</div> <!-- /.rbm_sldr_sc_content -->
				</div> <!-- /Grid -->
			</div> <!-- /item -->
		';
	}


}
?>