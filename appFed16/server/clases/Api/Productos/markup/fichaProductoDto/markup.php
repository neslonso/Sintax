					<div>
						<div class="banner-background" style="background:left top no-repeat url(<?=$imgSrc?>);">
							<div>
								<div class="banner-price">
<?
			if ($stdObjOfer->tipoDtoRespectoCatalogo>0){
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
										<?=\Sintax\ApiService\Productos::btnComprar($stdObjOfer,'banner-price-comprar');?>
										<!--<a class="btn jqCst banner-price-comprar" data-id="<?=$stdObjOfer->id?>" data-ttl="<?=$stdObjOfer->nombre?>" data-unit="1" data-prc="<?=$stdObjOfer->precio?>" data-src="<?=$stdObjOfer->urlFotoPpal?>">Comprar</a>-->
									</div>
								</div>
								<div onclick="window.location='<?=$stdObjOfer->url?>'" class="banner-txt"><a href="<?=$stdObjOfer->url?>"><?=$stdObjOfer->nombre?></a></div>
							</div>
						</div>
					</div>
