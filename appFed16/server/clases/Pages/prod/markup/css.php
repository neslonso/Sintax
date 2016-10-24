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
/*item detail*/
.item-detail .shop-item-rebote {
    top:-4px;
    right: 29px;
}
.item-detail .shop-item-rebote > div {
    top: 23px;
}
.shop-item-dto{
    height: 50px;
    width: 50px;
    position: absolute;
    left: 0px;
    top: 0px;
    z-index: @zindex-shop-item-rebote+1;
    font-size: 11px;
    color: @color-btn-items-bg-font;
    -webkit-transform: rotate(-45deg);
    transform: rotate(-45deg);
    padding-top: 8px;
    font-weight: bold;
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
.price-ahora{
	color: rgba(205, 90, 145, 0.6);
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
    min-height: 332px;
}
.item-detail img{
	display: inline-block !important;

}
.item-detail .inputUnit {
  width: 50px;
  line-height: 10px;
}

/*relacionados*/
.item-relacionados{
    margin-top: 15px !important;
    margin-bottom: 15px !important;
}
.item-relacionados .text-muted{
    padding-left: 10px;
}

/*gama*/
.item-gama{
    margin-top: 15px !important;
    margin-bottom: 15px !important;
}
.item-gama .text-muted{
    padding-left: 10px;
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
}
