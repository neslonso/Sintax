<?if (false) {?><style><?}?>
<?="\n/*".get_class()."*/\n"?>
body{
    background-image: url("<?=BASE_DIR?>index.php?MODULE=images&almacen=IMGS_DIR&fichero=landingOferta.<?=$GLOBALS['config']->tienda->key?>.jpg");
    /*añadir filtro al fondoo &filtro=opacity*/
    /*background-position:center center;*/
    background-size: cover;
    background-repeat:no-repeat;
}
footer{
    background-color: #fff;
}
.logoLanding img{
	width: 100%;
}
.cuerpoOferta{

}
.overlayBG{
	background: rgba(255, 255, 255, 0.55) none repeat scroll 0 0;
}
.promoH1{
	font-size: 40px;
    font-weight: 300;
    letter-spacing: -1px;
    line-height: 42px;
    color: @color-principal;
    text-shadow: 2px 2px 1px rgba(255, 255, 255, 1);
}
.promoH2{
	font-size: 30px;
    font-weight: 300;
    letter-spacing: -1px;
    line-height: 32px;
    color: @color-secundario;
    text-shadow: 2px 2px 1px rgba(255, 255, 255, 1);
}
.promoH3{
	font-size: 25px;
    font-weight: 300;
    letter-spacing: -1px;
    line-height: 27px;
    color: @color-terciario;
}
.precio{
    font-size: 1.5em;
}
.tachado{
    text-decoration: line-through;
}
.tabOferta{
    height: 400px;
    overflow-x: hidden;
    overflow-y: auto;
    padding:10px;
}
.tabResumen{
    padding:0px !important;
}
.textoOferta {
    background-color: rgba(255, 255, 255, 0.49) !important;
    border-color: #fff !important;
    border-style: solid !important;
    border-width: 1px !important;
    margin-bottom: 20px !important;
    margin-top: 20px !important;
    padding-bottom: 40px !important;
    padding-top: 40px !important;
    box-shadow: 0 2px 30px 0 #fff inset;
}
.imgOferta{
    width: 100%;
}
.card-item-white{
    background: #ffffff;
    margin-bottom: 10px;
    padding: 10px;
    line-height: 38px;
}
/* colocamos triangulo descuento*/
.shop-item-dto{
    width: 70px;
    left: 10px;
    top: 10px;
    font-size: 1.8em;
}
.shop-item-dto-triangle{
    border-width: 70px 70px 0 0;
    left: 14px;
    top: 0px;
}
/*item image*/
.img-item{
    background-color: #ffffff;
    margin: 15px auto;
    overflow: hidden;
    padding: 5px;
    position: relative;
    text-align: center;
    /*min-height: 332px;*/
}
.img-item img{
    width: 100%;
}
