<?if (false) {?><style><?}?>
<?="\n/*".get_class()."*/\n"?>


/*********** DEFINICION DE VARIABLES ************/
@color-principal: #6c94be;
@color-secundario: #ff94be;

@color-body: #ebeced;
@color-txt: #333333;

@color-cabecera: #fff;
@color-cuerpo: #ebeced;
@color-sidebarMenu: #ccc;
@color-pie: @color-secundario;

@color-borde-items: #fff;
@color-bg-items: #fff;
@color-borde-items-over:@color-principal;
@color-btn-items:@color-principal;
@color-btn-items-border: #fff;
@color-btn-items-bg-font: #fff;
@color-btn-items-bg:@color-secundario;
@color-items-precio:@color-txt;

@width-menu: 250px;
@shop-item-container-fluid: 1170 + 17 + @width-menu; /*1170 del container + 17 de scroll*/

/*********** ZONAS GENERALES ************/
body {
    background-color: @color-body;
    color: @color-txt;
    margin-top: 115px; /* ajuste de cuerpo debido a navbar fixed */
}
#container-cabecera {
    background-color: @color-cabecera;
    border-top: 5px solid @color-principal;
    box-shadow: 0 3px 5px 0 rgba(0, 0, 0, 0.25);
    height: 115px;
}
#container-banners{
    height: 250px;
    background-color: @color-secundario;
}
#container-cabecera .logo{
    max-height: 110px;
}
#container-cuerpo {
    background-color: @color-cuerpo;
}
#container-pie {
    background-color: @color-pie;
}

/*
 * Row with equal height columns
 * --------------------------------------------------
 */
.row-eq-height {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display:         flex;
}
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
  align-items: center;     /* Align the flex-items vertically */
  justify-content: center; /* Optional, to align inner flex-items
                              horizontally within the column  */
}


/*********** WRAPPER MENU ************/
#wrapper {
    padding-left: @width-menu;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}
#wrapper.toggled {
    padding-left: 0px;
}
#sidebar-wrapper {
    z-index: 1000;
    position: fixed;
    left: @width-menu;
    width: @width-menu;
    height: 100%;
    margin-left: -@width-menu;
    overflow-y: auto;
    background: @color-sidebarMenu;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}
#wrapper.toggled #sidebar-wrapper {
    width: 0px;
}
#page-content-wrapper {
    width: 100%;
    position: realtive;
    /*padding: 15px;*/
}
#wrapper.toggled #page-content-wrapper {
    position: relative;
    margin-right: 0px;
}


/*********  LISTADO DE PRODUCTOS **********/
.shop-item {
    position: relative;
    max-width: 360px;
    margin: 15px auto;
    padding: 5px;
    text-align: center;
    border-radius: 4px;
    overflow: hidden;
    border:2px solid @color-borde-items;
    background-color: @color-bg-items;
    /*max-width: 200px;*/
}
.shop-item:hover{
    border:2px solid @color-borde-items-over;
}
.shop-item img {
    width: 100%;
    max-width: 360px;
    margin: 0 auto;
    /*border: 1px solid #eee;*/
    border-radius: 3px;
}
.shop-item .shop-item-dtls h4 {
    margin-top: 13px;
    margin-bottom: 10px;
    text-transform: uppercase;
}
.shop-item .shop-item-dtls .shop-item-price {
    display: block;
    margin-bottom: 13px;
    font-size: 24px !important;
    color: @color-items-precio;
}
.shop-item .shop-item-cart {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    padding-bottom:10px;
    padding-top: 10px;
    background-color: @color-btn-items;
    -webkit-transition: all 0.35s ease-in;
    -moz-transition: all 0.35s ease-in;
    -ms-transition: all 0.35s ease-in;
    -o-transition: all 0.35s ease-in;
    transition: all 0.35s ease-in;
}
.shop-item:hover .shop-item-cart {
    margin-top: -50px;
}
.shop-item .shop-item-cart  a.btn{
    border:1px solid @color-btn-items-border;
    color:@color-btn-items-bg-font;
    background:@color-btn-items-bg;
    -webkit-transition: all 0.35s ease-in;
    -moz-transition: all 0.35s ease-in;
    -ms-transition: all 0.35s ease-in;
    -o-transition: all 0.35s ease-in;
    transition: all 0.35s ease-in;
}
.shop-item .shop-item-cart  a.btn:hover{
    color:#fff;
    background:transparent;
}
.shop-item-rebote{
    background-image: url("./appFed16/binaries/imgs/shop-item-rebote.png");
    cursor: pointer;
    font-size: larger;
    height: 100px;
    position: absolute;
    right: -40px;
    top: -40px;
    width: 100px;
    z-index: 999;
}

@media(min-width:768px) {

    #wrapper {
        padding-left: @width-menu;
    }
    #wrapper.toggled {
        padding-left: 0;
    }
    #sidebar-wrapper {
        width: @width-menu;
    }
    #wrapper.toggled #sidebar-wrapper {
        width: 0;
    }
    #page-content-wrapper {
        position: relative;
    }
    #wrapper.toggled #page-content-wrapper {
        position: relative;
        margin-right: 0;
    }

}
/*  CESTA */
.content-cart{
    position: absolute;
    right: 0;
    height: 400px;
    width: 60%;
    background-color: @color-bg-items;
    /*opacity: 1;*/
    /*border: 1px solid @color-btn-items-border;*/

}

.link-cart{
    text-align: left;
    margin-top: 0px !important;
    clear: both;
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

@media (max-width: @shop-item-container-fluid){
    .shop-item-container {
        width:auto !important;
    }
}


