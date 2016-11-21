<?if (false) {?><style><?}?>
<?="\n/*".get_class()."*/\n"?>
body{
    background-image: url("<?=BASE_DIR?>index.php?MODULE=images&almacen=IMGS_DIR&fichero=landingOferta.<?=$GLOBALS['config']->tienda->key?>.jpg");
    /*añadir filtro al fondoo &filtro=opacity*/
    /*background-position:center center;*/
    background-size: cover !important;
    background-repeat:no-repeat;
}
/*** SCALING TEXT ****/
@selector:~'body';
/* These values are the minimum and maximum viewport sizes to apply the font scaling*/
@min_width: 300;
@max_width: 900;
/* These values represent the range of fon-tsize to apply
   These values effect the base font-size, headings and other elements will scale proportionally*/
@min_font: 11;
@max_font: 14;

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
.logoLanding img{
	width: 100%;
}
.cuerpoOferta{

}
.overlayBG{
	background: rgba(255, 255, 255, 0.55) none repeat scroll 0 0;
}
.promoH1{
	font-size: 2.5em;
    font-weight: 300;
    letter-spacing: -1px;
    line-height: 42px;
    color: @color-principal;
    text-shadow: 0 0 0.1em contrast(@color-principal);
}
.promoH2{
	font-size: 2em;
    font-weight: 300;
    letter-spacing: -1px;
    line-height: 32px;
    color: @color-secundario;
    text-shadow: 0 0 0.1em contrast(@color-secundario);
}
.promoH3{
	font-size: 1.5em;
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
    height: 350px;
    overflow-x: hidden;
    overflow-y: auto;
    padding:10px;
    background-color:rgba(255, 255, 255, 0.5) !important;
}
.tabResumen{
    height: 350px;
    overflow-x: hidden;
    overflow-y: auto;
    padding:0px !important;
}
.textoOferta {
    background-color: rgba(255, 255, 255, 0.49) !important;
    border-color: #fff !important;
    border-style: solid !important;
    border-width: 1px !important;
    margin-bottom: 5px !important;
    margin-top: 10px !important;
    padding-bottom: 20px !important;
    padding-top: 20px !important;
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
.panel{
    background-color:rgba(255, 255, 255, 0.5) !important;
    margin-bottom: 0px !important;
}
.panel-footer{
    background-color:rgba(245, 245, 245, 0.5) !important;
}
.footerLanding {
    font-size: 0.8em;
}
.footerLanding h3{
    font-size: 1.2em !important;
    text-align: center;
}