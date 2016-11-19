<?if (false) {?><style><?}?>
<?="\n/*".get_class()."*/\n"?>
/* Introducir estilos aquí */
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
.bandaSuperior{
	background-color: @color-principal;
	color: contrast(@color-principal);
	font-size: 12px;
	text-align: center;
}

<?="\n/*/".get_class()."*/\n"?>
