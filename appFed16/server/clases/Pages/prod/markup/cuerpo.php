<?="\n<!-- ".get_class()." -->\n"?>
<?="\n<!-- /".get_class()." -->\n"?>
<div class="container">
	<div class="row item-detail">
		<div class="col-xs-12 text-center">
			<h1>Lorem product above focused on using variables</h1>
		</div>
		<div class="col-xs-12 col-sm-6 text-center">
			<img src="./appFed16/binaries/imgs/shop-item.jpg" class="img-responsive">
		</div>
		<div class="col-xs-12 col-sm-6 text-center">
			<span class="shop-item-modal-price">23.00€</span>
			<div>
				<a class="btn btn-default" href="#">Comprar</a>
			</div>
		</div>
		<div class="col-xs-12">
			<?=file_get_contents('http://loripsum.net/api/3/long/headers');?>
		</div>
	</div>
</div>