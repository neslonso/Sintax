<div id="container-banners">

</div>
<div class="container shop-item-container" id="container-cuerpo">
	<div class="row">
		<div class="col-lg-12">
			<input type="hidden" id="popupItemActive" value="">
<?
		$i=1;
		$htmlPopup="";
		foreach ($arrProds as $prod) {
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
								<img class="img-responsive" onclick="openItem(<?=$prod->id?>);" src="<?=$prod->urlFotoPpal?>" alt="" data-toggle="modal" data-target="#rbm_sldr_sc_m_mov_1_col_2"/>
								<!-- Item details -->
								<div class="shop-item-dtls">
									<!-- product title -->
									<h4><a data-toggle="modal" href="#rbm_sldr_sc_m_mov_1_col_2"><?=$prod->nombre?></a></h4>
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
			<div id="rbm_sldr_sc_m_mov_1_col_2" class="modal fade rbm_modal rbm_size_sldr_sc rbm_center rbm_bd_semi_trnsp rbm_bd_black rbm_blue rbm_bg_transp rbm_none_radius rbm_shadow_none  rbm_animate rbm_duration_vl rbmZoomIn rbm_easeOutQuint" role="dialog">
				<!-- Modal Dialog-->
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<!-- Close Button -->
						<a href="#" onclick="closePopup();" class="rbm_btn_x_out_shtr rbm_sq_txt_close rbm_sldr_sc_cl_btn" data-dismiss="modal">Cerrar</a>
						<!-- Slider -->
						<div id="rbm_sldr_sc_mov_1_col_2" class="carousel slide rbm_sldr_sc_gen rbm_sldr_sc_control two_columns swipe_x rbms_easeOutCirc" data-ride="carousel" data-pause="hover" data-interval="false" data-duration="1000">
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

<a data-toggle="modal" href="#rbm_banner_box_sm37" class="demo_modal_trigger" data-backdrop="true">ZoomIn</a>
<div id="rbm_banner_box_sm37" class="modal fade rbm_modal rbm_size_banner_box_sm rbm_center rbm_bd_dark_trnsp rbm_bd_black rbm_bg_black rbm_blue rbm_none_radius rbm_shadow_none rbm_animate rbm_duration_vl rbmZoomIn rbm_easeOutQuint" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<a href="#" class="rbm_btn_x_out_shtr rbm_bnr_close rbm_bnr_cl_btn" data-dismiss="modal"><span class="fa fa-times"></span></a>
			<div class="rbm_bnr_content">

				<div class="rbm_bnr_img rbm_bnr_box_sm_img">
					<img src="modal/images/rbm_banner_box_sm_01.jpg" alt="rbm_banner_box_sm_01">
				</div>
				<div class="rbm_bnr_txt rbm_bnr_box_sm_txt">

					<img src="modal/images/company_logo.png" alt="company_logo">
					<h1>main title of the banner</h1><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam nibh.</p>
					<a href="#" class="rbm_btn_x_out_shtr rbm_bnr_btn">learn more</a><span>www.envato.com</span>
				</div>
			</div>
		</div>
	</div>
</div>


	</div>
</div>