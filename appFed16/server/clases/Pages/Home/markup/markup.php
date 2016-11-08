<?="\n<!-- ".get_class()." -->\n"?>
<?="\n<!-- /".get_class()." -->\n"?>
<nav class="navbar navbar-default navbar-fixed-top">
	<header id="container-cabecera">
		<div class="bandaSuperior hidden-xs hidden-sm">
			<?=$GLOBALS['config']->tienda->BIENVENIDA?>
		</div>
		<div class="container-fluid container-cabecera-barraLogo">
			<div class="row vertical-align">
				<div class="hidden-xs col-sm-3 col-md-3">
					<a href="<?=BASE_URL?>"><img class="img-responsive logo" src="<?=$GLOBALS['config']->tienda->URL_LOGO?>" alt=""></a>
				</div>
				<div class="col-xs-2 col-sm-1">
					<a href="#menu-toggle" class="btn btn-default btn-menu" id="menu-toggle"><span class="glyphicon glyphicon-align-justify"></span></a>
					<?=$this->hueco1()->markup;?>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-4">
					<div class="input-group divBuscador">
						<input id="ssSearch" type="text" class="form-control" placeholder="Busca en <?=$GLOBALS['config']->tienda->SITE_NAME?>..." aria-describedby="térmnos de búsqueda">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</div>
				<div class="col-xs-4 col-sm-2 col-md-4">
					<div id="divJqCesta" data-arr-items="<?=$jsonArrCestaItems?>"></div>
					&nbsp;
