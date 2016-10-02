<div id="container-banners">
	<div class="swiper-container">
		<div class="swiper-wrapper">
<?
		foreach ($arrOfersMayorDescuento as $stdObjOfer) {
			$idFotoProd=rand(1,33);//$objProd->idFoto0();
			$imgSrc=$stdObjOfer->urlFotoPpal.'&modo='.(Imagen::OUTPUT_MODE_SCALE | Imagen::OUTPUT_MODE_ROTATE_H | Imagen::OUTPUT_MODE_ROTATE_V);
			$precioCatalogo=30;
			$precioOferta=20;
			$tipoDtoRespectoCatalogo=33.3;
?>
				<div class="swiper-slide">
					<div>
						<div style="background:center no-repeat url(<?=$imgSrc?>);">
							<div>
								<span style="font-size:x-large;"><?=$stdObjOfer->nombre?></span>
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
			<div class='row'>
<?
		$i=1;
		foreach ($arrOfersMasVendidas as $prod) {
			//echo "<pre>".print_r($prod,true)."</pre>";
			$rebote="";
			//$rebote = '<div class="shop-item-rebote"></div>';
?>
				<div class="col-lg-2 col-md-3 col-sm-6">
					<div class="shop-item-wrapper" data-id="<?=$prod->id?>" data-index="<?=($i-1)?>">
						<!--Item -->
						<div class="shop-item" data-toggle="tooltip" title="<?=$prod->nombre?>" data-index="<?=($i-1)?>">
							<!-- Item's image -->
							<a class="shop-item-link">
								<img class="img-responsive imgOfer" src="<?=$prod->urlFotoPpal?>" alt="" />
							</a>
							<!-- Item details -->
							<div class="shop-item-dtls">
								<!-- product title -->
								<h4><a class="shop-item-link"><div class="shop-item-name"><?=$prod->nombre?></div></a></h4>
								<!-- price -->
								<span class="shop-item-price"><?=$prod->precio?>€</span>
							</div>
							<!-- add to cart btn -->
							<div class="shop-item-cart">
								<a class="btn jqCst" data-id="<?=$prod->id?>" data-ttl="<?=$prod->nombre?>" data-unit="1" data-prc="<?=$prod->precio?>" data-src="<?=$prod->urlFotoPpal?>">Comprar</a>
							</div>
						</div>
						<?=$rebote?>
					</div>
				</div>
<?
			if ($i%6==0){echo '<div class="clearfix visible-lg"></div>';}
			if ($i%4==0){echo '<div class="clearfix visible-md"></div>';}
			if ($i%2==0){echo '<div class="clearfix visible-sm"></div>';}
			$i++;
		}
?>
			</div>
		</div>
	</div>
</div>

<div class="hiddenSwiper" style="display:none;">
	<div class="ofersPageSwiperContainer">
		<div class="swiper-wrapper">
<?
		$i=0;
		foreach ($arrOfersMasVendidas as $prod) {
?>
				<div class="swiper-slide">
					<div class="shop-item-wrapper" data-id="<?=$prod->id?>" data-index="<?=($i-1)?>">
						<!--Item -->
						<div class="shop-item" data-index="<?=($i-1)?>">
							<!-- Item's image -->
							<a class="shop-item-link">
								<img class="img-responsive imgOfer" src="<?=$prod->urlFotoPpal?>" alt="" />
							</a>
							<!-- Item details -->
							<div class="shop-item-dtls">
								<!-- product title -->
								<h4><a class="shop-item-link"><div class="shop-item-name"><?=$prod->nombre?></div></a></h4>
								<!-- price -->
								<span class="shop-item-price"><?=$prod->precio?>€</span>
							</div>
							<!-- add to cart btn -->
							<div class="shop-item-cart">
								<a class="btn jqCst" data-id="<?=$prod->id?>" data-ttl="<?=$prod->nombre?>" data-unit="1" data-prc="<?=$prod->precio?>" data-src="<?=$prod->urlFotoPpal?>">Comprar</a>
							</div>
						</div>
						<?=$rebote?>
					</div>
				</div>
<?
		}
?>
		</div>
		<!-- If we need pagination -->
		<!--<div class="swiper-pagination"></div>-->

		<!-- If we need navigation buttons -->
		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>

		<!-- If we need scrollbar -->
		<!--<div class="swiper-scrollbar"></div>-->
	</div>
</div>
