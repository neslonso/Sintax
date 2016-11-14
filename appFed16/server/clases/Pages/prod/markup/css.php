<?if (false) {?><style><?}?>
<?="\n/*".get_class()."*/\n"?>
.item-detail{
	margin-top: 15px !important;
	margin-bottom: 15px !important;
}
.card-item-white{
	background: #ffffff;
	margin-bottom: 3px;
	padding: 10px;
	line-height: 38px;
}
.text-muted{
	/*color: #bababa;*/
	/*padding-left: 20px;*/
}
.cajaRefEan{
	line-height: 18px;
}
/*colocamos rebote*/
.item-detail .shop-item-rebote {
	top:-16px;
	right: 7px;
	height: 80px;
	width: 80px;
}
.item-detail .shop-item-rebote > div {
	top: 35px;
}
/* colocamos triangulo descuento*/
.item-detail .shop-item-dto{
	width: 100px;
	left: 9px;
	top: 23px;
	font-size: 2.5em;
}
.item-detail .shop-item-dto-triangle{
	border-width: 100px 100px 0 0;
	left: 14px;
	top: 0px;
}
.price-ahora{
	color: @color-principal;
	font-size: 28px;
	line-height: 20px;
}
.price-antes{
	font-size: 25px;
	line-height: 20px;
	text-decoration: line-through;
}
.price-descuento{
	font-size: 25px;
	line-height: 20px;
	text-decoration: line-through;
}
.price-descuento .badge{
	background-color: #cd5a91 !important;
	font-size: 18px !important;
}


/*item image*/
.item-detail .img-item{
	background-color: #ffffff;
	margin: 15px auto;
	overflow: hidden;
	padding: 5px;
	position: relative;
	text-align: center;
	/*min-height: 332px;*/
}
.item-detail img{
	display: inline-block !important;

}
.item-detail .inputUnit {
  width: 50px;
  line-height: 10px;
}

/*relBlocks*/
.relBlock {
	margin-top: 15px !important;
	margin-bottom: 15px !important;
}
.relBlock .text-muted{
	padding-left: 10px;
}
.relBlock .swiper-slide, {
	width:250px;
}

/*descripcion*/
.item-desc{
	margin-top: 15px !important;
	margin-bottom: 15px !important;
}
.item-desc .text-muted{
	padding-left: 10px;
}
.item-desc .item-desc-text{
	padding: 10px;
	max-height: 400px;
	overflow-x: hidden;
	overflow-y: auto;
	line-height: 150%;
}
/* swiper-button */
.swiper-button-container {
	position: relative;
	width:100%;
	height:100%;
}

.swiper-button-container .swiper-button {
	left: auto;
	right: auto;
	margin:auto;
	top:auto;
	width:100%;
	height:100%;
	background-color: #fff;
	border: solid #c0c0c0 1px;
}
.swiper-button-container .swiper-button-prev {
	box-shadow: -1px -1px 7px 0px rgba(0,0,0,0.75);
}
.swiper-button-container .swiper-button-next {
	box-shadow: 1px -1px 7px 0px rgba(0,0,0,0.75);
}
.swiper-button-container .swiper-button:active {
	box-shadow: none;
}
.swiper-button-container .swiper-button:active {
	box-shadow: none;
}
.swiper-button-container .swiper-button:hover {
	background-color: @color-principal;
}
.swiper-button-container .swiper-button:hover {
	background-color: @color-principal;
}