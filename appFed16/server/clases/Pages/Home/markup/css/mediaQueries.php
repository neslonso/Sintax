<?if (false) {?><style><?}?>
@media(min-width:768px) {
	#wrapper {
		padding-left: @width-menu;
		position: relative;
		z-index: 29;
	}
	#wrapper.toggled {
		padding-left: 0;
	}
	#sidebar-wrapper {
		width: @width-menu;
		position: absolute;
	}
	#wrapper.toggled #sidebar-wrapper {
		width: 0;
		/*position: fixed !important;*/
	}
	#page-content-wrapper {
		position: relative;
	}
	#wrapper.toggled #page-content-wrapper {
		position: relative;
		margin-right: 0;
	}
}
/* LG */
@media (min-width: 1199px){
}
/* MD */
@media (min-width: 992px) and (max-width: 1199px){
	.col-subMenu{
		-moz-column-count: 2;
		-webkit-column-count: 2;
		column-count: 2;
	}
	#vertical .navbar-default .navbar-nav li .vertical-menu {
		max-width: 700px !important;
	}
}
/* SM */
@media (min-width: 768px) and (max-width: 991px){
	#vertical .navbar-default .navbar-nav li .vertical-menu {
		max-width: 500px !important;
	}
}
/* XS */
@media (max-width: 767px){
	/**** menu****/
	#wrapper {
		padding-left: 0px !important;
	}
	#sidebar-wrapper {
		left: 0px !important;
		width:100%;
		margin-left: 0px;
		height: auto;
	}
	.sidebar-wrapper-scroll{
		position: inherit !important;
	}
	.shop-item {
		position: relative;
		max-width: 100% !important;
	}
	.footer-logoTienda{
		text-align: center !important;
	}
	.footer-logos{
		text-align: center !important;
	}
}
/* XS y SM*/
@media (max-width: 991px){
	#container-cabecera {
		border-top: 5px solid @color-principal;
	}
	.container-cabecera-barraLogo{
		margin-top: 0px !important;
	}
	body {
		margin-top: 115px; /* ajuste de cuerpo debido a navbar fixed */
	}
	.col-subMenu{
		-moz-column-count: 1;
		-webkit-column-count: 1;
		column-count: 1;
	}
    .nav-user-menu{
        top: 112px !important;
    }
}
@media (max-width: @shop-item-container-fluid){
	.shop-item-container {
		width:auto !important;
	}
}