<?if (false) {?><style><?}?>
.nav-user-menu{
    position: absolute;
    top: 116px ;
    right: -300px !important;
    width: 300px !important;
    height: auto !important;
    border-top: 3px solid @color-principal;
    overflow: hidden;
    box-shadow: 0 5px 15px -3px rgba(0, 0, 0, 0.23);
    background-color: #fff;
    padding: 10px;
}
 .nav-user-panel{
 	margin-bottom: 0px;
 }
.nav-user-avatar{
    font-size: 43px;
}
.nav-user-menu-credito{
    background-image: url('<?=BASE_DIR?>index.php?MODULE=images&almacen=IMGS_DIR&filtro=grayscale&fichero=tarjetaAnverso.png&ancho=75');
    background-position: center;
    background-repeat: no-repeat;
    padding-top: 24px;
    padding-bottom: 10px;
    text-align: center;
    color: #fff;
    height: 52px;
    font-size: 17px;
}
.nav-user-menu-descuento{
    padding-top: 11px;
    font-size: 20px;
}
.nav-user-menu-descuento span{
    color: green;
}
 .nav-user-txt-info{
 	font-size: 12px;
 	font-weight: normal;
 	padding-top: 20px;
 }
.nav-user-menu-logunt{
    padding-top: 10px;
}
/*estilos desplazamiento menu user*/
.nav-user-menu-inside {
  animation: lateralMoveInMenu 0.5s;
  animation-direction: alternate;
  animation-fill-mode: forwards;
  animation-timing-function: ease-in;
}
.nav-user-menu-outside {
  animation: lateralMoveOutMenu 0.5s;
  animation-direction: alternate-reverse;
  animation-timing-function: ease-in;
}
@keyframes lateralMoveInMenu {
  0% {
    transform: translate(0, 0);
  }
  100% {
    -ms-transform: translateX(-300px); /* IE 9 */
    -webkit-transform: translateX(-300px); /* Chrome, Safari, Opera */
    transform: translateX(-300px);
  }
}
@keyframes lateralMoveOutMenu {
  0% {
    -ms-transform: translateX(0); /* IE 9 */
    -webkit-transform: translateX(0); /* Chrome, Safari, Opera */
    transform: translateX(0);
  }
  100% {
    -ms-transform: translateX(-300px); /* IE 9 */
    -webkit-transform: translateX(-300px); /* Chrome, Safari, Opera */
    transform: translateX(-300px);
  }
}