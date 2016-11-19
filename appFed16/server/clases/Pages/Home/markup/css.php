<?if (false) {?><style><?}?>
<?="\n/*".get_class()."*/\n"?>
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
		/**********************************************************************************/
		/* Ribbon */
		@ribbon-width-height:160px;
		@ribbon-div-height:45px;
		.ribbonBox {
			position: relative;
		}
		.ribbon {
			position: absolute;
			z-index: 999999999999999999;
			overflow: hidden;
			width: @ribbon-width-height; height: @ribbon-width-height;
		}
		.ribbon.ribbon-topRight {
			right: 0px; top: 0px;
		}
		.ribbon.ribbon-bottomLeft {
			left: 0px; bottom: 0px;
		}
		.ribbon>div {
			position: absolute;
			color: #FFF;
			/*
			background: #79A70A;
			background: linear-gradient(#F79E05 0%, #8F5408 100%);
			*/
			background: linear-gradient(@color-principal 0%, @color-secundario 100%);
			box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
			transform: rotate(45deg);
			-webkit-transform: rotate(45deg);
			height: @ribbon-div-height;
			width: @ribbon-width-height*2;
		}
		.ribbon.ribbon-topRight>div {
			right:-@ribbon-width-height/2 - sin(45deg)*@ribbon-div-height/2;
			top: @ribbon-width-height/2 - @ribbon-div-height/2 - sin(45deg)*@ribbon-div-height/2;
		}
		.ribbon.ribbon-bottomLeft>div {
			right:-@ribbon-width-height/2 + sin(45deg)*@ribbon-div-height/2;
			top: @ribbon-width-height/2 - @ribbon-div-height/2 + sin(45deg)*@ribbon-div-height/2;
		}

		.ribbon>div>div {
			height:100%;
			width:@ribbon-width-height;
			margin:auto;
			text-align: center;
		}
		/**/
		.ribbon-publicidad-portes {
			color: contrast(@color-principal);
			line-height: @ribbon-div-height/2;
			font-weight: bold;
		}
		.ribbon-publicidad-portes>span:first-child {
			font-size:1.2em;
			animation: glowingTextShadow 2s ease infinite;
		}
		.ribbon-publicidad-portes>span:last-child {

		}
		@keyframes glowingTextShadow {
			0%{text-shadow: none;}
			50%{
				text-shadow:
					0 0 0.2em contrast(@color-principal),
					0 0 0.5em contrast(@color-principal),
					0 0 0.7em contrast(@color-principal),
					0 0 1.0em @color-principal,
					0 0 1.5em @color-principal,
					0 0 2.0em @color-principal,
					0 0 2.7em @color-principal,
					0 0 3.7em @color-principal;
		/*#fff
		#49ff18*/
			}
			100%{text-shadow: none;}
		}
		/** TLF **/
		#container-cabecera .divTlfMasdivBuscador {
			width:100%;
			position: relative;
		}
		#container-cabecera .divTlf {
			position:absolute;
			width:100%;
			text-align: center;
		}
		@media(min-width:768px) {
			#container-cabecera .divTlf {
				top:-100%;
			}
		}
		#container-cabecera .divTlf a {
			font-weight: 900;
		}
		/*** SCALING TEXT ****/
		@selector:~'#container-cabecera .divTlf a';
		/* These values are the minimum and maximum viewport sizes to apply the font scaling*/
		@min_width: 300;
		@max_width: 900;
		/* These values represent the range of fon-tsize to apply
		   These values effect the base font-size, headings and other elements will scale proportionally*/
		@min_font: 12;
		@max_font: 28;

		@{selector} { font-size: @min_font*1px; }

		@media (min-width: (@min_width*1px)) and (max-width: (@max_width*1px)){
			@{selector} {
				font-size: ~"calc("@min_font*1px ~"+ ("@max_font ~"-" @min_font~") * ( (100vw -" @min_width*1px~") / ("@max_width~"-" @min_width~") ))";
			}
		}
		@media (min-width: (@max_width*1px)){
			@{selector} {
				font-size: @max_font*1px;
			}
		}
		/*********************/
/******************************************************************************/

/*********** ZONAS GENERALES ************/
body {
	background-color: @color-bg-body;
	color: @color-txt;
	margin-top: @height-banda-superior + @height-container-cabecera-barraLogo + @height-ticker; /* ajuste de cuerpo debido a navbar fixed */
}
a.blanco{
	color:#fff !important;
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
