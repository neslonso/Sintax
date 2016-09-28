<?="\n<!-- ".get_class()." -->\n"?>
<?="\n<!-- /".get_class()." -->\n"?>
<nav class="navbar navbar-default navbar-fixed-top">
	<header id="container-cabecera">
		<div class="bandaSuperior navbar-fixed-top hidden-xs hidden-sm">
			Bienvenido a <?=$GLOBALS['config']->tienda->SITE_NAME?>, parafarmacia online. Distribución y venta online de las mejores marcas de laboratorios de farmacia y parafarmacia.
		</div>
		<div class="container-fluid container-cabecera-barraLogo">
			<div class="row vertical-align">
				<div class="col-xs-6 col-sm-4 col-md-3">
					<a href="./"><img class="img-responsive logo" src="./appFed16/binaries/imgs/shop-logo.jpg" alt=""></a>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-1">
					<a href="#menu-toggle" class="btn btn-default btn-menu" id="menu-toggle"><span class="glyphicon glyphicon-align-justify"></span></a>
				</div>
				<div class="hidden-xs col-sm-4 col-md-4">
					<div id="custom-search-input">
						<div class="input-group col-md-12">
							<form>
								<div class="typeahead__container">
									<div class="typeahead__field">
										<span class="typeahead__query">
											<input class="js-typeahead" name="q" type="search" autocomplete="off">
										</span>
										<span class="typeahead__button">
											<button type="submit">
												<span class="typeahead__search-icon"></span>
											</button>
										</span>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-4">
					<div id="divJqCesta"></div>
					<div id="navUserMenu" class="nav-user-menu">
						<div class="row">
                            <div class="col-lg-4">
                                <p class="text-center">
                                    <span class="glyphicon glyphicon-user nav-user-avatar"></span>
                                </p>
                            </div>
                            <div class="col-lg-8">
                                <p class="text-left"><strong><?=$cliente->nombre?></strong></p>
                                <p class="text-left small"><?=$cliente->email?></p>
                                <div class="row">
                                	<div class="col-xs-6">
                                		<a href="<?=BASE_URL?>mis_datos" class="btn btn-primary btn-block btn-sm">Editar</a>
                                	</div>
									<div class="col-xs-6">
										<a href="#" class="btn btn-danger btn-block btn-sm">Salir</a>
                                	</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                            	<div class="text-right"><b>Crédito de usuario disponible:</b></div>
                            </div>
                            <div class="col-sm-4">
                            	<div class="nav-user-menu-credito">
									<?=$cliente->saldo?>€
                            	</div>
                            </div>
                        </div>
<?
					if ($cliente->tipoDescuento>0){
?>
  						<div class="row">
                            <div class="col-sm-8">
								<div class="text-right"><b>Descuento aplicable al pedido:</b></div>
                            </div>
                            <div class="col-sm-4">
                            	<div class="text-center nav-user-menu-descuento">
                            		<?=$cliente->tipoDescuento?>% <span class="glyphicon glyphicon-arrow-down"></span>
                            	</div>
                            </div>
                        </div>
<?
					}
?>
					</div>
                    <a id="btnUserNav" href="#" class="btn btn-default btn-menu">
                        <span class="glyphicon glyphicon-user"></span>
                    </a>
				</div>
			</div>
		</div>
	</header>
</nav>
<div id="wrapper" class="toggled">
	<!-- Sidebar -->
	<div id="sidebar-wrapper">
		<div class="sidebar-top"></div>

		<div class="container-menu">
			<div class="hero">
				<div id="vertical" class="hovermenu ttmenu menu-color-gradient" style="">
					<div class="navbar navbar-default" role="navigation">
						<div class="navbar-collapse collapse in">
							<ul class="nav navbar-nav">
