<?
//https://www.sessions.edu/color-calculator/
//https://color.adobe.com/es/create/color-wheel/
switch ($GLOBALS['config']->tienda->TEMA->ARMONIA) {
	case 'analogous': //3colores
?>
		@color-principal: <?=$GLOBALS['config']->tienda->TEMA->COLOR_PRIMARIO?>;
		@color-secundario: spin(@color-principal, 30);
		@color-terciario: spin(@color-principal, -30);
		@color-cuatro:	@color-terciario;
		@color-cinco:	@color-terciario;
<?
		break;
	case 'triadic': //3colores
?>
		@color-principal: <?=$GLOBALS['config']->tienda->TEMA->COLOR_PRIMARIO?>;
		@color-secundario: spin(@color-principal, 120);
		@color-terciario: spin(@color-principal, -120);
		@color-cuatro: @color-terciario;
		@color-cinco: @color-terciario;
<?
		break;
	case 'split': //3 colores
?>
		@color-principal: <?=$GLOBALS['config']->tienda->TEMA->COLOR_PRIMARIO?>;
		@color-secundario: spin(@color-principal, 150);
		@color-terciario: spin(@color-principal, -150);
		@color-cuatro: @color-terciario;
		@color-cinco: @color-terciario;
<?
		break;
	case 'tetradic': //4colores
?>
		@color-principal: <?=$GLOBALS['config']->tienda->TEMA->COLOR_PRIMARIO?>;
		@color-secundario: spin(@color-principal, 180);
		@color-terciario: spin(@color-principal, 90);
		@color-cuatro: spin(@color-principal, -90);
		@color-cinco: @color-cuatro;
<?
		break;
	case 'analogous+complementary': //4colores
?>
		@color-principal: <?=$GLOBALS['config']->tienda->TEMA->COLOR_PRIMARIO?>;
		@color-secundario: spin(@color-principal, 30);
		@color-terciario: spin(@color-principal, -30);
		@color-cuatro: spin(@color-principal, 180);
		@color-cinco: @color-cuatro;
<?
		break;
	case 'analogous+split': //5colores
?>
		@color-principal: <?=$GLOBALS['config']->tienda->TEMA->COLOR_PRIMARIO?>;
		@color-secundario: spin(@color-principal, 30);
		@color-terciario: spin(@color-principal, -30);
		@color-cuatro: spin(@color-principal, 150);
		@color-cinco: spin(@color-principal, -150);
<?
		break;
	case 'custom': //definido por el cliente
		try {
?>
		@color-principal: <?=$GLOBALS['config']->tienda->TEMA->COLOR_PRIMARIO?>;
		@color-secundario: <?=$GLOBALS['config']->tienda->TEMA->COLOR_SECUNDARIO?>;
		@color-terciario: @color-secundario;
		@color-cuatro: @color-secundario;
		@color-cinco: @color-secundario;
<?
		} catch (Exception $e) {
			throw new Exception("Hay que meter los colores de la web", 1);
		}
		break;
	default:
		throw new Exception("Hay que meter la armonia de color", 1);
		break;
}
?>

/* links */
@color-hover   : lighten(@color-principal, 10%);
@color-focus   : darken(@color-principal, 10%);
@color-disable : lightness(desaturate(@color-principal, 100%), 30%);

/*
@sombra: darken(@color-principal, 10%);
@luz: lighten(@color-principal, 30%);
@color-principal-saturado: saturate(@color-principal, 30%);
@color-principal-desaturado: desaturate(@color-principal, 40%);
@color-principal-fade: fade(@color-principal,50%);
@color-principal-grey: greyscale(@color-principal);
*/

<?if (false) {?><style><?}?>

html, body {}
body {}
/*Links*/
a:link {color: @color-principal;text-decoration: none;}
a:visited {color: @color-principal;}
a:hover,a:focus {color: lighten(@color-principal, 10%);text-decoration:underline;}
a:active {color: lighten(@color-principal, 10%);}

