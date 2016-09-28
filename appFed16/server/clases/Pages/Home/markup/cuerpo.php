<div id="container-banners">
	<div class="swiper-container">
		<div class="swiper-wrapper">
<?
		$i=0;
		foreach ($arrProds as $prod) {
			$i++;
			if ($i>13) {break;}
			$urlFondo='';
			//$urlProd=$objProd->url();
			$urlProd='';
			$idFotoProd=rand(1,33);//$objProd->idFoto0();
			$imgSrc=BASE_URL.FILE_APP.'?MODULE=images&almacen=DB&fichero=multi_productoAdjunto.id.'.$idFotoProd.'.data&alto=200&filtro=&modo='.(Imagen::OUTPUT_MODE_SCALE | Imagen::OUTPUT_MODE_ROTATE_H | Imagen::OUTPUT_MODE_ROTATE_V);
			//$precioCatalogo=Cadena::toLocalNumber($objProd->GETprecioAntes(),2);
			$precioCatalogo=33;
			//$precioOferta=Cadena::toLocalNumber($objProd->pvp(),2);
			$precioOferta=22;
			//$tipoDtoRespectoCatalogo=$objProd->dto();
			$tipoDtoRespectoCatalogo=64.2;
			//$nombreOferta=$objProd->GETnombre();
			$nombreOferta='Prueba '.rand(1,23);

?>
				<div class="swiper-slide">
					<div class="swiper-slide-1">
						<div style="background:center no-repeat url(<?=$imgSrc?>);">
							<div>
								<span style="font-size:x-large;"><?=$i?></span>
							</div>
						</div>
					</div>
				</div>
<?
		}
?>
		</div>
		<!-- If we need pagination -->
		<div class="swiper-pagination"></div>

		<!-- If we need navigation buttons -->
		<!--<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>-->

		<!-- If we need scrollbar -->
		<!--<div class="swiper-scrollbar"></div>-->
	</div>
</div>
<div class="container shop-item-container" id="container-cuerpo">
	<div class="row">
		<div class="col-lg-12">
			<input type="hidden" id="popupItemActive" value="">
<?
		$i=1;
		$htmlPopup="";
		foreach ($arrProds as $prod) {
			//echo "<pre>".print_r($prod,true)."</pre>";
			$rebote="";
			//$rebote = '<div class="shop-item-rebote"></div>';
			if(($i==1)){
?>
				<div class='row'>
<?
			}
?>
					<div class="col-lg-2 col-md-3 col-sm-6">
						<div class="shop-item-wrapper">
							<!--Item -->
							<div class="shop-item">
								<!-- Item's image -->
								<a data-item="<?=$prod->id?>" data-toggle="modal" data-target="#modalItems">
									<img class="img-responsive"  src="<?=$prod->urlFotoPpal?>" alt="" />
								</a>
								<!-- Item details -->
								<div class="shop-item-dtls">
									<!-- product title -->
									<h4><a data-item="<?=$prod->id?>" data-toggle="modal" data-target="#modalItems"><?=$prod->nombre?></a></h4>
									<!-- price -->
									<span class="shop-item-price"><?=$prod->precio?>€</span>
								</div>
								<!-- add to cart btn -->
								<div class="shop-item-cart">
									<a class="btn" href="#">Comprar</a>
								</div>
							</div>
							<?=$rebote?>
						</div>
					</div>
<?
			if(($i==6)){
?>
				</div>
<?
				$i=1;
			} else {
				$i++;
			}
			//html popup
			$htmlPopup.=$prod->popupProd;
		}
		if ($i!=1){
?>
				</div>
<?
		}
?>
			<!-- Responsive Bootstrap Modal Popup -->
			<div id="modalItems" class="modal fade rbm_modal rbm_size_sldr_sc rbm_center rbm_bd_semi_trnsp rbm_bd_black rbm_blue rbm_bg_transp rbm_none_radius rbm_shadow_none  rbm_animate rbm_duration_vl rbmZoomIn rbm_easeOutQuint" role="dialog">
				<!-- Modal Dialog-->
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<!-- Close Button -->
						<a href="#" onclick="closePopup();" class="rbm_btn_x_out_shtr rbm_sq_txt_close rbm_sldr_sc_cl_btn" data-dismiss="modal">Cerrar</a>
						<!-- Slider -->
						<div id="rbm_sldr_sc_mov_1_col_2" class="carousel slide rbm_sldr_sc_gen rbm_sldr_sc_control three_columns swipe_x rbms_easeOutCirc" data-ride="carousel" data-pause="hover" data-interval="false" data-duration="1000">
							<!-- Header of Slider -->
							<!--
							<div class="rbm_sldr_sc_header">
								<h1>our amazing products</h1>
							</div>
							-->
							<!-- /Header of Slider -->
							<!-- Wrapper For Slides -->
							<div class="carousel-inner" role="listbox">
								<?=$htmlPopup?>
							</div> <!-- End of Wrapper For Slides -->
							<!-- Left Control -->
							<a class="left carousel-control" href="#rbm_sldr_sc_mov_1_col_2" role="button" data-slide="prev">
								<span class="fa fa-angle-left"></span>
							</a>
							<!-- Right Control -->
							<a class="right carousel-control" href="#rbm_sldr_sc_mov_1_col_2" role="button" data-slide="next">
								<span class="fa fa-angle-right"></span>
							</a>
						</div> <!-- End Slider -->
					</div> <!-- /Modal content-->
				</div> <!-- /Modal Dialog-->
			</div> <!-- .modal -->
		    <!-- End Responsive Bootstrap Modal Popup -->

		</div>

	</div>
</div>