<?
						$x=0;
						foreach ($arrCatsRoots as $cat) {
?>
								<li class="dropdown ttmenu-full">
									<a href="#" data-toggle="dropdown" class="dropdown-toggle rootMenu" >
										<span class="rootMenu-ico" style="background-image:url('<?=$cat->ico?>'); background-position:<?=$x?>px 0px;"></span> <span class="txtMenuRoot"><?=$cat->nombre?> <b class="dropme"></b></span>
									</a>
									<ul class="dropdown-menu vertical-menu">
										<li>
											<div class="ttmenu-content">
												<div class="tabbable row">
													<div class="col-md-12">
														<div class="tab-content">
															<div id="tabs5-pane1" class="tab-pane active">
																<div class="row">
																	<div class="col-xs-12">
																		<div class="col-subMenu">
<?
																$arrCatsHijas=$this->subMenu($cat->id);
																foreach ($arrCatsHijas as $catH) {
																	$tieneHijos=(empty($catH->arrNietos))?false:true;

?>
																			<div class="box">
																				<ul style="display: inline-block;;">
																					<li>
<?
																					$imgCat="";
																					$imgProdsCat="";
																					if ($tieneHijos){
																						$x+=30;
																						$imgCat='<span style="background-image:url(\''.$cat->ico.'\'); background-position:'.$x.'px 0px;" class="img-cat-subMenu"></span>';
																					} else {
																						$imgProdsCat='
																							<div class="text-center">
																								<img src="'.$catH->img.'" alt="" class="img-responsive img-cat-subMenu">
																								<img src="'.$catH->img.'" alt="" class="img-responsive img-cat-subMenu">
																								<img src="'.$catH->img.'" alt="" class="img-responsive img-cat-subMenu">
																								<img src="'.$catH->img.'" alt="" class="img-responsive img-cat-subMenu">
																								<img src="'.$catH->img.'" alt="" class="img-responsive img-cat-subMenu">
																								<img src="'.$catH->img.'" alt="" class="img-responsive img-cat-subMenu">
																							</div>
																						';
																					}
?>
																						<h4><?=$imgCat?><?=$catH->nombre?></h4>
																						<?=$imgProdsCat?>
																					</li>
<?
																	if ($tieneHijos){
																		$i=1;
																		foreach ($catH->arrNietos as $nieto) {
?>
																					<li><a href="#"><?=$nieto->nombre?> <span class="fa fa-chevron-right"></span></a></li>
<?
																			if ($i==1){
?>
																				</ul>
																				<ul>
<?
																			}
																			$i++;
																		}
																	}
?>
																				</ul>
																			</div>
<?
																}
?>
																			<img src="<?=$cat->img?>" alt="" class="img-responsive">
																		</div>
																	</div>
																</div><!-- end row -->
															</div>
														</div><!-- /.tab-content -->
													</div><!-- end col -->
												</div><!-- /.tabbable -->
											</div><!-- end ttmenu-content -->
										</li>
									</ul>
								</li><!-- end mega menu -->
<?
							$x+=30;
						}
?>

							</ul><!-- end nav navbar-nav -->
						</div><!--/.nav-collapse -->
					</div><!-- end navbar navbar-default clearfix -->
				</div><!-- end menu 1 -->
			</div><!-- end hero -->
		</div><!-- /container -->


	</div>
	<!-- /#sidebar-wrapper -->
	<!-- Page Content -->
	<div id="page-content-wrapper">
		<?=$this->cuerpo()?>

		<div class="container-fluid" id="container-pie">
			<div class="row vertical-align">
				<div class="col-md-2">
					<img src="<?=BASE_DIR?>index.php?MODULE=images&almacen=IMGS_DIR&fichero=cofinanciado.xunta.png" alt="" class="img-responsive">
				</div>
				<div class="col-md-2">
					<img src="<?=BASE_DIR?>index.php?MODULE=images&almacen=IMGS_DIR&filtro=grayscale&fichero=visaMasterLogo.png" alt="" class="img-responsive">
				</div>
				<div class="col-md-1">
					<img src="<?=BASE_DIR?>index.php?MODULE=images&almacen=IMGS_DIR&filtro=grayscale&fichero=html5Logo.png" alt="" class="img-responsive">
				</div>
			</div>
		</div>
	</div>
	<!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->
<div id="divJqNotifications"></div>
