<?="\n<!-- ".get_class()." -->\n"?>
<header id="header" class=" ">
	<div class="bandaSuperior">
		<?=$GLOBALS['config']->tienda->BIENVENIDA?>
	</div>
	<div class="container">
		<div class="row vertical-align">
			<div class="col-xs-12 col-sm-3">
				<div class="logoLanding" class="">
					<a href="<?=BASE_URL?>">
						<img src="<?=$GLOBALS['config']->tienda->URL_LOGO?>" alt="">
					</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-9">
				<div class="textwidget">
					<strong>Solicita información:</strong>
					<a href="mailto:">informacion@.com</a>
					<a href="tel:+34 ">+34 </a>
				</div>
			</div>
		</div>
	</div>
</header>

<section class="cuerpoOferta" style="background-image: url('<?=$objOferta->imgSrc(0, 800, 800)?>');">
	<div class="overlayBG">
		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-1 text-center">
					<h1 class="promoH1"><?=$objOferta->GETnombre()?></h1>
					<h2 class="promoH2">Ahora por <?=$objOferta->pvp()?>€</h2>
				</div>
			</div>
			<div class="row textoOferta">
				<div class="col-sm-3">
					portes gratis etc
				</div>
				<div class="col-sm-6">
					<div><h3 class="promoH3"><?=$objOferta->GETnombre()?></h3></div>
<?
				$descripcion = nl2br($objOferta->GETdescripcion());
?>
					<div><p><?=trim($descripcion)?></p></div>
				</div>
				<div class="col-sm-3">
					<div>mas movidillas del producto</div>
					<div>btn comprar..</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?="\n<!-- /".get_class()." -->\n"?>
