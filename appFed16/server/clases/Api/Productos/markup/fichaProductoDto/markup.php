					<div>
						<div class="banner-background" style="background:left top no-repeat url(<?=$imgSrc?>);">
							<div>
								<div class="banner-price">
<?
			if ($stdObjOfer->precioCatalogo!=$stdObjOfer->precio){
?>
									<div class="banner-price-antes">Antes: <?=$stdObjOfer->precioCatalogo?> €</div>
									<div class="banner-price-ahora">Ahora: <?=$stdObjOfer->precio?> €</div>
									<div class="banner-price-descuento"><span class="badge">- <?=$stdObjOfer->tipoDtoRespectoCatalogo?> %</span></div>
<?
			} else {
?>
									<div class="banner-price-ahora banner-price-ahora-sinDescuento">Comprar ahora: <?=$stdObjOfer->precio?> €</div>
<?
			}
?>
									<div>
										<a class="btn jqCst banner-price-comprar" data-id="<?=$stdObjOfer->id?>" data-ttl="<?=$stdObjOfer->nombre?>" data-unit="1" data-prc="<?=$stdObjOfer->precio?>" data-src="<?=$stdObjOfer->urlFotoPpal?>">Comprar</a>
									</div>
								</div>
								<div class="banner-txt"><a href="<?=BASE_URL?>prod/<?=$stdObjOfer->id?>"><?=$stdObjOfer->nombre?></a></div>
							</div>
						</div>
					</div>
