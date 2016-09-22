<?="\n<!-- ".get_class()." -->\n"?>
<?="\n<!-- /".get_class()." -->\n"?>
<nav class="navbar navbar-default navbar-fixed-top">
<header id="container-cabecera">
	<div class="bandaSuperior navbar-fixed-top hidden-xs hidden-sm">
		Bienvenido a Farmaciacelorrio.com, parafarmacia online. Distribución y venta online de las mejores marcas de laboratorios de farmacia y parafarmacia.
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
                        <input type="text" class="  search-query form-control" placeholder="Busca en nuestra tienda..." />
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="button">
                                <span class=" glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
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
        <div class="sidebar-top"></div>

    	<div class="container container-menu">
        	<div class="hero">
    			<div id="vertical" class="hovermenu ttmenu menu-color-gradient" style="">
                    <div class="navbar navbar-default" role="navigation">
                        <div class="navbar-collapse collapse in">
                            <ul class="nav navbar-nav">
<?
                        foreach ($arrCatsRoots as $cat) {
?>
                                <li class="dropdown ttmenu-full">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?=$cat->nombre?> <b class="dropme"></b>
                                    </a>
                                    <ul id="first-menu" class="dropdown-menu vertical-menu">
                                        <li>
                                            <div class="ttmenu-content">
                                                <div class="tabbable row">
                                                    <div class="col-md-12">
                                                        <div class="tab-content">
                                                            <div id="tabs5-pane1" class="tab-pane active">
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                                        <div class="box">
                                                                            <ul>
                                                                                <li><h4>FONT ICON SUPPORT</h4></li>
                                                                                <li><a href="#">Web Design <span class="fa fa-laptop"></span></a></li>
                                                                                <li><a href="#">Web Development <span class="fa fa-gears"></span></a></li>
                                                                                <li><a href="#">Graphic Design <span class="fa fa-leaf"></span></a></li>
                                                                                <li><a href="#">IOS & ANDROID <span class="fa fa-android"></span></a></li>
                                                                                <li><a href="#">Logo Design <span class="fa fa-pencil"></span></a></li>
                                                                                <li><a href="#">Mockup Design <span class="fa fa-maxcdn"></span></a></li>
                                                                                <li><a href="#">e-Commerce <span class="fa fa-shopping-cart"></span></a></li>
                                                                                <li><a href="#">Digital Marketing <span class="fa fa-desktop"></span></a></li>
                                                                                <li><a href="#">SEO Services <span class="fa fa-area-chart"></span></a></li>
                                                                            </ul>
                                                                        </div><!-- end box -->
                                                                    </div><!-- end col -->

                                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                                        <div class="box">
                                                                            <ul>
                                                                                <li><h4>WHY CHOOSE TT MENU</h4></li>
                                                                                <li><a href="#">Responsive Layout</a></li>
                                                                                <li><a href="#">Retina Display Ready</a></li>
                                                                                <li><a href="#">Tons of Icons</a></li>
                                                                                <li><a href="#">Gradient Colors</a></li>
                                                                                <li><a href="#">Beginner Friendly</a></li>
                                                                                <li><a href="#">Detailed Documentation</a></li>
                                                                                <li><a href="#">100% Bootstrap Base</a></li>
                                                                                <li><a href="#">HTML5 CSS3</a></li>
                                                                                <li><a href="#">And Much More...</a></li>
                                                                            </ul>
                                                                        </div><!-- end box -->
                                                                    </div><!-- end col -->
                                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                                        <img src="./appFed16/binaries/imgs/shop-item.jpg" alt="" class="img-responsive">
                                                                    </div><!-- end col -->
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
