<?if (false) {?><style><?}?>
<?="\n/*".get_class()."*/\n"?>
/*********** DEFINICION DE VARIABLES ************/
@color-principal: #CD5A91; /*#ff94be*/
@color-secundario: #6c94be;
@color-links: #304c71;
@color-links-hover: #6c94be;

@color-body: #fff;
@color-txt: #333333;

@color-cabecera: #fff;
@color-cuerpo: #ebeced;
@color-sidebarMenu: #fff;
@color-pie: #fff;

@color-banner-txt: rgba(205, 90, 145, 0.6);

@color-borde-items: #a0a0a0;
@color-bg-items: #fff;
@color-borde-items-over:@color-principal;
@color-btn-items:@color-principal;
@color-btn-items-border: #fff;
@color-btn-items-bg-font: #fff;
@color-btn-items-bg:@color-secundario;
@color-items-precio:@color-txt;

@width-menu: 250px;
@shop-item-container-fluid: 1170 + 17 + @width-menu; /*1170 del container + 17 de scroll*/
@width-root-txt-menu: @width-menu - 63; /*espacio para img ico, flecha, margenes*/

@zindex-sidebar: 1000;
@zindex-shop-item-rebote: 900;

@height-banner: 250px;

/*********** ZONAS GENERALES ************/
body {
	background-color: @color-body;
	color: @color-txt;
	margin-top: 133px; /* ajuste de cuerpo debido a navbar fixed */
}
a{
	color: @color-links !important;
	text-decoration: none;
}
a:hover, a:focus {
	color: @color-links-hover !important;
	text-decoration: dotted;
}
a.blanco{
	color:#fff !important;
}
.bandaSuperior{
	background-color: @color-principal;
	font-size: 12px;
	color: #fff;
	text-align: center;
}
.btn-menu{
	font-size: 20px !important;
}
#container-cabecera {
	background-color: @color-cabecera;
	box-shadow: 0 3px 5px 0 rgba(0, 0, 0, 0.25);
	height: 115px;
}
.container-cabecera-barraLogo{
	margin-top: 18px !important;
}
#container-banners{
	height: @height-banner;
	background-color: @color-secundario;
}
#container-cabecera .logo{
	max-height: 110px;
}
#container-cuerpo {
	background-color: @color-cuerpo;
}
#container-pie {
	background-color: @color-pie;
	box-shadow: 0 -3px 5px 0 rgba(0, 0, 0, 0.25);
	margin-top: 10px;
}
#container-pie .img-responsive {
	margin:auto;
}
#container-pie img{
	margin: 10px;
}
/*
.nav > li > a{
	padding-left: 30px !important;
}
*/
.navbar-default .navbar-nav > li > a {
	padding-top: 15px !important;
}

/*
 * Row with equal height columns
 * --------------------------------------------------
 */
.row-eq-height {
	display: -webkit-box;
	display: -webkit-flex;
	display: -ms-flexbox;
	display:         flex;
}
/*
 * Vertical align de las cols hijas de un row.
 * Ademas, las cols ocupan mismo height que hermanas
 * --------------------------------------------------
 */
.vertical-align {
	display: flex;
	flex-direction: row;
}
.vertical-align > [class^="col-"],
.vertical-align > [class*=" col-"] {
	display: flex;
	align-items: center;		/* Align the flex-items vertically */
	justify-content: center;	/* Optional, to align inner flex-items
					horizontally within the column  */
}
/*********** WRAPPER general ************/
#wrapper {
	padding-left: @width-menu;
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
	transition: all 0.5s ease;
}
#wrapper.toggled {
	padding-left: 0px;
}
#sidebar-wrapper {
	z-index: @zindex-sidebar;
	position: fixed;
	left: @width-menu;
	width: @width-menu;
	height: 100%;
	margin-left: -@width-menu;
	overflow-y: auto;
	box-shadow: 0 -16px 10px 0 rgba(0, 0, 0, 0.15); /*-16 para quitar el borde inferior*/
	background: @color-sidebarMenu;
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
	transition: all 0.5s ease;
}
.sidebar-wrapper-scroll{
	/*clase para lograr hacer scroll*/
}
#wrapper.toggled #sidebar-wrapper {
	width: 0px;
}
#page-content-wrapper {
	width: 100%;
	position: realtive;
	/*padding: 15px;*/
	background-color: @color-cuerpo !important;
}
#wrapper.toggled #page-content-wrapper {
	position: relative;
	margin-right: 0px;
}
.sidebar-top{
	/*
	height: 5px;
	background-color: @color-principal;
	*/
}
