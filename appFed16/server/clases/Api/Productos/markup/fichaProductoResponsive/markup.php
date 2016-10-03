<?
			//echo "<pre>".print_r($stdObjOfer,true)."</pre>";
			$rebote="";
			if($stdObjOfer->rebote>0){
				$zIndex=$stdObjOfer->index-1;
				$rebote = '<div class="shop-item-rebote" data-toggle="tooltip" title="Con la compra de '.$stdObjOfer->nombre.' recibirá el '.$stdObjOfer->rebote.'% de su importe como crédito para futuras compras" data-index="'.$zIndex.'"><div>'.$stdObjOfer->rebote.'%</div></div>';
			}
?>
					<div class="shop-item-wrapper" data-id="<?=$stdObjOfer->id?>" data-index="<?=($stdObjOfer->index)?>">
						<!--Item -->
						<div class="shop-item" data-toggle="tooltip" title="<?=$stdObjOfer->nombre?>" data-index="<?=($stdObjOfer->index)?>">
							<!-- Item's image -->
							<a class="shop-item-link">
								<img class="img-responsive imgOfer" src="<?=$stdObjOfer->urlFotoPpal?>" alt="" />
							</a>
							<!-- Item details -->
							<div class="shop-item-dtls">
								<!-- product title -->
								<h4><a class="shop-item-link"><div class="shop-item-name"><?=$stdObjOfer->nombre?></div></a></h4>
								<!-- product descripcion -->
								<div class="shop-item-desc"><?//=$stdObjOfer->descripcion?></div>
								<!-- price -->
								<span class="shop-item-price"><?=$stdObjOfer->precio?>€</span>
							</div>
							<!-- add to cart btn -->
							<div class="shop-item-cart">
								<a class="btn jqCst" data-id="<?=$stdObjOfer->id?>" data-ttl="<?=$stdObjOfer->nombre?>" data-unit="1" data-prc="<?=$stdObjOfer->precio?>" data-src="<?=$stdObjOfer->urlFotoPpal?>">Comprar</a>
							</div>
						</div>
						<?=$rebote?>
					</div>
