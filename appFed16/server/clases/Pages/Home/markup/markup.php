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
					<a href="<?=BASE_URL?>"><img class="img-responsive logo" src="<?=$GLOBALS['config']->tienda->URL_LOGO?>" alt=""></a>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-1">
					<a href="#menu-toggle" class="btn btn-default btn-menu" id="menu-toggle"><span class="glyphicon glyphicon-align-justify"></span></a>
				</div>
				<div class="hidden-xs col-sm-4 col-md-4">
					<form id="typeahead-form" name="typeahead-form" style="width:100%;">
						<div class="typeahead__container">
							<div class="typeahead__field">
								<span class="typeahead__query">
									<span class="typeahead__cancel-button"></span><input class="js-typeahead" name="q" type="search" placeholder="Busca en <?=$GLOBALS['config']->tienda->SITE_NAME?>..." autocomplete="off">
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
				<div class="col-xs-3 col-sm-2 col-md-4">
					<div id="divJqCesta" data-arr-items="<?=$jsonArrCestaItems?>"></div>
					&nbsp;
<?
				if ($logueado){
					if ($cliente->nombre==""){
						$nombreAvatar=substr($cliente->email, 0, strrpos($cliente->email, '@'));
						$nombreAvatarMin=strtoupper($nombreAvatar[0]);
					} else {
						$stringNombre=explode(" ",$cliente->nombre);
						$nombreAvatar=$stringNombre[0];
						$nombreAvatarMin=strtoupper($nombreAvatar[0]);
					}
?>
                    <div class="btn-group" role="group" aria-label="...">
	                    <button id="btnUserNav" class="btn btn-primary btn-menu" type="button" data-toggle="tooltip" title="Área de usuario" data-placement="top" data-container="body">
	                        <span class="glyphicon glyphicon-user"></span>
	                        <span class="badge visible-xs visible-sm"><?=$nombreAvatarMin?></span>
	                        <span class="badge hidden-xs hidden-sm"><?=$nombreAvatar?></span>
	                    </button>
	                </div>
					<div id="navUserMenu" class="nav-user-menu">
						<div class="panel panel-default nav-user-panel">
							<div class="panel-body">
								<div class="row">
		                            <div class="col-sm-3">
		                                <p class="text-center">
		                                    <span class="glyphicon glyphicon-user nav-user-avatar"></span>
		                                </p>
		                            </div>
		                            <div class="col-sm-9">
		                                <p class="text-left"><strong><?=$cliente->nombre?></strong></p>
		                                <p class="text-left small"><?=$cliente->email?></p>
		                            </div>
		                        </div>
		                        <hr>
		                        <div class="row">
		                            <div class="col-sm-7">
		                            	<div class="text-right nav-user-txt-info"><b>Crédito de usuario:</b></div>
		                            </div>
		                            <div class="col-sm-5">
		                            	<div class="nav-user-menu-credito">
											<?=$cliente->saldo?>€
		                            	</div>
		                            </div>
		                        </div>
<?
					if ($cliente->tipoDescuento>0){
?>
		  						<div class="row">
		                            <div class="col-sm-7">
										<div class="text-right nav-user-txt-info"><b>Descuento aplicable:</b></div>
		                            </div>
		                            <div class="col-sm-5">
		                            	<div class="text-center nav-user-menu-descuento">
		                            		<?=$cliente->tipoDescuento?>% <span class="glyphicon glyphicon-arrow-down"></span>
		                            	</div>
		                            </div>
		                        </div>
<?
					}
?>
							</div>
							<div class="panel-footer">
                                <div class="row">
                                	<div class="col-xs-12 text-right">
                                		<a href="<?=BASE_URL?>mis_datos" class="btn btn-primary btn-sm blanco"><span class="fa fa-pencil-square-o"></span> Editar</a>
                                		<a href="<?=BASE_URL?>mis_pedidos" class="btn btn-primary btn-sm blanco"><span class="fa fa-shopping-cart"></span> Pedidos</a>
										<a title="Cerrar sesión" id="btnLogout" href="#" class="btn btn-danger btn-sm blanco"><span class="glyphicon glyphicon-log-out"></span> Salir</a>
                                	</div>
                                </div>
                            </div>
						</div>
					</div>
<?
				} else {
?>
					<div class="btn-group" role="group" aria-label="...">
	                    <button id="btnUserNav" class="btn btn-success btn-menu" type="button" data-toggle="tooltip" title="Accede / Regístrate" data-placement="top" data-container="body">
	                        <span class="fa fa-user-plus"></span>
	                    </button>
	                    <button id="btnUserFB" class="btn btn-primary btn-menu" type="button" data-toggle="tooltip" title="Accede con Facebook" data-placement="top" data-container="body">
	                        <span class="fa fa-facebook-square"></span>
	                    </button>
	                    <button id="btnUserTW" class="btn btn-info btn-menu" type="button" data-toggle="tooltip" title="Accede con Twitter" data-placement="top" data-container="body">
	                        <span class="fa fa fa-twitter"></span>
	                    </button>
	                </div>
					<div id="navUserMenu" class="nav-user-menu">
						<div class="row">
							<div class="col-xs-12">
								<div class="panel panel-default nav-user-panel">
									<form id="frmLogin">
										<div class="panel-heading">
											Acceso a tienda
										</div>
										<div class="panel-body">
											<div class="form-group">
												<label for="email" accesskey="">Email: </label>
												<input  class="form-control" type="text" name="email" id="email" value="" placeholder="tuCorreo@electronico.com" />
											</div>
											<div class="form-group">
												<label for="pass" accesskey="">Contraseña:</label>
												<input class="form-control" type="password" name="pass" id="pass" value="" />
											</div>
										</div>
										<div class="panel-footer text-right">
											<a id="btnRegistro" href="<?=BASE_URL?>registro_usuario" class="btn btn-warning btn-sm blanco">
												<span class="glyphicon glyphicon-plus"></span> Registrate
											</a>
											<a id="btnLogin" href="#" class="btn btn-primary btn-sm blanco">
												<span class="glyphicon glyphicon-ok"></span> Entrar
											</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
<?
				}
?>

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
																						$x-=30;
																						$imgCat='<span style="background-image:url(\''.$cat->ico.'\'); background-position:'.$x.'px 0px;" class="img-cat-subMenu"></span>';
																					} else {
																						$imgProdsCat='<div class="text-center">';
																						foreach ($catH->arrOfersMasVendidas as $oferMasVendida) {
																							$x-=30;
																							$imgProdsCat.='<span style="background-image:url(\''.$cat->ico.'\'); background-position:'.$x.'px 0px;" data-toggle="tooltip" title="'.$oferMasVendida->imgId.'--'.$oferMasVendida->nombre.'" data-placement="top" data-container="body" class="img-cat-subMenu"></span>';
																						}
																						$imgProdsCat.='</div>';
																						//$imgProdsCat="<pre>".print_r($catH,true)."</pre>";
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
							$x-=30;
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
