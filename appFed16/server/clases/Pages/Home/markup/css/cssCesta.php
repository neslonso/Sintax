<?if (false) {?><style><?}?>
@color-bg-cart: @color-bg-body;
@color-font-ttlItem:  #000000;
@color-font-unitItem:  #909090;
@color-font-priceItem:  #909090;
@color-bg-separatorItem:  #d3d3d3;
@color-bg-btnRemoveItem: @color-terciario;
@color-font-btnRemoveItem : #fff;
@color-bg-itemsCart: @color-bg-cuerpo;

/*  CESTA */
.contentCart{
	position: absolute;
	padding:13px;
	top: @height-container-cabecera-barraLogo + @height-ticker;
	right: -@width-cesta !important;
	width: @width-cesta !important;
	height: auto !important;
	border-top: 3px solid @color-principal;
	overflow: hidden;
	box-shadow: 0 5px 15px -3px rgba(0, 0, 0, 0.23);
	background-color: @color-bg-cart;
}

.badge.badgeCart {
	top:-7px;
	left:3px;
	box-shadow: 0 5px 15px -3px rgba(0, 0, 0, 0.23);
}
.contentCart .empty {
	padding:13px;
}

.itemsCart {
	max-height: 380px;
	overflow-x: hidden;
	overflow-y: auto;
	background-color: @color-bg-itemsCart;
	padding-right: 17px;
}

.separator-item{
	background-color: @color-bg-separatorItem;
	height: 1px;
	margin: 3px 0px 7px 0px;
}

.itemCart {
	font-size: small;
	padding: 7px;
}
.itemCart .ttl{
	font-variant: small-caps;
	white-space: nowrap;
	text-overflow: ellipsis;
	overflow: hidden;
	color: @color-font-ttlItem;
}

.itemCart .unit{
	color: @color-font-unitItem;
}
.itemCart img {
	border: solid @color-secundario 1px;
	background-color: #fff;
	border-radius: 3px;
}
.itemCart .price{
	font-size:larger;
	text-align: right;
	font-weight: bold;
	color: color-font-priceItem;
}

.itemCart .btn{
	border: 1px solid;
	background-color: @color-bg-btnRemoveItem;
	color: @color-font-btnRemoveItem !important;
}

/*.itemCart .unit .fuelux {
  width: 30%;
}*/
/*sustitucion fuelux spinbox*/
.itemCart .unit .inputUnit {
  width: 80% !important;
  margin: 4px;
}
/*estilos desplazamiento cesta*/
.contentCartInside {
	animation: lateralMoveIn 0.5s;
	animation-direction: alternate;
	animation-fill-mode: forwards;
	animation-timing-function: ease-in;
}
.contentCartOutside {
	animation: lateralMoveOut 0.5s;
	animation-direction: alternate-reverse;
	animation-timing-function: ease-in;
}
@keyframes lateralMoveIn {
	0% {
		transform: translate(0, 0);
	}
	100% {
		-ms-transform: translateX(-@width-cesta); /* IE 9 */
		-webkit-transform: translateX(-@width-cesta); /* Chrome, Safari, Opera */
		transform: translateX(-@width-cesta);
	}
}
@keyframes lateralMoveOut {
	0% {
		-ms-transform: translateX(0); /* IE 9 */
		-webkit-transform: translateX(0); /* Chrome, Safari, Opera */
		transform: translateX(0);
	}
	100% {
		-ms-transform: translateX(-@width-cesta); /* IE 9 */
		-webkit-transform: translateX(-@width-cesta); /* Chrome, Safari, Opera */
		transform: translateX(-@width-cesta);
	}
}
.contentCart .btn-comprar{
	background: @color-secundario none repeat scroll 0 0;
	border:1px solid lighten(@color-secundario,10%);
	color: contrast(@color-secundario) !important;
	transition: all 0.35s ease-in 0s;
}
.contentCart .btn-comprar:hover{
	background: lighten(@color-secundario, 10%) none repeat scroll 0 0;
	color:contrast(lighten(@color-secundario, 10%)) !important;
	border:1px solid @color-secundario;
}

/* LG */
@media (min-width: 1199px){

}
/* MD */
@media (min-width: 992px) and (max-width: 1199px){

}
/* SM */
@media (min-width: 768px) and (max-width: 991px){
}
/* XS */
@media (max-width: 768px){
}

/* XS */
@media (max-width: 399px){
	.contentCart{
		width: 350px  !important;
	}

}

/* XS */
@media (max-width: 349px){
	.contentCart{
		width: 300px  !important;
	}
	.itemCart .unit .inputUnit {
	  width: 90% !important;
	}

}