/* bootstrap theme */
@saturacion-principal : saturation(@color-principal);
@brillo-principal : lightness(@color-principal);
@hsvhue-principal : hsvhue(@color-principal); /*donde estamos en la rueda*/
@rojo-hue : hue(#ff0000);
@verde-hue : hue(#00ff00);
@naranja-hue : hue(#ff9900);
@color-danger: hsl(@rojo-hue, @saturacion-principal, @brillo-principal);
@color-success: hsl(@verde-hue, @saturacion-principal, @brillo-principal);
@color-warning : hsl(@naranja-hue, @saturacion-principal, @brillo-principal);
.btn-warning{
	background-color: @color-warning !important;
	color: contrast(@color-warning) !important;
	border-color: lighten(@color-warning,10%) !important;
}
.btn-success{
	background-color: @color-success !important;
	color: contrast(@color-success) !important;
	border-color: lighten(@color-success,10%) !important;
}
.btn-warning:hover{
	background-color: lighten(@color-warning,10%) !important;
	color: contrast(lighten(@color-warning,10%)) !important;
	border-color: @color-warning !important;
}
.btn-success:hover{
	background-color: lighten(@color-success,10%) !important;
	color: contrast(lighten(@color-success,10%)) !important;
	border-color: @color-success !important;
}

*::-moz-selection{
   background: @color-secundario;
   color: contrast(@color-secundario);
}
*::selection {
   background: @color-secundario;
   color: contrast(@color-secundario);
}

/* estilos rebote */
.shop-item-rebote{
	background-image: url("./appFed16/binaries/imgs/shop-item-rebote.png");
	background-size: cover;
	cursor: pointer;
	height: 60px;
	width: 60px;
	position: absolute;
	right: 9px;
	top: -7px;
	z-index: @zindex-shop-item-rebote;
}
.shop-item-rebote > div{
	font-family: arial;
	font-size: small;
	font-weight: bold;
	padding-left: 6px;
	position: absolute;
	text-align: center;
	top: 33px;
	width: 100%;
}
/*estilos triangulo dto*/
.shop-item-dto{
	position: absolute;
	z-index: @zindex-shop-item-rebote+1;
	font-size: 1.5em;
	color: contrast(@color-secundario);
	-webkit-transform: rotate(-45deg);
	transform: rotate(-45deg);
	font-weight: bold;
	text-align: center;
	height: 50px;
	width: 50px;
	left: 2px;
	top: 3px;
}
.shop-item-dto-triangle{
	width: 0;
	height: 0;
	border-style: solid;
	border-width: 50px 50px 0 0;
	border-color: @color-secundario transparent transparent transparent;
	position: absolute;
	left: 0px;
	top: 0px;
	z-index: @zindex-shop-item-rebote;
}
/*Stamp*/
.stamp {
	width: auto;
	height: auto;
	display: inline-block;
	padding: 10px;
	background: white;
	position: relative;
	-webkit-filter: drop-shadow(0px 0px 10px rgba(0,0,0,0.5));
	/*The stamp cutout will be created using crisp radial gradients*/
	background: radial-gradient(
		transparent 0px,
		transparent 4px,
		#000 4px,
		#000
	);
	background: radial-gradient(
		transparent 0px,
		transparent 4px,
		@color-principal 7px,
		@color-principal 10px,
		#fff 10px,
		#fff
	);

	/*reducing the gradient size*/
	background-size: 20px 20px;
	/*Offset to move the holes to the edge*/
	background-position: -10px -10px;
	cursor:default;
}
.stamp:after {
	content: '';
	position: absolute;
	/*We can shrink the pseudo element here to hide the shadow edges*/
	left: 5px; top: 5px; right: 5px; bottom: 5px;
	/*Shadow - doesn't look good because of the stamp cutout. We can still move this into another pseudo element behind the .stamp main element*/

	/*box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.5);*/
	/*pushing it back*/
	z-index: -1;
}
.stampRotate {
	-ms-transform: rotate(-30deg); /* IE 9 */
	-webkit-transform: rotate(-30deg); /* Chrome, Safari, Opera */
	transform: rotate(-30deg);
}

.stroke {
	color: white;
	text-shadow:
	-1px -1px 0 #000,
	1px -1px 0 #000,
	-1px 1px 0 #000,
	1px 1px 0 #000;
}
.stamp>div {
	display:table-cell;
	vertical-align:middle;
	text-align:center;
	width:100%;
	height:100%;
	background-color: #f0f0f0;
}