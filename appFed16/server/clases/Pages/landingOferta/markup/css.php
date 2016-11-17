<?if (false) {?><style><?}?>
<?="\n/*".get_class()."*/\n"?>
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
.logoLanding img{
	width: 100%;
}
.cuerpoOferta{
	/*background-position:center center;*/
	background-size: cover;
	background-repeat:no-repeat;
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
}
.promoH2{
	font-size: 30px;
    font-weight: 300;
    letter-spacing: -1px;
    line-height: 32px;
    color: @color-secundario;
}
.promoH3{
	font-size: 25px;
    font-weight: 300;
    letter-spacing: -1px;
    line-height: 27px;
    color: @color-terciario;
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