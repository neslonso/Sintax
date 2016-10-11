<?if (false) {?><style><?}?>
.banner-background{
	border-top-left-radius: 7px;
}
.banner-price{
 	padding: 10px;
    position: absolute;
    right: 0;
    text-align: right;
    top: 0;
    width: 60%;
    text-align: center;
}
.banner-price-antes{
	text-decoration: line-through;
	text-shadow: 2px 0 0 #000, -2px 0 0 #000, 0 2px 0 #000, 0 -2px 0 #000, 1px 1px #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
	font-size: 17px;
	color: #ccc;
}
.banner-price-ahora{
	color:#fff;
	text-shadow: 2px 0 0 @color-principal, -2px 0 0 @color-principal, 0 2px 0 @color-principal, 0 -2px 0 @color-principal, 1px 1px @color-principal, -1px -1px 0 @color-principal, 1px -1px 0 @color-principal, -1px 1px 0 @color-principal;
	font-size: 22px;
}
.banner-price-ahora-sinDescuento{
	margin-top: 20px;
	margin-bottom:7px;
}
.banner-price-comprar{
	background: @color-secundario none repeat scroll 0 0;
    border: 1px solid #ffffff;
    color: #ffffff !important;
    transition: all 0.35s ease-in 0s;
}
a.banner-price-comprar{
	color: #fff !important;
	transition: all 0.35s ease-in 0s;
}
a.banner-price-comprar:hover{
	background: @color-principal none repeat scroll 0 0;
}
.banner-price-descuento{
	margin-top: 5px;
	margin-bottom: 5px;
}
.banner-price-descuento > .badge{
	background-color: @color-principal !important;
	font-size: 18px !important;
}
.banner-txt{
	color: white;
	font: bold Helvetica, Sans-Serif;
	font-size: 20px;
	font-weight: bold;
	background: rgb(0, 0, 0);
	background: @color-banner-txt;
	padding: 5px;
	padding-top: 10px;
	border-bottom-left-radius: 7px;
	border-bottom-right-radius: 7px;
	bottom: 0px;
	position: absolute;
	width: 100%;
	text-overflow: ellipsis;
	overflow: hidden;
	white-space: nowrap;
	height: 49px;
	cursor:pointer;
}
.banner-txt > a{
	color: #fff !important;
}
