<?if (false) {?><style><?}?>

@color-principal:<?=$GLOBALS['config']->tienda->TEMA->COLOR_PRIMARIO?>;
/* obtenemos secundario y terciario*/
/*
triadricos: +-120;
split complementary: +-150;
analogos: +-30;
 */
@color-secundario:spin(@color-principal, 30);
@color-terciario:spin(@color-principal, -30);

/* obetenemos mediante mezcla "condicionada"*/
/*
@color-secundario : mix(@color-principal, mediumvioletred);
@color-terciario  : mix(@color-principal, mintcream);
*/
/* bootstrap theme */

@saturacion-principal : saturation(@color-principal);
@brillo-principal : lightness(@color-principal);
@hsvhue-principal : hsvhue(@color-principal); /*donde estamos en la rueda*/
@rojo-hue : hue(#ff0000);
@verde-hue : hue(#00ff00);
@naranja-hue : hue(#ff9900);

@color-secundario: hsl(@verde-hue, @saturacion-principal, @brillo-principal);
@color-terciario : hsl(@naranja-hue, @saturacion-principal, @brillo-principal);


/* links */
@color-hover   : lighten(@color-principal, 10%);
@color-focus   : darken(@color-principal, 10%);
@color-disable : lightness(desaturate(@color-principal, 100%), 30%);
html, body {}
body {}
/*Links*/
	a:link {color: rgb(142,11,0);text-decoration: none;}
	a:visited {color: rgb(142,11,0);}
	a:hover,a:focus {color: rgb(213,17,0);text-decoration:underline;}
	a:active {color: rgb(213,17,0);}
/**/
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
	color: @color-btn-items-bg-font;
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
	border-color: @color-btn-items-bg transparent transparent transparent;
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
/**/