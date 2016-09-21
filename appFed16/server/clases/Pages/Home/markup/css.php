<?if (false) {?><style><?}?>
<?="\n/*".get_class()."*/\n"?>


/*********** DEFINICION DE VARIABLES ************/
@color-principal: #ff94be;
@color-secundario: #6c94be;
@color-links: #304c71;
@color-links-hover: #6c94be;

@color-body: #fff;
@color-txt: #333333;

@color-cabecera: #fff;
@color-cuerpo: #ebeced;
@color-sidebarMenu: #fff;
@color-pie: #fff;

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


@zindex-sidebar: 1000;
@zindex-shop-item-rebote: 900;

/*********** ZONAS GENERALES ************/
body {
    background-color: @color-body;
    color: @color-txt;
    margin-top: 133px; /* ajuste de cuerpo debido a navbar fixed */
}
a{
    color: @color-links !important;
    text-decoration: none;
}
a:hover, a:focus {
    color: @color-links-hover !important;
    text-decoration: dotted;
}
.bandaSuperior{
    background-color: @color-principal;
    font-size: 12px;
    color: #fff;
    text-align: center;
}
.btn-menu{
    font-size: 20px !important;
}
#container-cabecera {
    background-color: @color-cabecera;
    box-shadow: 0 3px 5px 0 rgba(0, 0, 0, 0.25);
    height: 115px;
}
.container-cabecera-barraLogo{
    margin-top: 18px !important;
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
#container-pie img{
    margin: 10px;
}
.container-menu{
    padding-left: 0px !important;
    padding-right: 0px !important;
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


/******** buscador ********/
#custom-search-input {
    margin:0;
    padding: 0;
    width: 100%
}
#custom-search-input .search-query {
    padding-right: 3px;
    padding-right: 4px \9;
    padding-left: 3px;
    padding-left: 4px \9;
    /* IE7-8 doesn't have border-radius, so don't indent the padding */
    margin-bottom: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
#custom-search-input button {
    border: 0;
    background: none;
    /** belows styles are working good */
    padding: 2px 5px;
    margin-top: 2px;
    position: relative;
    left: -28px;
    /* IE7-8 doesn't have border-radius, so don't indent the padding */
    margin-bottom: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    color:@color-principal;
}
.search-query:focus + button {
    z-index: 3;
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
    z-index: @zindex-sidebar;
    position: fixed;
    left: @width-menu;
    width: @width-menu;
    height: 100%;
    margin-left: -@width-menu;
    overflow-y: auto;
    box-shadow: 0 -16px 10px 0 rgba(0, 0, 0, 0.15); /*-16 para quitar el borde inferior*/
    background: @color-sidebarMenu;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}
.sidebar-wrapper-scroll{
    /*clase para lograr hacer scroll*/
}
#wrapper.toggled #sidebar-wrapper {
    width: 0px;
}
#page-content-wrapper {
    width: 100%;
    position: realtive;
    /*padding: 15px;*/
    background-color: @color-cuerpo !important;
}
#wrapper.toggled #page-content-wrapper {
    position: relative;
    margin-right: 0px;
}
.sidebar-top{
    /*
    height: 5px;
    background-color: @color-principal;
    */
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
    color:@color-btn-items-bg-font !important;
    background:@color-btn-items-bg;
    -webkit-transition: all 0.35s ease-in;
    -moz-transition: all 0.35s ease-in;
    -ms-transition: all 0.35s ease-in;
    -o-transition: all 0.35s ease-in;
    transition: all 0.35s ease-in;
}
.shop-item .shop-item-cart  a.btn:hover{
    color:#fff !important;
    background:transparent;
}
.shop-item-rebote{
    background-image: url("./appFed16/binaries/imgs/shop-item-rebote.png");
    cursor: pointer;
    font-size: larger;
    height: 100px;
    position: absolute;
    right: -13px;
    top: -33px;
    width: 100px;
    z-index: @zindex-shop-item-rebote;
}
.shop-item-modal{
    padding: 5px;
    text-align: center;
    border-radius: 4px;
    border:2px solid @color-borde-items;
    background-color: @color-bg-items;
}
.shop-item-modal h1{
    font-size: 24px;
}
.shop-item-modal-price{
    color: @color-items-precio;
    font-size: 16px;
}
.rbm_form_cmrce_btn > button {
    background: @color-principal none repeat scroll 0 0 !important;
}
.rbm_sldr_sc_content > a{
    opacity: 1 !important;
    visibility: visible !important;
}
.rbm_sldr_sc_control .carousel-control{
    -webkit-transform: none !important;
    -ms-transform:  none !important;
    transform:  none !important;
}
.rbm_sldr_sc_control .carousel-control > span{
    -webkit-transform:  none !important;
    -ms-transform:  none !important;
    transform:  none !important;
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
        position: absolute;
    }
    #wrapper.toggled #sidebar-wrapper {
        width: 0;
        /*position: fixed !important;*/
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
@media (max-width: 767px){
    /**** menu****/
    #wrapper {
        padding-left: 0px !important;
    }
    #sidebar-wrapper {
        left: 0px !important;
        width:100%;
        margin-left: 0px;
        height: auto;
    }
    .sidebar-wrapper-scroll{
        position: inherit !important;
    }
    .shop-item {
        position: relative;
        max-width: 100% !important;
    }
}



/* XS y SM*/
@media (max-width: 991px){
    #container-cabecera {
        border-top: 5px solid @color-principal;
    }
    .container-cabecera-barraLogo{
        margin-top: 0px !important;
    }
    body {
        margin-top: 115px; /* ajuste de cuerpo debido a navbar fixed */
    }
}


@media (max-width: @shop-item-container-fluid){
    .shop-item-container {
        width:auto !important;
    }
}


