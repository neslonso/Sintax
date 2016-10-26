<?if (false) {?><style><?}?>
<?="\n/*".get_class()."*/\n"?>
/*********** DEFINICION DE VARIABLES DE NEGOCIO ************/
@color-cabecera: <?=$GLOBALS['config']->tienda->TEMA->COLOR_HEADER?>; /*bg de cabecera de web*/
@color-pie: <?=$GLOBALS['config']->tienda->TEMA->COLOR_FOOTER?>; /* bg footer*/
@color-txt: grayscale(@color-principal);
@color-bg-body: #fff; /*bg de la web (no del cuerpo de contenido central)*/
@color-bg-cuerpo: #e9ebee; /*bg zona central de cuerpo */
@color-bordes-contenedores: #a0a0a0; /*cajas contenedoras, fichas... etc*/
@color-bg-contenedores: @color-bg-body; /*bg de cajas contenedoras, fichas... etc*/
/**********************************************/

/* tamaños de zonas */
@width-menu: 250px;
@shop-item-container-fluid: 1170 + 17 + @width-menu; /*1170 del container + 17 de scroll*/
@width-root-txt-menu: @width-menu - 63; /*espacio para img ico, flecha, margenes*/
@zindex-sidebar: 1000;
@zindex-shop-item-rebote: 900;
@height-banner: 250px;
@width-cesta: 400px;
@height-banda-superior:18px;
@height-container-cabecera-barraLogo: 110px;
@height-ticker:35px;

/* definiciones secundarias */
@color-sidebarMenu: #fff; /*bg menu lateral*/
@color-banner-txt: @color-terciario;
@color-borde-items: @color-bordes-contenedores;
@color-bg-items: @color-bg-contenedores;
@color-borde-items-over:@color-principal;
@color-btn-items:@color-principal;
@color-btn-items-border: #fff;
@color-btn-items-bg-font: #fff;
@color-btn-items-bg:@color-secundario;
@color-items-precio:@color-txt;

/* Falta buscarles un sitio ***************************************************/
<?=$this->hueco1()->style?>;
.container-cabecera-ticker {
	position:absolute;
	bottom: 0px;
	width:100%;
	font-size:1.5em;
	background-color: contrast(lighten(@color-secundario,40%));
	font-family: monospace;
	color: lighten(@color-secundario,40%);
	padding: 0.17em 0em;
}
#cabecera-ticker {
	display: none;
	white-space: nowrap;
}
#cabecera-ticker li {
	cursor: default;
	margin-left:2em;
}
#cabecera-ticker li:hover {
	font-weight: bold;
}
#cabecera-ticker .gama {
	font-weight:bold;
}
#cabecera-ticker li small {
	font-size: 0.75em;
}

/**/
/* http://stackoverflow.com/questions/19288546/how-can-i-prevent-body-scrollbar-and-shifting-when-twitter-bootstrap-modal-dialo */
.modal-open {
	overflow: auto;
	padding-right: 0px !important;
}
/**/
/*********** ZONAS GENERALES ************/
body {
	background-color: @color-bg-body;
	color: @color-txt;
	margin-top: @height-banda-superior + @height-container-cabecera-barraLogo + @height-ticker; /* ajuste de cuerpo debido a navbar fixed */
}
a.blanco{
	color:#fff !important;
}
.bandaSuperior{
	background-color: @color-principal;
	color: contrast(@color-principal);
	font-size: 12px;
	text-align: center;
}
.btn-menu{
	font-size: 20px !important;
}
#container-cabecera {
	background-color: @color-cabecera;
	box-shadow: 0 3px 5px 0 rgba(0, 0, 0, 0.25);
	height: @height-banda-superior + @height-container-cabecera-barraLogo + @height-ticker;
}
.container-cabecera-barraLogo{
	/*margin-top: 18px !important;*/
}
#container-banners{
	height: @height-banner;
	background-color: @color-secundario;
}
#container-cabecera .logo{
	max-height: 110px;
}
#container-cuerpo {
	background-color: @color-bg-cuerpo;
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
.ellipsis{
	overflow: hidden;
	white-space: nowrap;
	text-overflow: ellipsis;
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
	background-color: @color-bg-cuerpo !important;
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
.highlight {
	color: @color-principal;
	font-size:1em;
	font-weight:bold;
}
#contextMenu{
	display:none;
	z-index: 9999;
}
#contextMenu .option{
    border-left: 1px solid greyscale(@color-principal);
    margin-left: 10px;
    padding-left: 10px;
}
#contextMenu .comprar .option{
    border-left: 1px solid contrast(@color-secundario) !important;
}
.dropdown-menu > li.comprar > a {
	background: @color-secundario !important;
	color: contrast(@color-secundario) !important;
}
.dropdown-menu > li.comprar > a:hover,
.dropdown-menu > li.comprar > a:focus {
	color: contrast(lighten(@color-secundario,10%)) !important;
    background: lighten(@color-secundario,10%) !important;
}
/*
#contextMenu > .comprar > a{
	color: contrast(@color-secundario) !important;
}
#contextMenu > .comprar > a:hover{
	color: contrast(lighten(@color-secundario,10%)) !important;
}*/
/* SM */
@media (min-width: 768px) and (max-width: 991px){
	#container-cabecera .logo{
		margin-top: 20px !important;
	}
}
/* XS */
@media (max-width: 767px){
	.btn-menu, .divBuscador{
		margin-top:30px;
	}
	.btn-menu-xs {
	    border-radius: 3px;
	    font-size: 12px;
	    line-height: 1.5;
	    padding: 1px 5px;
	}
}
