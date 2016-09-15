<div id="container-banners">

</div>
<div class="container shop-item-container" id="container-cuerpo">
	<div class="row">
		<div class="col-lg-12">
<?
		for ($i=0; $i < 12; $i++) {
			$rebote="";
			if ($i % 3 == 0) {$rebote = '<div class="shop-item-rebote"></div>';}
?>
			<div class="col-lg-2 col-md-3 col-sm-6">
				<div class="shop-item-wrapper">
					<!--Item -->
					<div class="shop-item">
						<!-- Item's image -->
						<img class="img-responsive" src="./appFed16/binaries/imgs/shop-item.jpg" alt="" data-toggle="modal" data-target="#rbm_sldr_sc_m_mov_1_col_4">
						<!-- Item details -->
						<div class="shop-item-dtls">
							<!-- product title -->
							<h4><a data-toggle="modal" href="#rbm_sldr_sc_m_mov_1_col_4" href="#">Lorem product above focused on using variables</a></h4>
							<!-- price -->
							<span class="shop-item-price">23.00€</span>
						</div>
						<!-- add to cart btn -->
						<div class="shop-item-cart">
							<a class="btn" href="#">Add to cart</a>
						</div>
					</div>
					<?=$rebote?>
				</div>
			</div>
<?
		}
?>
			<!-- Responsive Bootstrap Modal Popup -->
			<div id="rbm_sldr_sc_m_mov_1_col_4" class="modal fade rbm_modal rbm_size_sldr_sc rbm_center rbm_bd_semi_trnsp rbm_bd_black rbm_bg_transp rbm_blue rbm_none_radius rbm_shadow_none rbm_animate rbm_duration_md rbmFadeInDown rbm_easeOutQuint" role="dialog">
				<!-- Modal Dialog-->
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<!-- Close Button -->
						<a href="#" class="rbm_btn_x_out_shtr rbm_sq_txt_close rbm_sldr_sc_cl_btn" data-dismiss="modal">close</a>
						<!-- Slider -->
						<div id="rbm_sldr_sc_mov_1_col_4" class="carousel slide rbm_sldr_sc_gen rbm_sldr_sc_control four_columns swipe_x rbms_easeOutCirc" data-ride="carousel" data-pause="hover" data-interval="false" data-duration="2000">
							<!-- Header of Slider -->
							<div class="rbm_sldr_sc_header">
								<h1>our amazing products</h1>
							</div>
							<!-- /Header of Slider -->
							<!-- Wrapper For Slides -->
							<div class="carousel-inner" role="listbox">
<?
					for ($j=0; $j < 12; $j++) {
						$activo="";
						if ($j==4) {$activo = 'active';}
?>
								<!-- 1st Box -->
								<div class="item <?=$activo?>">
									<div class="col-xs-12 col-sm-6 col-md-6"> <!-- Grid -->
										<div class="rbm_sldr_sc_content rbm_sldr_sc_content_col shop-item-modal">
											<!-- Image -->
											<a href="http://fed16.farmaciacelorrio.com/index.php?page=prod"><img src="./appFed16/binaries/imgs/shop-item.jpg" alt="rbm_slider_showcase_01"></a>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris porttitor erat ac quam commodo, vitae ornare libero malesuada. Nam ultricies, felis sit amet faucibus facilisis, metus tellus dictum sem, id auctor eros risus sed tellus. Nullam iaculis lacus a ultricies gravida. Curabitur enim enim, elementum sit amet felis quis, lobortis pharetra mi. Phasellus id sem vehicula, iaculis neque id, ullamcorper magna. Mauris efficitur ullamcorper massa id cursus. Nunc sed egestas tortor. Integer lacus magna, tempor et fringilla ac, sodales non nunc.
											</p>
											<!-- Button -->
											<a href="http://fed16.farmaciacelorrio.com/index.php?page=prod" class="rbm_btn_x_out_shtr rbm_sldr_sc_btn rbm_sldr_sc_btn">view more</a>
										</div> <!-- /.rbm_sldr_sc_content -->
									</div> <!-- /Grid -->
								</div> <!-- /item -->
								<!-- End of 1st Box -->
<?
					}
?>
							</div> <!-- End of Wrapper For Slides -->
							<!-- Left Control -->
							<a class="left carousel-control" href="#rbm_sldr_sc_mov_1_col_4" role="button" data-slide="prev">
								<span class="fa fa-angle-left"></span>
							</a>
							<!-- Right Control -->
							<a class="right carousel-control" href="#rbm_sldr_sc_mov_1_col_4" role="button" data-slide="next">
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