<?
				if ($logueado){
					if ($cliente->nombre==""){
						//$nombreAvatar=substr($cliente->email, 0, strrpos($cliente->email, '@'));
						$nombreAvatar=$cliente->email[0];
					} else {
						$stringNombre=explode(" ",$cliente->nombre);
						$nombreAvatar=$stringNombre[0];
					}
					$nombreAvatarMin=strtoupper($nombreAvatar[0]);
?>
					<div class="btn-group" id="divBtnUserNav" role="group" aria-label="...">
						<button class="btnUserNav btn btn-primary btn-menu btn-menu-xs" type="button" data-toggle="tooltip" title="Área de usuario" data-placement="top" data-container="body">
							<span class="glyphicon glyphicon-user"></span>
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
										<a href="<?=BASE_URL?>mis_datos/" class="btn btn-primary btn-sm blanco"><span class="fa fa-pencil-square-o"></span> Editar</a>
										<a href="<?=BASE_URL?>mis_pedidos/" class="btn btn-primary btn-sm blanco"><span class="fa fa-shopping-cart"></span> Pedidos</a>
										<a title="Cerrar sesión" id="btnLogout" href="#" class="btn btn-danger btn-sm blanco"><span class="glyphicon glyphicon-log-out"></span> Salir</a>
									</div>
								</div>
							</div>
						</div>
					</div>
<?
				} else {
?>
					<div id="divBtnUserNav">
						<button class="btnUserNav btn btn-success btn-menu hidden-md hidden-lg btn-menu-xs" type="button" data-toggle="tooltip" title="Accede / Regístrate" data-placement="top" data-container="body">
							<span class="fa fa-user-plus"></span>
						</button>

						<div class="btn-group hidden-xs hidden-sm" role="group" aria-label="Acceso de cliente">
							<button class="btnUserNav btn btn-success btn-menu" type="button" data-toggle="tooltip" title="Accede / Regístrate" data-placement="top" data-container="body">
								<span class="fa fa-user-plus"></span>
							</button>
<?
					if ($activarFB){
?>
							<button class="FbLogin btn btn-primary btn-menu" type="button" disabled="disabled" data-toggle="tooltip" title="Accede con Facebook" data-placement="top" data-container="body">
								<span class="fa fa-facebook-square"></span>
							</button>
<?
					}
					if ($activarTW){
?>
							<button class="TwLogin btn btn-info btn-menu" type="button" data-toggle="tooltip" title="Accede con Twitter" data-placement="top" data-container="body">
								<span class="fa fa fa-twitter"></span>
							</button>
<?
					}
?>
						</div>
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
												<input  class="form-control" type="text" name="email" id="email" value="" placeholder="tucorreo@electronico.com" />
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
<?
					if ($activarFB){
?>
											<button class="FbLogin btn btn-primary btn-sm" type="button" disabled="disabled" data-toggle="tooltip" title="Accede con Facebook" data-placement="top" data-container="body">
												<span class="fa fa-facebook-square"></span>
											</button>
<?
					}
					if ($activarTW){
?>
											<button class="TwLogin btn btn-info btn-sm" type="button" data-toggle="tooltip" title="Accede con Twitter" data-placement="top" data-container="body">
												<span class="fa fa fa-twitter"></span>
											</button>
<?
					}
?>
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
		<div class="container-fluid container-cabecera-ticker">
			<ul id="cabecera-ticker">
				<?=$tickerContent?>
			</ul>
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
										<span class="rootMenu-ico" style="background-image:url('<?=$cat->img?>'); /*background-position:<?=$x?>px 0px;*/ background-size: contain;"></span> <span class="txtMenuRoot"><?=$cat->nombre?> <b class="dropme"></b></span>
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
																		<div class="tituloBox">
																			<a href="<?=$cat->url?>"><?=$cat->nombre?></a>
																		</div>
																		<div class="col-subMenu">
<?
																$arrCatsHijas=$this->subMenu($cat->id);
																foreach ($arrCatsHijas as $catH) {
																	$tieneHijos=(empty($catH->arrNietos))?false:true;
																	$boxClass=(empty($catH->arrNietos))?'noChild':'child';
?>
																			<div class="box <?=$boxClass?>">
																				<ul style="display: inline-block;;">
																					<li>
<?
																					$imgCat="";
																					$imgProdsCat="";
																					if ($tieneHijos) {
																						if (false) {
																							$x-=30;
																							$imgCat='<span style="background-image:url(\''.$cat->ico.'\'); background-position:'.$x.'px 0px;" class="img-cat-subMenu"></span>';
																						}
																					} else {
																						$imgProdsCat='<div>';
																						foreach ($catH->arrOfersMasVendidas as $oferMasVendida) {
																							$x-=30;
																							$imgProdsCat.='<span onclick="window.location=\''.BASE_URL.'prod/'.$oferMasVendida->imgId.'\'" style="cursor:pointer;background-image:url(\''.$cat->ico.'\'); background-position:'.$x.'px 0px;" data-toggle="tooltip" title="'.$oferMasVendida->nombre.'" data-placement="top" data-container="body" class="img-cat-subMenu"></span>';
																						}
																						$imgProdsCat.='</div>';
																					}
?>
																						<h4><a href="<?=$catH->url?>"><?=$imgCat?><?=$catH->nombre?></a></h4>
																						<?=$imgProdsCat?>
																					</li>
<?
																	if ($tieneHijos){
																		$i=1;
																		foreach ($catH->arrNietos as $nieto) {
?>
																					<li><a href="<?=$nieto->url?>"><?=$nieto->nombre?> <span class="fa fa-chevron-right"></span></a></li>
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
																			<div class="containerImgDecoCat"><img src="<?=$cat->img?>" alt="" class="img-responsive"></div>
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
			<footer>
				<div class="footer" id="footer">
					<div class="container-fluid">
						<div class="row">
							<div class="caracteristicas">
								<div class="col-lg-2  col-md-2 col-sm-4 col-xs-12">
									<h3><i class="fa fa-truck" aria-hidden="true"></i>  Entrega </h3>
									<ul>
										<li>Entrega: 24/48h </li>
										<li>Tarifa plana portes</li>
										<li>Seguimiento online del pedido</li>
									</ul>
								</div>
								<div class="col-lg-2  col-md-2 col-sm-4 col-xs-12">
									<h3><i class="fa fa-lock" aria-hidden="true"></i>  Pago seguro </h3>
									<ul>
										<li>Tarjeta, transferencia bancaria y contra reembolso</li>
										<li>Pago seguro via plataformas bancarias</li>
										<li>0% comisión contra reembolso</li>
									</ul>
								</div>
								<div class="col-lg-2  col-md-2 col-sm-4 col-xs-12">
									<h3><i class="fa fa-gavel" aria-hidden="true"></i>  Condiciones </h3>
									<ul>
										<li>Precios IVA incluído en euros</li>
										<li>Gastos de envío desglosados en cada pedido</li>
										<li>Fotos no contractuales</li>
										<li><a href="<?=BASE_URL?>aviso_legal/">Condiciones de Uso y Política de Privacidad</a></li>
									</ul>
								</div>
								<div class="col-lg-2  col-md-2 col-sm-4 col-xs-12">
									<h3><i class="fa fa-building" aria-hidden="true"></i>  Empresa </h3>
									<ul>
										<li><?=$GLOBALS['config']->tienda->EMPRESA->NOMBRE?></li>
										<li><a class="ellipsis" href="mailto:<?=$GLOBALS['config']->tienda->CONTACTO->EMAIL?>"><?=$GLOBALS['config']->tienda->CONTACTO->EMAIL?></a></li>
										<li><a href="tel:<?=$GLOBALS['config']->tienda->CONTACTO->TLF?>"><?=$GLOBALS['config']->tienda->CONTACTO->TLF?></a></li>
										<li><?=$GLOBALS['config']->tienda->EMPRESA->DIRECCION?></li>
										<li><?=$GLOBALS['config']->tienda->EMPRESA->CIF?></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-4  col-md-4 col-sm-6 col-xs-12 ">
								<h3><i class="fa fa-rss" aria-hidden="true"></i>  Suscríbete </h3>
								<ul>
									<li>
										<div class="input-append newsletter-box text-center">
											<p class="text-justify">Suscríbete a nuestro boletín y estarás informado de todas nuestras ofertas.</p>
											<form id="frmSuscribir">
												<div class="form-group">
													<div class="input-group">
														<span class="input-group-addon" id="spanAceptoSuscribir"  data-toggle="tooltip" title="Acepto las condiciones de uso" data-placement="top" data-container="body">
															<input type="checkbox" id="aceptoSuscribir" name="aceptoSuscribir" value="1">
														</span>
														<span class="input-group-addon"  data-toggle="tooltip" title="Ver las condiciones de uso" data-placement="top" data-container="body">
															<a href="<?=BASE_URL?>aviso_legal/"><i class="fa fa-gavel" aria-hidden="true"></i></a>
														</span>
														<input  class="form-control" type="text" name="emailSuscribir" id="emailSuscribir" value="" placeholder="tucorreo@electronico.com"  />
													</div>
												</div>
												<button type="button" id="btnSuscribir" class="btn btn-primary">
													 Enviar <i class="fa fa-long-arrow-right"> </i>
												</button>
											</form>
										</div>
									</li>
								</ul>
								<ul class="social">
<?
							if ($linkTiendaFB){
?>
									<li> <a href="<?=$GLOBALS['config']->tienda->SOCIAL->FB->URL?>"> <i class=" fa fa-facebook">   </i> </a> </li>
<?
							}
							if ($linkTiendaTW){
?>
									<li> <a href="<?=$GLOBALS['config']->tienda->SOCIAL->TW->URL?>"> <i class="fa fa-twitter">   </i> </a> </li>
<?
							}
?>
								<!--
									<li> <a href="#"> <i class="fa fa-google-plus">   </i> </a> </li>
									<li> <a href="#"> <i class="fa fa-pinterest">   </i> </a> </li>
									<li> <a href="#"> <i class="fa fa-youtube">   </i> </a> </li>
								-->
								</ul>
							</div>
						</div>
						<!--/.row-->
					</div>
					<!--/.container-->
				</div>
				<!--/.footer-->

				<div class="footer-bottom">
					<div class="container-fluid">
						<div class="pull-left footer-logoTienda">
							<a href="<?=BASE_URL?>">
								<img style="height:65px;" src="<?=$GLOBALS['config']->tienda->URL_LOGO?>" alt="<?=$GLOBALS['config']->tienda->key?>">
							</a>
							<!--© Nombretienda-->
						</div>
						<div class="pull-right footer-logos">
							<a href="http://xunta.es">
								<img src="<?=BASE_DIR?>index.php?MODULE=images&almacen=IMGS_DIR&alto=65&fichero=cofinanciado.xunta.png" alt="Xunta de Galicia">
							</a>
							<a href="javascript:void(null);">
								<img src="<?=BASE_DIR?>index.php?MODULE=images&almacen=IMGS_DIR&alto=65&fichero=visaMasterLogo.png" alt="Pago seguro">
							</a>
							<a href="javascript:void(null);">
								<img src="<?=BASE_DIR?>index.php?MODULE=images&almacen=IMGS_DIR&alto=65&fichero=html5Logo.png" alt="html5">
							</a>
							<a href="javascript:void(null);">
								<img src="<?=BASE_DIR?>index.php?MODULE=images&almacen=IMGS_DIR&alto=65&fichero=lib/dondominio_seals/ddsecure_70x70_white@3x.png" alt="Conexión cifrada">
							</a>
						</div>
					</div>
				</div>
				<!--/.footer-bottom-->
			</footer>
		</div>
	</div>
	<!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->
<div id="divJqNotifications"></div>
<ul id="contextMenu" class="dropdown-menu" role="menu" style="display:none; z-index: 9999;">
    <li><a tabindex="-1" href="<?=BASE_URL?>"><i class="fa fa-home"></i> <span class="option">Inicio</span></a></li>
<?
	if ($logueado){
?>
    <li><a tabindex="-1" href="<?=BASE_URL?>mis_datos/"><i class="fa fa-pencil-square-o"></i> <span class="option">Mis datos</span></a></li>
    <li><a tabindex="-1" href="<?=BASE_URL?>mis_pedidos/"><i class="fa fa-dropbox"></i> <span class="option">Mis pedidos</span></a></li>
<?
	} else {
?>
    <li><a tabindex="-1" href="<?=BASE_URL?>registro_usuario/"><i class="fa fa-plus"></i> <span class="option">Registrate</span></a></li>
<?
	}
?>
    <li class="divider"></li>
    <li class="comprar"><a tabindex="-1" href="<?=BASE_URL?>comprar_pedido/"><i class="fa fa-shopping-cart"></i> <span class="option">Comprar ahora</span></a></li>
</ul>