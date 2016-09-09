<?="\n<!-- ".get_class()." -->\n"?>
<?="\n<!-- /".get_class()." -->\n"?>
<nav class="navbar navbar-default navbar-fixed-top">
<header id="container-cabecera">
	<div class="container-fluid">
		<div class="row vertical-align">
			<div class="col-xs-6 col-sm-4 col-md-3">
				<img class="img-responsive logo" src="./appFed16/binaries/imgs/shop-logo.jpg" alt="">
			</div>
			<div class="col-xs-3 col-sm-2 col-md-1">
				<div><a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Menu</a></div>
			</div>
			<div class="hidden-xs col-sm-4 col-md-4">
				buscador
			</div>
			<div class="col-xs-3 col-sm-2 col-md-4">
				<div id="divJqCesta"></div>
				icons
			</div>
		</div>
	</div>
</header>
</nav>
<div id="wrapper" class="toggled">
	<!-- Sidebar -->
	<div id="sidebar-wrapper">
			menu
	</div>
	<!-- /#sidebar-wrapper -->
	<!-- Page Content -->
	<div id="page-content-wrapper">
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
								<img class="img-responsive" src="./appFed16/binaries/imgs/shop-item.jpg" alt="">
								<!-- Item details -->
								<div class="shop-item-dtls">
									<!-- product title -->
									<h4><a href="#">Lorem product</a></h4>
									<p>The examples above focused on using variables to control values in CSS rules</p>
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
				</div>
			</div>
		</div>
		<div class="container-fluid" id="container-pie">
			<div class="row">
				<div class="col-lg-12">
					footer
				</div>
			</div>
		</div>
	</div>
	<!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->