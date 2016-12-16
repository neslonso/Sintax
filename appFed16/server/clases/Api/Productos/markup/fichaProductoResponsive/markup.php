<?
			//echo "<pre>".print_r($stdObjOfer,true)."</pre>";
			$rebote="";
			if($stdObjOfer->rebote>0){
				$zIndex=$stdObjOfer->index-1;
				$rebote = '<div class="shop-item-rebote" data-toggle="tooltip" data-placement="bottom" title="Con la compra de '.$stdObjOfer->nombre.' recibirá el '.$stdObjOfer->rebote.'% de su importe como crédito para futuras compras" data-index="'.$zIndex.'"><div>'.$stdObjOfer->rebote.'%</div></div>';
			}
			$dto="";
			$precio=$stdObjOfer->precio."€";
			if ($stdObjOfer->tipoDtoRespectoCatalogo>0){
				$dto='<div class="shop-item-dto-triangle"></div><div class="shop-item-dto">-'.$stdObjOfer->tipoDtoRespectoCatalogo.'%</div>';
				$precio='<span class="shop-item-price-antes">'.$stdObjOfer->precioCatalogo."€</span>
						<span> ".$stdObjOfer->precio."€</span>";
			}
			$infoDtoGama='';
			if (isset($stdObjOfer->gama)) {
				$infoDtoGama='<div class="shop-item-dto-gama">
					<div class="stamp stampRotate" data-toggle="tooltip" data-placement="bottom" title="Desuento en toda la gama '.$stdObjOfer->gama->nombre.'"><div>-'.$stdObjOfer->gama->tipoDescuentoGama.'%</div></div></div>';
			}
			if (!isset($stdObjOfer->tooltip)) {$stdObjOfer->tooltip=$stdObjOfer->nombre;}
?>
					<div class="shop-item-wrapper" data-id="<?=$stdObjOfer->id?>"
						data-referencia="<?=$stdObjOfer->referencia?>"
						data-nombre="<?=$stdObjOfer->nombre?>"
						data-categoria="<?=$stdObjOfer->categoria?>"
						data-this-class="<?=get_class($this)?>"
						data-index="<?=($stdObjOfer->index)?>"
						data-img-src="<?=$stdObjOfer->urlFotoPpal?>"
						data-descripcion="<?=htmlentities(strip_tags($stdObjOfer->descripcion),ENT_QUOTES,"UTF-8")?>"
						data-precio="<?=$stdObjOfer->precio?>">
						<div class="shop-item" data-toggle="tooltip" title="<?=$stdObjOfer->tooltip?>" data-index="<?=($stdObjOfer->index)?>">
							<div class="shop-item-data">
								<div class="shop-item-img">
									<a class="shop-item-link">
										<img class="img-responsive" src="<?=$stdObjOfer->urlFotoPpal?>" alt="" />
									</a>
								</div>
								<div class="shop-item-dtls">
									<h4><a class="shop-item-link"><div class="shop-item-name"><?=$stdObjOfer->nombre?></div></a></h4>
									<span class="shop-item-price"><?=$precio?></span>
								</div>
								<div class="shop-item-desc"><?=strip_tags($stdObjOfer->descripcion)?></div>
							</div>
							<div class="shop-item-cart">
								<?=\Sintax\ApiService\Productos::btnComprar($stdObjOfer,'','','Comprar');?>
								<?=\Sintax\ApiService\Productos::btnMasInfo($stdObjOfer,'shop-item-btn-info','');?>
							</div>
							<?=$dto?>
						</div>
						<?=$rebote?>
						<?=$infoDtoGama?>
					</div>
